<?php
    session_start();
    if (isset($_POST['add_to_cart'])) {
        // If user has already add product to the cart
        if (isset($_SESSION['cart'])) {
            $products_array_ids = array_column($_SESSION['cart'], "product_id");
            // If product has already added to cart or not
            if (!in_array($_POST['product_id'], $products_array_ids)) {
                $product_id = $_POST['product_id'];

                $product_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity']
                );

                $_SESSION['cart'][$product_id] = $product_array;

                // Product has already been added
            } else {
                echo '<script>alert("Product was already added to the cart")</script>';
            }

            // If user the first add product to the cart
        } else {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];

            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );

            $_SESSION['cart'][$product_id] = $product_array;
        }

        // Calculate total
        calculateTotalCart();

        // Remove product from the cart
    } else if (isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];

        unset($_SESSION['cart'][$product_id]);

        // Calculate total
        calculateTotalCart();

        // Codingan baru
    } else if (isset($_POST['edit_quantity'])) {
        // We get the id from the form
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];

        // We get product array from the session
        $product_array = $_SESSION['cart'][$product_id];

        // Update the product quantity
        $product_array['product_quantity'] = $product_quantity;

        // Return array back its place
        $_SESSION['cart'][$product_id] = $product_array;

        // Calculate total
        calculateTotalCart();
        
    } else {
        //header('location: index.php');
    }

    function calculateTotalCart() {
        $total = 0;

        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total = $total + ($price * $quantity);
        }

        $_SESSION['total'] = $total;
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
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a>
                            <a href="shop.php">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="assets/img/product/<?php echo $value['product_image']; ?>" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $value['product_name']; ?></h6>
                                                <h5><?php echo $value['product_price']; ?></h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <form method="POST" action="shopping-cart.php">
                                                    <div>
                                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>"/>
                                                        <h6><input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"></h6>
                                                        <!--
                                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                                                        -->
                                                    </div>
                                                    <div>
                                                        <button class="editbtn" type="submit" name="edit_quantity"><i class="fa fa-refresh"></i> Update</button>
                                                    </div>
                                                    <!--
                                                    <div>
                                                        <button class="editbtn" type="submit" name="edit_quantity"><i class="fa fa-refresh"></i> Update Qty</button>
                                                    </div>
                                                    -->
                                                </form>
                                            </div>
                                        </td>
                                        <td class="cart__price">
                                            <span>$ </span>
                                            <span><?php echo $value['product_quantity'] * $value['product_price']; ?> </span>
                                        </td>
                                        <form method="POST" action="shopping-cart.php">
                                            <td>
                                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                                <button type="submit" class="btn btn-danger" name="remove_product"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </form>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="shop.php" class="btn btn-primary">Continue Shopping <i class="fa fa-arrow-circle-o-right fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span>$ <?php echo $_SESSION['total']; ?></span></li>
                        </ul>
                        <form method="POST" action="checkout.php">
                            <input type="submit" class="primary-btn" value="Checkout" name="checkout">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<?php
    include('layouts/footer.php');
?>