<?php
    /*
    Status:
    Not Paid
    Paid
    Shipped
    Delivered
    */
    include('server/connection.php');

    if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];

        $query_order_details = "SELECT * FROM order_items WHERE order_id = ?";

        $stmt_order_details = $conn->prepare($query_order_details);
        $stmt_order_details->bind_param('i', $order_id);
        $stmt_order_details->execute();
        $order_details = $stmt_order_details->get_result();

        $order_total_price = calculateTotalOrderPrice($order_details);
    } else {
        header('location: account.php');
        exit;
    }

    function calculateTotalOrderPrice($order_details) {
        $total = 0;

        foreach($order_details as $row) {
           $product_price = $row['product_price'];
           $product_quantity = $row['product_quantity'];

           $total = $total + ($product_price * $product_quantity);
        }

        return $total;
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
                        <h4>Order Details</h4>
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a>
                            <a href="shop.php">Shop</a>
                            <span>Order Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Order Details Section Begin -->
    <section id="orders" class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Order Details</h2>
                        <span>***</span>
                    </div>
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order_details as $row) { ?>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="assets/img/product/<?php echo $row['product_image']; ?>" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $row['product_name']; ?></h6>
                                                <h5><?php echo setRupiah(($row['product_price'] * $kurs_dollar)); ?></h5>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h5><?php echo $row['product_quantity']; ?></h5>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h5><?php echo $row['order_date']; ?></h5>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php if ($order_status == 'not paid') { ?>
                            <form method="POST" action="payment.php">
                                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
                                <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
                                <input type="submit" name="order_pay_btn" class="btn btn-primary" style="float: right;" value="Pay Now" />
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Details Section End -->

<?php 
    include('layouts/footer.php'); 
?>