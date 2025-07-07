<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    if (isset($_REQUEST['category_id'])) {
        $sql = "SELECT * FROM `category` WHERE `id` = :categoryId ";
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam('categoryId', $_REQUEST['category_id']);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_REQUEST['submit'])) {
        $sql = 'UPDATE `category` SET `name`=:name,`description`=:description,`img_url`=:img_url, `isActive`=:isActive  WHERE `id` = :id';
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':img_url', $image);
        $stmt->bindParam(':isActive', $isActive);

        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $description = $_REQUEST['description'];
        $isActive = $_REQUEST['isActive'];

        if (!empty($_FILES['img_url']) && $_FILES['img_url']['name'] != "") {
            // var_dump($_FILES['img_url']);
            if ($_REQUEST['oldImage'] != null) {
                unlink("/" . $_REQUEST['oldImage']);
            }
            $dir = "uploads/";
            $filename = $dir . $_FILES['img_url']['name'];
            if (move_uploaded_file($_FILES['img_url']['tmp_name'], $filename)) {
                $image = "uploads/" . $_FILES['img_url']['name'];
            } else {
                $image = "";
            }
        } else {
            $image = $_REQUEST['oldImage'];
        }
        // var_dump($_FILES['image']);

        $stmt->execute();
        $msg = "Category Update Success!";
        header("location:categoryIndex.php");
    }
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
                    <h2 class="font-weight-bold text-6">Edit Category</h2>

                </header>

                <!-- start: page -->
                <div class="row">
                    <div class="col-12">
                        <section class="card">
                            <div class="card-body p-5">
                                <?php
                                if ($msg != null) {
                                    echo $msg;
                                }
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                    <div class="form-group">
                                        <label class="" for="name">Category Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="subTitle" value="<?= $data['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="description">description</label>
                                        <input type="text" name="description" class="form-control" id="description" placeholder="description" value="<?= $data['description']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="img_url">img_url</label>
                                        <input type="file" name="img_url" class="form-control" id="img_url">
                                        <img src="./<?php echo $data['img_url']; ?>" alt="!" height="50">
                                        <input type="hidden" name="oldImage" value="<?php echo $data['img_url']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="isActive">Status</label>
                                        <select name="isActive" id="isActive" class="form-control">
                                            <option value="">~~Select~~</option>
                                            <option value="1" <?php if ($data['isActive'] == 1) {
                                                                    echo "selected";
                                                                } ?>>Active</option>
                                            <option value="0" <?php if ($data['isActive'] == 0) {
                                                                    echo "selected";
                                                                } ?>>Deactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Update</button>
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