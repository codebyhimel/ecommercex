<?php
session_start();
require_once('./config/db.php');
$db = new Db();
if (!isset($_SESSION['user']['email']) && $_SESSION['user']['login'] === true) {
    header('Location: login.php');
    exit();
}
if (isset($_REQUEST['submit'])) {
    $order_id = $_REQUEST['order_id'] ?? null;
    $user_id = $_SESSION['user']['id'] ?? null;

    $order = $db->dbHandler->prepare('SELECT * FROM `orders` WHERE id = :order_id AND user_id = :user_id');
    $order->bindParam(':order_id', $order_id);
    $order->bindParam(':user_id', $user_id);
    if ($order->execute()) {
        $orderDetails = $order->fetch(PDO::FETCH_ASSOC);
        if (!$orderDetails) {
            $msg = "Order not found or you do not have permission to view this order.";
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
            <h2>Track Order</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Track Order</li>
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
                    <!-- Start Track Order Area -->
                    <section class="track-order-area">
                        <div class="container">
                            <div class="track-order-content">
                                <h2>All In One Package Tracking</h2>

                                <form action="track_order.php" method="POST">
                                    <div class="form-group">
                                        <label>Order ID</label>
                                        <input type="text" name="order_id" class="form-control">
                                    </div>
                                    <button type="submit" name="submit" class="default-btn">Track Order</button>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- End Track Order Area -->
                    <section class="track-order-area">
                        <div class="container">
                            <div class="track-order-content">
                                <!-- <h2>Order Details</h2> -->
                                <?php if (isset($msg)): ?>
                                    <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>

                                <?php elseif (isset($orderDetails)): ?>
                                    <!-- <h3>Order ID: <strong><?= htmlspecialchars($orderDetails['id']) ?></strong></h3>
                                    <p>Total Amount: <strong><?= htmlspecialchars($orderDetails['total']) ?></strong></p>
                                    
                                    <p>We will contact you soon at <strong><?= htmlspecialchars($orderDetails['phone']) ?></strong></p> -->
                                    <h3>Order Status : <strong>
                                            <?php
                                            if ($orderDetails['status'] == 0) {
                                                echo "Order Pending..";
                                            } elseif ($orderDetails['status'] == 1) {
                                                echo "Order is Processing..";
                                            } elseif ($orderDetails['status'] == 2) {
                                                echo "Order is Ready for Delivery..";
                                            } elseif ($orderDetails['status'] == 3) {
                                                echo "Order Deliverd..";
                                            } elseif ($orderDetails['status'] == 4) {
                                                echo "Order is Cancle..";
                                            }
                                            ?>
                                        </strong></h3>
                                    <h3>last Update : <strong><?php echo $orderDetails['update_at'] ?></strong></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
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