<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['update_product'])) {
    $productid = $_POST['productid'];
    $productname = $_POST['productname'];
    $categoryid = $_POST['categoryid'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $update_product_query = "UPDATE product SET productname='$productname', categoryid='$categoryid', description='$description', price='$price', quantity='$quantity', image='$image' WHERE productid='$productid'";
    mysqli_query($con, $update_product_query);
}

if (isset($_POST['update_category'])) {
    $categoryid = $_POST['categoryid'];
    $categoryname = $_POST['categoryname'];
    $availability = $_POST['availability'];
    $update_category_query = "UPDATE category SET categoryname='$categoryname', availability='$availability' WHERE categoryid='$categoryid'";
    mysqli_query($con, $update_category_query);
}

$product_query = "SELECT * FROM product";
$product_result = mysqli_query($con, $product_query);

$category_query = "SELECT * FROM category";
$category_result = mysqli_query($con, $category_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Update</title>
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
            <div class="col-xs-12">
                <center>
                    <h1><b>Stock Update</b></h1>
                </center>
                
                <h2>Update Product Information</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Category ID</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                        <tr>
                            <form method="post">
                                <td><?php echo htmlspecialchars($product['productid']); ?></td>
                                <td><input type="text" name="productname" value="<?php echo htmlspecialchars($product['productname']); ?>"></td>
                                <td><input type="text" name="categoryid" value="<?php echo htmlspecialchars($product['categoryid']); ?>"></td>
                                <td><textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea></td>
                                <td><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>"></td>
                                <td><input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>"></td>
                                <td><input type="text" name="image" value="<?php echo htmlspecialchars($product['image']); ?>"></td>
                                <td>
                                    <input type="hidden" name="productid" value="<?php echo htmlspecialchars($product['productid']); ?>">
                                    <button type="submit" name="update_product" class="btn btn-primary">Update</button>
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <h2>Update Category Availability</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Availability</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                        <tr>
                            <form method="post">
                                <td><?php echo htmlspecialchars($category['categoryid']); ?></td>
                                <td><input type="text" name="categoryname" value="<?php echo htmlspecialchars($category['categoryname']); ?>"></td>
                                <td>
                                    <select name="availability">
                                        <option value="">Select</option>
                                        <option value="Y" <?php if ($category['availability'] == 'Y') echo 'selected'; ?>>Yes</option>
                                        <option value="N" <?php if ($category['availability'] == 'N') echo 'selected'; ?>>No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="categoryid" value="<?php echo htmlspecialchars($category['categoryid']); ?>">
                                    <button type="submit" name="update_category" class="btn btn-primary">Update</button>
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
