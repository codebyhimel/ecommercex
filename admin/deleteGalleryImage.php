<?php
include_once('./config/db.php');
session_start();
$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $img_path = $_POST['img_path'] ?? null;

    if ($id && $img_path) {
        $sql = "DELETE FROM product_gallery WHERE id = ?";
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->execute([$id]);

        if (file_exists($img_path)) {
            unlink($img_path);
        }

        $_SESSION['msg'] = "Image deleted successfully.";
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
