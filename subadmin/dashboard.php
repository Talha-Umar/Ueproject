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
<!--Custom js for update and delete data-->
<script src="js/departments.js"></script>
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
<style type="text/css">
  .col-md-4{
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
  .row1>.col-md-4>.Grid1{
    background: green;
    color: white;
  }
  .row1>.col-md-4>.Grid2{
    background: orange;
    color: white;
  }
  .row1>.col-md-4>.Grid3{
    background: blue;
    color: white;
  }
  .row2>.col-md-4>.Grid1{
    background: blue;
    color: white;
  }
  .row2>.col-md-4>.Grid2{
    background: green;
    color: white;
  }
  .row2>.col-md-4>.Grid3{
    background: orange;
    color: white;
  }
  .row3>.col-md-4>.Grid1{
    background: orange;
    color: white;
  }
  .row3>.col-md-4>.Grid2{
    background: blue;
    color: white;
  }
  .row3>.col-md-4>.Grid3{
    background: green;
    color: white;
  }
  
</style>
</head>
<body>
  <?php include 'header.php';  ?>
  <div class="content">
    <div class="container">
        <div class="table-wrapper">
          <!-- Header -->
            <div class="table-title">
                <div class="row">
                    <div class="col-md-12">
                   <h2>Admin <b>Dashboard</b></h2>
                   </div>
                </div>
            </div>
<!-- First Grids Row -->
          <div class="row row1">
            <!-- 1st Grid -->
             <div class="col-md-4">
             <div class="Grid Grid1">
                <h3>Total Courses</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totalcourses FROM courses";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalcourses'];
              ?></p>
             </div>
             </div>
             <!-- 2nd Grid -->
             <div class="col-md-4">
              <div class="Grid Grid2">
              <h3>Total Programs</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totalprograms FROM programs";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalprograms'];
              ?></p>
            </div>
             </div>
             <!-- 3rd Grid -->
            <div class="col-md-4">
              <div class="Grid Grid3">
            <h3>Total Students</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql1="SELECT count(name) as totalstudents FROM students";
                       $result1 = mysqli_query($conn, $sql1);
                      $value1 = mysqli_fetch_assoc($result1);
                     echo $value1['totalstudents'];
              ?></p>
            </div>
            </div>
            </div>
<!-- Second Grids Row -->
          <div class="row row2">
            <!-- 1st Grid -->
            <div class="col-md-4">
              <div class="Grid Grid1">
             <h3>Total Teachers</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totalteachers FROM teachers";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalteachers'];
              ?></p>
            </div>
          </div>
            <!-- 2nd Grid -->
             <div class="col-md-4">
             <div class="Grid Grid2">
                <h3>Course 2 Teacher</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totalcourses FROM courses";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalcourses'];
              ?></p>
             </div>
             </div>
             <!-- 3rd Grid -->
             <div class="col-md-4">
              <div class="Grid Grid3">
              <h3>Course 2 Program</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totalprograms FROM programs";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totalprograms'];
              ?></p>
            </div>
             </div>
             </div>
<!-- Third Grids Row -->
          <div class="row row3">
             <!-- 1st Grid -->
            <div class="col-md-4">
              <div class="Grid Grid1">
            <h3>Today Attendance</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql1="SELECT count(course) as totalattendance FROM attendance";
                       $result1 = mysqli_query($conn, $sql1);
                      $value1 = mysqli_fetch_assoc($result1);
                     echo $value1['totalattendance'];
              ?></p>
            </div>
            </div>
            <!-- 2nd Grid -->
            <div class="col-md-4">
              <div class="Grid Grid2">
             <h3>Total Departments</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(name) as totaldepartment FROM departments";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totaldepartment'];
              ?></p>
            </div>
          </div>
          <!-- 3rd Grid -->
            <div class="col-md-4">
              <div class="Grid Grid3">
             <h3>Total Admins</h3>
              <p>
              <?php 
              include '../others/dbconnection.php';
              $sql="SELECT count(id) as totaladmin FROM admin";
                       $result = mysqli_query($conn, $sql);
                      $value = mysqli_fetch_assoc($result);
                     echo $value['totaladmin'];
              ?></p>
            </div>
          </div>
        </div>
        

<!-- Footer -->
     <div class="clearfix">
        <div class="left-text">
          Manage your Dashboard
        </div>
        <div class="right-text">University of education vehari campus</div>    
            </div>

    </div>
  </div>
</div>
</body>
</html>                                                               