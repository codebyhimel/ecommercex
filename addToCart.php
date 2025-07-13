<?php
session_start();
include_once('./config/db.php');
$db = new Db();
// Retrieve product ID and quantity from request
$product_id = $_REQUEST['product_id'];
$qty = $_REQUEST['qty'] ?? 1;

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    // Check if the product is already in the cart
    $stmt = $db->dbHandler->prepare('SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    // $existing_item = $stmt->fetch(PDO::FETCH_ASSOC);   
    if ($stmt->rowCount() > 0) {
        // If the product is already in the cart, update the quantity
        $stmt = $db->dbHandler->prepare('UPDATE cart SET qty = qty + :qty WHERE user_id = :user_id AND product_id = :product_id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':qty', $qty);
        $stmt->execute();
    } else {
        // If the product is not in the cart, insert it
        $stmt = $db->dbHandler->prepare('INSERT INTO cart (user_id, product_id, qty) VALUES (:user_id, :product_id, :qty)');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':qty', $qty);
        $stmt->execute();
    }
} else {
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + $qty;
}

echo "Product added to cart successfully!";

// header('location: http://localhost/ecommercex/cart.php');
// exit();