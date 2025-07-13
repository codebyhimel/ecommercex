<?php
session_start();
require_once('./config/db.php');
$db = new Db();
$product_id = $_REQUEST['product_id'] ?? null;
$qty = intval($_REQUEST['qty'] ?? 1);

if ($qty < 1) $qty = 1;

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    $stmt = $db->dbHandler->prepare('UPDATE cart SET qty = ? WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$qty, $user_id, $product_id]);
} else {
    $_SESSION['cart'][$product_id] = $qty;
}
echo "Cart updated successfully!";
