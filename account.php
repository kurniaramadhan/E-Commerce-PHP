<?php
    session_start();
    include('server/connection.php');

    if (!isset($_SESSION['logged_in'])) {
        header('location: login.php');
        exit;
    }

    if (isset($_GET['logout'])) {
        if (isset($_SESSION['logged_in'])) {
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            header('location: login.php');
            exit;
        }
    }

    if (isset($_POST['change_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_SESSION['user_email'];

        if ($password !== $confirm_password) {
            header('location: account.php?error=Password did not match');
        } else if (strlen($password) < 6) {
            header('location: account.php?error=Password must be at least 6 characters');

            // Inf no error
        } else {
            $query_change_password = "UPDATE users SET user_password = ? WHERE user_email = ?";

            $stmt_change_password = $conn->prepare($query_change_password);
            $stmt_change_password->bind_param('ss', md5($password), $email);

            if ($stmt_change_password->execute()) {
                header('location: account.php?message=Password has been updated successfully');
            } else {
                header('location: account.php?error=Could not update password');
            }
        }
    }

    // Get Orders by User Login
    if (isset($_SESSION['logged_in'])) {
        $user_id = $_SESSION['user_id'];

        $query_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";

        $stmt_orders = $conn->prepare($query_orders);
        $stmt_orders->bind_param('i', $user_id);
        $stmt_orders->execute();

        $user_orders = $stmt_orders->get_result();
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
                            <a href="index.php">Checkout</a>
                            <span>Account</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Account Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form id="account-form" method="POST" action="account.php">
                            <div class="alert alert-danger" role="alert">
                                <?php if (isset($_GET['error'])) {
                                    echo $_GET['error'];
                                } ?>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <?php if (isset($_GET['message'])) {
                                    echo $_GET['message'];
                                } ?>
                            </div>
                            <h6 class="checkout__title">Change Password</h6>
                            <div class="checkout__input">
                                <p>Password</p>
                                <input type="password" id="account-password" name="password">
                            </div>
                            <div class="checkout__input">
                                <p>Confirm Password</p>
                                <input type="password" id="account-confirm-password" name="confirm_password">
                            </div>
                            <div class="checkout__input">
                                <input type="submit" class="site-btn" id="change-password-btn" name="change_password" value="CHANGE PASSWORD" />
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="alert alert-info" role="alert">
                            <?php if (isset($_GET['register_success'])) {
                                echo $_GET['register_success'];
                            } ?>
                        </div>
                        <div class="checkout__order">
                            <h4 class="order__title">Account Info</h4>
                            <div class="checkout__order__products">Name <span>Email</span></div>
                            <ul class="checkout__total__products">
                                <li><?php if (isset($_SESSION['user_name'])) {
                                        echo $_SESSION['user_name'];
                                    } ?> <span><?php if (isset($_SESSION['user_email'])) {
                                                    echo $_SESSION['user_email'];
                                                } ?></span></li>
                            </ul>
                            <h4 class="order__title"></h4>
                            <a href="#orders" class="btn btn-primary">YOUR ORDERS</a>
                            <a href="account.php?logout=1" id="logout-btn" class="btn btn-danger">LOG OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Section End -->


    <!-- Orders Section Begin -->
    <section id="orders" class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Your Orders</h2>
                        <span>***</span>
                    </div>
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $user_orders->fetch_assoc()) { ?>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $row['order_id']; ?></h6>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $row['order_cost']; ?></h6>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h6><?php echo $row['order_status']; ?></h6>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h5><?php echo $row['order_date']; ?></h5>
                                            </div>
                                        </td>
                                        <form method="POST" action="order_details.php">
                                            <td class="cart__price">
                                                <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status" />
                                                <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
                                                <input class="btn btn-success" name="order_details_btn" type="submit" value="Details" />
                                            </td>
                                        </form>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Orders Section End -->

    <!-- Footer Section Begin -->
<?php include('layouts/footer.php'); ?>