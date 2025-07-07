<?php
include_once('./partials/meta.php');
include_once('./config/db.php');
session_start();
$db = new Db();
$msg = null;

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $id = $_GET['attribute_id'] ?? null;

    if (!$id) {
        header('Location: attributeIndex.php');
        exit;
    }

    $stmt = $db->dbHandler->prepare("SELECT * FROM attribute WHERE id = ?");
    $stmt->execute([$id]);
    $attribute = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $sql = "UPDATE attribute SET name = ?, type = ?, isActive = ? WHERE id = ?";
        $updateStmt = $db->dbHandler->prepare($sql);
        $updateStmt->execute([$_POST['name'], $_POST['type'], $_POST['isActive'], $id]);
        $msg = "Attribute updated successfully!";
        $attribute['name'] = $_POST['name'];
        $attribute['type'] = $_POST['type'];
        $attribute['isActive'] = $_POST['isActive'];
    }
?>
    <section class="body">
        <?php include_once('./partials/header.php'); ?>
        <div class="inner-wrapper">
            <?php include_once('./partials/sidebar.php'); ?>
            <section role="main" class="content-body content-body-modern">
                <header class="page-header">
                    <h2 class="font-weight-bold text-6">Edit Attribute</h2>
                </header>
                <div class="row">
                    <div class="col">
                        <div class="card card-modern">
                            <div class="card-body">
                                <?php if ($msg) echo "<div class='alert alert-success'>{$msg}</div>"; ?>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $attribute['name'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" name="type" class="form-control" value="<?= $attribute['type'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="isActive" class="form-control">
                                            <option value="1" <?= $attribute['isActive'] == 1 ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?= $attribute['isActive'] == 0 ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <?php include_once('./partials/footer.php'); ?>
<?php } else {
    header('Location: login.php');
} ?>