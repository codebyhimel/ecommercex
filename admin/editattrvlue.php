<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $sql4 = "SELECT * FROM attr_value WHERE id = ? ";
    $stmt4 = $db->dbHandler->prepare($sql4);
    $stmt4->bindParam(1, $_REQUEST['edit_attribute_id']);
    $stmt4->execute();
    $editData = $stmt4->fetch(PDO::FETCH_ASSOC);
    // attribute_id
    if (isset($_POST['submit'])) {

        $sql = "UPDATE `attr_value` SET `attr_id`=?,`value`=?,`isActive`=? WHERE id = ?";
        $stmt = $db->dbHandler->prepare($sql);

        $value_id = $_POST['value_id'];
        $attr_id = $_POST['attr_id'];
        $value = $_POST['value'];
        $isActive = $_POST['isActive'];

        $stmt->bindParam(1, $attr_id);
        $stmt->bindParam(2, $value);
        $stmt->bindParam(3, $isActive);
        $stmt->bindParam(4, $value_id);

        if ($stmt->execute()) {
            $msg = "Attribute Inserted Successfully!";
            header("location:addattrvalue.php?attribute_id=" . $attr_id);
        } else {
            $msg = "Attribute Inserted Fail!";
        }
    }

?>
    <!-- Meta File End -->
    <section class="body">

        <!-- start: header -->
        <?php include_once('./partials/header.php'); ?>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php include_once('./partials/sidebar.php'); ?>
            <!-- end: sidebar -->

            <section role="main" class="content-body content-body-modern">
                <header class="page-header page-header-left-inline-breadcrumb">
                    <!-- <h2 class="font-weight-bold text-6">Add Attribute Value for: <?= $attribute['name'] ?></h2> -->
                </header>

                <!-- start: page -->
                <div class="row">

                    <div class="col-lg-6 mx-auto">
                        <section class="card">
                            <div class="card-body p-4">
                                <?php if ($msg != null): ?>
                                    <div class="alert alert-success">
                                        <?= $msg ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="post">
                                    <input type="hidden" name="value_id" value="<?= $editData['id']; ?>">
                                    <input type="hidden" name="attr_id" value="<?= $editData['attr_id']; ?>">
                                    <div class="form-group mb-3">
                                        <label for="value" class="form-label">Attribute Value</label>
                                        <input type="text" name="value" id="value" class="form-control" placeholder="Enter attribute value" required value="<?= $editData['value']; ?>">
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="isActive" class="form-label">Status</label>
                                        <select name="isActive" id="isActive" class="form-control">
                                            <option value="1" <?php
                                                                if ($editData['isActive'] == 1) {
                                                                    echo "selected";
                                                                }
                                                                ?>>Active</option>
                                            <option value="0" <?php
                                                                if ($editData['isActive'] == 0) {
                                                                    echo "selected";
                                                                }
                                                                ?>>Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Save Attribute</button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>
    </section>

    <?php include_once('./partials/footer.php'); ?>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
<?php
} else {
    header('Location: http://localhost/ecoomercex/admin/login.php');
    exit;
}
?>