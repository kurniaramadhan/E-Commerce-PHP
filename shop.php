<?php
include('server/connection.php');

// Use search section
if (isset($_POST['search']) && isset($_POST['category'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // If the user already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then the default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];

    $query_products = "SELECT * FROM products WHERE product_category = ?";

    $stmt_products = $conn->prepare($query_products);
    $stmt_products->bind_param('s', $category);
    $stmt_products->execute();
    $products = $stmt_products->get_result();
} else if (isset($_POST['search']) && isset($_POST['brand'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // If the user already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then the default page is 1
        $page_no = 1;
    }

    $brand = $_POST['brand'];

    $query_products = "SELECT * FROM products WHERE product_brand = ?";

    $stmt_products = $conn->prepare($query_products);
    $stmt_products->bind_param('s', $brand);
    $stmt_products->execute();
    $products = $stmt_products->get_result();
} else if (isset($_POST['search']) && isset($_POST['price'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // If the user already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then the default page is 1
        $page_no = 1;
    }

    $price = $_POST['price'];

    $query_products = "SELECT * FROM products WHERE product_price <= ?";

    $stmt_products = $conn->prepare($query_products);
    $stmt_products->bind_param('i', $price);
    $stmt_products->execute();
    $products = $stmt_products->get_result();
} else {
    //Return all product
    // 1. Determine page number
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // If the user already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then the default page is 1
        $page_no = 1;
    }

    // 2. Return the number of products
    $query_total_products = "SELECT COUNT(*) AS total_products FROM products";
    $stmt_total_products = $conn->prepare($query_total_products);
    $stmt_total_products->execute();
    $stmt_total_products->bind_result($total_products);
    $stmt_total_products->store_result();
    $stmt_total_products->fetch();

    // 3. Product per page
    $total_product_per_page = 6;
    $offset = ($page_no - 1) * $total_product_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacent = "2";
    $total_number_of_pages = ceil($total_products / $total_product_per_page);

    // 4. Get all products
    $query_products = "SELECT * FROM products LIMIT $offset, $total_product_per_page";
    $stmt_products = $conn->prepare($query_products);
    $stmt_products->execute();
    $products = $stmt_products->get_result();
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
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home <i class="fas fa-chevron-right"></i></a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <form method="POST" action="shop.php">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories <i class="fas fa-chevron-down"></i></a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Alfabet" name="category" id="category_one" <?php if (isset($category) && $category == 'Alfabet') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Alfabet
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Angka" name="category" id="category_two" <?php if (isset($category) && $category == 'Angka') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Angka
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Kalender" name="category" id="category_three" <?php if (isset($category) && $category == 'Kalender') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Kalender
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Peta" name="category" id="category_four" <?php if (isset($category) && $category == 'Peta') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Peta
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Hewan" name="category" id="category_five" <?php if (isset($category) && $category == 'Hewan') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Hewan
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Tabel Periodik" name="category" id="category_five" <?php if (isset($category) && $category == 'Tabel Periodik') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Tabel Periodik
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Buah dan Sayur" name="category" id="category_five" <?php if (isset($category) && $category == 'Buah dan Sayur') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Buah dan Sayur
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Hijaiyah" name="category" id="category_five" <?php if (isset($category) && $category == 'Hijaiyah') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="category">
                                                                Hijaiyah
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Paper Type <i class="fas fa-chevron-down"></i></a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Art Paper" name="brand" id="brand_one" <?php if (isset($brand) && $brand == 'Art Paper') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Art Paper
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Laminasi Glossy" name="brand" id="brand_two" <?php if (isset($brand) && $brand == 'Laminasi Glossy') {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Laminasi Glossy
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="NCR" name="brand" id="brand_three" <?php if (isset($brand) && $brand == 'NCR') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                NCR
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Concorde" name="brand" id="brand_four" <?php if (isset($brand) && $brand == 'Concorde') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Concorde
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Art Carton" name="brand" id="brand_five" <?php if (isset($brand) && $brand == 'Art Carton') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Art Carton
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Ivory" name="brand" id="brand_five" <?php if (isset($brand) && $brand == 'Ivory') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Ivory
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Matt Paper" name="brand" id="brand_five" <?php if (isset($brand) && $brand == 'Matt Paper') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Matt Paper
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Linen Jepang" name="brand" id="brand_five" <?php if (isset($brand) && $brand == 'Linen Jepang') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Linen Jepang
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-secondary" onClick="history.go(0);"><i class="fas fa-sync-alt"></i></button>
                                        <input type="submit" class="btn btn-primary" name="search" value="Search" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1 – <?php if (isset($total_product_per_page)) {
                                                    echo $total_product_per_page;
                                                } ?> of <?php if (isset($total_products)) {
                                                            echo $total_products;
                                                        } ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php while ($row = $products->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?php echo $row['product_image']; ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="assets/img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="#"><img src="assets/img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?php echo $row['product_name']; ?></h6>
                                    <h5><?php echo $row['product_brand']; ?></h5>
                                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <h5><?php echo setRupiah($row['product_price'] * $kurs_dollar); ?></h5>
                                    <div class="product__color__select">
                                        <label for="pc-4">
                                            <input type="radio" id="pc-4">
                                        </label>
                                        <label class="active black" for="pc-5">
                                            <input type="radio" id="pc-5">
                                        </label>
                                        <label class="grey" for="pc-6">
                                            <input type="radio" id="pc-6">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?php if ($page_no <= 1) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="<?php if ($page_no <= 1) {
                                                                    echo '#';
                                                                } else {
                                                                    echo "?page_no=" . ($page_no - 1);
                                                                } ?>">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                                <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                                <?php if ($page_no >= 3) { ?>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
                                <?php } ?>
                                <li class="page-item <?php if ($page_no >= $total_number_of_pages) {
                                                            echo 'disabled';
                                                        } ?>">
                                    <a class="page-link" href="<?php if ($page_no >= $total_number_of_pages) {
                                                                    echo '#';
                                                                } else {
                                                                    echo "?page_no=" . ($page_no + 1);
                                                                } ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php
include('layouts/footer.php');
?>