<?php 
session_start();
//require_once 'include/header.php';
require_once 'php/db.php'; 
$sql = mysqli_query($connect,"SELECT ap_flag FROM student_master where register_no='".$_SESSION['val']."'");
//$sql = mysqli_query($connect,"SELECT ap_flag FROM student_master where register_no='19US34'");
$row = mysqli_fetch_array($sql);
if($row['ap_flag']==1 )
{
  //echo '<script>window.location.replace("pop_up ");</script>';
}
else
{
    echo '<script>window.location.replace("index ");</script>';
}
if(isset($_POST['submit']))
{
$pass1=$_POST['new_pass'];
$pass2=$_POST['confirm_pass'];
if($pass1==$pass2)
  { 
      $query=mysqli_query($connect,"UPDATE student_master SET  pass='$pass1' where register_no='".$_SESSION['val']."'");
      if($query)
      {
        $_SESSION['admin']=$_SESSION['val'];
        $_SESSION['val']='';
        echo '<script>window.location.replace("pop_up ");</script>';
      }
      else{
        $error="Something went wrong . Please try again.";    
      }
    
  }
  else
  {
      echo "<script> alert('Password doesnot match')</script>";
  }
}
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> clg | UG STUDENTS PANEL </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Sweet Alert css -->
    <link href="js/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Datepicker css -->
    <link rel="stylesheet" type="text/css" href="vendor/datepicker/css/datepicker.min.css">
    <link rel="shortcut icon" href="img/favicon.png">
    <script type="text/javascript" src="js/html2pdf.js"></script>
  </head>
  <body style="width:100%; height:100%;">
<center>
 <div class="row" style="width: 100%; height:100%; padding-top:100px;">
  <div class="col-lg-12 md-10">
    <div class="card">
      <div class="card-header" align="center">
        <h6 class="text-uppercase mb-0">Change Password</h6>
      </div>
      <div class="card-body">
          <form name="category" method="post" >
        <div class="form-group row">
          </div>
          <div class="form-group row">
            <label class="form-control-label text-uppercase col-md-6">New Password</label>
            <div class="col-md-6">
                <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="form-control-label text-uppercase col-md-6">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="Confirm Password" required>
            </div>
          </div>
        <div class="line"></div>
        <div class="row" align="right">
          <div class="col-lg-12 mb-12">
            <button type="submit" class="btn btn-primary" name="submit" id="submit"  onclick="update_password(this);" style="margin: 10px;"> UPDATE PASSWORD </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</center>
  </body>