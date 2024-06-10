<?php
require 'connection.php';
session_start();

if (isset($_GET['pname']) && !empty($_GET['pname']) && isset($_SESSION['email'])) {
    $product_name = mysqli_real_escape_string($con, $_GET['pname']);
    $useremail = $_SESSION['email'];
    $stmt = $con->prepare("DELETE FROM orders WHERE productname = ? AND email = ?");
    $stmt->bind_param("ss", $product_name, $useremail);
    if ($stmt->execute()) {
        header('location: cart.php?message=Item removed successfully');
    } else {
        // Failed deletion
        header('location: cart.php?error=Failed to remove item');
    }
    $stmt->close();
} else {
    header('location: cart.php?error=Invalid request');
}
?>