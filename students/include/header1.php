<?php session_start();
require_once 'php/db.php';
  if (isset($_SESSION['admin']) == '') {
    echo '<script>window.location.replace("index ");</script>';
  }
  if (isset($_SESSION['type']))
  if($_SESSION['type'] != "C")
  {
   echo '<script>window.location.replace("index ");</script>'; 
  }
  $sql =mysqli_fetch_array(mysqli_query($connect,"SELECT session FROM `student_master` WHERE register_no= '".$_SESSION['admin']."'"));
  if($sql['session']!=sha1($_SESSION['id']))
        header("Location: index ");
?>
<!DOCTYPE html>
<html>
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

  <body oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" ><!-- <body oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;"> -->
    <header oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><p class="navbar-brand text-primary font-weight-bold text-uppercase text-base">clg UG STUDENTS Dashboard</p>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item">
          <li class="nav-item dropdown ml-auto"><a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="img/avatar.png" alt="Goldsan" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="profile " class="dropdown-item"><strong class="d-block text-uppercase headings-font-family">
              <?php if (isset($_SESSION['admin'])) {
              echo $_SESSION['admin']; }
              else { echo "Aln Xlmar"; } ?></strong><small>UG STUDENT</small></a>
              <div class="dropdown-divider"></div><a href="change_password " class="dropdown-item">Change Password</a>
              <div class="dropdown-divider"></div><a href="php/logout " class="dropdown-item">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
<style type="text/css" media="print">
    * { display: none; }
</style>
    <!-- Side nav bar -->
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MENU</div>
        <ul class="sidebar-menu list-unstyled" id="nav">
              <li class="sidebar-list-item" ><a href="dashboard " class="sidebar-link text-muted" ><i class="o-wireframe-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
               <li class="sidebar-list-item"><a href="qbank" class="sidebar-link text-muted"><i class="far fa-newspaper mr-3 text-gray"></i><span>Question Bank</span></a>
            
          </li>
              <li class="sidebar-list-item" ><a href="hallticket" class="sidebar-link text-muted" ><i class="o-survey-1 mr-3 text-gray"></i><span>Get Hallticket</span></a></li>

              <li class="sidebar-list-item" ><a href="viewStudents " class="sidebar-link text-muted" ><i class="fas fa-list mr-3 text-gray"></i><span>Time Table</span></a></li>

              <li class="sidebar-list-item" ><a href="manage_sheets " class="sidebar-link text-muted" ><i class="fas fa-user-graduate mr-3 text-gray"></i><span>Exam Result</span></a></li>

              
              

        </ul>
      </div>
      <div oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;"  class= "page-holder w-100 d-flex flex-wrap">
        <div oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;"  class= "container-fluid px-xl-5">
          <section oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;"   class="py-5">

<script>
            // window.onload = function() {
            //     var labels = document.getElementsByTagName('label');
            //     for (var i = 0; i < labels.length; i++) {
            //         disableSelection(labels[i]);
            //     }
            // };
            // function disableSelection(element) {
            //     if (typeof element.onselectstart != 'undefined') {
            //         element.onselectstart = function() { return false; };
            //     } else if (typeof element.style.MozUserSelect != 'undefined') {
            //         element.style.MozUserSelect = 'none';
            //     } else {
            //         element.onmousedown = function() { return false; };
            //     }
            //     }
                </script>