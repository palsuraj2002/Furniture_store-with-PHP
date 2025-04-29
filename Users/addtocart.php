<?php
include 'user_conn.php';
session_start();
if(empty( $_SESSION['username'])){
    header("location: user_login.php" );
    exit();
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if the product is already in the cart
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $product_exists = false;
    foreach($_SESSION['cart'] as &$item) {
        if($item['id'] == $product_id) {
            $item['quantity']++;
            $product_exists = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if(!$product_exists) {
        $sql = "SELECT id, name, price, image FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $item = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => $row['image'],
                'quantity' => 1
            );
            $_SESSION['cart'][] = $item;
        } else {
            echo "<script>alert('Product not found.'); window.location.href='home.php';</script>";
            exit();
        }
        $stmt->close();
    }

    echo "<script>alert('Product added to cart!'); window.location.href='cart.php';</script>";
    exit();

} else {
    header("location: home.php");
    exit();
}
?>