<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include('../others/dbconnection.php');

if(isset($_POST['change']))
  {
       @$id=$_SESSION["id"];
       $password=$_POST['password'];
$newpassword=$_POST['newpassword'];
                      $sql="SELECT password FROM teachers where id='$id'";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                      $conpass=$value['password'];
      if ($password==$conpass) {
           $sql1 = "UPDATE teachers SET password='$newpassword'  where  id='$id'";

            if (mysqli_query($conn, $sql1)) {
  echo "<script>alert('Password successfully changed');</script>";
              }
             else{ echo "<script>alert('Something Went Wrong');</script>";}  
         }
    else{echo "<script>alert('Current Password is Incorrect!');</script>";}

  
  }
  ?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
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
<!--Custom js for update and delete data-->
<script src="js/departments.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
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
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
          <!-- table header -->
            <div class="table-title">
                <div class="row">
                    <div class="col-md-12">
                   <h2>Reset <b>Password</b></h2>
                   </div>
                </div>
            </div>
           <!-- table content -->
         
          <div style="border: 1px solid #D6D5D5;"> 
            <div  style="background-color: #EAEAEA;
    border-bottom: 1px solid #D6D5D5; width: 100%; color: red;padding-top: 10px; padding-left: 20px; ">
              <h3>Reset Your Password :</h3>
            </div>
            <div style="margin: 20px;">
              <form method="post" action="">
                 <div class="form-group">
                  <label>Current Password</label>
                  <input type="password" name="password" class="form-control" required="true" value=""> 
                 </div> 
                  <div class="form-group"> 
                    <label for="exampleInputPassword1">New Password</label> 
                    <input type="password" name="newpassword" class="form-control" value="" required="true" onchange="checkpass()"> 
                   </div>
                <div class="form-group"> 
                <label for="exampleInputPassword1">Confirm Password</label> 
                <input type="password" name="confirmpassword" class="form-control" value="" required="true" onchange="checkpass()"> 
               </div>
                <input type="submit"  class="btn btn-default"name="change" value="Change">
                 </form> 
            </div>
      </div>
           <!-- table footer -->
      <div class="clearfix">
        <div class="left-text">
          Reset your Password
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>

    </div>
  </div>
</body>
</html>                                                               