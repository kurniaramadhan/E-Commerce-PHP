<?php
session_start();

if (isset($_POST['order_pay_btn'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}

$kurs_dollar = 15722;

function setRupiah($price)
{
    $result = "Rp".number_format($price, 0, ',', '.');
    return $result;
}
?>

<?php include('layouts/header.php'); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Payment</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <a href="checkout.php">Checkout</a>
                        <span>Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Payment Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="checkout__input">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span>
                            <?php if (isset($_POST['order_status'])) {
                                echo $_POST['order_status'];
                            } ?>
                        </h6>

                        <?php if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
                            <?php $amount = strval($_POST['order_total_price']); ?>
                            <?php $order_id = $_POST['order_id']; ?>
                            <h6 class="checkout__title">TOTAL PAYMENT: $<?php echo setRupiah(($_POST['order_total_price'] * $kurs_dollar)); ?></h6>
                            <!--<input type="submit" class="btn btn-primary" value="PAY NOW" />-->
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>

                        <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
                            <?php $amount = strval($_SESSION['total']); ?>
                            <?php $order_id = $_SESSION['order_id']; ?>
                            <h6 class="checkout__title">TOTAL PAYMENT: <?php echo setRupiah(($_SESSION['total'] * $kurs_dollar)); ?></h6>
                            <!--<input type="submit" class="btn btn-primary" value="PAY NOW" /> -->
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>

                        <?php } else { ?>
                            <p>You don't have an order</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Payment Section End -->

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AZc7gISngCVfWIqTNzlMZRSCsd7cte4sTB4ZrK7JEJHUGO9CEALMKj4mzo5ZIe2i6DRAiOhJouUWqxXF&currency=USD"></script>

<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $amount; ?>' // Can also reference a variable or function
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                
                window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id; ?>;
                // When ready to go live, remove the alert and show a success message within this page. For example:
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');
</script>

<?php
include('layouts/footer.php');
?>