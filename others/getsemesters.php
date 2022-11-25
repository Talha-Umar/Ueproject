<?php 

include "../others/dbconnection.php";

$progid = @$_POST['pid'];  
//
$sql1 = "SELECT * FROM programs WHERE id='$progid'";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
$totals = $row1['nsemester'];
$nsemester=1;
$users_arr = array();
while( $nsemester <= $totals ){

    $userid = $nsemester;
    $name = $nsemester;

    $users_arr[] = array("id" => $userid, "name" => $name);
$nsemester=$nsemester+1;
}
// encoding array to json format
echo json_encode($users_arr); 