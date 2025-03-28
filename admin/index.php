<!DOCTYPE html>
<html lang="en">
<?php
    //? Kết nối DB
include("../connection/connect.php");
error_reporting(0);
session_start();
    //? Check Logic đăng nhập
if (isset($_POST['submit'])) {
      //? Lấy giá trị username và password từ form 
    $username = $_POST['username'];
    $password = $_POST['password'];

    //? Check luôn empty fields của 2 cái 
    if (!empty($_POST["submit"])) {
        //? Query vào DB dùng cái md5 để hash pass
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . md5($password) . "'";
        $result = mysqli_query($db, $loginquery); // --> Check DB 
        $row = mysqli_fetch_array($result); //--> response từ DB dưới dạng Array

        //? Check response về có phải Arr ko
        if (is_array($row)) {
            $_SESSION["adm_id"] = $row['adm_id']; //--> Lưu thông tin vào Session
            header("refresh:1;url=dashboard.php"); //--> Navigate tới dashboards
        } else {
            echo "<script>alert('Invalid Username or Password!');</script>";
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="info">
            <h1>Admin Panel </h1>
        </div>
    </div>
    <!-- Login Form -->
    <div class="form">
        <div class="thumbnail"><img src="images/manager.png" /></div>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form class="login-form" action="index.php" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='js/index.js'></script>
</body>

</html>