<?php require_once 'include/header.php';
require_once 'php/db.php'; 
$sql = mysqli_query($connect,"SELECT ap_flag FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
if($row['ap_flag']==1 )
   echo '<script>window.location.replace("pop_up ");</script>'; 
$dt=date('m');
$sql = mysqli_query($connect,"SELECT academic_year FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
$yr=$row['academic_year'];
$str_array = explode("-", $yr);
// print_r($str_array);
$syear=(int)$str_array[1];
$eyear=(int)(date('Y'));
$dif=$syear-$eyear;
$sem=0;
//$dt=11;
if($dt>=7&& $dt<=12)
{
  if($dif==3)
    $sem=1;
  else if($dif==2)
    $sem=3;
  else if($dif==1)
    $sem=5;
}
else if($dt>=1 && $dt<=6)
{
 if($dif==2)
   $sem=2;
  else if($dif==1)
    $sem=4;
  else if($dif==0)
    $sem=6;
}
if($sem==0)
   echo '<script>window.location.replace("invalid_access ");</script>'; 
// $sem=1;
$sql1 = mysqli_query($connect,"SELECT sem".$sem." FROM student_master where register_no='".$_SESSION['admin']."'");
$row1 = mysqli_fetch_array($sql1);
//echo$sem." ";

$Subjects = explode(",", ($row1['sem'.$sem]));


?>

<div class="row">
  <div class="col-lg-12 mb-10">
    <div class="card">
      <div class="card-header" align="center">
            <h6 class="text-uppercase mb-0">Regular Time Table</h6>
      </div>
      <div class="card-body">
<!--       	 <form action="hallticket " method="POST">  -->
       Semester : <?Php echo $sem;?>
      <input type="hidden" class="form-control" name="semester" id="reg_no" value="<?php echo $_SESSION['admin'] ?>">
      <div class="card-body table-responsive" id="print_claim_table">
        <table class="table table-striped table-hover card-text" id="print_table" cellspacing="0" cellpadding="1">
          <thead>
            <tr>
          .
              <th>Subject Code </th>
              <th>Subject Name </th>
              <th>Date</th>
              <th>Session </th>
              <!--<th>Test 3</th>-->
              <!--<th>Test Final </th>-->
              <!--<th>Quiz 1</th>-->
              <!--<th>Quiz 2</th>-->
              <!--<th>Quiz 3</th>-->
              <!--<th>Quiz Final </th>-->
              <!--<th>Assign. 1</th>-->
              <!--<th>Assign. 2</th>-->
              <!--<th>Assign. Final </th>-->
              <!--<th>Total </th>-->
<!--               <th>Status</th> -->
              
            </tr>
          </thead>
          <tbody>
            <?php
            for($i=0;$i<sizeof($Subjects);$i++)
            {
$Subjs = explode("-", ($Subjects[$i]));

              $sql = mysqli_query($connect,"SELECT PaperName,exam_date,session  FROM exam where Papercode ='".$Subjs[0]."' and Result='0'");
              
$sub = mysqli_fetch_array($sql);
if(mysqli_num_rows($sql)!=0){
echo"<tr><th>".$Subjs[0]."</th><th>".$sub['PaperName'].'</th>';
// $sql2 = mysqli_query($connect,"SELECT isStudentViewable,sheetid  FROM internalsheets where subjectCode ='".$Subjects[$i]."' and batch='".$row['academic_year']."'");
// $sub2 = mysqli_fetch_array($sql2);
// if($sub2['isStudentViewable']==0){
//   echo"<th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th></tr>";
// }
// else{
//   $sql2 = mysqli_query($connect,"SELECT *  FROM ".$sub2['sheetid']." where rollnumber ='".$_SESSION['admin']."'");
// $marks = mysqli_fetch_array($sql2);

echo"<th>".$sub['exam_date']."</th><th>".$sub['session']."</th></tr>";//.$marks['Internal_3']."</th><th>".$marks['FinalInternal']."</th><th>".$marks['Assignment_1']."</th><th>".$marks['Assignment_2']."</th><th>".$marks['FinalAssignment']."</th><th>".$marks['Quiz_1']."</th><th>".$marks['Quiz_2']."</th><th>".$marks['Quiz_3']."</th><th>".$marks['FinalQuiz']."</th><th>".$marks['Total']."</th></tr>";
//}
}
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="line"></div>
      <div class="row" align="right">
        <div class="col-lg-12 mb-12">
       <!--    <button type="reset" class="btn btn-secondary" name="clear" onclick="clear1(this);">Clear</button> -->
<!--           <button type="submit" class="btn btn-primary" name="add" id="add" onclick="verify_me(this);"> Verify</button>
 -->        </div>
      </div>
      <!-- </form> -->


    </div>
    

    
    <div class="footer"></div>
    </div>
  </div>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php require_once 'include/footer.php'; ?>


    