<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $totalAmt = $_GET['totalcost'];
        $email = $_SESSION['email'];
        $confirm_query="update orders set status='Confirmed' where status='cart' and email='$email'";
        $confirm_query_result=mysqli_query($con,$confirm_query) or die(mysqli_error($con));
        
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
    <body class="loginSignup">
        <div>
            <?php
                require 'header.php';
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <center>
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h2> Your order is confirmed.</h2>
                                <p> Pay either using cash at counter or scan this QR code.</p>
                                <img src="img/qrcode.png" alt="QRCode">
                            </div>
                            <a href="billpayments.php"> Click here to see all the bill payments. </a>
                        </div>
                    </div>
                    </center>
                </div>
            </div>
            <?php
                require 'footer.php';
            ?>
        </div>
    </body>
</html>
