<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
include '../others/dbconnection.php';
//check for action add
if (isset($_POST['add'])) {
  $name = $_POST['name'];
$uname = $_POST['uname'];
$department = $_POST['department'];
$email = $_POST['email'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];


  // inser data
$sql = "INSERT INTO admin (name, username, email, contactno, password, department, type)
VALUES ('$name','$uname','$email','$mobile', '$password', '$department', 'subadmin')";
if ($conn->query($sql) === TRUE) {
echo '<script>alert("Sub-Admin Added!")</script>';
echo "<script type='text/javascript'>location.replace('subadmins.php')</script>"; 

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
<title>Sub Admins</title>
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
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
<!--Custom js for update and delete data-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/subadmins.js"></script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-lg-4 left">
            <h2>Manage <b>Amins</b></h2>
          </div>
          <div class="col-lg-4 center">
            <form accept="" method="post">
              <input class="btn btn-success" type="submit" name="search" value="Search">
              <select class="btn" style="color: black; width: 200px;" name="depart">
                <option value="<?php $Data=@$_POST['depart']; echo $Data; ?>">
                 <?php 
                 $Data=@$_POST['depart'];
               if (isset($_POST['search']) && $Data!='') {
                        
                        $sq="SELECT * FROM departments WHERE id=$Data";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                       }
                elseif(isset($_POST['search']) && $Data=='') {
                        
                         echo "ALL";
                       }
                       else{
                      echo "Select Department";
                    }
                 ?>
                </option>
                <option value="">ALL</option>
                <?php 
                                $sql="SELECT * FROM departments";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
             <?php } } ?>
              </select>
              
              </form>
          </div>
          <div class="col-lg-4 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Program</span></a>
                        
          </div>
                </div>
            </div>
             <div style="overflow-x:auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Department</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       
                       $k=0;
                       $departid=@$_POST['depart'];
                       $search=@$_POST['search'];
                       if (isset($search) && $departid!='') {
                         $sql="SELECT * FROM admin WHERE department=$departid && type='subadmin'";
                       }
                       elseif (isset($search) && $departid='') {
                         $sql="SELECT * FROM admin WHERE type='subadmin'";
                       }
                       else{
                       $sql="SELECT * FROM admin WHERE type='subadmin'";
                       }
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["id"]; ?>">
                        <td><?php echo ++$k; ?></td>
                        <td data-target="name"><?php echo $value["name"]; ?></td>
                        <td data-target="uname"><?php echo $value["username"]; ?></td>
                        <td data-target="email"><?php echo $value["email"]; ?></td>
                        <td data-target="mobile"><?php echo $value["contactno"]; ?></td>
                        <td style="display: none;" data-target="did"><?php echo $value["department"]; ?></td>
                        <td data-target="department"><?php $x=$value["department"]; 
                             $sq="SELECT * FROM departments WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td><?php echo $value["password"]; ?></td>
                        <td>
                            <a href="#edit" class="edit" data-toggle="modal" data-role="edit" data-id="<?php echo $value["id"]; ?>"><form><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></form></a>
                            <a href="#delete" class="delete" data-toggle="modal" data-role="delete" data-id="<?php echo $value["id"]; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php }} 
                      else{?>
                        <tr style="text-align: center;">
        <th colspan="12">No data exist !!!</th>
        </tr>
        <?php } ?>
                 
                </tbody>
            </table>
          </div>
      <div class="clearfix">
        <div class="left-text">
          Manage your Sub Amins
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>
    </div>
  <!-- Add Modal HTML -->
  <div id="add" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Add Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> 
                   
            <div class="form-group">
              <label>Admin Name</label>
              <input type="text" name="name" class="form-control" required="true">
            </div>
            <div class="form-group">
              <label>Admin Username</label>
              <input type="text" name="uname" class="form-control" required="true">
            </div>
            <div class="form-group">
              <label>Admin Department</label>
              <select class="form-control" name="department" required="true">
                <option value="">Select department</option>
                <?php 
                                $sql="SELECT * FROM departments";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
             <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required="true">
            </div> 
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="mobile" class="form-control" required="true">
            </div> 
            <div class="form-group">
              <input type="hidden" name="password" required="true" value="<?php
                          function randomPassword() {
                         $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                          $pass = array(); //remember to declare $pass as an array
                          $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                          for ($i = 0; $i < 8; $i++) {
                             $n = rand(0, $alphaLength);
                             $pass[] = $alphabet[$n];
                             }
                   return implode($pass); //turn the array into a string
                         }
           echo randomPassword();?>" class="form-control">
            </div>    
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-success" value="Add" id="add" name="add">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <?php
if(isset($_POST['edit'])){
  $Id=$_POST['Id'];
  $Uname=$_POST['Uname'];
  $Name=$_POST['Name'];
  $Department=$_POST['Department'];
  $Email=$_POST['Email'];
  $Mobile=$_POST['Mobile'];
  
  if ($Name!='' && $Department!='') {
  $sql = "UPDATE admin SET name='$Name', username='$Uname', email='$Email', contactno='$Mobile', department='$Department' WHERE id=$Id";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('subadmins.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}
}
 ?>
  <div id="edit" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Sub-Admins</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> 
          <div class="form-group">
              <label>Name</label>
              <input type="text" name="Name" class="form-control" id="name">
            </div>         
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="Uname" class="form-control" id="uname">
            </div>
            <div class="form-group">
              <label>Program Department</label>
              <select class="form-control" name="Department">
              <option id="department"></option>
                <?php 
                                $sql="SELECT * FROM departments";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
             <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="Email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="Mobile" class="form-control" id="mobile">
            </div>
            <input type="hidden" id="userid" name="Id">   
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save" name="edit">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <?php 
// php to delete a record
  if (isset($_POST['delete'])) {
$y=$_POST['userid'];
// sql to delete a record
$sql = "DELETE FROM admin WHERE id=$y";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('subadmins.php')</script>";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}
}
 ?>
  <div id="delete" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Delete Record</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <p>Are you sure you want to delete this Record?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
              <input type="hidden" id="id" name="userid">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="Delete" name="delete">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>                                                              