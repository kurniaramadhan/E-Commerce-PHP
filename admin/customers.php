<?php
    session_start();

    if (!isset($_SESSION['admin_logged_in'])) {
        header('location: login.php');
    }
    ?>
<?php include('header.php'); ?>

<?php
    $query_customers = "SELECT * FROM users";

    $stmt_customers = $conn->prepare($query_customers);
    $stmt_customers->execute();
    $customers = $stmt_customers->get_result();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customers</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Photo</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Customer Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customers as $customer) { ?>
                            <tr>
                                <td><?php echo $customer['user_id']; ?></td>
                                <td class="text-center"><img src="<?php echo '../assets/img/profile/' . $customer['user_photo']; ?>" style="width: 80px; height: 80px;" /></td>
                                <td><?php echo $customer['user_name']; ?></td>
                                <td><?php echo $customer['user_email']; ?></td>
                                <td><?php echo $customer['user_phone']; ?></td>
                                <td><?php echo $customer['user_address'] . ', ' . $customer['user_city']; ?></td>
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