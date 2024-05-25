<?php
session_start();
require 'connection.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['email'];

$user_products_query = "SELECT * from orders where email = '$user_id' and status = 'cart'";

$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
$no_of_user_products = mysqli_num_rows($user_products_result);
$sum = 0;

if ($no_of_user_products == 0) {
    echo "<script>alert('No items in the cart!!');</script>";
} else {
    while ($row = mysqli_fetch_array($user_products_result)) {
        $sum += $row['price'] * $row['quantity'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
    <title>MarketMart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body class="cart">
<div>
    <?php require 'header.php'; ?>
    <br>
    <div class="container">
        <h1> Cart </h1>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Item Number</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php
            $user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
            $no_of_user_products = mysqli_num_rows($user_products_result);
            $counter = 1;
            while ($row = mysqli_fetch_array($user_products_result)) {
                ?>
                <tr>
                    <th><?php echo $counter; ?></th>
                    <th><?php echo $row['productname']; ?></th>
                    <th><?php echo $row['price']; ?></th>
                    <th><?php echo $row['quantity']; ?></th>
                    <th><?php echo $row['price'] * $row['quantity']; ?></th>
                    <th><a href='cart_remove.php?id=<?php echo $row['productid']; ?>'>Remove</a></th>
                </tr>
                <?php
                $counter++;
            }
            ?>
            <tr>
                <th></th>
                <th>Total</th>
                <th></th>
                <th></th>
                <th>Rs <?php echo $sum; ?>/-</th>
                <th><a href="success.php?totalcost=<?php echo $sum; ?>" class="btn btn-primary">Confirm Order</a></th>
            </tr>
            </tbody>
        </table>
    </div>
    <?php require 'footer.php'; ?>      
</div>
</body>
</html>

