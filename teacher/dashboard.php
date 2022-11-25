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
   .col-md-3{
    padding: 6px 4px;
  }
  .Grid{
    border-radius: 2px;
    padding: 8px 10px;
  }
  .Grid>p{
    text-align: right;
    font-size: 18pt;
    margin-bottom: -5px;
  }
  .row1>.col-md-3>.Grid1{
    background: green;
    color: white;
  }
  .row1>.col-md-3>.Grid2{
    background: orange;
    color: white;
  }
  .row1>.col-md-3>.Grid3{
    background: lightpink;
    color: white;
  }
  .row1>.col-md-3>.Grid4{
    background: blue;
    color: white;
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

           <!-- First Grids Row -->
          <div class="row row1">
            <!-- 1st Grid -->
             <div class="col-md-3">
             <div class="Grid Grid1">
                <h3>Courses</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $tid=$_SESSION["id"];
              $sql="SELECT count(c_id) as totalcourses FROM coursetoteacher WHERE t_id='$tid'";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalcourses'];
              ?></p>
             </div>
             </div>
             <!-- 2nd Grid -->
             <div class="col-md-3">
              <div class="Grid Grid2">
              <h3>Programs</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(p_id) as totalprograms FROM coursetoteacher WHERE t_id='$tid'";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalprograms'];
              ?></p>
            </div>
             </div>
             <!-- 3rd Grid -->
            <div class="col-md-3">
              <div class="Grid Grid3">
            <h3>Departments</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql1="SELECT count(d_id) as totaldepartments FROM coursetoteacher WHERE t_id='$tid'";
                       $result1 = mysqli_query($conn, $sql1);
                      $value1 = mysqli_fetch_assoc($result1);
                     echo $value1['totaldepartments'];
              ?></p>
            </div>
            </div>
             <!-- 4th Grid -->
            <div class="col-md-3">
              <div class="Grid Grid4">
            <h3>Shifts</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql1="SELECT count(sh_id) as totalshifts FROM coursetoteacher WHERE t_id='$tid'";
                       $result1 = mysqli_query($conn, $sql1);
                      $value1 = mysqli_fetch_assoc($result1);
                      if ($value1['totalshifts']>'2') {
                        echo "2";
                      }
                     else{
                      echo  $value1['totalshifts'];
                     }
              ?></p>
            </div>
            </div>
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