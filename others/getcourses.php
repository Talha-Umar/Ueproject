<?php 

include "../others/dbconnection.php";

$progid = @$_POST['pid'];  
$ses = @$_POST['sid'];    
//
$sql1 = "SELECT * FROM courses WHERE p_id='$progid' && semester='$ses'";
$result1 = mysqli_query($conn,$sql1);
$users_arr = array();
while( $row1 = mysqli_fetch_array($result1) ){

    $userid = $row1['code'];
    $name = $row1['name'];

    $users_arr[] = array("id" => $userid, "name" => $name);

}
// encoding array to json format
echo json_encode($users_arr); 