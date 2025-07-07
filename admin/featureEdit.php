<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    if (isset($_REQUEST['edit_id'])) {
        $sql = "SELECT * FROM `featured` WHERE `id` = :id ";
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam('id', $_REQUEST['edit_id']);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($data);
    }

    if (isset($_REQUEST['submit'])) {
        $sql = 'UPDATE `featured` SET `title`=:title,`content`=:content,`button_title`=:button_title,`button_url`=:button_url,`image`=:image,`is_active`=:is_active,`is_featured`=:is_featured,`updated_at`=:updated_at WHERE `id` = :id';
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':button_title', $button_title);
        $stmt->bindParam(':button_url', $button_url);
        $stmt->bindParam(':is_active', $is_active);
        $stmt->bindParam(':is_featured', $is_featured);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->bindParam(':image', $image);
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        $button_title = $_REQUEST['button_title'];
        $button_url = $_REQUEST['button_url'];
        $is_active = $_REQUEST['is_active'];
        $is_featured = $_REQUEST['is_featured'];
        $updated_at = date("Y-m-d h:s:i");
        $align = $_REQUEST['align'];
        if (!empty($_FILES['image']) && $_FILES['image']['name'] != "") {
            var_dump($_FILES['image']);
            if ($_REQUEST['oldImage'] != null) {
                unlink("../" . $_REQUEST['oldImage']);
            }
            $dir = "../uploads/";
            $filename = $dir . $_FILES['image']['name'];
            if (move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
                $image = "uploads/" . $_FILES['image']['name'];
            }
        } else {
            $image = $_REQUEST['oldImage'];
        }
        // var_dump($_FILES['image']);

        // Upload File
        $isActive = $_REQUEST['isActive'];

        $stmt->execute();
        $msg = "Featured Update Success!";
        // header("location:SliderIndex.php");
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
                    <h2 class="font-weight-bold text-6">Create Featured</h2>

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
                                        <label class="" for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="title" value="<?= $data['title']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="" for="content">Content</label>
                                        <input type="text" name="content" class="form-control" id="content" placeholder="content" value="<?= $data['content']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="button_title">Button Text</label>
                                        <input type="text" name="button_title" class="form-control" id="button_title" placeholder="Shop Now" value="<?= $data['button_title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="button_url">Button URL</label>
                                        <input type="text" name="button_url" class="form-control" id="button_url" placeholder="/Categories" value="<?= $data['button_url']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        <img src="../<?php echo $data['image']; ?>" alt="!" height="50">
                                        <input type="hidden" name="oldImage" value="<?php echo $data['image']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option value="">~~Select~~</option>
                                            <option value="1" <?php if ($data['is_active'] == 1) {
                                                                    echo "selected";
                                                                } ?>>Active</option>
                                            <option value="0" <?php if ($data['is_active'] == 0) {
                                                                    echo "selected";
                                                                } ?>>Deactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Is Featured</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="">~~Select~~</option>
                                            <option value="1" <?php if ($data['is_featured'] == 1) {
                                                                    echo "selected";
                                                                } ?>>Yes</option>
                                            <option value="0" <?php if ($data['is_featured'] == 0) {
                                                                    echo "selected";
                                                                } ?>>No</option>
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