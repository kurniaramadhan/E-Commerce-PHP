<?php
session_start();
if (!empty($_SESSION['cart'])) {
    // Let user in
} else {
    // Send user to hompe page
    // Kalau mau dihilangkan tinggal diberi comment
    //header('location: index.php');
}
?>

<?php include('layouts/header.php'); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['message'])) {
                        echo $_GET['message'];
                    } ?>
                    <?php if (isset($_GET['message'])) { ?>
                        <a href="login.php" class="btn btn-primary">Login</a>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="checkout__input">
                            <p>Name<span>*</span></p>
                            <input type="text" name="name">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" name="city">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Price</span></div>
                            <ul class="checkout__total__products">
                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                    <li><?php echo $value['product_quantity']; ?> <?php echo $value['product_name']; ?> <span>$ <?php echo $value['product_price']; ?></span></li>
                                <?php } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Total <span>$<?php echo $_SESSION['total']; ?></span></li>
                            </ul>

                            <input type="submit" class="site-btn" id="checkout-btn" name="place_order" value="PLACE ORDER" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php include('layouts/footer.php'); ?>