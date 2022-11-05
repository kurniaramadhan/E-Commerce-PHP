<?php
    session_start();
    include('server/connection.php');

    if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit;
    }

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];

        // This is image file
        $photo = $_FILES['photo']['tmp_name'];

        // Photo name
        $photo_name = str_replace(' ', '_', $name) . ".jpg";

        // Upload image
        move_uploaded_file($photo, "assets/img/profile/" . $photo_name);

        // If password didn't match
        if ($password !== $confirm_password) {
            header('location: register.php?error=Password did not match');

        // If password less than 6 characters
        } else if (strlen($password) < 6) {
            header('location: register.php?error=Password must be at least 6 characters');

        // Inf no error
        } else {
            // Check whether there is a user with this email or not
            $query_check_user = "SELECT COUNT(*) FROM users WHERE user_email = ?";

            $stmt_check_user = $conn->prepare($query_check_user);
            $stmt_check_user->bind_param('s', $email);
            $stmt_check_user->execute();
            $stmt_check_user->bind_result($num_rows);
            $stmt_check_user->store_result();
            $stmt_check_user->fetch();

            // If there is a user registered with this email
            if ($num_rows !== 0) {
                header('location: register.php?error=User with this email already exists');
            
            // If no user registered with this email
            } else {
                $query_save_user = "INSERT INTO users (user_name, user_email, user_password, user_phone, user_address, user_city, user_photo) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)";

                // Create a new user
                $stmt_save_user = $conn->prepare($query_save_user);
                $stmt_save_user->bind_param('ssssss', $name, $email, md5($password), $phone, $address, $city, $photo_name);
                
                // If account was created successfully
                if ($stmt_save_user->execute()) {
                    $user_id = $stmt_save_user->insert_id;

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_photo'] = $photo_name;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register_success=You registered successfully!');
                // If account couldn't registered
                } else {
                    header('location: register.php?error=Could not create an account at the moment');
                }
            }
        }
    }
?>

<?php
    include('layouts/header.php');
?>

    <!-- Register Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="checkout-form" method="POST" action="register.php">
                    <div class="alert alert-danger" role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h6 class="checkout__title">Registration</h6>
                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input type="text" id="registered-name" name="name" required>
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input id="registered-email" type="email" name="email" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Password<span>*</span></p>
                                        <input id="registered-password" type="password" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Confirm Password<span>*</span></p>
                                        <input id="registered-confirm-password" type="password" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Phone<span></span></p>
                                <input type="text" name="phone">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span></span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div>
                                <p>Photo<span></span></p>
                                <div class="custom-file">
                                    <input type="file" id="photo" name="photo" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="cold-md-12">
                                    <p> </p>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <input type="submit" class="site-btn" id="register-btn" name="register" value="REGISTER" />
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    <a id="login-url" href="login.php">Do you have an account? Login</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Register Section End -->

<?php
    include('layouts/footer.php');
?>