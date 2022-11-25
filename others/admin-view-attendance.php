<?php 

include "dbconnection.php";
$pid = @$_POST['pid']; 
$ssid = @$_POST['sid']; 
$shid = @$_POST['shid']; 
$cid = @$_POST['cid'];

   $sqy = "SELECT id FROM coursetoprogram WHERE shift='$shid' && course='$cid' && program='$pid' && session='$ssid'";
   $res = mysqli_query($conn, $sqy);
   $val = mysqli_fetch_assoc($res);
   $c2p=$val['id'];
  
    $sql = "SELECT student FROM coursestostudents WHERE course='$c2p'";
$k=0;
$result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
                      
while($value = mysqli_fetch_assoc($result)) {
$sid=$value['student'];

//Select student information by studen id
$sql1 = "SELECT * FROM students WHERE id='$sid'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$name=$row1['name'];
$rollno=$row1['rollno'];

//select and count number of prerests by a student
$sql2 = "SELECT count(status) as present FROM attendance WHERE student='$sid' && course='$cid' && status='1'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$present=$row2['present'];
//select and count total number of status by of a student
$sql3 = "SELECT count(status) as total, id FROM attendance WHERE student='$sid'  && course='$cid'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$total=$row3['total'];
$attid=$row3['id'];
//pecetage of attendace by a student
$pecentage=($present/$total)*100;

$k=++$k;
echo"<tr>
<td>$k</td>
<td >$rollno</td>
<td >$name</td>
<td >$pecentage</td>
<td><a href='attendance-detail.php?action=view&amp;sid=$sid&amp;cid=$cid'><i class='fas fa-eye'></i></a>
</tr>";
}
}
else{
	echo "Not Found For This Course!!!";
}
?>
