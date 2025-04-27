<?php require_once 'include/header.php';
require_once 'php/db.php'; 
$register_number=$_SESSION['admin'];
?>
<div class="row">
  <div class="col-lg-12 mb-10">
    <div class="card">
      <div class="card-header" align="center">
            <h6 class="text-uppercase mb-0">Hall Ticket</h6>
      </div>
      <div class="card-body">
<!--       	 <form action="hallticket " method="POST">  -->
<center>
<?php
 $get_student_data = mysqli_query($connect,"SELECT * FROM student_master where register_no='$register_number'");
$student_data=mysqli_fetch_array($get_student_data);
if($student_data['remark']!='' and $student_data['hallticket_stat']==2)
echo "Your Hallticket is blocked for ".$student_data['remark'].' issues,..!';
else if($student_data['hallticket_stat']==2)
echo "Your Hallticket is blocked Please contact the UG Controller for more details,..!";
else if($student_data['hallticket_stat']==0)
echo"Your Hallticket is not yet ready..! Please contact the UG Controller for more details,..!";
// else if($student_data['hallticket_stat']==1)
// echo"<script>window.location.replace('hallticket ');</script>";
else
echo"Invalid Access,..!";
//echo "No Reasons are"
?></center>
      <div class="line"></div>
      
      <!-- </form> -->


    </div>
    

    
    <div class="footer"></div>
    </div>
  </div>
</div>

<?php require_once 'include/footer.php'; ?>
