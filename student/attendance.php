<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include '../others/dbconnection.php';
$Course=@$_POST['Course'];
$Shift=@$_POST['Shift'];
$tablerow = @$_POST['tablerow'];
$Date=@$_POST['Date'];
if (isset($_POST['add'])) {

$sql="SELECT * FROM attendance WHERE shift='$Shift' && course='$Course' && date='$Date'";
  $result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);
if ($value["shift"]!=$Shift && $value["course"]!=$Course && $Date!=$value['date']) {

foreach ($tablerow as $key => $value) {
  $sid=@$value[0];
  $status=@$value[1];
  
        if ($Course!='' && $Shift!='' && $Date!='' && $sid!='' && $status!='') {

$sql = "INSERT INTO attendance (student,shift,course,status,date) VALUES ('$sid','$Shift','$Course','$status','$Date')";
if ($conn->query($sql) === TRUE) {
echo '<script>alert("Attendance Marked!")</script>';
echo "<script type='text/javascript'>location.replace('attendance.php')</script>"; 
}
 else {echo "Error: " . $sql . "<br>" . $conn->error;}
                  }
                  else{echo '<script>alert("Please Mark Correct!")</script>';}
}
}
else{
   echo '<script>alert("Already Marked to this Class!")</script>';
   echo "<script type='text/javascript'>location.replace('attendance.php')</script>"; 
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Attendance</title>
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
<script src="js/attendance.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
<style type="text/css">
</style>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-6 left">
            <h2>Manage <b>Attendance</b></h2>
          </div>
          <div class="col-md-6 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Mark</span></a>
                        
          </div>
                </div>
            </div>
                       
            <div class="form-group">
               <?php  
                $tid=$_SESSION["id"];
                ?>
                <input id="teacher" type="hidden" value="<?php echo $tid ?>">
              <select class="form-control" style="width: 200px;" id="course">
                <option value="">Select Course</option>
                <?php  
                $tid=$_SESSION["id"];
                                $sql="SELECT * FROM coursetoteacher WHERE t_id='$tid'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                          $course=$value["c_id"];
                    $sql1="SELECT * FROM courses WHERE code='$course'";
                                $result1 = mysqli_query($conn, $sql1);
                       if (mysqli_num_rows($result1) > 0) {
                       // output data of each row
                      while($value1 = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $value1["code"];?>"><?php echo $value1["name"];?></option>
             <?php } } } } ?>
              </select><br>
              <select class="form-control" style="width: 200px;" id="shift">
                <option value="">Select Shift</option>
              </select> 
            </div> 
            <div align="center" class="form-group">
             <input style="width: 300px;" type="date" id="date" class="form-control" value="<?php
             date_default_timezone_set('Asia/Karachi'); 
                       $date=date("Y-m-d");
                      echo $date;
               ?>">
            </div>
            <div style="overflow-x:auto;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody id="Search">
                 
                </tbody>
            </table>
            </div>
      <div class="clearfix">
        <div class="hint-text">
          Manage your Attendance
        </div>
        <div class="pagination">University of education vehari campus</div>
                
            </div>
        </div>
    </div>
  <!-- Add Modal HTML -->
  <div id="add" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Mark Attendance</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            
                <div class="form-group">
              <select class="form-control" style="width: 200px;" id="Course" name="Course">
                <option value="">Select Course</option>
                <?php 
                $tid=$_SESSION["id"];
                                $sql="SELECT * FROM coursetoteacher WHERE t_id='$tid'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                          $course=$value["c_id"];
                    $sql1="SELECT * FROM courses WHERE code='$course'";
                                $result1 = mysqli_query($conn, $sql1);
                       if (mysqli_num_rows($result1) > 0) {
                       // output data of each row
                      while($value1 = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $value1["code"];?>"><?php echo $value1["name"];?></option>
             <?php } } } } ?>
              </select><br>
              <select class="form-control" style="width: 200px;" id="Shift" name="Shift">
                <option>Select Shift</option>
                <?php 
                $tid=$_SESSION["id"];
                                $sql="SELECT * FROM coursetoteacher WHERE t_id='$tid'";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                        $shift=$value["sh_id"];
                    $sql1="SELECT * FROM shifts WHERE id='$shift'";
                                $result1 = mysqli_query($conn, $sql1);
                       if (mysqli_num_rows($result1) > 0) {
                       // output data of each row
                      while($value1 = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $value1["id"];?>"><?php echo $value1["shift"];?></option>
             <?php } } } } ?>
              </select> 
            </div> 
            
            <div align="center" class="form-group">
             <input style="width: 300px;" type="date" name="Date" class="form-control" value="<?php
             date_default_timezone_set('Asia/Karachi'); 
                       $date=date("Y-m-d");
                      echo $date;
               ?>">
            </div>
            
            <div class="form-group" style="overflow-x:auto;">
              <table class="table table-striped table-hover">
              	<thead>
              		<tr>
              			<th>Sr</th>
              			<th>Roll No</th>
              			<th>Name</th>
                        <th>Present</th> 
                        <th>Absent</th><br>
              		</tr>
              	</thead>
                <tbody id="searchdata">
                   
                  </tbody>
              </table>
            </div>  
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-success" value="Mark" id="add" name="add">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <?php
if(isset($_POST['edit'])){
  $Id=$_POST['Id'];
  $status=$_POST['status'];
  if ($status!='') {
  $sql = "UPDATE attendance SET status='$status' WHERE id=$Id";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('attendance.php')</script>";
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
            <h4 class="modal-title">Edit Attendance</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="Name" class="form-control" id="name" readonly="yes">
            </div>
            <div class="form-group">
              <label>Roll No</label>
              <input type="text" name="Name" class="form-control" id="rollno" readonly="yes">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status">
                <option id="status"></option>
                <option value="1">Present</option>
                <option value="0">Absent</option>
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
  
  
  </div>
</body>
</html>                                                               