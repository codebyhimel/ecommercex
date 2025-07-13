<?php
session_start();
require_once('./config/db.php');
$db = new Db();
$cartCount = 0;
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    // Fetch count of items in the cart for the logged-in user
    $stmt = $db->dbHandler->prepare('SELECT SUM(qty) as total FROM cart WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $cartCount = $result['total'] ?? 0;
} elseif (!empty($_SESSION['cart'])) {
    // Count items in the session cart for guest users
    $cartCount = array_sum($_SESSION['cart']);
}
echo $cartCount;
