<?php
require 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (!preg_match($regex_email, $email)) {
        header('Location: login.php?error=Invalid email format');
        exit();
    }
    if (strlen($password) < 6) {
        header('Location: login.php?error=Password must be at least 6 characters');
        exit();
    }

    // Authenticate user
    $user_authentication_query = "SELECT email, type, password FROM user WHERE email='$email'";
    $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
    $rows_fetched = mysqli_num_rows($user_authentication_result);

    if ($rows_fetched == 0) {
        header('Location: login.php?error=Wrong username or password');
        exit();
    } else {
        $row = mysqli_fetch_assoc($user_authentication_result);
        if (password_verify($password, $row['password']) || $password=$row['password']) {
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $row['type'];
            // premium customers
            if ($row['type'] == 'customer') {
                header('Location: products.php');
            } else if ($row['type'] == 'staff') {
                header('Location: allorders.php');
            } else if ($row['type'] == 'admin') {
                header('Location: stockupdate.php');
            } else if ($row['type'] == 'owner') {
                header('Location: promotion.php');
            }
                exit();
        } else {
            header('Location: login.php?error=Wrong username or password');
            exit();
        }
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
    <style>
        .login-container {
            padding: 2rem;
        }
    </style>
</head>
<body class='loginSignup'>
    <div>
        <?php require 'header.php'; ?>
        <div class="container login-container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <center>
                        <h1><b> Login </b></h1>
                        <p>Login to make a purchase.</p>
                    <div class="panel-body">
                        <?php
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
                        }
                        ?>
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password (min. 6 characters)" pattern=".{6,}" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                    <center>
                </div>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </div>
</body>
</html>

