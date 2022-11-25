<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}

include '../others/dbconnection.php';
$Program=@$_POST['Program'];
$Session=@$_POST['Session'];
$Course=@$_POST['Course'];
$Shift=@$_POST['Shift'];
$tablerow = @$_POST['tablerow'];
$Date=@$_POST['Date'];
if (isset($_POST['add'])) {

$sql="SELECT * FROM attendance WHERE program='$Program' && session='$Session' && shift='$Shift' && course='$Course' && date='$Date'";
  $result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);
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

<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
<style type="text/css">
	.modal-lg {
    max-width: 80% !important;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--Custom js for update and delete data-->
<script src="js/attendance.js"></script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12">
            <h2>Manage <b>Attendance</b></h2>
          </div>
          
                </div>
            </div>
            <div class="form-group" >
              <select class="form-control" style="width: 200px;" id="session">
               <option>Select Session</option>
               <?php
                                $sql="SELECT * FROM sessions";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["session"];?></option>
             <?php } } ?>
              </select><br>
              <select class="form-control" style="width: 200px;" id="program">
               <option>Select program</option>
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
            <div class="form-group" style="float: right;margin-top: -110px;">
              <select class="form-control" style="width: 200px;" id="shift">
                <option>Select Shift</option>
                <?php 
                                $sql="SELECT * FROM shifts";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["shift"];?></option>
             <?php } } ?>
              </select> <br>
              <select class="form-control" style="width: 200px;" id="course">
                <option value="">Select Course</option>
              </select>
            </div> 
            <div style="overflow-x:auto; width: 100%;">
              <button id="download" class="btn btn-success">Export</button>
            <table class="table table-striped table-hover" id="table2excel">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Percentage</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody id="Search">
                 
                </tbody>
            </table>
            </div>
      <div class="clearfix">
        <div class="left-text" style="text-align: center;">
          Manage your Attendance
        </div>
        <div class="right-text" style="text-align: center;">University of education vehari campus</div> 
        </div>
        </div>
    </div>
  
  <!-- Edit Modal HTML -->
  <?php
if(isset($_POST['edit'])){
  $Id=$_POST['Id'];
  $Name=$_POST['Name'];
  if ($Name!='') {
  $sql = "UPDATE departments SET name='$Name' WHERE id=$Id";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('departments.php')</script>";
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
            <h4 class="modal-title">Edit Department</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Department Name</label>
              <input type="text" name="Name" class="form-control" id="name">
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
$sql = "DELETE FROM departments WHERE id=$y";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('http://localhost/ueproject/departments.php')</script>";
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
  <script type="text/javascript">
    $("#download").click(function(){
  $("#table2excel").table2excel({
    // exclude CSS class
    exclude:".noExl",
    name:"Worksheet Name",
    filename:"download",//do not include extension
    fileext:".xls" // file extension
  });
});

  </script>
  <script type="text/javascript">
    $("#course").click(function(){
        var progid = $("#program").val();
        var sesid = $("#session").val();
        var shid = $("#shift").val();
        var cid = $("#course").val();
        var date = $("#Date").val();
        $.ajax({
            url: '../viewstudentsattendance.php',
            type: 'post',
            data: {"progid":progid,"sesid":sesid,"shid":shid,"cid":cid,"date":date},
            success:function(data){

                $('#Search').html(data);
            }
        });
    });
    $("#Date").change(function(){
        var progid = $("#program").val();
        var sesid = $("#session").val();
        var shid = $("#shift").val();
        var cid = $("#course").val();
        var date = $("#Date").val();
        $.ajax({
            url: '../viewstudentsattendance.php',
            type: 'post',
            data: {"progid":progid,"sesid":sesid,"shid":shid,"cid":cid,"date":date},
            success:function(data){

                $('#Search').html(data);
            }
        });
    });
  </script>
</body>
</html>                                                               