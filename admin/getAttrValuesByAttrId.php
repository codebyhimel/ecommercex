<?php
include_once('./config/db.php');
$db = new Db();

if (isset($_POST['attr_id'])) {
    $attr_id = $_POST['attr_id'];
    $stmt = $db->dbHandler->prepare("SELECT id, value FROM attr_value WHERE attr_id = ?");
    $stmt->execute([$attr_id]);
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<option value="">Select Attribute Value</option>';
    foreach ($values as $val) {
        echo "<option value=\"{$val['id']}\">{$val['value']}</option>";
    }
}
?>
