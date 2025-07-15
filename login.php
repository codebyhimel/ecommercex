<?php
session_start();
require_once('./config/db.php');
$db = new Db();

$msg = null;

// Redirect if already logged in
if (isset($_SESSION['user']['email']) && $_SESSION['user']['login'] === true) {
    header('Location: dashboard.php');
    exit();
}

// Handle login form submission
if (isset($_POST['submit'])) {
    $loginInput = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = 'SELECT * FROM `user` WHERE email = :login OR username = :login';
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->bindParam(':login', $loginInput);

    if ($stmt->execute()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (md5($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'fname'    => $user['fname'],
                    'email'    => $user['email'],
                    'login'    => true,
                    'msg'      => 'Login Success!',
                ];
                header('Location: dashboard.php');
                exit();
            } else {
                $msg = "Invalid password. Please try again.";
            }
        } else {
            $msg = "Username or email not found.";
        }
    } else {
        $msg = "Database error. Please try again later.";
    }
}
?>

<?php require_once('./layout/meta.php'); ?>
<?php require_once('./layout/header.php'); ?>

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Login Area -->
<section class="login-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="login-content">
                    <h2>Login</h2>

                    <?php if ($msg): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
                    <?php endif; ?>

                    <form class="login-form" method="post" action="">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username or email address" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button type="submit" name="submit" class="default-btn">Login</button>
                        <a href="forgate-pass.php" class="forgot-password">Lost your password?</a>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="new-customer-content">
                    <h2>New Customer</h2>
                    <span>Create An Account</span>
                    <p>Sign up for a free account. Registration is quick and easy.</p>
                    <a href="signup.php" class="optional-btn">Create An Account</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Area -->

<!-- Start Facility Area -->
<section class="facility-area pb-70">
    <div class="container">
        <div class="facility-slides owl-carousel owl-theme">
            <div class="single-facility-box"><div class="icon"><i class='flaticon-tracking'></i></div><h3>Free Shipping Worldwide</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-return'></i></div><h3>Easy Return Policy</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-shuffle'></i></div><h3>7 Day Exchange Policy</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-sale'></i></div><h3>Weekend Discount Coupon</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-credit-card'></i></div><h3>Secure Payment Methods</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-location'></i></div><h3>Track Your Package</h3></div>
            <div class="single-facility-box"><div class="icon"><i class='flaticon-customer-service'></i></div><h3>24/7 Customer Support</h3></div>
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
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="single-instagram-post">
                    <img src="assets/img/instagram/img<?= $i ?>.jpg" alt="image">
                    <i class='bx bxl-instagram'></i>
                    <a href="https://www.instagram.com/" target="_blank" class="link-btn"></a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<!-- End Instagram Area -->

<!-- Start Modals and Footer -->
<?php
require_once('./layout/sidebar.php');
require_once('./layout/quickview.php');
require_once('./layout/shipping.php');
require_once('./layout/wishlist.php');
require_once('./layout/sizegide.php');
require_once('./layout/product-filter.php');
require_once('./layout/footer.php');
?>