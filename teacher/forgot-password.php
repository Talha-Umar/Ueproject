<?php
if (!isset($_SESSION)) { 
  session_start();
  }

$msg="";
if(isset($_POST['submit'])) {
 include '../others/dbconnection.php';
$email = @$_POST['email'];
$contact = $_POST['contact'];
$sql ="SELECT id FROM teachers WHERE email='$email' and contact='$contact'";
$result = mysqli_query($conn, $sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
  session_start();
$_SESSION["uid"] = $row['id'];
} else {
$msg = "Invalid Details. Please try again.";
}
}

if(isset($_SESSION["id"])){
      header("Location:reset-password.php");
    
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/ue.png">
<title>Forget Password</title>
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
<script type="text/javascript">
function checkemail() {
  var email = document.querySelector('input[name=email]');
  var format = /\S+@\S+\.\S+/;
  if (format.test(email.value)) {
    email.setCustomValidity('');
  } else {
    email.setCustomValidity('Please macth the requested format.');
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
                        <h4 style="color: red"> Teacher Forget Password</h4>
                    </div>
                    <div class="login-body">
                        <form  method="post" action="">
                            <p style="font-size:16px; color:red" align="center"><?php echo @$msg; ?>  </p>
                            <input type="text" class="lock" name="email" placeholder="Email" required="true" onchange="checkemail()">
                            <input type="text" name="contact" class="lock" placeholder="Mobile Number" required="true" maxlength="11" minlength="11" pattern="[0-9]+">
                            <input type="submit" name="submit" value="Reset"> 
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