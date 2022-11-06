<?php
ob_start();
session_start();
include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<?php
if (isset($_POST['create_btn'])) {
    $product_name = $_POST['product_name'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $product_criteria = $_POST['product_criteria'];
    $product_color = $_POST['product_color'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'];

    // This is image file
    $product_image1 = $_FILES['product_image1']['tmp_name'];
    $product_image2 = $_FILES['product_image2']['tmp_name'];
    $product_image3 = $_FILES['product_image3']['tmp_name'];
    $product_image4 = $_FILES['product_image4']['tmp_name'];

    // Images name
    $image_name1 = str_replace(' ', '_', $product_name) . "1.jpg";
    $image_name2 = str_replace(' ', '_', $product_name) . "2.jpg";
    $image_name3 = str_replace(' ', '_', $product_name) . "3.jpg";
    $image_name4 = str_replace(' ', '_', $product_name) . "4.jpg";

    // Upload image
    move_uploaded_file($product_image1, "../assets/img/product/" . $image_name1);
    move_uploaded_file($product_image2, "../assets/img/product/" . $image_name2);
    move_uploaded_file($product_image3, "../assets/img/product/" . $image_name3);
    move_uploaded_file($product_image4, "../assets/img/product/" . $image_name4);

    $query_insert_product = "INSERT INTO products (product_name, product_brand, product_category, 
        product_description, product_criteria, product_image, product_image2, product_image3, 
        product_image4, product_price, product_special_offer, product_color) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_insert_product = $conn->prepare($query_insert_product);

    $stmt_insert_product->bind_param(
        'ssssssssssss',
        $product_name,
        $product_brand,
        $product_category,
        $product_description,
        $product_criteria,
        $image_name1,
        $image_name2,
        $image_name3,
        $image_name4,
        $product_price,
        $product_special_offer,
        $product_color
    );

    if ($stmt_insert_product->execute()) {
        header('location: products.php?success_create_message=Product has been created successfully');
    } else {
        header('location: products.php?fail_create_message=Could not create product!');
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Product</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">Create Product</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label>Paper Type</label>
                                    <select class="form-control" name="product_brand">
                                        <option value="" disabled selected>Select Paper Type</option>
                                        <option value="Art Paper">Art Paper</option>
                                        <option value="Laminasi Glossy">Laminasi Glossy</option>
                                        <option value="NCR">NCR</option>
                                        <option value="Concorde">Concorde</option>
                                        <option value="Art Carton">Art Carton</option>
                                        <option value="Ivory">Ivory</option>
                                        <option value="Matt Paper">Matt Paper</option>
                                        <option value="Linen Jepang">Linen Jepang</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="product_category">
                                        <option value="" disabled selected>Select Category</option>
                                        <option value="Alfabet">Alfabet</option>
                                        <option value="Angka">Angka</option>
                                        <option value="Kalender">Kalender</option>
                                        <option value="Peta">Peta</option>
                                        <option value="Hewan">Hewan</option>
                                        <option value="Tabel Periodik">Tabel Periodik</option>
                                        <option value="Hewan">Buah dan Sayur</option>
                                        <option value="Hijaiyah">Hijaiyah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Criteria</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="featured" name="product_criteria" value="featured" required>
                                        <label class="custom-control-label" for="featured">Featured</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="none" name="product_criteria" value="none" required>
                                        <label class="custom-control-label" for="none">Non-Featured</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control" name="product_color">
                                        <option value="" disabled selected>Select Color</option>
                                        <option value="Red">Red</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Dark Brown">Dark Brown</option>
                                        <option value="Gold">Gold</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="5" name="product_description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" type="text" name="product_price">
                                </div>
                                <div class="form-group">
                                    <label>Special Offer</label>
                                    <input class="form-control" type="text" name="product_special_offer">
                                </div>
                                <label>Image 1</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="addImage1" name="product_image1" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage1">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 2</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="addImage2" name="product_image2" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage2">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 3</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="addImage3" name="product_image3" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage1">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 4</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="addImage4" name="product_image4" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage1">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="products.php" class="btn btn-danger">Cancel <i class="fas fa-undo"></i></a>
                            <button type="submit" class="btn btn-primary submit-btn" name="create_btn">Create <i class="fas fa-save"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include('footer.php'); ?>