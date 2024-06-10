<?php 
   session_start();
   include("../php/connection.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Products</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="../index.php">MarketMart</a> </p>
        </div>
        <div class="right-links">
            <a href="../php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p><b>Let the Shopping Begin</b></p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>We have following products:- </p> 
            </div>
                <?php
                    $result = mysqli_query($con, "select * from products");
                    echo "<table class='Mytable'>";
                    echo "<tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category ID</th>
                        <th>Price</th>
                        <th>Discription</th>
                        <th>Quantity</th>
                        </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['productid']}</td>
                        <td>{$row['productname']}</td>
                        <td>{$row['categoryid']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['discription']}</td>
                        <td>{$row['quantity']}</td>
                        </tr>";
                    }
                    echo "</table>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                ?>
          </div>
       </div>
                    
    </main>
</body>
</html>