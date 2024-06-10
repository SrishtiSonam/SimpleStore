<?php
require 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $lastname = $email = $password = $conform_password = $phoneno = $city = $address = $gender = $dob = "";

    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $conform_password = mysqli_real_escape_string($con, $_POST['conform_password']);
    $phoneno = mysqli_real_escape_string($con, $_POST['phoneno']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    if ($password !== $conform_password) {
        echo "Error: Passwords do not match";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $type = "customer";

    $stmt = $con->prepare("INSERT INTO user (email, username, firstname, lastname, password, phoneno, gender, dob, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $email, $username, $firstname, $lastname, $hashed_password, $phoneno, $gender, $dob, $type);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        $stmt->close();
        $con->close();
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
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
    <?php require 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <center>
                    <h1><b>SIGN UP FOR NEW USER</b></h1>
                <center>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="User Name" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="true">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    </div> 
                    <div class="form-group"> 
                        <input type="tel" class="form-control" name="phoneno" placeholder="Phone Number" required="true">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender" required="true">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required="true">
                    </div>
                    <div class="form-group">
                        <label for="type">Gender:</label>
                        <select class="form-control" id="type" name="type" required="true">
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password (min. 6 characters)" required="true" pattern=".{6,}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="conform_password" placeholder="Confirm Password" required="true">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Sign Up">
                    </div>
                </form>
                <div class="panel-footer">Already have an account. <a href="login.php">Login</a></div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</div>
</body>
</html>