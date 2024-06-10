<?php
session_start();
require 'connection.php';
require 'check_if_added.php';

$sql = "SELECT * FROM product";
$result = $con->query($sql);
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
    <style>
        body {
            background-color: rgba(220, 20, 60, 0.6);
        }
        .img-container {
            position: relative;
            height: 15rem;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;   
        }
        .img-container img {
            height: 100%;
            object-fit: cover; 
        }
        .img-container .description {
            display: none;
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            width: 100%;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
        }
        .img-container:hover .description {
            display: block;
        }
    </style>
</head>
<body>
    <div>
        <?php require 'header.php'; ?>
        <div class="container">
            <div class="jumbotron" style="background-color: rgba(169, 255, 251, 0.2); color:rgb(255, 255, 255);">
                <center>
                    <h1>Welcome to our MarketMart!</h1>
                    <p>Shop with us and find everything you need at your fingertips.</p>
                </center>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 col-sm-6">';
                        echo '<div class="thumbnail">';
                        echo '<a href="cart.php">';
                        echo '<div class="img-container">';
                        echo '<img src="img/' . $row['image'] . '" alt="' . $row['productname'] . '">';
                        echo '<div class="description">';
                        echo '<p>' . $row['description'] . '</p>'; // Assuming 'description' is the column name in your database for product descriptions
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '<center>';
                        echo '<div class="caption">';
                        echo '<h3>' . $row['productname'] . '</h3>';
                        echo '<p>Price: Rs. ' . $row['price'] . '</p>';
                        if ($row['quantity'] == 0) {
                            echo '<p><button class="btn btn-primary btn-block buyNow" disabled>Not Available</button></p>';
                        } else {
                            if (check_if_added_to_cart($row['productid'])) {
                                echo '<a href="#" class="btn btn-block btn-success disabled">Added to cart</a>';
                            } else {
                                echo '<form method="post" action="cart_add.php">';
                                echo '<div class="form-group">';
                                echo '<input type="number" name="quantity" class="form-control" placeholder="Quantity" min="1" required>';
                                echo '</div>';
                                echo '<input type="hidden" name="productid" value="' . $row['productid'] . '">';
                                echo '<button type="submit" class="btn btn-block btn-primary" name="add" value="add">Add to cart</button>';
                                echo '</form>';
                            }
                        }
                        echo '</div>';
                        echo '</center>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<div class='col-md-12'><p>No products found</p></div>";
                }
                $con->close();
                ?>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </div>
</body>
</html>
