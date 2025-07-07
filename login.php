<?php
session_start();
require_once('./config/db.php');
$db = new Db();
// $_SESSION['user']['email'] = null;
// $_SESSION['user']['login'] = false;
$msg = null;
if ($_SESSION['user']['email'] != null && $_SESSION['user']['login'] == true) {
    header('location: http://localhost/ecoomercex/dashboard.php');
}
if (isset($_REQUEST['submit'])) {
    $sql = 'SELECT * FROM `user` WHERE  email = :username or username = :email';
    $stmt = $db->dbHandler->prepare($sql);
    $stmt->bindParam(':email', $username);
    $stmt->bindParam(':username', $username);
    $username = $_REQUEST['username'];
    if ($stmt->execute()) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $password = $_REQUEST['password'];
        $pass = md5($password);
        if (!empty($data['email']) || !empty($data['username'])) {
            if ($pass == $data['password']) { 
                $msg = "Login Success!";
                $_SESSION['user']['id'] = $data['id'];
                $_SESSION['user']['username'] = $data['username'];
                $_SESSION['user']['fname'] = $data['fname'];
                $_SESSION['user']['email'] = $data['email'];
                $_SESSION['user']['login'] = true;
                $_SESSION['user']['msg'] = "Login Success!";
                header('location: http://localhost/ecoomercex/dashboard.php');
            } else {
                $msg = "Invalid Password, Please Try Currect Password";
            }
        } else {
            $msg = "Username name or Email Not Found!";
        }
    } else {
        $msg = "Invalid Username or Email Address!";
    }
}
?>
<?php
require_once('./layout/meta.php');
require_once('./layout/header.php');
?>
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
                    <?php 
                        if($msg != null){
                            echo $msg;
                        }
                    ?>
                    <form class="login-form" method="post" action="">
                        <div class="form-group">
                            <input type="email" name="username" class="form-control" placeholder="Username or email address">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <button type="submit" name="submit" class="default-btn">Login</button>

                        <a href="forgate-pass.php" class="forgot-password">Lost your password?</a>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="new-customer-content">
                    <h2>New Customer</h2>

                    <span>Create A Account</span>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                    <a href="signup.php" class="optional-btn">Create A Account</a>
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

<!-- Hello Dhaka -->