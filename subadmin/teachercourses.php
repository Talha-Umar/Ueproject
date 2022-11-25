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
  $department = $_POST['department'];
$teacher = $_POST['teacher'];
$program= $_POST['program'];
$course = $_POST['course'];
$semester = $_POST['semester'];
$session = $_POST['session'];
$shift = $_POST['shift'];
$sql="SELECT * FROM coursetoteacher WHERE p_id='$program' AND session_id='$session' AND c_id='$course' AND sh_id='$shift'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 0) {
  // inser data
$sql1 = "INSERT INTO coursetoteacher (t_id,p_id,c_id,session_id,sh_id,d_id,semester)
VALUES ('$teacher','$program','$course','$session','$shift','$department','$semester')";
if ($conn->query($sql1) === TRUE) {
echo '<script>alert("Record Added!")</script>';
echo "<script type='text/javascript'>location.replace('teachercourses.php')</script>"; 

}
 else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
}
else{
  echo '<script>alert("Already assign to someone!")</script>';
  echo "<script type='text/javascript'>location.replace('teachercourses.php')</script>"; 
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Courses to Teacher</title>
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
<script src="js/teachercourses.js"></script>
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
                    <div class="col-md-6">
            <h2>Manage <b>Courses Assign to Teacher</b></h2>
          </div>
          <div class="col-md-6 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add a course to teacher</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Teacher Name</th>
                        <th>Department</th>
                        <th>Program</th>
                        <th>Course</th>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Shift</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       
                       $k=0;
                       $sql="SELECT * FROM coursetoteacher WHERE d_id='$did'";
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["id"]; ?>">
            <td>
              <?php echo ++$k; ?>
            </td>
                        <td style="display: none;" data-target="tid"><?php echo $value["t_id"]; ?></td>
                        <td data-target="teacher">
                          <?php $x=$value["t_id"]; 
                             $sq="SELECT * FROM teachers WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="did"><?php echo $value["d_id"]; ?></td>
                        <td data-target="department">
                          <?php $x=$value["d_id"]; 
                             $sq="SELECT * FROM departments WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="pid"><?php echo $value["p_id"]; ?></td>
                        <td data-target="program">
                          <?php $x=$value["p_id"]; 
                             $sq="SELECT * FROM programs WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="cid"><?php echo $value["c_id"]; ?></td>
                        <td data-target="course">
                          <?php $x=$value["c_id"]; 
                             $sq="SELECT * FROM courses WHERE code='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="ssid"><?php echo $value["session_id"]; ?></td>
                        <td data-target="session">
                          <?php $x=$value["session_id"]; 
                             $sq="SELECT * FROM sessions WHERE id='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["session"];
                        ?></td>
                        <td  data-target="semester"><?php echo $value["semester"]; ?></td>
                        
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
          Manage your Courses Assign to Teacher
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
              <label>Department</label>
              <select class="form-control" name="department" id="department">
                <option value="">Select Department</option>
                <?php 
                                $sql="SELECT * FROM departments WHERE id='$did'";
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
              <label>Teacher</label>
              <select class="form-control" name="teacher" id="teacher">
                <option value="">Select Teacher</option>
              </select>
            </div>
            <div class="form-group">
              <label>Program</label>
              <select class="form-control" name="program" id="program">
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
              <label>Semester </label>
              <select class="form-control" name="semester" id="semester">
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
              <select class="form-control" name="session">
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
              <select class="form-control" name="shift">
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
$Department=$_POST['Department'];
$Teacher=$_POST['Teacher'];
$Program=$_POST['Program'];
$Course=$_POST['Course'];
$Session=$_POST['Session'];
$Semester=$_POST['Semester'];
$Shift=$_POST['Shift'];

if ($Department!='' && $Teacher!='' && $Program!='' && $Course!='' && $Semester!='' && $Shift!='' && $Session!='') {
  $sql = "UPDATE coursetoteacher SET t_id='$Teacher',p_id='$Program',c_id='$Course',session_id='$Session',sh_id='$Shift' ,d_id='$Department',semester='$Semester' WHERE id='$Id'";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('teachercourses.php')</script>";
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
              <label>Department</label>
              <select class="form-control" name="Department" id="Department">
                <option id="depart">Select Department</option>
              </select>
            </div>        
            <div class="form-group">
              <label>Teacher</label>
              <select class="form-control" name="Teacher" id="Teacher">
                <option id="teach">Select Teacher</option>
              </select>
            </div>
            <div class="form-group">
              <label>Program</label>
              <select class="form-control" name="Program" id="Program">
                <option id="prog">Select Program</option>
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
              <label>Semester </label>
              <select class="form-control" name="Semester" id="Semester">
                <option value="" id="sems">Select Semester</option>
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
              <select class="form-control" name="Session">
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
// sql to delete a record
$sql = "DELETE FROM coursetoteacher WHERE id='$y'";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('teachercourses.php')</script>";
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