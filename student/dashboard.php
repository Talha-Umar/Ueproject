<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Dashboard</title>
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
<style type="text/css">
    .col-md-4{
        padding: 1em;
    }
    .first{
      color: black; 
      border: 1px solid #F5F1F1; 
    }
    .second{
      background: lightpink; 
    }
    .third{
        background: gray; 
    }
    .title{
        font-size: 18pt; 
        float: left;
    }
    .desc{
        font-size: 20pt; 
        float: right;
        font-weight: bold;
            }
</style>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-12">
                   <h2>Here <b>Dashboard</b></h2>
                   </div>
                </div>
            </div>
             
    
 


                  
            <div style="overflow-x:auto;">
             
            
             <table  class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Course</th>
                       <th>Attendance</th>
                       <th>Action</th>
                        
                    </tr>
                </thead>
              <tbody>
                <?php 
              include '../others/dbconnection.php';
                      $sid=$_SESSION["id"];
              //select course student take
             $sql ="SELECT * FROM coursestostudents WHERE student='$sid'";
             $result = mysqli_query($conn, $sql);
             $k=0;
  while($row = mysqli_fetch_assoc($result)) {
   $cid=$row['course'];
   //get course detail 
   $sql1="SELECT * FROM coursetoprogram WHERE id='$cid'";
   $result1 = mysqli_query($conn, $sql1);
  while($row1 = mysqli_fetch_assoc($result1)) {
   $crsid=$row1['course'];
   //get course name
   $sql2="SELECT name FROM courses WHERE code='$crsid'";
   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_assoc($result2);
   $course=$row2['name'];
   $k=++$k;
   //select and count number of prerests by a student in a course
$sql3 = "SELECT count(status) as present FROM attendance WHERE student='$sid' && course='$crsid' && status='1'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$present=$row3['present'];
//select and count total number of status by of a student
$sql4 = "SELECT count(status) as total FROM attendance WHERE student='$sid' && course='$crsid'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_assoc($result4);
$total=$row4['total'];
//pecetage of attendace by a student
@$percentage=$present/$total*100;
echo"<tr>
<td>$k</td>
<td>$course</td>
<td>$percentage %</td>
<td><a href='attendance-detail.php?action=view&amp;sid=$sid&amp;cid=$crsid'><i class='fas fa-eye'></i></a></td>
</tr>";
  }
}



                ?>
              </tbody>
                </table>
            
           </div>
            
      <div class="clearfix">
        <div class="left-text">
          Manage from Dashboard
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>
    </div>
  </div>
  
</body>
</html>                                                               