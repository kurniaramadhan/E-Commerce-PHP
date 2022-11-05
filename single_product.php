<?php
    include('server/connection.php');

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $query = "SELECT * FROM products WHERE product_id=$product_id";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $single_product = $stmt->get_result();
    } else {
        // no product id was given
        header('location: index.php');
    }

    $kurs_dollar = 15722;

    function setRupiah($price)
    {
        $result = "Rp".number_format($price, 0, ',', '.');
        return $result;
    }
?>

<?php
    include('layouts/header.php');
?>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <?php while ($row = $single_product->fetch_assoc()) { ?>
            <div class="product__details__pic">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__breadcrumb">
                                <a href="index.php">Home <i class="fas fa-chevron-right"></i></a>
                                <a href="shop.php">Shop <i class="fas fa-chevron-right"></i></a>
                                <span>Product Details</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image']; ?>">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image2']; ?>">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image3']; ?>">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image4']; ?>">
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="assets/img/product/<?php echo $row['product_image']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="assets/img/product/<?php echo $row['product_image2']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="assets/img/product/<?php echo $row['product_image3']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-4" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="assets/img/product/<?php echo $row['product_image4']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <h4><?php echo $row['product_name']; ?></h4>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span> - 5 Reviews</span>
                                </div>
                                <h3><?php echo setRupiah($row['product_price'] * $kurs_dollar); ?></h3>
                                <p><?php echo $row['product_description']; ?></p>
                                <div class="product__details__cart__option">
                                    <form method="POST" action="shopping-cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" name="product_quantity" value="1">
                                            </div>
                                        </div>
                                        <button type="submit" name="add_to_cart" class="primary-btn"><i class="fa fa-shopping-cart fa-2x"></i> add to cart</button>
                                    </form>
                                </div>
                                <div class="product__details__btns__option">
                                    <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                    <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                                </div>
                                <div class="product__details__last__option">
                                    <h5><span>Guaranteed Safe Checkout</span></h5>
                                    <img src="assets/img/shop-details/details-payment.png" alt="">
                                    <ul>
                                        <li><span>Diskon:</span> <?php echo $row['product_special_offer']." %"; ?></li>
                                        <li><span>Categories:</span> <?php echo $row['product_category']; ?></li>
                                        <li><span>Tag:</span> Poster</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p><?php echo $row['product_description']; ?></p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p><?php echo $row['product_brand']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
    </section>
    <!-- Related Section End -->

<?php
    include('layouts/footer.php');
?>