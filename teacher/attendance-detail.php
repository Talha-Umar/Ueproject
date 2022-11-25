<?php
if (!isset($_SESSION)) { 
  session_start();
  }
if (!isset($_SESSION["id"])) {
  header("Location:login.php");
}
include '../others/dbconnection.php';
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
<!-- form style css -->
<link rel="stylesheet" type="text/css" href="../assets/css/form.css">
<!-- Jquery JS-->
<script src="../assets/js/jquery.min.js"></script>
<!-- Bootstrap JS-->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- custom js for Modals-->
<script src="../assets/js/custom.js"></script>
<script src="js/allattendance.js"></script>
<script type="text/javascript">
  $(document).on('click','a[data-role=edit]',function(){
    var id=$(this).data('id');
     var rollno=$('#'+id).children('td[data-target=rollno]').text();
    var name=$('#'+id).children('td[data-target=name]').text();
     var svalue=$('#'+id).children('td[data-target=svalue]').text();
      var status=$('#'+id).children('td[data-target=status]').text();
      var course=$('#'+id).children('td[data-target=course]').text();
      var date=$('#'+id).children('td[data-target=date]').text();
    
    $('#rollno').val(rollno);
    $('#name').val(name);
    $('#status').val(svalue);
    $('#status').text(status);
     $('#course').val(course);
      $('#date').val(date);
    $('#userid').val(id);
});
</script>

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
            <a href="allattendance.php" class="btn btn-success" ><i class="fas fa-arrow-left"></i> <span>Back</span></a>
                        
          </div>
                </div>
            </div>
            <div style="overflow-x:auto; width: 100%;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>

                        <th>Sr.</th>
                        <th>Rollno</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sid=@$_REQUEST['sid'];
                    $cid=@$_REQUEST['cid'];
                       include '../others/dbconnection.php';
                       $k=0;
                       $sql="SELECT * FROM attendance WHERE course='$cid' && student='$sid'";
                       $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {
                       // output data of each row
                      while($value = mysqli_fetch_assoc($result)) {
                               $id=$value['id'];
                               $x=1;
                               $y=0;
                               $svalue=$value['status'];
                               if ($svalue==$x) {$status='<span style="color:green;">Present</span>';}
                             if ($svalue==$y) {$status='<span style="color:Red;">Absent</span>';}
                        ?>
                        <tr id='<?php echo $id; ?>'>
                        <td><?php echo ++$k; ?></td>
                        <td data-target='rollno'><?php 
                           $sql1="SELECT * FROM students WHERE id='$sid'";
                       $result1 = mysqli_query($conn, $sql1);
                       $value1 = mysqli_fetch_assoc($result1);
                       echo $value1['rollno'];
                         ?></td>
                        <td data-target='name'><?php echo $value1['name']; ?></td>
                        <td data-target='course'><?php 
                        $sql2="SELECT * FROM courses WHERE code='$cid'";
                       $result2 = mysqli_query($conn, $sql2);
                       $value2 = mysqli_fetch_assoc($result2);
                       echo $value2['name'];

                        ?></td>
                        <td style="display: none;" data-target='svalue'><?php echo $svalue;?></td>
                        <td data-target='status'><?php echo $status;?></td>
                        <td data-target='date'><?php echo  $value['date']; ?></td>
                        <td> <a href='#edit' class='edit' data-toggle='modal' data-role='edit' data-id='<?php echo $id; ?>'><form><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a></td>

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
<!-- Edit Modal HTML -->
  
  <div id="edit" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="update.php" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Attendance</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Name</label>
              <input type="text"  class="form-control" id="name" readonly="yes">
            </div>
            <div class="form-group">
              <label>Roll No</label>
              <input type="text"  class="form-control" id="rollno" readonly="yes">
            </div>
            <div class="form-group">
              <label>Course</label>
              <input type="text" class="form-control" id="course" readonly="yes">
            </div>
            <div class="form-group">
              <label>Date</label>
              <input type="date" class="form-control" id="date" readonly="yes">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" id="Status" name="status">
                <option id="status"></option>
                <option value="1">Present</option>
                <option value="0">Absent</option>
              </select>
            </div>
            <input type="hidden" id="userid" name="Id">   
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save" name="Edit">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>                                                               