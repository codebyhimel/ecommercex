<!-- Meta File Start -->
<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();
if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {

    if (isset($_REQUEST['slider_id'])) {
        $sql = "SELECT * FROM `slidertable` WHERE `id` = :sliderId ";
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam('sliderId', $_REQUEST['slider_id']);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($data);
    }

    if (isset($_REQUEST['submit'])) {
        $sql = 'UPDATE `slidertable` SET `subTitle`=:subTitle,`title`=:title,`details`=:details,`btnOneText`=:btnOneText,`btnOneUrl`=:btnOneUrl,`btnTwoTxt`=:btnTwoTxt,`btnTwoUrl`=:btnTwoUrl,`align`=:align,`image`=:image,`isActive`=:isActive WHERE `id` = :id';
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':subTitle', $subTitle);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':btnOneText', $btnOneText);
        $stmt->bindParam(':btnOneUrl', $btnOneUrl);
        $stmt->bindParam(':btnTwoTxt', $btnTwoTxt);
        $stmt->bindParam(':btnTwoUrl', $btnTwoUrl);
        $stmt->bindParam(':align', $align);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':isActive', $isActive);
        $id = $_REQUEST['id'];
        $subTitle = $_REQUEST['subTitle'];
        $title = $_REQUEST['title'];
        $details = $_REQUEST['details'];
        $btnOneText = $_REQUEST['btnOneText'];
        $btnOneUrl = $_REQUEST['btnOneUrl'];
        $btnTwoTxt = $_REQUEST['btnTwoTxt'];
        $btnTwoUrl = $_REQUEST['btnTwoUrl'];
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
        $msg = "Silder Update Success!";
        header("location:SliderIndex.php");
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
                    <h2 class="font-weight-bold text-6">Create Slider</h2>

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
                                        <label class="" for="subTitle">sub Title</label>
                                        <input type="text" name="subTitle" class="form-control" id="subTitle" placeholder="subTitle" value="<?= $data['subTitle']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="title" value="<?= $data['title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="details">Details</label>
                                        <input type="text" name="details" class="form-control" id="details" placeholder="details" value="<?= $data['details']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="btnOneText">Button One Text</label>
                                        <input type="text" name="btnOneText" class="form-control" id="btnOneText" placeholder="Shop Now" value="<?= $data['btnOneText']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="btnOneUrl">Button One URL</label>
                                        <input type="text" name="btnOneUrl" class="form-control" id="btnOneUrl" placeholder="/Categories" value="<?= $data['btnOneUrl']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="btnTwoTxt">Button Two Txt</label>
                                        <input type="text" name="btnTwoTxt" class="form-control" id="btnTwoTxt" placeholder="Explore" value="<?= $data['btnTwoTxt']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="btnTwoUrl">Button Two URL</label>
                                        <input type="text" name="btnTwoUrl" class="form-control" id="btnTwoUrl" placeholder="/contact" value="<?= $data['btnTwoUrl']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="align">Slider Text Aligntmnt </label>
                                        <input type="text" name="align" class="form-control" id="align" placeholder="center" value="<?= $data['align']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="image">image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        <img src="../<?php echo $data['image']; ?>" alt="!" height="50">
                                        <input type="hidden" name="oldImage" value="<?php echo $data['image']; ?>">
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