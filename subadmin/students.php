<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
$did=$_SESSION['department'];
include '../others/dbconnection.php';
// check for add action
if (isset($_POST['add'])) {
  $name = @$_POST['name'];
$rollno = @$_POST['rollno'];
$cnic = @$_POST['cnic'];
$email = @$_POST['email'];
$contact = @$_POST['contact'];
$address = @$_POST['address'];
$program= @$_POST['program'];
$session = @$_POST['session'];
$semester = @$_POST['semester'];
$shift = @$_POST['shift'];
$password=@$_POST["password"];
$sql="SELECT * FROM students WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $value = mysqli_fetch_assoc($result);
  // check for already available in database
if ($value['email']!=$email) {
  // inser data
$sql1 = "INSERT INTO students (rollno,name,cnic,email,contact,address,pg_id,ss_id,sm_id,sh_id,password)
VALUES ('$rollno','$name','$cnic','$email','$contact','$address','$program','$session','$semester','$shift','$password')";
if ($conn->query($sql1) === TRUE) {
echo '<script>alert("Record Added!")</script>';
echo "<script type='text/javascript'>location.replace('students.php')</script>"; 

}
 else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
}
else{
  echo '<script>alert("Already added with this email!")</script>';
  echo "<script type='text/javascript'>location.replace('students.php')</script>"; 
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Students</title>
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
<script src="js/student.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-lg-4 left">
            <h2>Manage <b>Students</b></h2>
          </div>
          <div class="col-lg-4 center">
            <form accept="" method="post">
             
              <select class="btn" style="color: black; width: 200px;" name="prog" id="prog">
                <option value="<?php $Data=@$_POST['prog']; echo $Data; ?>">
       <?php 
                 $Data=@$_POST['prog'];
               if (isset($_POST['search']) && $Data!='') {
                        
                        $sq="SELECT * FROM programs WHERE id=$Data";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                       }
                elseif(isset($_POST['search']) && $Data=='') {
                        
                         echo "ALL";
                       }
                       else{
                      echo "Select Program";
                    }
                 ?>
                </option>
                 <?php 
                                $sql="SELECT * FROM programs WHERE d_id='$did'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
             <?php } } ?>
              </select>
               <input class="btn btn-success" type="submit" name="search" value="Search">
              </form>
          </div>
          <div class="col-lg-4 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>CNIC</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Program</th>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Shift</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $k=0;
                       $progid=@$_POST['prog'];
                       $search=@$_POST['search'];
                       if (isset($search) && $progid!='') {
                         $sql="SELECT * FROM students WHERE pg_id=$progid";
                      
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["id"]; ?>">
            <td>
              <?php echo ++$k; ?>
            </td>
                        <td data-target="rollno"><?php echo $value["rollno"]; ?></td>
                        <td data-target="name"><?php echo $value["name"]; ?></td>
                        <td data-target="cnic"><?php echo $value["cnic"]; ?></td>
                        <td data-target="email"><?php echo $value["email"]; ?></td>
                        <td><?php echo $value["password"]; ?></td>
                        <td data-target="contact"><?php echo $value["contact"]; ?></td>
                        <td data-target="address"><?php echo $value["address"]; ?></td>
                        <td style="display: none;" data-target="pgid"><?php echo $value["pg_id"]; ?></td>
                        <td data-target="program">
                          <?php $x=$value["pg_id"]; 
                             $sq="SELECT * FROM programs WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="ssid"><?php echo $value["ss_id"]; ?></td>
                        <td data-target="session">
                          <?php $x=$value["ss_id"]; 
                             $sq="SELECT * FROM sessions WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["session"];
                        ?></td>
                        <td style="display: none;" data-target="smid"><?php echo $value["sm_id"]; ?></td>
                        <td data-target="semester">
                          <?php $x=$value["sm_id"]; 
                             $sq="SELECT * FROM semsters WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["semester"];
                        ?></td>
                        <td style="display: none;" data-target="shid"><?php echo $value["sh_id"]; ?></td>
                        <td data-target="shift">
                          <?php $x=$value["sh_id"]; 
                             $sq="SELECT * FROM shifts WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["shift"];
                        ?></td>
                        <td>
                            <a href="#edit" class="edit" data-toggle="modal" data-role="edit" data-id="<?php echo $value["id"]; ?>"><form><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></form></a>
                            <a href="#delete" class="delete" data-toggle="modal" data-role="delete" data-id="<?php echo $value["id"]; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php }} }
                      else{?>
                        <tr style="text-align: center;">
        <th colspan="12">First Select Program and Make Search</th>
        </tr>
        <?php } ?>
                 
                </tbody>
            </table>
          </div>
      <div class="clearfix">
        <div class="left-text">
          Manage your Students
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
            <h4 class="modal-title">Add Student</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">  
           <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required="true">
            </div>        
            <div class="form-group">
              <label>Roll No e.g. bsf1234567</label>
              <input type="text" name="rollno" class="form-control" required="true" pattern="bsf[0-9]+" maxlength="10" minlength="10">
            </div>
            <div class="form-group">
              <label>CNIC (without dashes)</label>
              <input type="text" name="cnic" class="form-control" required="true" maxlength="13" minlength="13" pattern="[0-9]+">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control"  required="true">
            </div>
            <div class="form-group">
              <label>Contact No e.g. 03001234567</label>
              <input type="text" name="contact" class="form-control" required="true" maxlength="11" minlength="11" pattern="[0-9]+">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="address" class="form-control" required="true">
            </div>
            <div class="form-group">
              <label>Student Program</label>
              <select class="form-control" name="program" required="true">
                <option value="">Select Program</option>
                <?php
                                $sql="SELECT * FROM programs WHERE d_id='$did'";
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
              <label>Student Session</label>
              <select class="form-control" name="session" required="true">
                <option value="">Select Session</option>
                <?php 
                                $sql="SELECT * FROM sessions";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["session"];?></option>
             <?php } } ?>
              </select>
            </div>
             <div class="form-group" style="display: none !important;">
              <label>Student Semester</label>
              <select class="form-control" name="semester">
                 <?php
                                $sql="SELECT * FROM semsters WHERE current='1'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["semester"];?></option>
             <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Student Shift</label>
              <select class="form-control" name="shift" required="true">
                <option value="">Select Shift</option>
                <?php 
                                $sql="SELECT * FROM shifts";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["shift"];?></option>
             <?php } } ?>
              </select>
            </div>
            <input type="hidden"name="password" value="<?php
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

