<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
include('../others/dbconnection.php');

if(isset($_POST['reset']))
  {
    $id=$_SESSION['id'];
     $password=$_POST['newpassword'];

        $sql = "UPDATE teachers SET password='$password'  where  id='$id'";
if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Password successfully changed');</script>";
  echo "<script type='text/javascript'>location.replace('login.php')</script>";
}  
session_destroy();
  
  }
  ?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/ue.png">
<title>Reset Password</title>
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
<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
<script type="text/javascript">
function checkpass() {
  const password = document.querySelector('input[name=newpassword]');
  const confirm = document.querySelector('input[name=confirmpassword]');
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
</script>
</head>
<body>
<div class="main-content">
        
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page login-page ">
                <h3 class="title1"><img src="../assets/img/ue.png" width="200" height="200" class="img-fluid"></h3>
                <div class="widget-shadow">
                    <div class="login-top" >
                        <h4 style="color: red">Teacher Reset Password</h4>
                    </div>
                    <div class="login-body">
                        <form  method="post" action="">
                            <input type="text" class="lock" name="newpassword" placeholder="New Password" required="true" onchange="checkpass()">
                            <input type="text" name="confirmpassword" class="lock" placeholder="Conform Password" required="true" onchange="checkpass()">
                            <input type="submit" name="reset" value="Reset"> 
                        </form>
                         <div>
                               
                                
                                <div class="forgot">
                                    <a href="login.php">No need to change?</a>
                                </div>
                            </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        
    </div>
  
</body>
</html>