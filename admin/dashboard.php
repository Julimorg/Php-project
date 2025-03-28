<!DOCTYPE html>
<html lang="en">
<?php
//? Connect DB
include("../connection/connect.php");
error_reporting(0);
session_start(); //--> Chạy Session được lưu từ lúc login 

//? Check thông tin Session 
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Panel</title>
        <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body class="fix-header">
        <!--  Loading Animation -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <div id="main-wrapper">
            <!-- Header Admin Panel -->
            <div class="header">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <!-- Scroll về Dashboard -->
                        <a class="navbar-brand" href="dashboard.php">
                            <span><img src="images/icn.png" alt="homepage" class="dark-logo" /></span>
                        </a>
                    </div>
                    <!--  Navbar Content -->
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto mt-md-0">
                        </ul>
                        <!-- Admin Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Sidebar Container -->
            <div class="left-sidebar">
                <div class="scroll-sidebar">
                    <nav class="sidebar-nav">
                        <!-- Sidebar Content -->
                        <ul id="sidebarnav">
                            <li class="nav-devider"></li>
                            <li class="nav-label">Home</li>
                            <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-label">Log</li>
                            <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="all_restaurant.php">All Restaurant</a></li>
                                    <li><a href="add_category.php">Add Category</a></li>
                                    <li><a href="add_restaurant.php">Add Restaurant</a></li>
                                </ul>
                            </li>
                            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="all_menu.php">All Menues</a></li>
                                    <li><a href="add_menu.php">Add Menu</a></li>
                                </ul>
                            </li>
                            <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                        </ul>
                    </nav>

                </div>

            </div>
            <!-- Main Body -->
            <div class="page-wrapper">
                <!-- Banner -->
                <div style="padding-top: 10px;">
                    <marquee onMouseOver="this.stop()" onMouseOut="this.start()"> Công ty của CTO Khoa và Front-end Lead Fong</marquee>
                </div>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Admin Dashboard</h4>
                            </div>
                            <div class="row">
                                <!-- Restaurant Component -->
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-home f-s-40 "></i></span>
                                            </div>
                                            <!-- Restaurant Number -->
                                            <div class="media-body media-text-right">
                                                <!-- Query đến DB -->
                                                <h2><?php $sql = "select * from restaurant"; // --> Query count nhà hàng
                                                    $result = mysqli_query($db, $sql); // --> Query execute 
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;  // --> Display Số lượng được Query
                                                    ?>
                                                </h2>
                                                <p class="m-b-0">Restaurants</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dishes Component -->
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <!-- Dishes Number -->
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from dishes"; // --> Query count dishes
                                                    $result = mysqli_query($db, $sql); // --> Query execute
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws; // --> Display Số lượng được Query
                                                    ?>
                                                </h2>
                                                <p class="m-b-0">Dishes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Users Component -->
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-users f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users"; // --> Query count users
                                                    $result = mysqli_query($db, $sql); // --> Query execute
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws; // --> Display Số lượng được Query
                                                    ?>
                                                </h2>
                                                <p class="m-b-0">Users</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total Orders Component -->
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users_orders"; // --> Query count users_ordes
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;  // --> Display số lượng được Query
                                                    ?>
                                                </h2>
                                                <p class="m-b-0">Total Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Restro Categories Component -->
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from res_category"; // --> Query count res_category
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws; // --> Display số lượng được Query
                                                    ?>
                                                </h2>
                                                <p class="m-b-0">Restro Categories</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Processing Orders Component -->
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users_orders WHERE status = 'in process' "; // --> Query count users_orders status
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws; // --> Display số lượng được Query
                                                    ?></h2>
                                                <p class="m-b-0">Processing Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delivered Orders Component -->
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users_orders WHERE status = 'closed' "; // --> Query count users_orders status closed
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws;  //--> Display số lượng được Query
                                                    ?>
                                                    </h2>
                                                <p class="m-b-0">Delivered Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Delivered Orders Component -->
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users_orders WHERE status = 'rejected' "; // --> Query count users_orders status rejected
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; //--> Display số lượng được Query
                                                    ?>
                                                    </h2>
                                                <p class="m-b-0">Cancelled Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Earnings Component -->
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php
                                                    $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"'); // --> Sum value mà đơn hàng đã giao
                                                    $row = mysqli_fetch_assoc($result); // --> Lấy value
                                                    $sum = $row['value_sum']; // --> Lấy giá trị tổng
                                                    echo $sum; //--> Display value
                                                    ?></h2>
                                                <p class="m-b-0">Total Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "include/footer.php" ?>

                <script src="js/lib/jquery/jquery.min.js"></script>
                <script src="js/lib/bootstrap/js/popper.min.js"></script>
                <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
                <script src="js/jquery.slimscroll.js"></script>
                <script src="js/sidebarmenu.js"></script>
                <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
                <script src="js/custom.min.js"></script>

    </body>

</html>
<?php
}
?>