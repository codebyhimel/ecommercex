<?php
// --- FILE: productAttrValueDelete.php ---
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SESSION['data']['email'] != null && $_SESSION['data']['login'] == true) {
    $id = $_GET['id'];
    $stmt = $db->dbHandler->prepare("DELETE FROM product_attr_value WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['msg'] = "Deleted successfully.";
}
header("Location: productAttrValueList.php");
