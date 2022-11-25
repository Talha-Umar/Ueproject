<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
 
include '../others/dbconnection.php';
// check for add action
if (isset($_POST['add'])) {
$code = @$_POST['code'];
$name = @$_POST['name'];
$program= @$_POST['program'];
$hour = @$_POST['hour'];
$semester = @$_POST['semester'];
$sql="SELECT * FROM courses WHERE name='$name'";
  $result = mysqli_query($conn, $sql);
  $value = mysqli_fetch_assoc($result);
// check for already available in database
if (@$value['name']!=$name) {
  // inser data
$sql1 = "INSERT INTO courses (code,name,ch_id,p_id,semester)
VALUES ('$code','$name','$hour','$program','$semester')";
if ($conn->query($sql1) === TRUE) {
echo '<script>alert("Record Added!")</script>';
echo "<script type='text/javascript'>location.replace('courses.php')</script>"; 

}
 else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
}
else{
  echo '<script>alert("Already Added!")</script>';
  echo "<script type='text/javascript'>location.replace('courses.php')</script>"; 
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Courses</title>
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
<script src="js/courses.js"></script>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-lg-4 left">
            <h2>Manage <b>Courses</b></h2>
          </div>
           <div class="col-lg-4 center">
            <form accept="" method="post">
              <input class="btn btn-success" type="submit" name="search" value="Search">
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
                <option value="">ALL</option>
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
               
              </form>
          </div>
          <div class="col-lg-4 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Course</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Program</th>
                        <th>Course Credit Hour's</th>
                        <th>Semester</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $k=0;
                       $progid=@$_POST['prog'];
                       $search=@$_POST['search'];
                       if (isset($search) && $progid!='') {
                         $sql="SELECT * FROM courses WHERE p_id=$progid";
                       }
                       elseif (isset($search) && $progid='') {
                         $sql="SELECT * FROM courses";
                       }
                       else{
                       $sql="SELECT * FROM courses";
                       }
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["code"]; ?>">
            <td>
              <?php echo ++$k; ?>
            </td>
                        <td data-target="code"><?php echo $value["code"]; ?></td>
                        <td data-target="name"><?php echo $value["name"]; ?></td>
                        <td style="display: none;" data-target="pid"><?php echo $value["p_id"]; ?></td>
                        <td data-target="program">
                          <?php $x=$value["p_id"]; 
                             $sq="SELECT * FROM programs WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="chid"><?php echo $value["ch_id"]; ?></td>
                        <td data-target="chours">
                          <?php $x=$value["ch_id"]; 
                             $sq="SELECT * FROM credit_hours WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["hours"];
                        ?></td>
                        <td data-target="semester"><?php echo $value["semester"]; ?></td>
                        <td>
                            <a href="#edit" class="edit" data-toggle="modal" data-role="edit" data-id="<?php echo $value["code"]; ?>"><form><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></form></a>
                            <a href="#delete" class="delete" data-toggle="modal" data-role="delete" data-id="<?php echo $value["code"]; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
          Manage your Courses
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
              <label>Course Code</label>
              <input type="text" name="code" class="form-control" required="true">
            </div>        
            <div class="form-group">
              <label>Course Name</label>
              <input type="text" name="name" class="form-control" required="true">
            </div>
            <div class="form-group">
              <label>Course Program</label>
              <select class="form-control" name="program" id="Program" required="true">
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
              <label>Course Semester</label>
              <select class="form-control" name="semester" id="Semester" required="true">
                <option value="">Select Semester</option>
              </select>
            </div>
            <div class="form-group">
              <label>Course Credit Hour's</label>
              <select class="form-control" name="hour" required="true">
                <option value="">Select Credit Hour</option>
                <?php 
                                $sql="SELECT * FROM credit_hours";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["hours"];?></option>
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
  $Code=$_POST['Code'];
  $Name=$_POST['Name'];
  $Program=$_POST['Program'];
  $Semester=$_POST['Semester'];
  $Hour=$_POST['Hour'];
  if ($Name!='' && $Code!='' && $Program!='' && $Hour!='') {
  $sql = "UPDATE courses SET code='$Code',name='$Name',ch_id='$Hour',p_id='$Program',semester='$Semester' WHERE code='$Id'";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('courses.php')</script>";
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
              <label>Course Code</label>
              <input type="text" name="Code" class="form-control" id="code">
            </div>         
            <div class="form-group">
              <label>Course Name</label>
              <input type="text" name="Name" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label>Course Program</label>
              <select class="form-control" name="Program" id="Prog">
                <option value="" id="program">Select Program</option>
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
              <label>Course Semester</label>
              <select class="form-control" name="Semester" id="Sem">
                <option value="" id="semester">Select Semester</option>
              </select>
            </div>
            <div class="form-group">
              <label>Course Credit Hour's</label>
              <select class="form-control" name="Hour">
              <option id="hour"></option>
                <?php 
                                $sql="SELECT * FROM credit_hours";
                                $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["hours"];?></option>
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
$sql = "DELETE FROM courses WHERE code='$y'";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('courses.php')</script>";
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
</html>                                                                                                                                                                                                                                                                                                                                                                                                             