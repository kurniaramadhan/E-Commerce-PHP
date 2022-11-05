<?php
    session_start();
    include('../server/connection.php');
?>

<?php
    if (!isset($_SESSION['admin_logged_in'])) {
        header('location: login.php');
    }

    if (isset($_GET['product_id'])) {
        
        $product_id = $_GET['product_id'];
        

        $query_delete_product = "DELETE FROM products WHERE product_id = ?";
        $stmt_delete_product = $conn->prepare($query_delete_product);
        $stmt_delete_product->bind_param('i', $product_id);

        if ($stmt_delete_product->execute()) {
            header('location: products.php?success_delete_message=Product has been deleted successfully');
        } else {
            header('location: products.php?fail_delete_message=Could not delete product');
        }
    } 
?>

