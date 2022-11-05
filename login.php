<?php
    session_start();
    include('server/connection.php');

    if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit;
    }

    if (isset($_POST['login_btn'])) {
        $email = $_POST['user_email'];
        $password = md5($_POST['user_password']);

        $query = "SELECT user_id, user_name, user_email, user_password, user_phone, user_address, user_city, user_photo FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

        $stmt_login = $conn->prepare($query);
        $stmt_login->bind_param('ss', $email, $password);
        
        if ($stmt_login->execute()) {
            $stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo);
            $stmt_login->store_result();

            if ($stmt_login->num_rows() == 1) {
                $stmt_login->fetch();

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_phone'] = $user_phone;
                $_SESSION['user_address'] = $user_address;
                $_SESSION['user_city'] = $user_city;
                $_SESSION['user_photo'] = $user_photo;
                $_SESSION['logged_in'] = true;

                header('location: account.php?message=Logged in successfully');
            } else {
                header('location: login.php?error=Could not verify your account');
            }
        } else {
            // Error
            header('location: login.php?error=Something went wrong!');
        }
    }
?>

<?php include('layouts/header.php'); ?>

    <!-- Login Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="login-form" method="POST" action="login.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php if (isset($_GET['error'])) {
                                echo $_GET['error'];
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h6 class="checkout__title">Login</h6>
                            <div class="checkout__input">
                                <p>Email</p>
                                <input type="email" name="user_email">
                            </div>
                            <div class="checkout__input">
                                <p>Password</p>
                                <input type="password" name="user_password">
                            </div>
                            <div class="checkout__input">
                                <input type="submit" class="site-btn" id="login-btn" name="login_btn" value="LOGIN" />
                            </div>
                            <div class="checkout__input__checkbox">
                                <label>
                                    <a id="register-url" href="register.php">Do you have an account? Register</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <!-- Footer Section Begin -->
<?php include('layouts/footer.php'); ?>