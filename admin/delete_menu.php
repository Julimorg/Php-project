<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

//? Query xóa DB menu từ bảng Dishes từ dish_id
mysqli_query($db,"DELETE FROM dishes WHERE d_id = '".$_GET['menu_del']."'");
header("location:all_menu.php");  

?>
