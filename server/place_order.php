<?php 
    session_start();
    include('connection.php');
    // If user is not logged in
    if (!isset($_SESSION['logged_in'])) {
        header('location: ../checkout.php?message=Please Login or Register to Place an Order');
        exit;
    
    // If user is logged in
    } else {
        if (isset($_POST['place_order'])) {
            // 1. Get user info and save to the database
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $order_cost = $_SESSION['total'];
            $order_status = "not paid";
            $user_id = $_SESSION['user_id'];
            $order_date = date('Y-m-d h:i:s');
    
            $query_orders = "INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            $stmt_orders = $conn->prepare($query_orders);
            $stmt_orders->bind_param('ssissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
            $stmt_status = $stmt_orders->execute();
    
            if (!$stmt_status) {
                header('location: ../index.php');
                exit;
            }
    
            // 2. Issue new order and store order info to the database
            $order_id = $stmt_orders->insert_id;
    
            // 3. Get products from the cart
            foreach ($_SESSION['cart'] as $key => $value) {
                $product = $_SESSION['cart'][$key];
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_image = $product['product_image'];
                $product_price = $product['product_price'];
                $product_quantity = $product['product_quantity'];
    
                // 4. Store each single item to the order item in database
                $query_order_items = "INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
                $stmt_order_items = $conn->prepare($query_order_items);
                $stmt_order_items->bind_param('iissssis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
                $stmt_order_items->execute();
            }
    
            // 5. Remove everything from cart --> delay until payment is done
            //unset($_SESSION['cart']);

            $_SESSION['order_id'] = $order_id;
    
            // 6. Inform user whether everyhting is fine or there is a problem
            header('location: ../payment.php?order_status="order placed successfully"');
        }

    }
