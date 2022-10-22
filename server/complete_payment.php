<?php
    session_start();
    include('connection.php');

    if (isset($_GET['transaction_id']) && isset($_GET['order_id'])) {
        
        $order_id = $_GET['order_id'];
        $order_status = "paid";
        $transaction_id = $_GET['transaction_id'];
        $user_id = $_SESSION['user_id'];
        $payment_date = date('Y-m-d H:i:s');

        // Change the order status to paid
        $query_change_order_status = "UPDATE orders SET order_status = ? WHERE order_id = ?";

        $stmt_change_order_status = $conn->prepare($query_change_order_status);
        $stmt_change_order_status->bind_param('si', $order_status, $order_id);
        $stmt_change_order_status->execute();
        
        // Store payment info
        $query_save_payment = "INSERT INTO payments (order_id, user_id, transaction_id, payment_date) VALUES (?, ?, ?, ?)";
        $stmt_save_payment = $conn->prepare($query_save_payment);
        $stmt_save_payment->bind_param('iiss', $order_id, $user_id, $transaction_id, $payment_date);
        $stmt_save_payment->execute();

        // Go to user account
        header('location: ../account.php?payment_message=Paid successfully, thanks for your shopping with us');

    } else {
        header('location: ../index.php');
        exit;
    }
?>