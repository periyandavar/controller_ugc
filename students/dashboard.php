<?php require_once 'include/header.php';
require_once 'php/db.php'; 
$sql = mysqli_query($connect,"SELECT ap_flag FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
if($row['ap_flag']==1 )
   echo '<script>window.location.replace("pop_up ");</script>'; 
?>

<div class="row mb-5">
  <!-- add student page navigation -->
  <div class="col-lg-4">
    <a href="hallticket" style="color: black !important; text-decoration-line: none;">
    <div class="card mb-5">
      <div class="card-header">
        <h2 class="h6 text-uppercase mb-0">Hall Ticket</h2>
      </div>
      <div class="card-body">
        <?php
          // $sql = mysqli_query($connect,"SELECT COUNT(1) as no_of_students FROM `student_master`");
          // while ($row = mysqli_fetch_array($sql)) {
          //   echo '<h1 align="center" class="h1 text-uppercase mb-0">'.$row['no_of_students'].'</h1>';
          // }
        ?>
      </div>
    </div>
    </a>
  </div>
  <!-- add student page navigation -->
  <!-- no of departments -->
  <div class="col-lg-3">
    <a href="viewStudents " style="color: black !important; text-decoration-line: none;">
    <div class="card mb-5">
      <div class="card-header">
        <h2 class="h6 text-uppercase mb-0">Time Table</h2>
      </div>
      <div class="card-body">
        <?php
          // $sql = mysqli_query($connect,"SELECT COUNT(1) as no_of_dept FROM `department`");
          // while ($row = mysqli_fetch_array($sql)) {
          //   echo '<h1 align="center" class="h1 text-uppercase mb-0">'.$row['no_of_dept'].'</h1>';
          // }
        ?>
      </div>
    </div>
    </a>
  </div>
  <!-- no of depaertmentss -->
  <!-- no of submitted internal mark sheets -->
  <div class="col-lg-5">
    <a href="manage_sheets " style="color: black !important; text-decoration-line: none;">
    <div class="card mb-5">
      <div class="card-header">
        <h2 class="h6 text-uppercase mb-0">External Mark</h2>
      </div>
      <div class="card-body">
        <?php
          // $countSubmittedSheets=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM  `internalsheets` WHERE isSubmittedToController='1'"));
          //   echo '<h1 align="center" class="h1 text-uppercase mb-0">'.$countSubmittedSheets.'</h1>';
        ?>
      </div>
    </div>
    </a>
  </div>
  <!-- no of submitted internal mark sheets -->
</div>

<?php require_once 'include/footer.php'; ?>
