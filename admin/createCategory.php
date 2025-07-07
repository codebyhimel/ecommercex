<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    if (isset($_REQUEST['submit'])) {
        $sql = 'INSERT INTO `category`(`name`, `description`, `img_url`, `isactive`) VALUES (?,?,?,?)';
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $img_url);
        $stmt->bindParam(4, $status);
        $name = $_REQUEST['name'];
        $description = $_REQUEST['description'];
        $status = $_REQUEST['isActive'];

        // Upload File
        $dir = "uploads/";
        $filename = $dir . $_FILES['img_url']['name'];
        if (move_uploaded_file($_FILES['img_url']['tmp_name'], $filename)) {
            $image = "uploads/" . $_FILES['img_url']['name'];
        } else {
            $image = "";
        }
        $img_url =  $image;
        $stmt->execute();
        $msg = "Category Insert Success!";
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
                    <h2 class="font-weight-bold text-6">Create Category</h2>

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
                                <div class="form-group">
                                    <label class="" for="name">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder=" Category name">
                                </div>
                                <div class="form-group">
                                    <label class="" for="description">description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="description">
                                </div>
                                <div class="form-group">
                                    <label class="" for="img_url">Image</label>
                                    <input type="file" name="img_url" class="form-control" id="img_url" placeholder="img_url">
                                </div>
                                <div class="form-group">
                                    <label for="isActive">Status</label>
                                    <select name="isActive" id="isActive" class="form-control">
                                        <option value="">~~Select~~</option>
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