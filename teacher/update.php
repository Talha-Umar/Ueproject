<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include '../others/dbconnection.php';
if(isset($_POST['Edit'])){
  $Id=$_POST['Id'];
  $status=$_POST['status'];
  if ($status!='') {
  $sql = "UPDATE attendance SET status='$status' WHERE id=$Id";
  if (mysqli_query($conn, $sql)) {
$message = "Attendance Updated!";
echo "<script type='text/javascript'>alert('$message');</script>";
echo "<script type='text/javascript'>location.replace('attendance.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}
}
 ?>