<?php
include('server/connection.php');

// Use search section
if (isset($_POST['search']) && isset($_POST['category']) && isset($_POST['brand']) && isset($_POST['price'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        // If the user already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        // If user just entered the page then the default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];

    $query_products = "SELECT * FROM products WHERE product_category = ? AND product_brand = ? AND product_price <= ?";

    $stmt_products = $conn->prepare($query_products);
    $stmt_products->bind_param('ssi', $category, $brand, $price);
    $stmt_products->execute();
    $products = $stmt_products->get_result();
} else if (isset($_POST['search']) && isset($_POST['category'])) {
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
                        <a href="index.php">Home</a>
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
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Shoes" name="category" id="category_one" <?php if (isset($category) && $category == 'Shoes') { echo 'checked'; } ?> >
                                                            <label class="form-check-label" for="category">
                                                                Shoes
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="T-Shirt" name="category" id="category_two" <?php if (isset($category) && $category == 'T-Shirt') { echo 'checked'; } ?> >
                                                            <label class="form-check-label" for="category">
                                                                T-Shirt
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Jacket" name="category" id="category_three" <?php if (isset($category) && $category == 'Jacket') { echo 'checked'; } ?> >
                                                            <label class="form-check-label" for="category">
                                                                Jacket
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Scarf" name="category" id="category_four" <?php if (isset($category) && $category == 'Scarf') { echo 'checked'; } ?> >
                                                            <label class="form-check-label" for="category">
                                                                Scarf
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Perfume" name="category" id="category_five" <?php if (isset($category) && $category == 'Perfume') { echo 'checked'; } ?> >
                                                            <label class="form-check-label" for="category">
                                                                Perfume
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
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Dior" name="brand" id="brand_one" <?php if (isset($brand) && $brand == 'Dior') { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Dior
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Louis Vuitton" name="brand" id="brand_two" <?php if (isset($brand) && $brand == 'Louis Vuitton') { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Louis Vuitton
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Chanel" name="brand" id="brand_three" <?php if (isset($brand) && $brand == 'Chanel') { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Chanel
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Hermes" name="brand" id="brand_four" <?php if (isset($brand) && $brand == 'Hermes') { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Hermes
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="Gucci" name="brand" id="brand_five" <?php if (isset($brand) && $brand == 'Gucci') { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="brand">
                                                                Gucci
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
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="50.00" name="price" id="price_one">
                                                            <label class="form-check-label" for="price">
                                                                $0.00 - $50.00
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="100.00" name="price" id="price_two">
                                                            <label class="form-check-label" for="price">
                                                                $50.00 - $100.00
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="150.00" name="price" id="price_three">
                                                            <label class="form-check-label" for="price">
                                                                $100.00 - $150.00
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="200.00" name="price" id="price_four">
                                                            <label class="form-check-label" for="price">
                                                                $150.00 - $200.00
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="250.00" name="price" id="price_five">
                                                            <label class="form-check-label" for="price">
                                                                $200.00 - $250.00
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="251.00" name="price" id="price_six" <?php if (isset($price) && $price > 250000) { echo 'checked'; } ?>>
                                                            <label class="form-check-label" for="price">
                                                                $250.00+
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
                                <p>Showing 1 – <?php if (isset($total_product_per_page)) { echo $total_product_per_page; } ?> of <?php if (isset($total_products)) { echo $total_products; } ?> results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php while ($row = $products->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
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
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>$<?php echo $row['product_price']; ?></h5>
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
                                <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if ($page_no <= 1) { echo '#'; } else { echo "?page_no=".($page_no-1); } ?>">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                                <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                                <?php if ($page_no >= 3) { ?>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
                                <?php } ?>
                                <li class="page-item <?php if ($page_no >= $total_number_of_pages) { echo 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if ($page_no >= $total_number_of_pages) { echo '#'; } else { echo "?page_no=".($page_no+1); } ?>">Next</a>
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