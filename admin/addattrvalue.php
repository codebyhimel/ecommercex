<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    if (isset($_POST['submit'])) {

        $sql = "INSERT INTO `attr_value`(`attr_id`, `value`, `isActive`) VALUES (?,?,?)";
        $stmt = $db->dbHandler->prepare($sql);

        $attr_id = $_POST['attr_id'];
        $value = $_POST['value'];
        $isActive = $_POST['isActive'];
        $stmt->bindParam(1, $attr_id);
        $stmt->bindParam(2, $value);
        $stmt->bindParam(3, $isActive);

        if ($stmt->execute()) {
            $msg = "Attribute Inserted Successfully!";
            // header("location:attributeList.php");
        } else {
            $msg = "Attribute Inserted Fail!";
        }
    }


    if (isset($_REQUEST['attribute_id'])) {
        $sql2 = "SELECT * FROM attribute WHERE id = ? ";
        $stmt2 = $db->dbHandler->prepare($sql2);
        $stmt2->bindParam(1, $_REQUEST['attribute_id']);
        $stmt2->execute();
        $attribute = $stmt2->fetch(PDO::FETCH_ASSOC);
        // var_dump($data);
    }

    $sql3 = "SELECT * FROM attr_value where attr_id = ?";
    $stmt3 = $db->dbHandler->prepare($sql3);
    $stmt3->bindParam(1, $_REQUEST['attribute_id']);
    $stmt3->execute();
    $attr_values = $stmt3->fetchAll(PDO::FETCH_ASSOC);

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
                    <h2 class="font-weight-bold text-6">Add Attribute Value for: <?= $attribute['name'] ?></h2>
                </header>

                <!-- start: page -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card card-modern">
                            <div class="card-body">

                                <table class="table table-ecommerce-simple table-striped mb-0" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Value</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($attr_values as $items) {
                                        ?>
                                            <tr>
                                                <td><?= $items['id']; ?></td>
                                                <td><?= $items['value']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($items['isActive'] == 1) {
                                                        echo "Active";
                                                    } else {
                                                        echo "Inactive";
                                                    }
                                                    ?>

                                                </td>
                                                <td><a href="editattrvlue.php?edit_attribute_id=<?= $items['id']; ?>">Edit</a>
                                                    <a href="#">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mx-auto">
                        <section class="card">
                            <div class="card-body p-4">
                                <?php if ($msg != null): ?>
                                    <div class="alert alert-success">
                                        <?= $msg ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="post">
                                    <input type="hidden" name="attr_id" value="<?php echo $_REQUEST['attribute_id']; ?>">
                                    <div class="form-group mb-3">
                                        <label for="value" class="form-label">Attribute Value</label>
                                        <input type="text" name="value" id="value" class="form-control" placeholder="Enter attribute value" required value="">
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="isActive" class="form-label">Status</label>
                                        <select name="isActive" id="isActive" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
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