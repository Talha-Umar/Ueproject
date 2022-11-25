<?php 

include "dbconnection.php";
$shid = @$_POST['shid']; 
$cid = @$_POST['cid']; 
$date = @$_POST['date']; 

   $sql = "SELECT * FROM attendance WHERE shift='$shid' && course='$cid' && date='$date'";
$k=0;
$result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
                      
while($value = mysqli_fetch_assoc($result)) {
	$id=$value['id'];
$sid=$value['student'];
$svalue=$value['status'];
$sql1 = "SELECT * FROM students WHERE id='$sid'";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);
$name=$row['name'];
$x=1;
$y=0;
$rollno=$row['rollno'];
if ($svalue==$x) {
	$status='Present';
}
if ($svalue==$y) {
	$status='Absent';
}
$k=++$k;
echo"<tr id='$id'>
<td>$k</td>
<td data-target='rollno'>$rollno</td>
<td data-target='name'>$name</td>
<td style='display: none;' data-target='svalue'>$svalue</td>
<td data-target='status'>$status</td>
<td>
     <a href='#edit' class='edit' data-toggle='modal' data-role='edit' data-id='$id'><form><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
 </td>
</tr>";
}
}
else{
	echo "Please Mark Attendance or check with right date!!!";
}
?>
