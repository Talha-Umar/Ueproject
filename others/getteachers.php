<?php 

include "../others/dbconnection.php";

 
$did = @$_POST['did'];   
//
$sql1 = "SELECT * FROM teachers WHERE id='$did'";
$result1 = mysqli_query($conn,$sql1);
$users_arr = array();
while( $row1 = mysqli_fetch_array($result1) ){

    $userid = $row1['id'];
    $name = $row1['name'];

    $users_arr[] = array("id" => $userid, "name" => $name);

}
// encoding array to json format
echo json_encode($users_arr); 