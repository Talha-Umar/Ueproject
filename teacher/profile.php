<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include '../others/dbconnection.php';
$id =@$_POST['id'];
$name = @$_POST['name'];
$email = @$_POST['email'];
$contact = @$_POST['contact'];
$address = @$_POST['address'];


if (isset($_POST['update'])) {

$sql = "UPDATE teachers SET  name='$name', email='$email',contact='$contact',address='$address' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
echo '<script>alert("Profile Updated!")</script>';
echo "<script type='text/javascript'>location.replace('profile.php')</script>"; 

}
 else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Profile</title>
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
   $(document).ready(function(){
     var name=$('#add').val();
     $('#address').val(name);
   });
</script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-12">
                   <h2>Manage <b>Profile</b></h2>
                   </div>
                </div>
            </div>
             <!-- table content -->
         
          <div style="border: 1px solid #D6D5D5;"> 
            <div  style="background-color: #EAEAEA;
    border-bottom: 1px solid #D6D5D5; width: 100%; color: red;padding-top: 10px; padding-left: 20px; ">
              <h3>Update Your Profile :</h3>
            </div>
            <?php
            @$ids=$_SESSION["id"];
             $sql="SELECT * FROM teachers WHERE id='$ids'";
              $result = mysqli_query($conn, $sql);
             $value = mysqli_fetch_assoc($result);
             ?>
             
             <input type="hidden" id="add" value="<?php echo $value["address"]; ?>">
            <div style="margin: 20px;">
              <form method="post" action="">
                 <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $value["id"]; ?>">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" required="true" value="<?php echo $value["name"]; ?>"> 
                 </div> 
                 <div class="form-group">
                  <label>Department</label>
                   <?php
                      $did=$value["d_id"];
                 $sql1="SELECT name FROM departments WHERE id='$did'";
              $result1 = mysqli_query($conn, $sql1);
             $value1 = mysqli_fetch_assoc($result1);
             ?>
                  <input type="text"  class="form-control" readonly="true"  value="<?php echo $value1["name"]; ?>"> 
                 </div> 
                  <div class="form-group"> 
                    <label>Email</label> 
                    <input type="text" name="email" class="form-control" value="<?php echo $value["email"]; ?>" required="true"> 
                   </div>
                <div class="form-group"> 
                <label>Contact</label> 
                <input type="text" name="contact" class="form-control" value="<?php echo $value["contact"]; ?>" required="true"> 
               </div>
               <div class="form-group"> 
                <label>Address</label> 
                <textarea id="address" name="address" class="form-control" required="true"></textarea>
               </div>
               
                <input type="submit"  class="btn btn-default"name="update" value="Update">
                 </form> 
            </div>
      </div>
           <!-- table footer -->
           
      <div class="clearfix">
        <div class="left-text">
          Manage your Profile
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>

    </div>
  </div>
</body>
</html>                                                              