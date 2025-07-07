<?php
// --- FILE: productAttrValueList.php ---
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $sql = "SELECT pav.*, p.name AS product_name, a.name AS attr_name, av.value AS attr_value
            FROM product_attr_value pav
            JOIN product p ON pav.product_id = p.id
            JOIN attribute a ON pav.attr_id = a.id
            JOIN attr_value av ON pav.attr_value_id = av.id";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <section class="body">
        <?php include_once('./partials/header.php'); ?>
        <div class="inner-wrapper">
            <?php include_once('./partials/sidebar.php'); ?>
            <section role="main" class="content-body content-body-modern">
                <header class="page-header">
                    <h2 class="font-weight-bold text-6">Product Attribute Values</h2>
                </header>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <a href="productAttrValueAdd.php" class="btn btn-primary mb-3">+ Add Product Attribute Value</a>
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Attribute</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($entries as $value): ?>
                                            <tr>
                                                <td><?= $value['id'] ?></td>
                                                <td><?= $value['product_name'] ?></td>
                                                <td><?= $value['attr_name'] ?></td>
                                                <td><?= $value['attr_value'] ?></td>
                                                <td>
                                                    <a href="productAttrValueEdit.php?id=<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="productAttrValueDelete.php?id=<?= $value['id'] ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <?php include_once('./partials/footer.php'); ?>
    <script>
        $(document).ready(() => {
            $('#datatable').DataTable();
        });
    </script>
<?php } else {
    header('Location: login.php');
} ?>


