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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Brand</th>
                            <th>Product Color</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $products->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td class="text-center"><img src="<?php echo '../assets/img/product/'.$row['product_image']; ?>" style="width: 80px; height: 80px;" /></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['product_brand']; ?></td>
                                <td><?php echo $row['product_color']; ?></td>
                                <td>$<?php echo $row['product_price']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle">
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include('footer.php'); ?>