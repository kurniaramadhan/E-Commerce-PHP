<?php session_start(); ?>

<?php
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        if (isset($_SESSION['admin_logged_in'])) {
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION['admin_email']);
            unset($_SESSION['admin_name']);
            header('location: login.php');
            exit;
        }
    }
?>