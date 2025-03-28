
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

//? Query xóa db từ user_orders dựa trên order_id
mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '" . $_GET['order_del'] . "'");
header("location:all_orders.php");

?>
