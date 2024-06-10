<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['update_user_type'])) {
    $email = $_POST['email'];
    $new_type = $_POST['new_type'];
    $update_user_type_query = "UPDATE user SET type='$new_type' WHERE email='$email'";
    mysqli_query($con, $update_user_type_query);
}

$user_query = "SELECT * FROM user";
$user_result = mysqli_query($con, $user_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script>
        function filterUsers() {
            let userType = document.getElementById("userType").value;
            let rows = document.querySelectorAll("#userTableBody tr");
            rows.forEach(row => {
                row.style.display = row.dataset.type === userType || userType === 'all' ? '' : 'none';
            });
        }
        document.addEventListener('DOMContentLoaded', (event) => {
            filterUsers();
        });
    </script>
</head>
<body class="loginSignup">
    <?php require 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <center>
                    <h1><b>User Management</b></h1>
                </center>
                
                <label for="userType">Select User Type:</label>
                <select id="userType" onchange="filterUsers()">
                    <option value="all">All</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <option value="guest">Guest</option>
                </select>

                <h2>Update User Type</h2>
                <form method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Date of Birth</th>
                                <th>Type</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Change Type</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php while ($user = mysqli_fetch_assoc($user_result)): ?>
                            <tr data-type="<?php echo htmlspecialchars($user['type']); ?>">
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                                <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($user['dob']); ?></td>
                                <td><?php echo htmlspecialchars($user['type']); ?></td>
                                <td><?php echo htmlspecialchars($user['phoneno']); ?></td>
                                <td><?php echo htmlspecialchars($user['gender']); ?></td>
                                <td>
                                    <select name="new_type">
                                        <option value="admin" <?php if ($user['type'] == 'admin') echo 'selected'; ?>>Admin</option>
                                        <option value="customer" <?php if ($user['type'] == 'customer') echo 'selected'; ?>>Customer</option>
                                        <option value="staff" <?php if ($user['type'] == 'staff') echo 'selected'; ?>>Staff</option>
                                    </select>
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                    <button type="submit" name="update_user_type" class="btn btn-primary">Update</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="movetoother">
                <a href="addone.php"> Click here to add one user </a>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
