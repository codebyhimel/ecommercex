<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $products = $db->dbHandler->query("SELECT id, name FROM product")->fetchAll(PDO::FETCH_ASSOC);
    $attributes = $db->dbHandler->query("SELECT id, name FROM attribute")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $attr_id = $_POST['attr_id'];
        $attr_value_id = $_POST['attr_value_id'];

        $stmt = $db->dbHandler->prepare("INSERT INTO product_attr_value (product_id, attr_id, attr_value_id) VALUES (?, ?, ?)");
        $stmt->execute([$product_id, $attr_id, $attr_value_id]);

        $_SESSION['msg'] = "Added successfully.";
        header("Location: productAttrValueList.php");
        exit;
    }
?>
    <section class="body">
        <?php include_once('./partials/header.php'); ?>
        <div class="inner-wrapper">
            <?php include_once('./partials/sidebar.php'); ?>
            <section role="main" class="content-body content-body-modern">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Add Product Attribute Value</h4>
                        <form method="post">
                            <div class="mb-3">
                                <label>Product</label>
                                <select name="product_id" class="form-control" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $p): ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Attribute</label>
                                <select name="attr_id" id="attr_id" class="form-control" required>
                                    <option value="">Select Attribute</option>
                                    <?php foreach ($attributes as $a): ?>
                                        <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Attribute Value</label>
                                <select name="attr_value_id" id="attr_value_id" class="form-control" required>
                                    <option value="">Select Attribute Value</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Add</button>
                            <a href="productAttrValueList.php" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#attr_id').on('change', function() {
                var attr_id = $(this).val();
                if (attr_id) {
                    $.ajax({
                        url: 'getAttrValuesByAttrId.php',
                        type: 'POST',
                        data: { attr_id: attr_id },
                        success: function(response) {
                            $('#attr_value_id').html(response);
                        }
                    });
                } else {
                    $('#attr_value_id').html('<option value="">Select Attribute Value</option>');
                }
            });
        });
    </script>

    <?php include_once('./partials/footer.php'); ?>
<?php } else {
    header('Location: login.php');
}
?>
