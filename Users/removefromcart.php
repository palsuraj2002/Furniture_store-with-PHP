<?php
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id_to_remove = $_GET['id'];

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $product_id_to_remove) {
                unset($_SESSION['cart'][$key]);
                // Re-index the array to avoid potential issues
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "<script>alert('Product removed from cart.'); window.location.href='cart.php';</script>";
                exit();
            }
        }
        // If the product ID was not found in the cart
        echo "<script>alert('Product not found in cart.'); window.location.href='cart.php';</script>";
        exit();
    } else {
        // If the cart is empty
        echo "<script>alert('Your cart is empty.'); window.location.href='cart.php';</script>";
        exit();
    }
} else {
    // If the ID is not set or not numeric
    header("location: cart.php");
    exit();
}
