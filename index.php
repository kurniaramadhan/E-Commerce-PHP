<?php
include('server/products.php');
include('server/limit_blog.php');
include('layouts/header.php');

$kurs_dollar = 15722;

function setRupiah($price){
	$result = "Rp".number_format($price,0,',','.');
	return $result;
}
?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="assets/img/hero/banner1.jpg">
            </div>
            <div class="hero__items set-bg" data-setbg="assets/img/hero/banner2.jpg">
            </div>
            <div class="hero__items set-bg" data-setbg="assets/img/hero/banner3.jpg">
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="assets/img/banner/b-edukasi440x440.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Mainan<br>Edukasi</h2>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="assets/img/banner/b-planner480x440.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Poster<br>Planner</h2>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="assets/img/banner/b-kalender470x470.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Kalender<br>2022</h2>
                            <a href="shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Featured Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Featured</h2>
                        <span>Here you can check out our featured products</span>
                    </div>
                </div>
            </div>
            <div class="row product__filter">
                <?php while ($row = $featured_products->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix all-products">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image']; ?>">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="assets/img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="assets/img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><?php echo $row['product_name']; ?></h6>
                                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <h5><?php echo setRupiah(($row['product_price'] * $kurs_dollar)); ?></h5>
                                <div class="product__color__select">
                                    <label for="pc-7">
                                        <input type="radio" id="pc-7">
                                    </label>
                                    <label class="active black" for="pc-8">
                                        <input type="radio" id="pc-8">
                                    </label>
                                    <label class="grey" for="pc-9">
                                        <input type="radio" id="pc-9">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Featured Product Section End -->
    
    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Mainan Edukasi <br /> <span>Poster Edukasi</span> <br /> Kalender</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="assets/img/a-edukasi.jpg" alt="">
                        <div class="hot__deal__sticker">
                            <span>Harga</span>
                            <h5>Rp12.500</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Tawaran Bulan Ini</span>
                        <h2>Promo Poster Edukasi</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="shop.php" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Kamu bisa beli satuan ya. <br> No min. Order. <br> Jadikan hari spesial keluargamu semakin berkesan, dengan hadiah spesial dari kamu nih 🌼 <br> Buat yg ingin pesan langsung hub. Ke no yg tertera di bio ya</p>
                        <h3>@mfbinary</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>BLOGS</span>
                        <h2>Latest Post</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php while ($row = $limit_blog->fetch_assoc()) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="<?php echo 'assets/img/blog/'.$row['blog_image']; ?>"></div>
                            <div class="blog__item__text">
                                <span><img src="assets/img/icon/calendar.png" alt=""> <?php echo date('d F Y', strtotime($row['blog_date'])); ?></span>
                                <h5><?php echo $row['blog_title']; ?></h5>
                                <a href="<?php echo "blog-details.php?blog_id=" . $row['blog_id']; ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <!-- Footer Section Begin -->
<?php include ('layouts/footer.php'); ?>