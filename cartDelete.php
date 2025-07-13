<?php
session_start();
require_once('./config/db.php');
$db = new Db();
$product_id = $_REQUEST['product_id'];
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    // Delete the product from the cart for the logged-in user
    $stmt = $db->dbHandler->prepare('DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
} else {
    // Delete the product from the session cart for guest users
    unset($_SESSION['cart'][$product_id]);
}
echo "Product removed from cart successfully!";
