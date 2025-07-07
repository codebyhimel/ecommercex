<?php
require_once('./layout/meta.php');
require_once('./layout/header.php');
include_once('./config/db.php');
$db = new Db();
$id = $_GET['detail'] ?? null;

if (!isset($_REQUEST['detail'])) {
    header('Location: http://localhost/ecoomercex');
}

$stmt = $db->dbHandler->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// search brand
$stmtBand = $db->dbHandler->prepare("SELECT * FROM brand WHERE id = ?");
$stmtBand->execute([$product['brand_id']]);
$Brand = $stmtBand->fetch(PDO::FETCH_ASSOC);

// search Category
$stmtCat = $db->dbHandler->prepare("SELECT * FROM category WHERE id = ?");
$stmtCat->execute([$product['cat_id']]);
$Category = $stmtCat->fetch(PDO::FETCH_ASSOC);

// Products Galary
$sql = "SELECT * FROM product_gallery WHERE product_id = ?";
$stmt = $db->dbHandler->prepare($sql);
$stmt->execute([$id]);
$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

// get attr

$sql = "SELECT `attr_id` FROM `product_attr_value` WHERE `product_id` = ? GROUP BY `attr_id`";
$stmt = $db->dbHandler->prepare($sql);
$stmt->execute([$id]);
$attr = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2><?= $product['name']; ?></h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>Products Details</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Product Details Area -->
<section class="product-details-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12">
                <div class="products-details-image">
                    <div class="single-products-details-image">
                        <img src="admin/uploads/products/<?= $product['feat_img']; ?>" alt="image">
                    </div>
                    <?php
                    foreach ($gallery as $item) {
                    ?>
                        <div class="single-products-details-image">
                            <img src="admin/<?= $item['img_url']; ?>" alt="image">
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="products-details-desc products-details-desc-sticky">
                    <h3><?= $product['name']; ?></h3>

                    <div class="price">
                        <span class="new-price">$<?php echo $product['price'] - $product['discount'] ?></span>
                        <span class="old-price">$<?= $product['price']; ?></span>
                    </div>

                    <div class="products-review">
                        <div class="rating">
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <a href="#" class="rating-count">3 reviews</a>
                    </div>

                    <ul class="products-info">
                        <li><span>Vendor:</span> <a href="#"><?= $Brand['name'] ?></a></li>
                        <li><span>Availability:</span> <a href="#"> </a></li>
                        <li><span>Products Type:</span> <a href="#"><?= $Category['name'] ?></a></li>
                        <li><?= $product['short_desc']; ?></li>
                    </ul>
                    <?php
                    foreach ($attr as $value) {
                        $sql = "SELECT `name` FROM `attribute` WHERE `id` = ?";
                        $stmt = $db->dbHandler->prepare($sql);
                        $stmt->execute([$value['attr_id']]);
                        $attr_name = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="products-size-wrapper">

                            <span><?= $attr_name[0]['name']; ?>:</span>
                            <?php
                            $sql = "SELECT `attr_value_id` FROM `product_attr_value` WHERE `attr_id` = ? ";
                            $stmt = $db->dbHandler->prepare($sql);
                            $stmt->execute([$value['attr_id']]);
                            $attr_val_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            // print_r($attr_val_id); 
                            ?>
                            <ul><?php
                                foreach ($attr_val_id as $items) {
                                    $sql = "SELECT `value` FROM `attr_value` WHERE `id` = ?";
                                    $stmt = $db->dbHandler->prepare($sql);
                                    $stmt->execute([$items['attr_value_id']]);
                                    $attr_value = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                    <li><a href="#"><?=$attr_value[0]['value'];?></a></li>
                                <?php

                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="products-info-btn">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sizeGuideModal"><i class='bx bx-crop'></i> Size guide</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#productsShippingModal"><i class='bx bxs-truck'></i> Shipping</a>
                        <a href="contact.html"><i class='bx bx-envelope'></i> Ask about this products</a>
                    </div>

                    <div class="products-add-to-cart">
                        <div class="input-counter">
                            <span class="minus-btn"><i class='bx bx-minus'></i></span>
                            <input type="text" value="1">
                            <span class="plus-btn"><i class='bx bx-plus'></i></span>
                        </div>

                        <button type="submit" class="default-btn"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                    </div>

                    <div class="wishlist-compare-btn">
                        <a href="#" class="optional-btn"><i class='bx bx-heart'></i> Add to Wishlist</a>
                        <a href="#" class="optional-btn"><i class='bx bx-refresh'></i> Add to Compare</a>
                    </div>

                    <div class="buy-checkbox-btn">
                        <div class="item">
                            <input class="inp-cbx" id="cbx" type="checkbox">
                            <label class="cbx" for="cbx">
                                <span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg>
                                </span>
                                <span>I agree with the terms and conditions</span>
                            </label>
                        </div>

                        <div class="item">
                            <a href="#" class="default-btn">Buy it now!</a>
                        </div>
                    </div>

                    <div class="products-details-accordion">
                        <ul class="accordion">
                            <li class="accordion-item">
                                <a class="accordion-title active" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    Description
                                </a>

                                <div class="accordion-content show">
                                    <?php
                                    echo $product['long_desc'];
                                    ?>
                                </div>
                            </li>

                            <li class="accordion-item">
                                <a class="accordion-title" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    Additional information
                                </a>

                                <div class="accordion-content">
                                    <?php
                                    echo $product['add_info'];
                                    ?>
                                </div>
                            </li>

                            <li class="accordion-item">
                                <a class="accordion-title" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    Reviews
                                </a>

                                <div class="accordion-content">
                                    <div class="products-review-form">
                                        <h3>Customer Reviews</h3>

                                        <div class="review-title">
                                            <div class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bx-star'></i>
                                            </div>
                                            <p>Based on 3 reviews</p>
                                            <a href="#" class="default-btn">Write a Review</a>
                                        </div>

                                        <div class="review-comments">
                                            <div class="review-item">
                                                <div class="rating">
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bx-star'></i>
                                                </div>
                                                <h3>Good</h3>
                                                <span><strong>Admin</strong> on <strong>Sep 21, 2024</strong></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                            </div>

                                            <div class="review-item">
                                                <div class="rating">
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bx-star'></i>
                                                </div>
                                                <h3>Good</h3>
                                                <span><strong>Admin</strong> on <strong>Sep 21, 2024</strong></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                            </div>

                                            <div class="review-item">
                                                <div class="rating">
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bx-star'></i>
                                                </div>
                                                <h3>Good</h3>
                                                <span><strong>Admin</strong> on <strong>Sep 21, 2024</strong></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                            </div>
                                        </div>

                                        <div class="review-form">
                                            <h3>Write a Review</h3>

                                            <form>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" id="review-title" name="review-title" placeholder="Enter your review a title" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="review-body" id="review-body" cols="30" rows="6" placeholder="Write your comments here" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <button type="submit" class="default-btn">Submit Review</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related-products">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Shop</span>
                <h2>Related Products</h2>
            </div>

            <div class="products-slides owl-carousel owl-theme">
                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img1.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover1.jpg" class="hover-image" alt="image">
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
                        <h3><a href="#">Long Sleeve Leopard T-Shirt</a></h3>
                        <div class="price">
                            <span class="old-price">$321</span>
                            <span class="new-price">$250</span>
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

                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img2.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover2.jpg" class="hover-image" alt="image">
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

                        <div class="sale-tag">Sale!</div>
                    </div>

                    <div class="products-content">
                        <h3><a href="#">Causal V-Neck Soft Raglan</a></h3>
                        <div class="price">
                            <span class="old-price">$210</span>
                            <span class="new-price">$200</span>
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

                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img3.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover3.jpg" class="hover-image" alt="image">
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
                        <h3><a href="#">Hanes Men's Pullover</a></h3>
                        <div class="price">
                            <span class="old-price">$210</span>
                            <span class="new-price">$200</span>
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

                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img4.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover4.jpg" class="hover-image" alt="image">
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
                        <h3><a href="#">Gildan Men's Crew T-Shirt</a></h3>
                        <div class="price">
                            <span class="new-price">$150</span>
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

                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img5.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover5.jpg" class="hover-image" alt="image">
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
                        <h3><a href="#">Yidarton Women's Comfy</a></h3>
                        <div class="price">
                            <span class="new-price">$240</span>
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

                <div class="single-products-box">
                    <div class="products-image">
                        <a href="#">
                            <img src="assets/img/products/img6.jpg" class="main-image" alt="image">
                            <img src="assets/img/products/img-hover6.jpg" class="hover-image" alt="image">
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

                        <div class="new-tag">New!</div>
                    </div>

                    <div class="products-content">
                        <h3><a href="#">Womens Tops Color</a></h3>
                        <div class="price">
                            <span class="old-price">$150</span>
                            <span class="new-price">$100</span>
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
        </div>
    </div>
</section>
<!-- End Product Details Area -->

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