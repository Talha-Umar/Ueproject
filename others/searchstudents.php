<?php 

include "../others/dbconnection.php"; 
$shid = @$_POST['shid']; 
$cid = @$_POST['cid'];   

$sql1 = "SELECT * FROM coursetoprogram WHERE shift='$shid' && course='$cid'";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);
$course = $row1['id'];
$sql2 = "SELECT * FROM coursestostudents WHERE course='$course'";
$result2 = mysqli_query($conn,$sql2);
$k=0; 
$count=0;
while( $row2 = mysqli_fetch_array($result2) ){
    $student = $row2['student'];
    $sql = "SELECT * FROM students WHERE id='$student'";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$rollno=$row['rollno'];
$student=$row['id'];
$name=$row['name'];
$k=++$k;
echo "<tr>
<td>$k</td>
<input type='hidden' name='tablerow[$count][]' value='$student'>
<td>$rollno</td>
<td>$name</td>
<td><input type='radio' name='tablerow[$count][]' value='1'> Present</td>
<td><input type='radio' name='tablerow[$count][]' value='0'> Absent</td>
</tr>";

$count++;
}

