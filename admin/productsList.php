<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$msg = null;
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {


    $sql = "SELECT * FROM product";
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <h2 class="font-weight-bold text-6">Products</h2>
                </header>
                <div class="row">
                    <div class="col">
                        <div class="card card-modern">
                            <div class="card-body">
                                <a href="addproducts.php" class="btn btn-primary mb-3">+ Add Products</a>
                                <table class="table table-ecommerce-simple table-striped mb-0" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>image</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $value): ?>
                                            <tr>
                                                <td><?= $value['id'] ?></td>
                                                <td>
                                                    <img src="uploads/products/<?= $value['feat_img'] ?>" alt="!" height="50">
                                                  
                                                </td>
                                                <td><?= $value['name'] ?></td>
                                                
                                                <td><?= $value['is_active'] == 1 ? 'Active' : 'Inactive' ?></td>
                                                <td><?= date('d-M-Y H:i A', strtotime($value['created_at'])) ?></td>
                                                <td>
                                                    <a href="addImageGalary.php?product_id=<?= $value['id'] ?>" class="btn btn-sm btn-info">Add Image</a>
                                                    <a href="productAttrValueList.php?product_id=<?= $value['id'] ?>" class="btn btn-sm btn-info">Add Attribute</a>
                                                    <a href="productEdit.php?product_id=<?= $value['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="productsList.php?product_id=<?= $value['id'] ?>" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Delete</a>
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