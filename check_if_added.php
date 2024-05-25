<?php
    if(session_status() === PHP_SESSION_NONE) {     session_start();    }
function check_if_added_to_cart($item_id){
    require 'connection.php';
    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $product_check_query = "SELECT * FROM users_items WHERE item_id='$item_id' AND user_id='$user_id' AND status='Added to cart'";
        $product_check_result = mysqli_query($con, $product_check_query) or die(mysqli_error($con));
        $num_rows = mysqli_num_rows($product_check_result);
        return ($num_rows >= 1) ? true : false;
    } else {
        return false;
    }
}
?>