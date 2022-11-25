<?php
iif (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
$did=$_SESSION['department'];
include '../others/dbconnection.php';
//check for action add
if (isset($_POST['add'])) {
  $name = @$_POST['name'];
$code = @$_POST['code'];
$department = @$_POST['department'];
$nsemester = @$_POST['nsemester'];

$sql="SELECT * FROM programs WHERE name='$name'";
  $result = mysqli_query($conn, $sql);
  $value = mysqli_fetch_assoc($result);
  // check for already available in database
if ($value['name']!=$name) {
  // inser data
$sql1 = "INSERT INTO programs (code,name,d_id,nsemester)
VALUES ('$code','$name','$department','$nsemester')";
if ($conn->query($sql1) === TRUE) {
echo '<script>alert("Record Added!")</script>';
echo "<script type='text/javascript'>location.replace('programs.php')</script>"; 

}
 else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
}
else{
  echo '<script>alert("Already Added!")</script>';
  echo "<script type='text/javascript'>location.replace('programs.php')</script>"; 
}
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Programs</title>
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
<script src="js/programs.js"></script>
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
                    <div class="col-lg-6 left">
            <h2>Manage <b>Programs</b></h2>
          </div>
         
          <div class="col-lg-6 right">
            <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Program</span></a>
                        
          </div>
                </div>
            </div>
             <div style="overflow-x:auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Program Code</th>
                        <th>Program Name</th>
                        <th>Program Department</th>
                        <th>No of Semesters</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       
                       $k=0;
                       
                         $sql="SELECT * FROM programs WHERE d_id='$did'";
                       
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $value["id"]; ?>">
                        <td><?php echo ++$k; ?></td>
                        <td data-target="code"><?php echo $value["code"]; ?></td>
                        <td data-target="name"><?php echo $value["name"]; ?></td>
                        <td style="display: none;" data-target="did"><?php echo $value["d_id"]; ?></td>
                        <td data-target="department"><?php $x=$value["d_id"]; 
                             $sq="SELECT * FROM departments WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td data-target="nsemester"><?php echo $value["nsemester"]; ?></td>
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
          Manage your Programs
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
            <h4 class="modal-title">Add Program</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> 
          <div class="form-group">
              <label>Program Code</label>
              <input type="text" name="code" class="form-control" required="true">
            </div>         
            <div class="form-group">
              <label>Program Name</label>
              <input type="text" name="name" class="form-control" required="true">
            </div>
            <div class="form-group">
              <label>Program Department</label>
              <select class="form-control" name="department" required="true">
                <?php 
                $did=$_SESSION['department'];
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
              <label>No of semesters</label>
              <input type="number" name="nsemester" class="form-control" required="true">
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
  $Department=$_POST['Department'];
  $Nsemester=$_POST['Nsemester'];
  
  if ($Name!='' && $Code!='' && $Department!='') {
  $sql = "UPDATE programs SET code='$Code',name='$Name',d_id='$Department',nsemester='$Nsemester' WHERE id=$Id";
  if (mysqli_query($conn, $sql)) {
    $message = "Record Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('programs.php')</script>";
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
            <h4 class="modal-title">Edit Program</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"> 
          <div class="form-group">
              <label>Program Code</label>
              <input type="text" name="Code" class="form-control" id="code">
            </div>         
            <div class="form-group">
              <label>Program Name</label>
              <input type="text" name="Name" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label>Program Department</label>
              <select class="form-control" name="Department">
              <option id="department"></option>
              </select>
            </div>
            <div class="form-group">
              <label>No of semesters</label>
              <input type="number" name="Nsemester" class="form-control" id="nsemester">
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
$sql = "DELETE FROM programs WHERE id=$y";

if (mysqli_query($conn, $sql)) {
  echo '<script>alert("Record deleted!")</script>';
  echo "<script type='text/javascript'>location.replace('programs.php')</script>";
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