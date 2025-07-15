<?php
session_start();
require_once('./config/db.php');
$db = new Db();

$msg = null;
$pasMag = null;

// Redirect to dashboard if user already logged in
if (isset($_SESSION['user']['email']) && $_SESSION['user']['login'] === true) {
    header('Location: http://localhost/ecoomercex/dashboard.php');
    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $passwordRaw = $_POST['password'];
    $passwordConfirm = $_POST['pwd_confirm'];

    if ($passwordRaw !== $passwordConfirm) {
        $pasMag = "Confirm Password does not match";
    } else {
        // Hash the password
        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        // Prepare and bind
        $sql = 'INSERT INTO `user` (`fname`, `lname`, `username`, `phone`, `email`, `password`) 
                VALUES (:fname, :lname, :username, :phone, :email, :password)';
        $stmt = $db->dbHandler->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $_SESSION['register_success'] = "Registration successful. Please login.";
            header('Location: http://localhost/ecoomercex/login.php');
            exit();
        } else {
            $msg = "Registration failed. Please try again.";
        }
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
                <li><a href="index.html">Home</a></li>
                <li>Signup</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start SignUP Area -->
<section class="signup-area ptb-100">
    <div class="container">
        <div class="signup-content">
            <h2>Create an Account</h2>

            <form class="signup-form" method="post" action="">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter your first name" id="fname" value="<?= htmlspecialchars($_POST['fname'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" placeholder="Enter your last name" id="lname" value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" id="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" id="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" id="password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="pwd_confirm" class="form-control" placeholder="Confirm your password" id="pwd_confirm">
                </div>

                <?php if ($pasMag): ?>
                    <span class="text-danger"><?= $pasMag ?></span><br>
                <?php elseif ($msg): ?>
                    <span class="text-danger"><?= $msg ?></span><br>
                <?php endif; ?>

                <button type="submit" name="submit" class="default-btn">Signup</button>
                <a href="index.php" class="return-store">or Return to Store</a>
            </form>
        </div>
    </div>
</section>
<!-- End SignUP Area -->
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