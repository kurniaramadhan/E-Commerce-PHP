<?php
    include('connection.php');

    $query_featured = "SELECT * FROM products WHERE product_criteria = 'featured' LIMIT 8";

    $stmt_featured = $conn->prepare($query_featured);

    $stmt_featured->execute();

    $featured_products = $stmt_featured->get_result();
    
?>