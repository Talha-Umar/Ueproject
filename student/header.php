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
</head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
<style type="text/css">
	.sidebar{
		height: 100%;
  position: fixed;
  z-index: 1;
  background-color: white;
  overflow-x: hidden;
  margin-top: 0px;
  display: block !important;
  border-left: 1px solid rgba(0,0,0,.0625);
	}
	.menu a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #7279A1;
  display: block;
  border-bottom: 1px solid white;
}
.toggle{
    float: left;
    margin-left: 5px;
    margin-top: 10px;
    cursor: pointer;
    display: block;
  }

  @media only screen and (min-width: 960px) {
  .sidebar {
    display: block !important;
    width: 15% !important;
  }
  .header{
    width: 85% !important;
  }
  .content{
    width: 85% !important;
  }
  .toggle{
    display: none !important;
  }
}
@media only screen and (max-width: 959px) {
  .sidebar {
    display: none;
    width: 0%;
  }
  .name{
    display: none;
  }
  .header{
    width: 100%;
  }
  .content{
    width: 100%;
  }
  
}
.menu a:hover {
  color: black;
}
 .active {
  background:#435d7d;
}
.content{
  float: right;
}

	.container{
		margin-top: 75px;
	}
	.table-wrapper{
		margin-top: 15px;
	}
  .fas{
    float: right;
  }
  .header{
        background-color: #fff;
    border-bottom: 1px solid rgba(0,0,0,.0625);
    display: block;
    margin-bottom: 0;
    padding: 0;
    position: fixed;
    z-index: 800;
    text-align: center;
    border-bottom: 1px solid rgba(0,0,0,.0625);
  }
	

.dropdown {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 150px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
box-sizing: border-box;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
  text-align:center;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function () {
            $('.menu a').each(function(){
        var path = window.location.href;
        var current = path.substring(path.lastIndexOf('/')+1);
        var url = $(this).attr('href');

        if(url == current){
            $(this).addClass('active');
        };
    }); 
    $(".toggle").toggle(
    function(){
      $(".sidebar").css("display","block");
      $(".sidebar").css("width","35%");
      $(".content").css("width","100%");
      $(".header").css("width","100%");

  },
    function(){
      $(".sidebar").css("display","none");
       $(".sidebar").css("width","0%");
       $(".content").css("width","100%");
       $(".header").css("width","100%");
});

        });
  $( document ).ready(function() {
  $("body").click(function(){
      $("#myDropdown").hide();
  });

  $(".profile").click(function(event) {
    event.stopPropagation();
  });
  $(".profile").click(function(){
  $("#myDropdown").toggle();
});
});
</script>
<body>
<nav class="sidebar">

    <div class="brand" style="border-bottom: 1px solid rgba(0,0,0,.0625); padding: 0 20px;">
  
        <a href="dashboard.php" style="text-decoration: none!important; color: #0f9aee;">
           <div style=" align-items: center; display: flex!important; ">
        
                <div><img src="../assets/img/ue.png" alt="Logo" width="90"></div>
                <div><h5 class="name mB-0">Student</h5></div>
           </div>
       </a>
    </div>
    <div class="menu">
    <a  href="dashboard.php">Dashboard <i class="fas fa-angle-right"></i></a>
  </div>	
</nav>
<div class="content">
<div class="header">
  <nav style="text-align: center; padding: 17.5px 30px; font-size: 20px;">
 <span class="toggle"><i class="fa fa-bars"></i></span>
Dashboard
<div class="profile" style="float: right;">
<div class="dropdown" onclick="myFunction()">
<img src="../assets/img/user.png" style="width: 2em; height: 2em; border-radius: 50%;">
  <span><?php
  include '../others/dbconnection.php';
 $id=@$_SESSION["id"]; 
 $sql = "SELECT name FROM students WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo $row["name"];
 ?></span>
  <div id="myDropdown" class="dropdown-content">
    <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
    <a href="change_password.php"><i class="fa fa-cog"></i> Settings</a>
    <a href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
    
  </div>
</div>
</div>
</nav>
</div>
</div>
</body>
</html>