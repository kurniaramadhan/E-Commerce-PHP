<?php include('../server/connection.php'); ?>

<?php

if (isset($_POST['update_image_btn'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    // This is image file
    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];

    // Images name
    $image_name1 = str_replace(' ', '_', $product_name) . "1.jpg";
    $image_name2 = str_replace(' ', '_', $product_name) . "2.jpg";
    $image_name3 = str_replace(' ', '_', $product_name) . "3.jpg";
    $image_name4 = str_replace(' ', '_', $product_name) . "4.jpg";

    // Upload image
    move_uploaded_file($image1, "../assets/img/product/" . $image_name1);
    move_uploaded_file($image2, "../assets/img/product/" . $image_name2);
    move_uploaded_file($image3, "../assets/img/product/" . $image_name3);
    move_uploaded_file($image4, "../assets/img/product/" . $image_name4);

    $query_update_image = "UPDATE products SET product_image = ?, product_image2 = ?, 
    product_image3 = ?, product_image4 = ? WHERE product_id = ?";

    $stmt_update_image = $conn->prepare($query_update_image);
    $stmt_update_image->bind_param('ssssi', $image_name1, $image_name2, $image_name3, $image_name4, $product_id);
    
    if ($stmt_update_image->execute()) {
        header('location: products.php?image_success=Images have been updated successfully');
    } else {
        header('location: products.php?image_failed=Error occurs, please try again!');
    }
}

?>