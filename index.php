<?php
require_once('./layout/meta.php');
require_once('./layout/header.php');
include_once('./config/db.php');
$db = new Db();
// Slider Table Data
$sql = "SELECT * FROM `slidertable` WHERE isActive = 1";
$slider = $db->dbHandler->prepare($sql);
$slider->execute();
$sliderData = $slider->fetchAll(PDO::FETCH_ASSOC);
// Featured Table Data
$fsql = "SELECT * FROM `featured` WHERE `is_active` = 1 AND `is_featured` = 1";
$fdata = $db->dbHandler->prepare($fsql);
$fdata->execute();
$featured = $fdata->fetchAll(PDO::FETCH_ASSOC);

// Brands
$bsql = "SELECT * FROM `brand` WHERE `isActive` = 1 ";
$stmts = $db->dbHandler->prepare($bsql);
$stmts->execute();
$brands = $stmts->fetchAll(PDO::FETCH_ASSOC);

// Products Table Data
$psql = "SELECT * FROM `product` WHERE `is_active` = 1 AND `is_featured` = 1";
$products = $db->dbHandler->prepare($psql);
$products->execute();
$product = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Start Main Banner Area -->
<div class="home-slides owl-carousel owl-theme">
    <?php
    foreach ($sliderData as $item) {
    ?>
        <div class="main-banner" style="background-image: url(./<?= $item['image'] ?>);">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="main-banner-content text-<?= $item['align'] ?>">
                            <span class="sub-title"><?= $item['subTitle'] ?></span>
                            <h1><?= $item['title'] ?></h1>
                            <p><?= $item['details'] ?></p>
                            <div class="btn-box">
                                <a href="<?= $item['btnOneUrl'] ?>" class="default-btn"><?= $item['btnOneText'] ?></a>
                                <a href="<?= $item['btnTwoUrl'] ?>" class="optional-btn"><?= $item['btnTwoTxt'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>
<!-- End Main Banner Area -->

<!-- Start Categories Banner Area -->
<section class="categories-banner-area pt-100 pb-70">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php
            foreach ($featured as $a) {
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-categories-box">
                        <img src="<?= $a['image'] ?>" alt="image">

                        <div class="content text-primary">
                            <span><?= $a['title'] ?></span>
                            <h3><?= $a['content'] ?></h3>
                            <a href="<?= $a['button_url'] ?>" class="default-btn"><?= $a['button_title'] ?></a>
                        </div>
                        <a href="<?= $a['button_url'] ?>" class="link-btn"></a>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-categories-box">
                    <img src="assets/img/categories/img2.jpg" alt="image">

                    <div class="content">
                        <span>New Collection</span>
                        <h3>Need Now</h3>
                        <a href="products-right-sidebar.html" class="default-btn">Discover Now</a>
                    </div>
                    <a href="products-right-sidebar.html" class="link-btn"></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-categories-box">
                    <img src="assets/img/categories/img3.jpg" alt="image">

                    <div class="content">
                        <span>Your Looks</span>
                        <h3>Must Haves</h3>
                        <a href="products-right-sidebar.html" class="default-btn">Discover Now</a>
                    </div>
                    <a href="products-right-sidebar.html" class="link-btn"></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-categories-box">
                    <img src="assets/img/categories/img4.jpg" alt="image">

                    <div class="content text-white">
                        <span>Take 20% OFF</span>
                        <h3>Winter Spring!</h3>
                        <a href="products-right-sidebar.html" class="default-btn">Discover Now</a>
                    </div>
                    <a href="products-right-sidebar.html" class="link-btn"></a>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Categories Banner Area -->

<!-- Start Products Area -->
<section class="products-area pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">See Our Collection</span>
            <h2>Recent Products</h2>
        </div>

        <div class="row justify-content-center">
            <?php

            foreach ($product as $value) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-products-box">
                        <div class="products-image">
                            <a href="products-type.php?detail=<?= $value['id']; ?>">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="main-image" alt="image">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="hover-image" alt="image">
                            </a>

                            <div class="products-button">
                                <ul>
                                    <li>
                                        <div class="wishlist-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#shoppingWishlistModal">
                                                <i class='bx bx-heart'></i>
                                                <span class="tooltip-label">Add to Wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="compare-btn">
                                            <a href="compare.html">
                                                <i class='bx bx-refresh'></i>
                                                <span class="tooltip-label">Compare</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="quick-view-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                <i class='bx bx-search-alt'></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="products-content">
                            <h3><a href="products-type.php?detail=<?= $value['id']; ?>"><?= $value['name']; ?></a></h3>
                            <div class="price">
                                <span class="old-price">$<?= $value['price']; ?></span>
                                <span class="new-price">$<?php echo $value['price'] - $value['discount'] ?></span>
                            </div>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <button onclick="addToCart(<?= $value['id'] ?>)" class="add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>
<!-- End Products Area -->

<!-- Start Offer Area -->
<section class="offer-area bg-image1 ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="offer-content">
                    <span class="sub-title">Limited Time Offer!</span>
                    <h2>-40% OFF</h2>
                    <p>Get The Best Deals Now</p>
                    <a href="products-one-row.html" class="default-btn">Discover Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Offer Area -->

<!-- Start Products Area -->
<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">See Our Collection</span>
            <h2>Popular Products</h2>
        </div>

        <div class="row justify-content-center">
            <?php

            foreach ($product as $value) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-products-box">
                        <div class="products-image">
                            <a href="products-type.php?detail=<?= $value['id']; ?>">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="main-image" alt="image">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="hover-image" alt="image">
                            </a>

                            <div class="products-button">
                                <ul>
                                    <li>
                                        <div class="wishlist-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#shoppingWishlistModal">
                                                <i class='bx bx-heart'></i>
                                                <span class="tooltip-label">Add to Wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="compare-btn">
                                            <a href="compare.html">
                                                <i class='bx bx-refresh'></i>
                                                <span class="tooltip-label">Compare</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="quick-view-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                <i class='bx bx-search-alt'></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="products-content">
                            <h3><a href="products-type.php?detail=<?= $value['id']; ?>"><?= $value['name']; ?></a></h3>
                            <div class="price">
                                <span class="old-price">$<?= $value['price']; ?></span>
                                <span class="new-price">$<?php echo $value['price'] - $value['discount'] ?></span>
                            </div>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="cart.html" class="add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- End Products Area -->

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

<!-- Start Products Area -->
<section class="products-area pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">See Our Collection</span>
            <h2>Best Selling Products</h2>
        </div>

        <div class="row justify-content-center">
            <?php

            foreach ($product as $value) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-products-box">
                        <div class="products-image">
                            <a href="products-type.php?detail=<?= $value['id']; ?>">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="main-image" alt="image">
                                <img src="admin/uploads/products/<?= $value['feat_img']; ?>" class="hover-image" alt="image">
                            </a>

                            <div class="products-button">
                                <ul>
                                    <li>
                                        <div class="wishlist-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#shoppingWishlistModal">
                                                <i class='bx bx-heart'></i>
                                                <span class="tooltip-label">Add to Wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="compare-btn">
                                            <a href="compare.html">
                                                <i class='bx bx-refresh'></i>
                                                <span class="tooltip-label">Compare</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="quick-view-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                <i class='bx bx-search-alt'></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="products-content">
                            <h3><a href="products-type.php?detail=<?= $value['id']; ?>"><?= $value['name']; ?></a></h3>
                            <div class="price">
                                <span class="old-price">$<?= $value['price']; ?></span>
                                <span class="new-price">$<?php echo $value['price'] - $value['discount'] ?></span>
                            </div>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="cart.html" class="add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- End Products Area -->

<!-- Start Partner Area -->
<div class="partner-area ptb-70">
    <div class="container">
        <div class="section-title">
            <h2>Our Partners</h2>
        </div>

        <div class="partner-slides owl-carousel owl-theme">

            <?php
            foreach ($brands as $item) {
            ?>
                <div class="partner-item">
                    <a href="brands.php>id=<?php echo $item['id']; ?>"><img src="admin/<?= $item['img_url']; ?> " alt="image"></a>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<!-- End Partner Area -->

<!-- Start Blog Area -->
<section class="blog-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Recent Story</span>
            <h2>From The Xton Blog</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="single-blog-1.html">
                            <img src="assets/img/blog/img1.jpg" alt="image">
                        </a>
                        <div class="date">
                            <span>January 29, 2024</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Ideas</span>
                        <h3><a href="single-blog-1.html">The #1 eCommerce blog to grow your business</a></h3>
                        <a href="single-blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="single-blog-1.html">
                            <img src="assets/img/blog/img2.jpg" alt="image">
                        </a>
                        <div class="date">
                            <span>January 29, 2024</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Advice</span>
                        <h3><a href="single-blog-1.html">Latest ecommerce trend: The rise of shoppable posts</a></h3>
                        <a href="single-blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="single-blog-1.html">
                            <img src="assets/img/blog/img3.jpg" alt="image">
                        </a>
                        <div class="date">
                            <span>January 29, 2024</span>
                        </div>
                    </div>

                    <div class="post-content">
                        <span class="category">Social</span>
                        <h3><a href="single-blog-1.html">Building eCommerce wave: Social media shopping</a></h3>
                        <a href="single-blog-1.html" class="details-btn">Read Story</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->

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