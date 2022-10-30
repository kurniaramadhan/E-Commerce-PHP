<?php
ob_start();
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<?php 
    include('header.php');
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $query_edit_product = "SELECT * FROM products WHERE product_id = ?";
        $stmt_edit_product = $conn->prepare($query_edit_product);
        $stmt_edit_product->bind_param('i', $product_id);
        $stmt_edit_product->execute();
        $products = $stmt_edit_product->get_result();

    } else if (isset($_POST['edit_btn'])) {
        $id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $brand = $_POST['product_brand'];
        $category = $_POST['product_category'];
        $criteria = $_POST['product_criteria'];
        $color = $_POST['product_color'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $special_offer = $_POST['product_special_offer'];

        $query_update_product = "UPDATE products SET product_name = ?, product_brand = ?, product_category = ?, 
            product_criteria = ?, product_color = ?, product_description = ?, product_price = ?, product_special_offer = ? 
            WHERE product_id = ?";

        $stmt_update_product = $conn->prepare($query_update_product);
        $stmt_update_product->bind_param('ssssssssi', $name, $brand, $category, $criteria, $color, $description, $price, $special_offer, $id);

        if ($stmt_update_product->execute()) {
            header('location: products.php?success_message=Product has been updated successfully');
        } else {
            header('location: products.php?fail_message=Error occured, try again!');
        }
    } else {
        header('location: products.php');
        exit;
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="edit-form" method="POST" action="edit_product.php">
                        <div class="row">
                            <?php foreach ($products as $product) { ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                                        <label>Name</label>
                                        <input class="form-control" type="text" name="product_name" value="<?php echo $product['product_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control" name="product_brand">
                                            <option value="" disabled>Select Brand</option>
                                            <option value="Dior" <?php if ($product['product_brand'] == 'Dior') echo ' selected'; ?>>Dior</option>
                                            <option value="Louis Vuitton" <?php if ($product['product_brand'] == 'Louis Vuitton') echo ' selected'; ?>>Louis Vuitton</option>
                                            <option value="Chanel" <?php if ($product['product_brand'] == 'Chanel') echo ' selected'; ?>>Chanel</option>
                                            <option value="Hermes" <?php if ($product['product_brand'] == 'Hermes') echo ' selected'; ?>>Hermes</option>
                                            <option value="Gucci" <?php if ($product['product_brand'] == 'Gucci') echo ' selected'; ?>>Gucci</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="product_category">
                                            <option value="" disabled>Select Category</option>
                                            <option value="Shoes" <?php if ($product['product_category'] == 'Shoes') echo ' selected'; ?>>Shoes</option>
                                            <option value="Jacket" <?php if ($product['product_category'] == 'Jacket') echo ' selected'; ?>>Jacket</option>
                                            <option value="Bag" <?php if ($product['product_category'] == 'Bag') echo ' selected'; ?>>Bag</option>
                                            <option value="T-Shirt" <?php if ($product['product_category'] == 'T-Shirt') echo ' selected'; ?>>T-Shirt</option>
                                            <option value="Perfume" <?php if ($product['product_category'] == 'Perfume') echo ' selected'; ?>>Perfume</option>
                                            <option value="Glasses" <?php if ($product['product_category'] == 'Glasses') echo ' selected'; ?>>Glasses</option>
                                            <option value="Scarf" <?php if ($product['product_category'] == 'Scarf') echo ' selected'; ?>>Scarf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Criteria</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="featured" name="product_criteria" value="featured" required <?php if ($product['product_criteria'] == 'featured') echo ' checked'; ?>>
                                            <label class="custom-control-label" for="featured">Featured</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="none" name="product_criteria" value="none" required <?php if ($product['product_criteria'] == 'none') echo ' checked'; ?>>
                                            <label class="custom-control-label" for="none">Non-Featured</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Color</label>
                                        <select class="form-control" name="product_color">
                                            <option value="" disabled>Select Color</option>
                                            <option value="Red" <?php if ($product['product_color'] == 'Red') echo ' selected'; ?>>Red</option>
                                            <option value="Green" <?php if ($product['product_color'] == 'Green') echo ' selected'; ?>>Green</option>
                                            <option value="Blue" <?php if ($product['product_color'] == 'Blue') echo ' selected'; ?>>Blue</option>
                                            <option value="Black" <?php if ($product['product_color'] == 'Black') echo ' selected'; ?>>Black</option>
                                            <option value="White" <?php if ($product['product_color'] == 'White') echo ' selected'; ?>>White</option>
                                            <option value="Yellow" <?php if ($product['product_color'] == 'Yellow') echo ' selected'; ?>>Yellow</option>
                                            <option value="Brown" <?php if ($product['product_color'] == 'Brown') echo ' selected'; ?>>Brown</option>
                                            <option value="Dark Brown" <?php if ($product['product_color'] == 'Dark Brown') echo ' selected'; ?>>Dark Brown</option>
                                            <option value="Gold" <?php if ($product['product_color'] == 'Gold') echo ' selected'; ?>>Gold</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="5" name="product_description"><?php echo $product['product_description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" type="number" name="product_price" value="<?php echo $product['product_price']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Special Offer</label>
                                    <input class="form-control" type="number" name="product_special_offer" value="<?php echo $product['product_special_offer']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="products.php" class="btn btn-danger">Cancel <i class="fas fa-undo"></i></a>
                            <button type="submit" class="btn btn-primary submit-btn" name="edit_btn">Update <i class="fas fa-share-square"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include('footer.php'); ?>