echo randomPassword();
?>">
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
  $Name = @$_POST['Name'];
$Rollno = @$_POST['Rollno'];
$Cnic = @$_POST['Cnic'];
$Email = @$_POST['Email'];
$Contact = @$_POST['Contact'];
$Address = @$_POST['Address'];
$Program= @$_POST['Program'];
$Session = @$_POST['Session'];
$Semester = @$_POST['Semester'];
$Shift = @$_POST['Shift'];

if ($Name!=''&&$Rollno!=''&&$Cnic!=''&&$Email!=''&&$Contact!=''&&$Address!=''&&$Session!=''&&$Program!=''&&$Semester!=''&&$Shift!='') {
  $sql = "UPDATE students SET rollno='$Rollno',name='$Name',cnic='$Cnic',email='$Email',contact='$Contact',address='$Address',pg_id='$Program',ss_id='$Session',sm_id='$Semester',sh_id='$Shift' WHERE id='$Id'";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('students.php')</script>";
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
            <h4 class="modal-title">Edit Course</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> 
          <div class="form-group">
              <label>Name</label>
              <input type="text" name="Name" id="name" class="form-control" placeholder="Student Name">
            </div>        
            <div class="form-group">
              <label>Roll No</label>
              <input type="text" name="Rollno" id="rollno" class="form-control" placeholder="Student Roll no e.g. bsf1234567">
            </div>
            <div class="form-group">
              <label>CNIC</label>
              <input type="text" name="Cnic" id="cnic" class="form-control" placeholder="Student CNIC e.g. 12345-6789012-3">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="Email" id="email" class="form-control" placeholder="Student Email">
            </div>
            <div class="form-group">
              <label>Contact No</label>
              <input type="text" name="Contact" id="contact" class="form-control" placeholder="Student Contact e.g. 03001234567">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="Address" id="address" class="form-control" placeholder="Student Address">
            </div>
            <div class="form-group">
              <label>Student Program</label>
              <select class="form-control" name="Program">
                <option id="program">Select Program</option>
                <?php 
                                $sql="SELECT * FROM programs WHERE d_id='$did'";
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
              <label>Student Session</label>
              <select class="form-control" name="Session" id="Sess">
                <option  id="session">Select Session</option>
                <?php 
                                $sql="SELECT * FROM sessions";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["session"];?></option>
             <?php } } ?>
              </select>
            </div>
             <div class="form-group">
              <label>Student Semester</label>
              <select class="form-control" name="Semester" id="Sems">
                <?php 
                                $sql="SELECT * FROM semsters WHERE current='1'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option id="semester" value="<?php echo $value["id"];?>"><?php echo $value["semester"];?></option>
             <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Student Shift</label>
              <select class="form-control" name="Shift">
                <option id="shift">Select Shift</option>
                <?php 
                                $sql="SELECT * FROM shifts";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["shift"];?></option>
             <?php } } ?>
              </select>
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
$sql = "DELETE FROM students WHERE code='$y'";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('students.php')</script>";
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