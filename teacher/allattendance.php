<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include '../others/dbconnection.php';

?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>All Attendance</title>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--Custom js for update and delete data-->
<script src="js/allattendance.js"></script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-12 left">
            <h2>Manage <b>Attendance</b></h2>
          </div>
                </div>
            </div>
                       
            <div class="form-group">
              <form action="" method="post">
               <?php  
                $tid=$_SESSION["id"];
                ?>
                <input id="teacher" type="hidden" value="<?php echo $tid ?>">
              <select class="form-control" style="width: 200px;" id="shift" name="shift">
                <option value="<?php
                  if (isset($_POST['submit'])) {
                    echo $_POST['shift'];
                  }
                 ?>">
              <?php
                  if (isset($_POST['submit'])) {
                    $shid=$_POST['shift'];
                    $sql = "SELECT * FROM shifts WHERE id='$shid'";
                    $result = mysqli_query($conn, $sql);
                   $row = mysqli_fetch_assoc($result);
                   echo $row['shift'];
                  }
                  else{
                    echo "Select Shift";
                  }?>
               </option>
                <?php  
                                $sql="SELECT * FROM shifts";
                                $result = mysqli_query($conn, $sql);
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                         
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["shift"];?></option>
             <?php } ?>
              </select><br>
              <select class="form-control" style="width: 200px;" id="course" name="course">
                <option value="<?php
                  if (isset($_POST['submit'])) {
                    echo $_POST['course'];
                  }
                 ?>"><?php
                  if (isset($_POST['submit'])) {
                    $crid=$_POST['course'];
                    $sql = "SELECT * FROM courses WHERE code='$crid'";
                    $result = mysqli_query($conn, $sql);
                   $row = mysqli_fetch_assoc($result);
                   echo $row['name'];
                  }
                  else{
                    echo "Select Course";
                  }?></option>
              </select> 
            </div> 
            <div class="form-group" style="margin-left: 40%;">
             <input style="width: 200px; float:left;" type="text" name="rollno" placeholder="e.g bsf1234567" class="form-control">
             <input type="submit" name="submit" value="Search" class="btn btn-info" style="margin-left: 4px; cursor: pointer;">
            </div>
            </form>
            <div style="overflow-x:auto;">
              <button id="download" class="btn btn-success">Export</button>
            <table class="table table-striped table-hover" id="table2excel">
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
                 <?php
                 include "../others/dbconnection.php";
                    if (isset($_POST['submit'])) {
                      $shift=$_POST['shift'];
                      $course=$_POST['course'];
                      $rollno=$_POST['rollno'];

$k=0;
//Select student information by studen id
$sql1 = "SELECT * FROM students WHERE rollno='$rollno'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$stid=$row1['id'];
$name=$row1['name'];
$rollno=$row1['rollno'];
//select and count number of prerests by a student
$sql2 = "SELECT count(status) as present FROM attendance WHERE student='$stid' && course='$course' && shift='$shift' && status='1'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$present=$row2['present'];
//select and count total number of status by of a student
$sql3 = "SELECT count(status) as total, id FROM attendance WHERE student='$stid'  && course='$course' && shift='$shift'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$total=$row3['total'];
$attid=$row3['id'];
//pecetage of attendace by a student
$pecentage=$present/$total*100;

$k=++$k;
echo"<tr>
<td>$k</td>
<td >$rollno</td>
<td >$name</td>
<td >$pecentage</td>
<td><a href='attendance-detail.php?action=view&amp;sid=$stid&amp;cid=$course'><i id='view' class='fas fa-eye'></i></a></td>
</tr>";
}               ?>
                </tbody>
            </table>
            </div>
      <div class="clearfix">
        <div class="left-text">
          Manage your Attendance
        </div>
        <div class="right-text">University of education vehari campus</div>
                
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
</body>
</html>                                                              