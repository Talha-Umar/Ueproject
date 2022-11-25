<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
include '../others/dbconnection.php';
if(isset($_POST['add'])){
  $program= @$_POST['program'];
$course = @$_POST['course'];
$session = @$_POST['session'];
$semesterno = @$_POST['semesterno'];
$shift = @$_POST['shift'];
$sql="SELECT * FROM coursetoprogram WHERE course='$course' AND program='$program' AND session='$session' AND shift='$shift'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
//insert data
$sql = "INSERT INTO coursetoprogram (program,semesterno,course,session,shift)
VALUES ('$program','$semesterno','$course','$session','$shift')";
if ($conn->query($sql) === TRUE) {
                   
$sql="SELECT * FROM coursetoprogram WHERE course='$course' && program='$program' && semesterno='$semesterno' && session='$session' && shift='$shift'";
$result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);
$pcourse=$value['id'];
$sql1="SELECT * FROM students WHERE pg_id='$program' && ss_id='$session' && sh_id='$shift'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
                  
while($value1 = mysqli_fetch_assoc($result1)) {
$student=$value1['id'];
$sql = "INSERT INTO coursestostudents (student,course) VALUES ('$student','$pcourse')";
if ($conn->query($sql) === TRUE) {}
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
}
                      
echo '<script>alert("Record Added!")</script>';
echo "<script type='text/javascript'>location.replace('programcourses.php')</script>";
}
 else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else{
  echo '<script>alert("Record is already exist!")</script>';
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Program Courses</title>
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
<script src="../assetsjs/custom.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--Custom js for update and delete data-->
<script src="js/programcourses.js"></script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-6 left">
            <h2>Manage <b>Courses Assign</b></h2>
          </div>
          <div class="col-md-6 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Assign a Course</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Program</th>
                        <th>Semester No</th>
                        <th>Course</th>
                        <th>Session</th>
                        <th>Shift</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $k=0;
                       $sql="SELECT * FROM coursetoprogram";
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["id"]; ?>">
            <td>
              <?php echo ++$k; ?>
            </td>
                        <td style="display: none;" data-target="pid"><?php echo $value["program"]; ?></td>
                        <td data-target="program">
                          <?php $x=$value["program"]; 
                             $sq="SELECT * FROM programs WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td data-target="semesterno"><?php echo $value["semesterno"]; ?></td>
                        
                        <td style="display: none;" data-target="cid"><?php echo $value["course"]; ?></td>
                        <td data-target="course">
                          <?php $x=$value["course"]; 
                             $sq="SELECT * FROM courses WHERE code='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="ssid"><?php echo $value["session"]; ?></td>
                        <td data-target="session">
                          <?php $x=$value["session"]; 
                             $sq="SELECT * FROM sessions WHERE id='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["session"];
                        ?></td>
                        
                        <td style="display: none;" data-target="shid"><?php echo $value["shift"]; ?></td>
                        <td data-target="shift">
                          <?php $x=$value["shift"]; 
                             $sq="SELECT * FROM shifts WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["shift"];
                        ?></td>
                        <td>
                          <?php echo '<a href="studentcourses.php?action=view&id='.$value['id'].'"><i class="fas fa-eye"></i></a>'; ?>
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
          Manage your Courses Assign
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
            <h4 class="modal-title">Add Course</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">  
           <div class="form-group">
              <label>Program</label>
              <select class="form-control" name="program" id="program">
                <option value="">Select Program</option>
                <?php 
                                $sql="SELECT * FROM programs";
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
              <label>Semester No</label>
              <select class="form-control" name="semesterno" id="semester">
                <option value="">Select Semester</option>
              </select>
            </div>
            <div class="form-group">
              <label>Course</label>
              <select class="form-control" name="course" id="course">
                <option value="">Select Course</option>
              </select>
            </div>
            <div class="form-group">
              <label>Session</label>
              <select class="form-control" name="session" >
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
            
            <div class="form-group">
              <label>Shift</label>
              <select class="form-control" name="shift" >
                <option value="">Select shift</option>
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
$Program= @$_POST['Program'];
$Course = @$_POST['Course'];
$Session = @$_POST['Session'];
$Semesterno = @$_POST['Semesterno'];
$Shift = @$_POST['Shift'];

if ($Semesterno!='' && $Program!='' && $Course!='' && $Shift!='' &&$Session!='') {
  $sql = "UPDATE coursetoprogram SET semesterno='$Semesterno',course='$Course',program='$Program',session='$Session',shift='$Shift' WHERE id='$Id'";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('programcourses.php')</script>";
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
              <label>Program</label>
              <select class="form-control" name="Program" id="Program">
                <option id="prog">Select Program</option>
                <?php
                                $sql="SELECT * FROM programs";
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
              <label>Semester No</label>
              <select class="form-control" name="Semesterno" id="Semesterno">
                <option value="" id="Semes">Select Semester</option>
              </select>
            </div>
             <div class="form-group">
              <label>Course</label>
              <select class="form-control" name="Course" id="Course">
                <option id="cours">Select Course</option>
              </select>
            </div>
            <div class="form-group">
              <label>Session</label>
              <select class="form-control" name="Session" id="Session">
                <option value="" id="ses">Select Session</option>
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
              <label>Shift</label>
              <select class="form-control" name="Shift" id="Shift">
                <option id="shif">Select shift</option>
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
$x=$_POST['Cid'];

// sql to delete a record
$sql = "DELETE FROM coursetoprogram WHERE id='$y'";
$sql1 = "DELETE FROM coursestostudents WHERE course='$x'";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('programcourses.php')</script>";
} 
 else {
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
              <input type="hidden" id="Cid" name="Cid">
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