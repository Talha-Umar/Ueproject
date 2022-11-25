<?php 

include "../others/dbconnection.php";

$progid = @$_POST['progid'];  
$sesid = @$_POST['sesid'];  
$shid = @$_POST['shid'];   
//
$sql1 = "SELECT * FROM coursetoprogram WHERE program='$progid' && session='$sesid' && shift='$shid'";
$result1 = mysqli_query($conn,$sql1);
$users_arr = array();
while( $row1 = mysqli_fetch_array($result1) ){
$course = $row1['course'];
//get course name by id
$sql = "SELECT * FROM courses WHERE code='$course'";
$result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_array($result);
    $userid = $row['code'];
    $name = $row['name'];

    $users_arr[] = array("id" => $userid, "name" => $name);

}
// encoding array to json format
echo json_encode($users_arr); 