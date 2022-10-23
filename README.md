# E-Commerce-PHP
E-commerce PHP is an e-commerce application developed using the native PHP programming language. Some of the technology stacks used in this application are:
- Programming language: PHP
- Databases: MySQL
- [Local web server: XAMPP (includes php, mysql, and apache)](https://www.apachefriends.org/download.html)
- [IDE: Visual Studio Code](https://code.visualstudio.com/)
- [Visual Database Management: phpMyAdmin or Heidi SQL](https://www.heidisql.com/download.php)
- Login Access: username: user1@gmail.com pass: 1234567, username: user2@gmail.com, pass: 1234567, username: user3@gmail.com pass: 1234567

## Feature:
- Login
- Register
- Display Account
- Change Password
- Product List
- Product Details
- Shopping Cart
- Checkout
- Payment Using Paypal
- Pagination
- Admin Dashboard

## Configuration:
- Clone this project and save it in C:\xampp\htdocs\
- Create database in your local DBMS using phpMydmin or Heidi SQL or can also be done through the command prompt by typing the command: mysql > create database ecommerce_app;
- Import the ecommerce.sql database containing the DDL of tables and data into your DBMS (ecommerce_app)
- Open the application using Visual Studio Code, and configure the database in the file /server/connection.php ($host = "localhost", $user = "root", $password = "", $database = "ecommerce")

#### connection.php
```PHP
<?php
    $conn = mysqli_connect("localhost", "root", "", "ecommerce") 
        or die("Can't connect to the database");
?>
```

## Dummy Paypal Account
- Create a Dummy Paypal Accout to Payment Test
- Choose a Business Account
- After the business account is created, go to the url: https://developer.paypal.com/home <br/>
![alt text](https://i.ibb.co/k9b6Y84/1.png)
- Paypal Developer Dashboard <br/>
![alt text](https://i.ibb.co/dW3wWBQ/2-1.png)
- Create App and Credentials <br/>
![alt text](https://i.ibb.co/HYwvVwF/3.png.png)
- Create Dummy Account for Buyer and and Seller, which Business for Seller Account and Personal for Buyer Account <br/>  
![alt text](https://i.ibb.co/dtv49JD/4.png)
- Integrate Paypal to your Application <br/>
![alt text](https://i.ibb.co/MkzXM71/2.png)
#### payment.php
```Javascript
<div id="paypal-button-container"></div>

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
```
