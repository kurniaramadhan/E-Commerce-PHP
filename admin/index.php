<?php
    session_start();

    include ('../server/connection.php');
    
    if (!isset($_SESSION['admin_logged_in'])) {
        header('location: login.php');
    }
?>

<?php
    $query_total_orders = "SELECT COUNT(*) AS total_orders FROM orders";
    $stmt_total_orders = $conn->prepare($query_total_orders);
    $stmt_total_orders->execute();
    $stmt_total_orders->bind_result($total_orders);
    $stmt_total_orders->store_result();
    $stmt_total_orders->fetch();

    $query_total_payments = "SELECT SUM(o.order_cost) AS total_payments FROM payments p, orders o WHERE p.order_id = o.order_id";
    $stmt_total_payments = $conn->prepare($query_total_payments);
    $stmt_total_payments->execute();
    $stmt_total_payments->bind_result($total_payments);
    $stmt_total_payments->store_result();
    $stmt_total_payments->fetch();

    $query_total_paid = "SELECT COUNT(*) AS total_paid FROM orders WHERE order_status = 'delivered' OR order_status = 'shipped' OR order_status = 'paid'";
    $stmt_total_paid = $conn->prepare($query_total_paid);
    $stmt_total_paid->execute();
    $stmt_total_paid->bind_result($total_paid);
    $stmt_total_paid->store_result();
    $stmt_total_paid->fetch();

    $query_total_not_paid = "SELECT COUNT(*) AS total__not_paid FROM orders WHERE order_status = 'not paid'";
    $stmt_total_not_paid = $conn->prepare($query_total_not_paid);
    $stmt_total_not_paid->execute();
    $stmt_total_not_paid->bind_result($total_not_paid);
    $stmt_total_not_paid->store_result();
    $stmt_total_not_paid->fetch();

    $kurs_dollar = 15722;

    function setRupiah($price)
    {
        $result = "Rp".number_format($price, 0, ',', '.');
        return $result;
    }
?>

<?php include('header.php'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_orders)) { echo $total_orders; } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_payments)) { echo setRupiah(($total_payments * $kurs_dollar)); } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Paid</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_paid)) { echo $total_paid; } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Not Paid</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_not_paid)) { echo $total_not_paid; } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?php include('footer.php'); ?>