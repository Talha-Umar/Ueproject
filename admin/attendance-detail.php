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
<title>Attendance Detail</title>
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
            <h2>Manage <b>Courses Students Attendance</b></h2>
          </div>
          <div class="col-md-6 right">
            <a href="attendance.php" class="btn btn-success" ><i class="fas fa-arrow-left"></i> <span>Back</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x:auto; width: 100%;">
              <button id="download" class="btn btn-success">Export</button>
            <table class="table table-striped table-hover" id="table2excel">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Rollno</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sid=$_REQUEST['sid'];
                    $cid=$_REQUEST['cid'];
                       include '../others/dbconnection.php';
                       $k=0;
                       $sql="SELECT * FROM attendance WHERE course='$cid' && student='$sid'";
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {

                        ?>
                        <tr>
                        <td><?php echo ++$k; ?></td>
                        <td><?php 
                           $sql1="SELECT * FROM students WHERE id='$sid'";
                       $result1 = mysqli_query($conn, $sql1);
                       $value1 = mysqli_fetch_assoc($result1);
                       echo $value1['rollno'];
                         ?></td>
                        <td><?php echo $value1['name']; ?></td>
                        <td><?php 
                            $sql2="SELECT * FROM courses WHERE code='$cid'";
                       $result2 = mysqli_query($conn, $sql2);
                       $value2 = mysqli_fetch_assoc($result2);
                       echo $value2['name'];
                        ?></td>
                        <td><?php if ($value['status']=='1') {

                          echo "<span style='color:green'>Present</span";
                        } else{
                          echo "<span style='color:red'>Absent</span";
                        }
                        ?></td>
                        <td><?php echo  $value['date']; ?></td>

                        <?php
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
          Manage your Students Attendance
        </div>
        <div class="right-text">University of education vehari campus</div>
                
            </div>
        </div>
  </div>
</div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
  <script type="text/javascript">
    $("#download").click(function(){
  $("#table2excel").table2excel({
    // exclude CSS class
    exclude:".noExl",
    name:"Worksheet Name",
    filename:"download",//do not include extension
    fileext:".xls" // file extension
  });
});

  </script>
</body>
</html>                                                               