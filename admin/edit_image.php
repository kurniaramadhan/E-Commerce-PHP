<?php
ob_start();
session_start();
include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
} else {
    header('location: products.php');
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Image</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">Edit Image</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Images</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="edit-image-form" enctype="multipart/form-data" method="POST" action="update_image.php">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>" />
                                <label>Image 1</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage1" name="image1" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage1">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 2</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage2" name="image2" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage2">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 3</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage3" name="image3" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage3">Choose file...</label>
                                    </div>
                                </div>
                                <label>Image 4</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage4" name="image4" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="editImage4">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-right">
                        <a href="products.php" class="btn btn-danger">Cancel <i class="fas fa-undo"></i></a>
                            <button type="submit" class="btn btn-primary submit-btn" name="update_image_btn">Update Image <i class="fas fa-save"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include('footer.php'); ?>