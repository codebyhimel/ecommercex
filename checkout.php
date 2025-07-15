<?php
session_start();
include_once('./config/db.php');  // Include necessary files and start session
$db = new Db();  // Initialize database connection
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();
}
// Continue with the checkout process...
$user_id = $_SESSION['user']['id'];  // Get user ID from session
// Fetch products details from the database
$query = $db->dbHandler->prepare("SELECT p.id, p.name, p.price, c.qty FROM `cart` c JOIN `product` p ON c.product_id = p.id WHERE c.user_id = ?");
$query->execute([$user_id]);
$cartItems = $query->fetchAll(PDO::FETCH_ASSOC);  // Fetch all cart items  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment = $_POST['payment_method'];
    $coupon = $_POST['cupone_code'] ?? null;
    $discount = 0;
    $tax = 0;  // Example tax rate
    $shipping = 80;  // Example shipping cost
    $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cartItems));
    if ($coupon  != "") {
        $cp = $db->dbHandler->prepare("SELECT * FROM `coupons` WHERE `code` = ? AND `is_active` = 1");
        $cp->execute([$coupon]);
        $cp = $cp->fetch(PDO::FETCH_ASSOC);
        if ($cp) {
            $discount = $cp['discount_type'] == 'percentage' ? ($subtotal * $cp['discount_value'] / 100) : $cp['discount_value'];
        }
    }
    $total = $subtotal + $tax + $shipping - $discount;  // Calculate total amount
    // Insert order into the database
    $stmt = $db->dbHandler->prepare("INSERT INTO `orders` (user_id, name, phone, address, cupone_code, discount, shipping, tax, total, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $name, $phone, $address, $coupon, $discount, $shipping, $tax, $total, $payment]);
    $orderId = $db->dbHandler->lastInsertId();  // Get the last inserted order ID
    // Insert order items into the database
    foreach ($cartItems as $item) {
        $stmt = $db->dbHandler->prepare("INSERT INTO `order_items` (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $item['id'], $item['qty'], $item['price']]);
    }
    // Clear the cart after successful order
    $db->dbHandler->prepare("DELETE FROM `cart` WHERE user_id = ?")->execute([$user_id]);
    $_SESSION['msg'] = "Order placed successfully!";  // Set success message in session
    // Redirect to order confirmation page
    header('Location: order_confirmation.php?order_id=' . $orderId);
    exit();
}
require_once('./layout/meta.php');
require_once('./layout/header.php');
?>

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Checkout</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Checkout Area -->
<section class="checkout-area ptb-100">
    <div class="container">
        <!-- <div class="user-actions">
                    <i class='bx bx-log-in'></i>
                    <span>Returning customer? <a href="login.html">Click here to login</a></span>
                </div> -->

        <form method="post" action="" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>

                        <div class="row justify-content-center">


                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Coupon Code </label>
                                    <input type="text" class="form-control" name="coupon_code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="order-details">
                        <h3 class="title">Your Order</h3>

                        <div class="order-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $subtotala = 0;  // Initialize subtotal accumulator 
                                    ?>
                                    <?php foreach ($cartItems as $item): ?>
                                        <tr>
                                            <td class="product-name">
                                                <a href="#"><?= $item['name'] ?></a>
                                            </td>

                                            <td class="product-total">
                                                <span class="subtotal-amount"><?= $item['price'] * $item['qty'] ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                        $substotal = $item['price'] * $item['qty'];
                                        $subtotala += $substotal;  // Calculate subtotal for all items
                                        ?>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td class="order-subtotal">
                                            <span>Cart Subtotal</span>
                                        </td>

                                        <td class="order-subtotal-price">
                                            <span class="order-subtotal-amount"><?= $subtotala ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="order-shipping">
                                            <span>Shipping</span>
                                        </td>

                                        <td class="shipping-price">
                                            <span>80</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="total-price">
                                            <span>Order Total</span>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="subtotal-amount"><?= $subtotala + 80 ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="payment-box">
                            <div class="payment-method">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Payment Method <span class="required">*</span></label>
                                        <select name="payment_method" id="payment_method" class="form-control">
                                            <option value="1">Cash on Delivery</option>
                                            <option value="2">PayPal</option>
                                            <option value="3">Stripe</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="phone" required> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="default-btn">Place Order</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Checkout Area -->

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