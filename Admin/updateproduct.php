// Update product
<?php
include 'admin_conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $price = $_POST['price'];
 
    $sql = "UPDATE products SET price='$price' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: productmanagement.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
