<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:../login.php");
}
 ?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/img/bootstrap-solid.svg">
<title>Students Course</title>
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
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
         <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-md-6 left">
            <h2>Manage <b>Courses Students Course</b></h2>
          </div>
          <div class="col-md-6 right">
            <a href="programcourses.php" class="btn btn-success"><i class="fas fa-arrow-left"></i> <span>Back</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Rollno</th>
                        <th>Name</th>
                        <th>Program</th>
                        <th>Semester</th>
                        <th>Course</th>
                        <th>Session</th>
                        <th>Shift</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $id=$_REQUEST['id'];
                    
                       include '../others/dbconnection.php';
                       $k=0;
                       $sql1="SELECT * FROM coursestostudents WHERE course='$id'";
                       $result1 = mysqli_query($conn, $sql1);
                       if (mysqli_num_rows($result1) > 0) {
                       // output data of each row
                      while($value1 = mysqli_fetch_assoc($result1)) {
                        $student=$value1['student'];
                       $sql2="SELECT * FROM students WHERE id='$student'";
                       $result2 = mysqli_query($conn, $sql2);
                       if (mysqli_num_rows($result2) > 0) {
                       // output data of each row
                      while($value2 = mysqli_fetch_assoc($result2)) {
                        
                        ?>
                        <tr id="<?php echo $value["id"]; ?>">
                        <td><?php echo ++$k; ?></td>
                        <td><?php echo  $value2['rollno']; ?></td>
                        <td><?php echo  $value2['name']; ?></td>

                        <?php
                       
                   
                       $sql="SELECT * FROM coursetoprogram WHERE id='$id'";
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                    ?>
                    
            
                        <td style="display: none;" data-target="pid"><?php echo $value["program"]; ?></td>
                        <td data-target="program">
                          <?php $x=$value["program"]; 
                             $sq="SELECT * FROM programs WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td data-target="semesterno"><?php echo $value["semesterno"]; ?></td>
                        
                        <td style="display: none;" data-target="cid"><?php echo $value["course"]; ?></td>
                        <td data-target="course">
                          <?php $x=$value["course"]; 
                             $sq="SELECT * FROM courses WHERE code='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["name"];
                        ?></td>
                        <td style="display: none;" data-target="ssid"><?php echo $value["session"]; ?></td>
                        <td data-target="session">
                          <?php $x=$value["session"]; 
                             $sq="SELECT * FROM sessions WHERE id='$x'";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["session"];
                        ?></td>
                        <td style="display: none;" data-target="shid"><?php echo $value["shift"]; ?></td>
                        <td data-target="shift">
                          <?php $x=$value["shift"]; 
                             $sq="SELECT * FROM shifts WHERE id=$x";
                       $res = mysqli_query($conn, $sq);
                       $val = mysqli_fetch_assoc($res);
                       echo $val["shift"];
                        ?></td>
                    </tr>
                <?php }}   }
                   }
                     }
                   }
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
          Manage your Students Course
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>
  </div>
</div>
</body>
</html>                                                               