<?php
    ob_start();
    session_start();
    include('header.php');

    if (!isset($_SESSION['admin_logged_in'])) {
        header('location: login.php');
    }
?>

<?php 
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $query_edit_order = "SELECT * FROM orders WHERE order_id = ?";
        $stmt_edit_order = $conn->prepare($query_edit_order);
        $stmt_edit_order->bind_param('i', $order_id);
        $stmt_edit_order->execute();
        $orders = $stmt_edit_order->get_result();

    } else if (isset($_POST['edit_btn'])) {
        $o_id = $_POST['order_id'];
        $o_status = $_POST['order_status'];

        $query_update_status = "UPDATE orders SET order_status = ? WHERE order_id = ?";

        $stmt_update_status = $conn->prepare($query_update_status);
        $stmt_update_status->bind_param('si', $o_status, $o_id);

        if ($stmt_update_status->execute()) {
            header('location: orders.php?success_status=Status has been updated successfully');
        } else {
            header('location: orders.php?fail_status=Could not update order status!');
        }
    } else {
        header('location: orders.php');
        exit;
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Order</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Orders</a></li>
            <li class="breadcrumb-item active">Edit Order</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Order</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="edit-form" method="POST" action="edit_order.php">
                        <div class="row">
                            <?php foreach ($orders as $order) { ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Order ID</label>
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>" />
                                        <input class="form-control" type="text" value="<?php echo $order['order_id']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Order Status</label>
                                        <select class="form-control" name="order_status" <?php if ($order['order_status'] == 'delivered') echo ' disabled'; ?>>
                                            <option value="" disabled>Select Status</option>
                                            <option value="not paid" <?php if ($order['order_status'] == 'not paid') echo ' selected'; ?>>Not Paid</option>
                                            <option value="paid" <?php if ($order['order_status'] == 'paid') echo ' selected'; ?>>Paid</option>
                                            <option value="shipped" <?php if ($order['order_status'] == 'shipped') echo ' selected'; ?>>Shipped</option>
                                            <option value="delivered" <?php if ($order['order_status'] == 'delivered') echo ' selected'; ?>>Delivered</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input class="form-control" type="text" value="<?php echo $order['user_id']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Order Date</label>
                                        <input class="form-control" type="text" value="<?php echo $order['order_date']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>User Phone</label>
                                        <input class="form-control" type="text" value="<?php echo $order['user_phone']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>User Address</label>
                                        <input class="form-control" type="text" value="<?php echo $order['user_address']; ?>" disabled>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="orders.php" class="btn btn-danger">Cancel <i class="fas fa-undo"></i></a>
                            <button type="submit" class="btn btn-primary submit-btn" name="edit_btn">Update <i class="fas fa-share-square"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include('footer.php'); ?>