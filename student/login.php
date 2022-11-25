<?php
session_start();
$message="";
if(count($_POST)>0) {
 include '../others/dbconnection.php';
$email = $_POST['email'];
$password = $_POST['password'];
$sql ="SELECT * FROM students WHERE email='$email' and password ='$password'";
$result = mysqli_query($conn, $sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
$_SESSION["email"] = $row['email'];
$_SESSION["password"] = $row['password'];
$_SESSION["id"] = $row['id'];
} else {
$message = "Invalid Username or Password!";
}
}

if(isset($_SESSION["email"])){
      header("Location:dashboard.php");
    
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/ue.png">
<title>Login</title>
<!-- Icons css CDN-->
<link rel="stylesheet" href="../assets/css/Varela+Round.css">
<link rel="stylesheet" href="../assets/css/Material+Icons.css">
<!-- font awesome icons css CDN -->
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<!-- Bootstrap CSS-->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<!-- Jquery JS-->
<script src="../assets/js/jquery.min.js"></script>
<!-- Bootstrap JS-->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- custom js for Modals-->
<script src="../assets/js/custom.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
</head>
<body>
<div class="main-content">
        
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page login-page ">
                <h3 class="title1"><img src="../assets/img/ue.png" width="200" height="200" class="img-fluid"></h3>
                <div class="widget-shadow">
                    <div class="login-top" >
                        <h4 style="color: red;">Student Login </h4>
                    </div>
                    <div class="login-body">
                        <form  method="post" action="">
                            <p style="font-size:16px; color:red" align="center"><?php echo $message; ?>  </p>
                            <input type="text" class="user" name="email" placeholder="Email" required="true">
                            <input type="password" name="password" class="lock" placeholder="Password" required="true">
                            <input type="submit" name="login" value="Sign In"> 
                        </form>
                         <div>
                                <div class="forgot" style="float: left;">
                                    <a href="../index.php">Switch User?</a>
                                </div>
                                
                                <div class="forgot">
                                    <a href="forgot-password.php">Forgot Password?</a>
                                </div>
                            </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        
    </div>
  
</body>
</html>