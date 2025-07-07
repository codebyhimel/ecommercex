<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    if (isset($_GET['attribute_id'])) {
        $id = $_GET['attribute_id'];
        $sql = "DELETE FROM attribute WHERE id = :id";
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['msg'] = "Attribute deleted successfully!";
    }

    $sql = "SELECT * FROM attribute";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $attributes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .curser-hover{
        cursor: pointer !important;
    }
</style>
    <section class="body">
        <?php include_once('./partials/header.php'); ?>
        <div class="inner-wrapper">
            <?php include_once('./partials/sidebar.php'); ?>
            <section role="main" class="content-body content-body-modern">
                <header class="page-header page-header-left-inline-breadcrumb">
                    <h2 class="font-weight-bold text-6">Attributes</h2>
                </header>
                <div class="row">
                    <div class="col">
                        <div class="card card-modern">
                            <div class="card-body">
                                <a href="attributeCreate.php" class="btn btn-primary mb-3">+ Add Attribute</a>
                                <table class="table table-ecommerce-simple table-striped mb-0" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Attribute</th>
                                            <th>Value</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attributes as $attr): ?>
                                            <tr>
                                                <td><?= $attr['id'] ?></td>
                                                <td><?= $attr['name'] ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($attr['id'])) {
                                                        $sql = "SELECT * FROM attr_value WHERE attr_id = ? ";
                                                        $stmt = $db->dbHandler->prepare($sql);
                                                        $stmt->bindParam(1, $attr['id']);
                                                        $stmt->execute();
                                                        $attribute = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($attribute as $item) {
                                                    ?>
                                                    <a href="editattrvlue.php?edit_attribute_id=<?= $item['id']; ?>">
                                                            <label class="badge bg-primary curser-hover">
                                                                <?php
                                                                echo $item['value'];
                                                                ?>
                                                            </label>
                                                            </a>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </td>
                                                <td><?= $attr['isActive'] == 1 ? 'Active' : 'Inactive' ?></td>
                                                <td><?= date('d-M-Y H:i A', strtotime($attr['create_at'])) ?></td>
                                                <td>
                                                    <a href="addattrvalue.php?attribute_id=<?= $attr['id'] ?>" class="btn btn-sm btn-info">Add Value</a>
                                                    <a href="attributeEdit.php?attribute_id=<?= $attr['id'] ?>" class="btn btn-sm btn-primary">Edit</a>

                                                    <a href="attributeIndex.php?attribute_id=<?= $attr['id'] ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if (isset($_SESSION['msg'])): ?>
                                    <div class="alert alert-success mt-3"><?= $_SESSION['msg'];
                                                                            unset($_SESSION['msg']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <?php include_once('./partials/footer.php'); ?>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
<?php } else {
    header('Location: login.php');
}
?>