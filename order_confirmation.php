<?php
session_start();
require_once('./config/db.php');
$db = new Db();
if (!isset($_REQUEST['order_id'])) {
    // header('Location: http://localhost/ecoomercex/index.php');
    // exit();
    $msg = "Order ID is missing.";
}

$orderId = $_REQUEST['order_id'];
$order = $db->dbHandler->prepare('SELECT * FROM `orders` WHERE id = :order_id');
$order->bindParam(':order_id', $orderId);
if ($order->execute()) {
    $orderDetails = $order->fetch(PDO::FETCH_ASSOC);
    if (!$orderDetails) {
        $msg = "Order not found.";
    }
} else {
    $msg = "Database error. Please try again later.";
}
require_once('./layout/meta.php');
require_once('./layout/header.php');
?>
<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Order Confirmation</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Order Confirmation</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-center shadow my-5">
                <div class="card-body">
                    <?php if (isset($msg)): ?>
                        <div class="alert alert-danger"><?php echo $msg; ?></div>
                    <?php else: ?>
                        <h3>Thank you for your order!</h3>
                        <h3>Your order ID is: <strong><?php echo htmlspecialchars($orderDetails['id']); ?></strong></h3>
                        <p>Total Amount: <strong><?php echo htmlspecialchars($orderDetails['total']); ?></strong></p>
                        <p>Order Date: <strong><?php echo htmlspecialchars($orderDetails['create_at']); ?></strong></p>
                        <p>We will contact you soo at <strong><?= $orderDetails['phone'] ?></strong></p>
                    <?php endif; ?>
                    <div class="text-center">
                        <a href="dashboard.php" class="btn btn-success">Go to Dashboard</a>
                    </div>
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
<!-- Start Sidebar Modal -->
<?php
require_once('./layout/sidebar.php');
?>
<!-- End Sidebar Modal -->

<!-- Start QuickView Modal Area -->
<?php
require_once('./layout/quickview.php');
?>
<!-- End QuickView Modal Area -->

<!-- Start Shopping Cart Modal -->
<?php
require_once('./layout/shipping.php');
?>
<!-- End Shopping Cart Modal -->

<!-- Start Wishlist Modal -->
<?php
require_once('./layout/wishlist.php');
?>
<!-- End Wishlist Modal -->

<!-- Start Size Guide Modal Area -->
<?php
require_once('./layout/sizegide.php');
?>
<!-- End Size Guide Modal Area -->

<!-- Start Shipping Modal Area -->
<?php
require_once('./layout/shipping.php');
?>
<!-- End Shipping Modal Area -->

<!-- Start Products Filter Modal Area -->
<?php
require_once('./layout/product-filter.php');
?>
<!-- End Products Filter Modal Area -->


<?php
require_once('./layout/footer.php');
?>