// Update user
<?php
include 'admin_conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $sql = "UPDATE users SET name='$name', email='$email', username='$username' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: usermanagement.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
