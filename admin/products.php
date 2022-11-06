<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<?php include('header.php'); ?>

<?php
    $query_products = "SELECT * FROM products";

    $stmt_products = $conn->prepare($query_products);
    $stmt_products->execute();
    $products = $stmt_products->get_result();

    $kurs_dollar = 15722;

    function setRupiah($price)
    {
        $result = "Rp".number_format($price, 0, ',', '.');
        return $result;
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">Product List</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
        </div>
        <div class="card-body">
            <?php if (isset($_GET['success_update_message'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php if (isset($_GET['success_update_message'])) {
                        echo $_GET['success_update_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['fail_update_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['fail_update_message'])) {
                        echo $_GET['fail_update_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success_delete_message'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php if (isset($_GET['success_delete_message'])) {
                        echo $_GET['success_delete_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['fail_delete_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['fail_delete_message'])) {
                        echo $_GET['fail_delete_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success_create_message'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php if (isset($_GET['success_create_message'])) {
                        echo $_GET['success_create_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['fail_create_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['fail_create_message'])) {
                        echo $_GET['fail_create_message'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['image_success'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php if (isset($_GET['image_success'])) {
                        echo $_GET['image_success'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['image_failed'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['image_failed'])) {
                        echo $_GET['image_failed'];
                    } ?>
                </div>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Brand</th>
                            <th>Product Category</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td class="text-center"><img src="<?php echo '../assets/img/product/' . $product['product_image']; ?>" style="width: 80px; height: 80px;" /></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['product_brand']; ?></td>
                                <td><?php echo $product['product_category']; ?></td>
                                <td><?php echo setRupiah(($product['product_price'] * $kurs_dollar)); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo 'edit_image.php?product_id=' . $product['product_id'] . '&product_name=' . $product['product_name']; ?>" class="btn btn-warning btn-circle">
                                        <i class="fas fa-images"></i>
                                    </a>
                                    <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include('footer.php'); ?>