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
                        <li>Lost Password</li>
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
                            <h2>Recover Password</h2>

                            <form class="login-form">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email address">
                                </div>
                                <button type="submit" class="default-btn">Send Reset Link</button>

                                <a href="login.php" class="forgot-password">Login</a>
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