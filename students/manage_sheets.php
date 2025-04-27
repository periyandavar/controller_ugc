<?php require_once 'include/header.php';
require_once 'php/db.php'; 
$dt=date('m');
$sql = mysqli_query($connect,"SELECT ap_flag FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
if($row['ap_flag']==1 )
   echo '<script>window.location.replace("pop_up ");</script>'; 

$sql = mysqli_query($connect,"SELECT academic_year,dept_code FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
$yr=$row['academic_year'];
$sqlf = mysqli_query($connect,"SELECT * FROM app_form where id='4'");
$rowf = mysqli_fetch_array($sqlf);
$yrf=$rowf['appear_month'];
$str_array = explode(",", $yrf);
// print_r($str_array);

// $syear=(int)$str_array[1];
// $eyear=(int)(date('Y'));
// $dif=$syear-$eyear;
$sem=0;

 if($dt==12|| $dt>=1 && $dt<6){
  if($yr==$str_array[0])
 $sem=5;
else if($yr==$str_array[1])
  $sem=3;
else if($yr==$str_array[2])
  $sem=1;
}
else if($dt>=6&&$dt<=11){
  if($yr==$str_array[0])
 $sem=6;
else if($yr==$str_array[1])
  $sem=4;
else if($yr==$str_array[2])
  $sem=2;
}

// if($dt>=6&& $dt<=11)
// {
//   if($dif==2)
//     $sem=2;
//   else if($dif==1)
//     $sem=4;
//   else if($dif==0)
//     $sem=6;
//    else if($dif==0)
//     $sem=7;
// }
// else if($dt==12||$dt>=1 && $dt<6)
// {
//  if($dif==3)
//    $sem=1;
//   else if($dif==2)
//     $sem=5;
//   else if($dif==1)
//     $sem=5;
// }
//$sem=$sem-1;
if($sem!=0){
$sql1 = mysqli_query($connect,"SELECT sem".$sem." FROM student_master where register_no='".$_SESSION['admin']."'");
//echo"SELECT sem".$sem." FROM papers where reg_no='".$_SESSION['admin']."'";
$row1 = mysqli_fetch_array($sql1);
//echo$sem." ";
$Subjects = explode(",", ($row1['sem'.$sem]));
}

?>

<div class="row">
  <div class="col-lg-12 mb-10">
    <div class="card">
      <div class="card-header" align="center">
            <h6 class="text-uppercase mb-0">Exam Results</h6>
      </div>
      <div class="card-body">
<!--         <form action="hallticket " method="POST">  -->
       <pre>Semester : <?Php echo $sem;?>                                                                                                       Register No. : <?php echo$_SESSION['admin']; ?></pre>
      <input type="hidden" class="form-control" name="semester" id="reg_no" value="<?php echo $_SESSION['admin'] ?>">
      <div class="card-body table-responsive" id="print_claim_table">
        <table class="table table-striped table-hover card-text" id="print_table" cellspacing="0" cellpadding="1">
          <thead>
            <tr>
          .
              <th>Subject Code </th>
              <th>Subject Name</th>
              <th>Internal</th>
              <th>External</th>
              <th>Total</th>
              
              <th>Result </th>
              <!--               <th>Status</th> -->
              
            </tr>
          </thead>
          <tbody>
            <?php
            
            if($sem!=0){
            for($i=0;$i<sizeof($Subjects);$i++)
            {
                $Subjs=explode('-',$Subjects[$i]);
                $sq=mysqli_query($connect,"SELECT Result from exam where PaperCode='".$Subjs[0]."' and type='r'");
                $flags_val=mysqli_fetch_array($sq);
                $fv=$flags_val['Result'];
              $sql = mysqli_query($connect,"SELECT subject_name  FROM subject_master where subject_code ='".$Subjs[0]."'  ");
              //echo "SELECT subject_name  FROM subject_master where subject_code ='".$Subjs[0]."'  ";
$sub = mysqli_fetch_array($sql);
//if(mysqli_num_rows($sql)!=0)
{
echo"<tr><th>".$Subjs[0]."</th><th>".$sub['subject_name'].'</th>';
// $sql2 = mysqli_query($connect,"SELECT rs".$syear."  FROM department where coursecode ='".$row['dept_code']."'");
// $sub2 = mysqli_fetch_array($sql2);
if($fv==0){
  echo"<th>-</th><th>-</th><th>-</th><th>-</th></tr>";
}
else{
  $sql2 = mysqli_query($connect,"SELECT *  FROM mark_details where register_no ='".$_SESSION['admin']."' and sem='".$sem."' and subject_code='".$Subjs[0]."'");
$marks = mysqli_fetch_array($sql2);
if($marks['internal']==0)
  $interanal_mark="  ";
else
  $interanal_mark=$marks['internal'];
echo"<th>".$interanal_mark."</th><th>".$marks['ext']."</th><th>".$marks['tot']."</th><th>".$marks['result']."</th></tr>";
}
}
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
  <script type="text/javascript">
// add hall ticket details start
 

    function generate_hall_ticket(obj){
        if ($('#semester').val() == 'Select Semester') {
            $.toaster('Required Fields...', 'Semester', 'warning');
        }else{
          var formData = new FormData();
          formData.append("op","get_record");
          formData.append("reg_no","<?php echo $_SESSION['admin'] ?>");
          formData.append("semester",$('#semester').val());
          swal({
             title: "Fetching your " +" Hall Ticket",
             type: "info",
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            },
             function(){
              $.ajax({
                  url : 'php/ticket.php',
                  type : 'POST',
                  processData: false,
                  contentType: false,
                  async : false,
                  data :formData,
                  success:function(result)
                  {
                      obj = JSON.parse(result);
                      if(obj.err==0) {
                        setTimeout(function(){ swal({
                          html:true,
             title: "<a id='link' href='"+obj.path+"' hidden download='Personal Care "+"<?php echo$_SESSION['admin'] ?>"+".pdf'>click </a> Click OK to download",
             type: 'info',
             showCancelButton: true,

                        },function(){document.getElementById('link').click()});
                      });
                          $.toaster('', obj.result, 'success');
                          $('#semester').val('');
                          
                      }else{
                        setTimeout(function(){
                          swal(obj.result,"","error");
                        })
                          $.toaster('',obj.result,'error');
                      }
                  }
              });
           }
        );
      }
    }
// end
// start clear fun...
    function clear1(obj) {
      $('#semester').val('');
//      $('#reg_no').val('');
            $.toaster('Required Fields...', 'Register No is', 'warning');
    }
// end clear fun...
  </script>
