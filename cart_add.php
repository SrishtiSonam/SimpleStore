<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['add'])) {
    if (isset($_POST['quantity']) && isset($_POST['productid'])) {
        $quantity_requested = $_POST['quantity'];
        $item_id = $_POST['productid'];
        
        // Check if the requested quantity is available in the products table
        $query = "SELECT quantity FROM product WHERE productid='$item_id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        
        if ($row && $row['quantity'] >= $quantity_requested) {
            // Reduce the product quantity in the products table
            $new_quantity = $row['quantity'] - $quantity_requested;
            $update_query = "UPDATE product SET quantity=$new_quantity WHERE productid='$item_id'";
            mysqli_query($con, $update_query) or die(mysqli_error($con));
            
            // Add the product to the cart
            $query = "SELECT price, productname FROM product WHERE productid='$item_id'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $price = $row['price'];
                $product_name = $row['productname'];
                $length_query = "SELECT COUNT(*) as count FROM orders";
                $length_result = mysqli_query($con, $length_query) or die(mysqli_error($con));
                $length_row = mysqli_fetch_assoc($length_result);
                $length = $length_row['count'];
                $order_id = "O" . ($length + 1);
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $insert_order_query = "
                    INSERT INTO orders (orderid, email, status, productname, price, quantity, date, time)
                    VALUES ('$order_id', '{$_SESSION['email']}', 'cart', '$product_name', '$price', '$quantity_requested', '$date', '$time')";
                $insert_order_result = mysqli_query($con, $insert_order_query) or die(mysqli_error($con));
            }
        } else {
            // Redirect to products page with error message
            header('location: products.php?error=quantity_not_available');
            exit();
        }
    }
}

// Redirect to products page after processing
header('location: products.php');
exit();
?>
