<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    if (isset($_POST['submit'])) {
        try {
            // Upload featured image
            $feat_img = null;
            if (isset($_FILES['img_url']) && $_FILES['img_url']['error'] === 0) {
                $targetDir = "uploads/products/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES["img_url"]["name"]);
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($_FILES["img_url"]["tmp_name"], $targetFile)) {
                    $feat_img = $fileName;
                }
            }

            $sql = "INSERT INTO `product`(`name`, `short_desc`, `long_desc`, `add_info`, `ship_info`, `why_us`, `price`, `discount`, `is_featured`, `is_new`, `is_flash`, `flash_price`, `flash_start`, `flash_end`, `feat_img`, `cat_id`, `brand_id`, `is_active`, `created_at`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

            $stmt = $db->dbHandler->prepare($sql);

            $stmt->execute([
                $_POST['name'],
                $_POST['short_desc'],
                $_POST['long_desc'],
                $_POST['add_info'],
                $_POST['ship_info'],
                $_POST['why_us'],
                $_POST['price'],
                $_POST['discount'],
                $_POST['is_featured'],
                $_POST['is_new'],
                $_POST['is_flash'],
                $_POST['flash_price'],
                $_POST['flash_start'],
                $_POST['flash_end'],
                $feat_img,
                $_POST['cat_id'],
                $_POST['brand_id'],
                $_POST['is_active']
            ]);

            $msg = "Product inserted successfully.";
            $msg_type = "success";
        } catch (PDOException $e) {
            $msg = "Failed to insert product.";
            $msg_type = "danger";
        }
    }
    //Query for Category
    $sql = "SELECT * FROM category where isActive = 1";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Query For Brand
    $sql = "SELECT * FROM brand where isActive = 1";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $brand = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <!-- Meta File End -->
    <section class="body">

        <!-- start: header -->
        <?php
        include_once('./partials/header.php');
        ?>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php
            include_once('./partials/sidebar.php');
            ?>
            <!-- end: sidebar -->

            <section role="main" class="content-body content-body-modern">
                <header class="page-header page-header-left-inline-breadcrumb">
                    <h2 class="font-weight-bold text-6">Create Products</h2>

                </header>
                <?php if (!empty($msg)): ?>
                    <div class="alert alert-<?php echo $msg_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $msg; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <!-- start: page -->
                <div class="row">
                    <div class="col-12">
                        <section class="card">

                            <div class="card-body p-5">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Products Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="short_desc">Short Description</label>
                                        <input type="text" name="short_desc" class="form-control" id="short_desc">
                                    </div>
                                    <div class="form-group">
                                        <label for="long_desc">Long Description</label>
                                        <textarea name="long_desc" class="form-control" id="long_desc" rows="30"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_info">Additional Info</label>
                                        <textarea name="add_info" class="form-control" id="add_info"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ship_info">Shipping Info</label>
                                        <textarea name="ship_info" class="form-control" id="ship_info"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="why_us">Why Choose Us</label>
                                        <textarea name="why_us" class="form-control" id="why_us"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Discount (%)</label>
                                        <input type="number" name="discount" class="form-control" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Is Featured?</label>
                                        <select name="is_featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_new">Is New?</label>
                                        <select name="is_new" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_flash">Flash Sale?</label>
                                        <select name="is_flash" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="flash_price">Flash Price</label>
                                        <input type="number" name="flash_price" class="form-control" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="flash_start">Flash Start</label>
                                        <input type="datetime-local" name="flash_start" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="flash_end">Flash End</label>
                                        <input type="datetime-local" name="flash_end" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="img_url">Featured Image</label>
                                        <input type="file" name="img_url" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cat_id">Category</label>
                                        <select name="cat_id" class="form-control">
                                            <option value="">~~Select~~</option>
                                            <?php
                                            foreach ($category as $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            <!-- Populate dynamically -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Brand</label>
                                        <select name="brand_id" class="form-control">
                                            <option value="">~~Select~~</option>
                                            <?php
                                            foreach ($brand as $value) {
                                            ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            <!-- Populate dynamically -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>


                            </div>
                        </section>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>


    </section>


    <?php
    include_once('./partials/footer.php');
    ?>

<?php
} else {
    header('location: http://localhost/ecoomercex/admin/login.php');
}
?>