<?php
session_start();
require 'connection.php';
require 'check_if_added.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

// Fetch products from the database
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
                // Check if products are available
                if ($result->num_rows > 0) {
                    // Iterate through each product
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 col-sm-6">';
                        echo '<div class="thumbnail">';
                        echo '<a href="cart.php">';
                        echo '<img src="img/' . $row['image'] . '" alt="' . $row['productname'] . '" style="height: 15rem;">';
                        echo '</a>';
                        echo '<center>';
                        echo '<div class="caption">';
                        echo '<h3>' . $row['productname'] . '</h3>';
                        echo '<p>Price: Rs. ' . $row['price'] . '</p>';
                        
                        // Check product availability
                        if ($row['quantity'] == 0 || getCategoryAvailability($row['categoryid'], $con) == 'N') {
                            echo '<p><button class="btn btn-primary btn-block buyNow" disabled>Not Available</button></p>';
                        } else {
                            // Display add to cart form
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
                ?>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </div>
</body>
</html>

<?php
// Function to get category availability
function getCategoryAvailability($categoryid, $con) {
    // Query to fetch category availability
    $query = "SELECT availability FROM category WHERE categoryid='$categoryid'";
    $result = $con->query($query) or die($conn->error); // Perform query
    $row = $result->fetch_assoc(); // Fetch result
    return $row['availability'];
    // Close the connection
$con->close();
}
?>
