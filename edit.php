<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['email'];
$user_info_query = "SELECT * FROM user WHERE email = '$user_id'";
$user_info_result = mysqli_query($con, $user_info_query);
$user_info = mysqli_fetch_assoc($user_info_result);

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $phoneno = $_POST['phoneno'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $password_query = "SELECT password FROM user WHERE email = '$user_id'";
    $password_result = mysqli_query($con, $password_query);
    $password_row = mysqli_fetch_assoc($password_result);

    if (password_verify($password, $password_row['password'])) {
        if ($newpassword === $confirmpassword) {
            $hashed_newpassword = password_hash($newpassword, PASSWORD_BCRYPT);
            $update_query = "UPDATE user SET username='$username', firstname='$firstname', lastname='$lastname', dob='$dob', phoneno='$phoneno', password='$hashed_newpassword' WHERE email='$user_id'";
            $update_result = mysqli_query($con, $update_query);
            if ($update_result) {
                header('location: index.php');
                exit();
            } else {
                echo "Error updating user information.";
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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
                    <h1><b>Edit Profile</b></h1>
                <form method="post">
                    <div class="form-group">
                        <label for="username">UserName:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_info['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_info['firstname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user_info['lastname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user_info['dob']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneno">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $user_info['phoneno']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Current Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="newpassword">New Password:</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
            </center>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>