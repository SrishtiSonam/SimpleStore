<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/cart.webp" />
        <title>MarketMart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body class="landingPage">
        <div>
           <?php
            require 'header.php';
           ?>
           <div id="bannerImage">
                <center>
                   <div id="bannerContent">
                       <h2> An easy way of daily purchasing</h2>
                       <a href="products.php" class="btn btn-danger" style="display: flex; align-items: center; width:12vw;">
                            <h5 style="margin: 0; padding-right: 10px;">MarketMart</h5>
                            <img src="img/cart.webp" alt="Shop Now" height="30rem" style="border-radius: 25%;">
                        </a>
                   </div>
                </center>
           </div>
           <?php
                require 'footer.php';
           ?>
        </div>
    </body>
</html>