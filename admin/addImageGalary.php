<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $product_id = $_GET['product_id'] ?? null;
    if (!$product_id) {
        header('Location: productsList.php');
        exit;
    }

    // Handle multiple file upload
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img_url'])) {
        $uploadDir = "uploads/gallery/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileCount = count($_FILES['img_url']['name']);
        $success = 0;

        for ($i = 0; $i < $fileCount; $i++) {
            $tmpName = $_FILES['img_url']['tmp_name'][$i];
            $originalName = $_FILES['img_url']['name'][$i];

            if (!empty($originalName)) {
                $filename = time() . '_' . uniqid() . '_' . basename($originalName);
                $filepath = $uploadDir . $filename;

                if (move_uploaded_file($tmpName, $filepath)) {
                    $sql = "INSERT INTO product_gallery (product_id, img_url) VALUES (?, ?)";
                    $stmt = $db->dbHandler->prepare($sql);
                    $stmt->execute([$product_id, $filepath]);
                    $success++;
                }
            }
        }

        $_SESSION['msg'] = "$success image(s) uploaded successfully.";
        header("Location: addImageGalary.php?product_id=$product_id");
        exit;
    }

    // Fetch gallery images
    $sql = "SELECT * FROM product_gallery WHERE product_id = ?";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute([$product_id]);
    $gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="body">
    <?php include_once('./partials/header.php'); ?>
    <div class="inner-wrapper">
        <?php include_once('./partials/sidebar.php'); ?>
        <section role="main" class="content-body content-body-modern">
            <header class="page-header page-header-left-inline-breadcrumb">
                <h2 class="font-weight-bold text-6">Product Gallery</h2>
            </header>
            <div class="row">
                <div class="col">
                    <div class="card card-modern">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="img_url" class="form-label">Upload Images</label>
                                    <input type="file" class="form-control" name="img_url[]" id="img_url" multiple required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload Images</button>
                            </form>
                            <?php if (isset($_SESSION['msg'])): ?>
                                <div class="alert alert-success mt-3"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
                            <?php endif; ?>
                            <hr>
                            <h5>Gallery Images</h5>
                            <div class="row">
                                <?php foreach ($gallery as $img): ?>
                                    <div class="col-md-3 text-center mb-3">
                                        <img src="<?= $img['img_url'] ?>" class="img-fluid border" height="120">
                                        <form method="post" action="deleteGalleryImage.php" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="id" value="<?= $img['id'] ?>">
                                            <input type="hidden" name="img_path" value="<?= $img['img_url'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger mt-2">Delete</button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<?php include_once('./partials/footer.php'); ?>
<?php } else {
    header('Location: login.php');
} ?>
