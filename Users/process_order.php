<?php
session_start();

if (empty($_SESSION['username'])) {
    echo "<script>alert('You must be logged in to place an order.'); window.location.href='user_login.php';</script>";
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty. Nothing to order.'); window.location.href='cart.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    
    unset($_SESSION['cart']); // Clear the cart after "placing" the order
    echo "<script>alert('Your order has been placed successfully!'); window.location.href='home.php';</script>";
    exit();

} else {
    // If the page is accessed directly without submitting the form
    echo "<script>alert('Invalid access to this page.'); window.location.href='checkout.php';</script>";
    exit();
}
?>