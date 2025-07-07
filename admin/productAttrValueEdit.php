<?php
// --- FILE: productAttrValueEdit.php ---
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $id = $_GET['id'];
    $stmt = $db->dbHandler->prepare("SELECT * FROM product_attr_value WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $products = $db->dbHandler->query("SELECT id, name FROM product")->fetchAll(PDO::FETCH_ASSOC);
    $attributes = $db->dbHandler->query("SELECT id, name FROM attribute")->fetchAll(PDO::FETCH_ASSOC);
    $attrValues = $db->dbHandler->query("SELECT id, value FROM attr_value")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $attr_id = $_POST['attr_id'];
        $attr_value_id = $_POST['attr_value_id'];

        $stmt = $db->dbHandler->prepare("UPDATE product_attr_value SET product_id = ?, attr_id = ?, attr_value_id = ? WHERE id = ?");
        $stmt->execute([$product_id, $attr_id, $attr_value_id, $id]);

        $_SESSION['msg'] = "Updated successfully.";
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
                        <form method="post">
                            <div class="mb-3">
                                <label>Product</label>
                                <select name="product_id" class="form-control" required>
                                    <?php foreach ($products as $p): ?>
                                        <option value="<?= $p['id'] ?>" <?= $p['id'] == $data['product_id'] ? 'selected' : '' ?>><?= $p['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Attribute</label>
                                <select name="attr_id" class="form-control" required>
                                    <?php foreach ($attributes as $a): ?>
                                        <option value="<?= $a['id'] ?>" <?= $a['id'] == $data['attr_id'] ? 'selected' : '' ?>><?= $a['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Attribute Value</label>
                                <select name="attr_value_id" class="form-control" required>
                                    <?php foreach ($attrValues as $av): ?>
                                        <option value="<?= $av['id'] ?>" <?= $av['id'] == $data['attr_value_id'] ? 'selected' : '' ?>><?= $av['value'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="productAttrValueList.php" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
    
    <?php include_once('./partials/footer.php'); ?>
<?php } else {
    header('Location: login.php');
} ?>