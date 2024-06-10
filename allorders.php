<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$user_email = '';
if (isset($_POST['view_orders'])) {
    $user_email = $_POST['email'];
}

$order_query = "SELECT * FROM orders WHERE email='$user_email' ORDER BY date, time";
$order_result = mysqli_query($con, $order_query);

$orders = [];
while ($order = mysqli_fetch_assoc($order_result)) {
    $orders[] = $order;
}

function group_orders_by_time($orders) {
    $grouped_orders = [];
    $current_group = [];
    $previous_order = null;

    foreach ($orders as $order) {
        if ($previous_order) {
            $prev_time = strtotime($previous_order['date'] . ' ' . $previous_order['time']);
            $curr_time = strtotime($order['date'] . ' ' . $order['time']);
            $time_diff = ($curr_time - $prev_time) / 3600;

            if ($time_diff > 1) {
                $grouped_orders[] = $current_group;
                $current_group = [];
            }
        }

        $current_group[] = $order;
        $previous_order = $order;
    }

    if (!empty($current_group)) {
        $grouped_orders[] = $current_group;
    }

    return $grouped_orders;
}

$grouped_orders = group_orders_by_time($orders);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Payments</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body class="loginSignup">
    <?php require 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <center>
                    <h1><b> All Orders </b></h1>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Enter Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" name="view_orders" class="btn btn-primary">View Orders</button>
                    </form>
                </center>
                <?php if (!empty($user_email)): ?>
                    <h2>Orders for <?php echo htmlspecialchars($user_email); ?></h2>
                    <?php foreach ($grouped_orders as $group): ?>
                        <h3><?php echo date('Y-m-d', strtotime($group[0]['date'])); ?></h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Payment Mode</th>
                                    <th>Product Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($group as $order): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($order['orderid']); ?></td>
                                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                                        <td><?php echo htmlspecialchars($order['price']); ?></td>
                                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                        <td><?php echo htmlspecialchars($order['date']); ?></td>
                                        <td><?php echo htmlspecialchars($order['time']); ?></td>
                                        <td><?php echo htmlspecialchars($order['paymentmode']); ?></td>
                                        <td><?php echo htmlspecialchars($order['productname']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
