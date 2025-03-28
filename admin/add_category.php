<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php"); // Chèn file connect.php từ thư mục cha để kết nối cơ sở dữ liệu
error_reporting(0);
session_start(); // chạy session

//? Check Form
if (isset($_POST['submit'])) {
    //? Check c_name
    if (empty($_POST['c_name'])) {
        //? Catch Err
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>field Required!</strong>
                  </div>';
    } else {
        $check_cat = mysqli_query($db, "SELECT c_name FROM res_category where c_name = '" . $_POST['c_name'] . "' "); // --> Truy vấn kiểm tra xem danh mục đã tồn tại chưa

        if (mysqli_num_rows($check_cat) > 0) {
            //? Catch Err
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Category already exist!</strong>
                      </div>';
        } else {
            $mql = "INSERT INTO res_category(c_name) VALUES('" . $_POST['c_name'] . "')"; //--> Truy vấn thêm danh mục mới vào bảng res_category
            mysqli_query($db, $mql); // --> Thực thi truy vấn
            $success = '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          New Category Added Successfully.</br></div>';
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add Category</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
    <!-- Loading Animation -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
        <!-- Header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <span><img src="images/icn.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <!-- Admin panel drop down -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
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
        <!-- SideBar Container -->
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_restaurant.php">All Restaurants</a></li>
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
            <div style="padding-top: 10px;">
                <marquee onMouseOver="this.stop()" onMouseOut="this.start()"> Công ty của CTO Khoa và Front-end Lead Fong</marquee>
            </div>
            <div class="container-fluid"> 
                <div class="row"> 
                    <div class="container-fluid"> 
                        <?php
                        echo $error; // Hiển thị thông báo lỗi (nếu có)
                        echo $success; // Hiển thị thông báo thành công (nếu có)
                        ?>
                        <div class="col-lg-12"> 
                            <div class="card card-outline-primary"> 
                                <div class="card-header"> 
                                    <h4 class="m-b-0 text-white">Add Restaurant Category</h4> 
                                </div>
                                <form action='' method='post'>
                                    <div class="form-body"> 
                                        <hr> 
                                        <div class="row p-t-20"> 
                                            <div class="col-md-12"> 
                                                <div class="form-group"> 
                                                    <label class="control-label">Category</label> 
                                                    <input type="text" name="c_name" class="form-control"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                            <a href="add_category.php" class="btn btn-inverse">Cancel</a> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12"> 
                    <div class="card"> 
                        <div class="card-body"> 
                            <h4 class="card-title">Listed Categories</h4> 
                            <div class="table-responsive m-t-40"> 
                                <table id="myTable" class="table table-bordered table-hover table-striped"> 
                                    <thead class="thead-dark"> 
                                        <tr>
                                            <th>ID</th> 
                                            <th>Category Name</th> 
                                            <th>Date</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $sql = "SELECT * FROM res_category order by c_id desc"; // Truy vấn lấy tất cả danh mục, sắp xếp giảm dần theo c_id
                                        $query = mysqli_query($db, $sql); // Thực thi truy vấn

                                        if (!mysqli_num_rows($query) > 0) { // Nếu không có dữ liệu
                                            echo '<td colspan="7"><center>No Categories-Data!</center></td>'; // Hiển thị thông báo không có dữ liệu
                                        } else { // Nếu có dữ liệu
                                            while ($rows = mysqli_fetch_array($query)) { // Lặp qua từng dòng kết quả
                                                echo ' <tr><td>' . $rows['c_id'] . '</td> <!-- Hiển thị ID -->
                                                        <td>' . $rows['c_name'] . '</td> <!-- Hiển thị tên danh mục -->
                                                        <td>' . $rows['date'] . '</td> <!-- Hiển thị ngày tạo -->
                                                        <td><a href="delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> <!-- Nút xóa -->
                                                        <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a> <!-- Nút sửa -->
                                                        </td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "include/footer.php" ?> 

    </div>
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script> 
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script> 
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> 
    <script src="js/custom.min.js"></script> 
</body>

</html>