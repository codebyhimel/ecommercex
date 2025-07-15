<?php
session_start();
require_once('./config/db.php');
$db = new Db();
if (!isset($_SESSION['user']['email']) && $_SESSION['user']['login'] === true) {
    header('Location: login.php');
    exit();
}
$order_id = $_REQUEST['order_id'] ?? null;
$user_id = $_SESSION['user']['id'] ?? null;
if (!$order_id || !$user_id) {
    $msg = "Order ID or User ID is missing.";
} else {
    $order = $db->dbHandler->prepare('SELECT * FROM `orders` WHERE id = :order_id AND user_id = :user_id');
    $order->bindParam(':order_id', $order_id);
    $order->bindParam(':user_id', $user_id);
    if ($order->execute()) {
        $order = $order->fetch(PDO::FETCH_ASSOC);
        $items = $db->dbHandler->prepare('SELECT oi.*, p.name FROM order_items oi JOIN product p ON oi.product_id = p.id WHERE order_id = ?');
        $items->execute([$order_id]);
        $items = $items->fetchAll(PDO::FETCH_ASSOC);
        if (!$order) {
            $msg = "Order not found.";
        }
    } else {
        $msg = "Database error. Please try again later.";
    }
}


require_once('./layout/meta.php');
require_once('./layout/header.php');
?>
<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow rounded-0">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="list-group-item"><a href="track_order.php">Track Order</a></li>
                        <li class="list-group-item"><a href="order.php">Order</a></li>
                        <li class="list-group-item"><a href="logout.php">Logout</a></li>
                        <!-- <li class="list-group-item"><a href="invoice.php">Invoice</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow rounded-0">
                <div class="card-body">
                    <h2>Invoice #<?= $order['id'] ?></h2>
                    <p><strong>Name:</strong> <?= $order['name'] ?><br>
                        <strong>Phone:</strong> <?= $order['phone'] ?><br>
                        <strong>Address:</strong> <?= $order['address'] ?><br>
                        <strong>Payment:</strong> <?= $order['payment_method'] ?><br>
                        <strong>Status:</strong> <?= $order['status'] ?><br>
                        <strong>Date:</strong> <?= date('d M Y h:i A', strtotime($order['create_at'])) ?>
                    </p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $subtotal = 0;
                            foreach ($items as $item): $line = $item['qty'] * $item['price'];
                                $subtotal += $line; ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td><?= $item['price'] ?></td>
                                    <td><?= $line ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Subtotal</th>
                                <td><?= $subtotal ?> ৳</td>
                            </tr>
                            <tr>
                                <th colspan="3">Shipping</th>
                                <td><?= $order['shipping'] ?> ৳</td>
                            </tr>
                            <tr>
                                <th colspan="3">Discount</th>
                                <td><?= $order['discount'] ?> ৳</td>
                            </tr>
                            <tr>
                                <th colspan="3">Total</th>
                                <td><strong><?= $order['total'] ?> ৳</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Facility Area -->
<section class="facility-area pb-70">
    <div class="container">
        <div class="facility-slides owl-carousel owl-theme">
            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-tracking'></i>
                </div>
                <h3>Free Shipping Worldwide</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-return'></i>
                </div>
                <h3>Easy Return Policy</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-shuffle'></i>
                </div>
                <h3>7 Day Exchange Policy</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-sale'></i>
                </div>
                <h3>Weekend Discount Coupon</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-credit-card'></i>
                </div>
                <h3>Secure Payment Methods</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-location'></i>
                </div>
                <h3>Track Your Package</h3>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-customer-service'></i>
                </div>
                <h3>24/7 Customer Support</h3>
            </div>
        </div>
    </div>
</section>
<!-- End Facility Area -->

<!-- Start Instagram Area -->
<div class="instagram-area">
    <div class="container-fluid">
        <div class="instagram-title">
            <a href="#" target="_blank"><i class='bx bxl-instagram'></i> Follow us on @xton</a>
        </div>

        <div class="instagram-slides owl-carousel owl-theme">
            <div class="single-instagram-post">
                <img src="assets/img/instagram/img1.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img2.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img3.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img4.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img10.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img6.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img7.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img8.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img9.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>

            <div class="single-instagram-post">
                <img src="assets/img/instagram/img5.jpg" alt="image">
                <i class='bx bxl-instagram'></i>
                <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Area -->
<?php
// require_once('./layout/facility.php');
// require_once('./layout/instagram.php');
require_once('./layout/sidebar.php');
require_once('./layout/quickview.php');
require_once('./layout/shipping.php');
require_once('./layout/wishlist.php');
require_once('./layout/sizegide.php');
require_once('./layout/product-filter.php');
require_once('./layout/footer.php');
?>