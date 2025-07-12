<?php
// error_reporting(0);
require_once 'include/header1.php';
require_once 'php/db.php';
$register_number=$_SESSION['admin'];

$get_student_data = mysqli_query($connect,"SELECT * FROM student_master where register_no='$register_number'");
$student_data=mysqli_fetch_array($get_student_data);
$get_exam_year=mysqli_query($connect,"SELECT * FROM `app_form` WHERE id=2");
$exam_year=mysqli_fetch_array($get_exam_year);
$get_issued_date=mysqli_query($connect,"SELECT * FROM `app_form` WHERE id=5");
$issued_date=mysqli_fetch_array($get_issued_date);
if($student_data['ap_flag']==1 )
  header( "Location: pop_up.php" );
if($student_data['hallticket_stat']==3 )
  echo '<script>window.location.replace("arrear_ticket.php");</script>';
 if($student_data['hallticket_stat']!=1 )
  echo '<script>window.location.replace("invalid.php");</script>';

$student_semester='';
$class_year=get_class_year($exam_year['appear_month'],$student_data['academic_year']);
$get_arrear_papers = mysqli_query($connect,"select subject_code, subject_name,type from `mark_details` where register_no='".$register_number."' and `result`='RA'");

// if($student_data['hallticket_stat'] == 2){
//   echo "<script>alert('You are blocked by the controller !! Please contact the controller...')</script>";
// }

function get_class_year($exam_year,$academic_year){
  global $student_semester;
    $semester=0;
    $str = $exam_year;
    $str_array = explode("-", $str);
    // print_r($str_array);
    $app_year=(int)$str_array[1];
    $stryr_array = explode("-", $academic_year);
    // print_r($stryr_array);
    $start_year=(int)$stryr_array[0];
  
    $year=$app_year-$start_year;
    //$year=8;
    if($year==2 and( $str_array[0]=="April" or $str_array[0]=="May")){
    $semester=4;
    $year='II';
    }
    elseif($year==1 and ($str_array[0]=="November" or $str_array[0]=="October")){
    $year='II';
    $semester=3;
    }
    elseif($year==1 and ($str_array[0]=="April" or $str_array[0]=="May")){
    $semester=2;
    $year='I';
    }
    elseif($year==0 and ($str_array[0]=="November" or $str_array[0]=="October")){
    $semester=1;
    $year='I';
    }
    elseif($year==3 and ($str_array[0]=="April" or $str_array[0]=="May")){
    $semester=6;
    $year='III';
    }
    elseif($year==2 and ($str_array[0]=="November" or $str_array[0]=="October")){
    $semester=5;
    $year='III';
    }
    
    
    $student_semester=$semester;
    return $year;
}

if ($student_semester == 0) {
  $student_semester = 1;
}

$get_current_sem_papers=mysqli_query($connect,"select sem".$student_semester." from `student_master` where `register_no`= '".$register_number."'");
?>
<link rel="stylesheet" href="hallticket.scss">
<div class="row">
  <div class="col-lg-12 mb-10">
    <div class="card">
      <div class="card-header" align="center">
            <!-- <h6 class="text-uppercase mb-0">Hall Ticket</h6> -->
            <div class="row">
              <div class="col-md-10 mb-10">
                <center>
                  <h6 class="text-uppercase mb-0" style="margin-top: 1em;">Hall Ticket</h6>
                </center>
              </div>
              <div oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" class="col-md-12 mb-2" align="right">
                <!-- <img src="img/printer.svg" height="30px" width="50px" align="right" onclick="print_hallticket();" style="cursor: pointer; margin-top: 5px;"> -->Download Hallticket 
                <img src="img/down.gif" height="72px" width="250px" align="right" onclick="get_pdf()" style="cursor: pointer; margin-top: 5px;">
                
              </div>

            </div>
      </div>
      <div class="card-body" oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" id="hallticket_container">
        

<!-- Hall Ticket Form Container Starts -->
  <div class="container" id="print_claim_table">
    
    <div class="logo" id="box">
      <!-- <center> -->
      <img src="img/clg.png" alt="clg logo" width="100" height="100">
      <!-- </center> -->
    </div>

    <div class="collegeName" id="box">
      <center> 
      AYYA NADAR JANAKI AMMAL COLLEGE,SIVAKASI.
      </center>
    </div>

    <div class="collegeDescription" id="box">
      <center>
      (An Autonomous Institution Affiliated to the Madurai Kamaraj University, Madurai)
      </center>
    </div>

    <div class="exam-header" id="box">
      <center>
      TERMINAL EXAMINATIONS, <span style="color:black"><?php echo $exam_year['appear_month']; ?></span>
      </center>
    </div>
    <div class="space">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
    <!-- <div class="degree_2" id="box">
     EXAMINATIONS,
     </div> -->

    <!-- <div class="degree_3" id="box">
      &nbsp&nbsp<?php echo $exam_year['appear_month']; ?>
    </div> -->

    <div class="photo" id="box">
      <center>
         <img src="img/user.png" style= "height:100px;width:100px">
        
      </center>
    </div>

    <div class="title" id="box">
      <center>
        <strong>HALL TICKET</strong>
      </center>
    </div>


    <div class="name" id="box">NAME :</div>

    <div class="studentName" id="box">
      <?php echo $student_data['name']; ?>
    </div>


    <!-- <div class="class" id="box"></div> -->

    <div class="studentYear" id="box" align="right">
    CLASS: <?php echo $class_year.' '.$student_data['class'].' '.$student_data['course']; ?>
    </div>


    <div class="register_container" align="center" id="box_2"></div>
    <div class="registerNo" id="box"> 
    <center>REGISTER NO : <?php echo $register_number; ?></center>
    </div>
    <div class="studentRegisterNo" id="box"></div>

    <div class="container_7" id="box"><center>&nbsp</center></div>
    

    <div class="container_1section_1 grs-21 gre-22" id="box_1" style="border-right:1px solid black"><strong>Papers Appearing</strong></div>

    <div class="first_row_border grs-21 gre-22"><strong></strong></div>
    <div class="second_row_border grs-22 gre-23"><strong></strong></div>
    <?php  
      
      if(mysqli_num_rows($get_current_sem_papers)>0):
        $res=mysqli_fetch_array($get_current_sem_papers);
        $papers_list=$res['sem'.$student_semester];
        $papers_list=explode(',', $papers_list);
        $j=0;
        $paper_list=array();
        while ($j<sizeof($papers_list)):
          $temp_data=explode('-', $papers_list[$j]);
          $paper_list[$j]=$temp_data[0];
          $j++;
        endwhile;
        $i=2;
        $j=0;
        while($j<sizeof($paper_list)):
    ?>
    <div class="grs-21 gre-22 container_1section_<?php echo $i; ?>" id="box_1"> <center>  <strong><?php echo $paper_list[$j] ?></strong> </center> </div>
    <?php
      $i++;
      $j++;
      endwhile;
    endif;
    ?>

     <div class="grs-22 gre-23 container_4section_1" id="box_1" style="border-right:1px solid black"><strong>Arrear Papers</strong></div>
    <?php 
       $get_papers=mysqli_query($connect,"select papers from Arrear_ticket where reg_no ='".$register_number."'");
        if(mysqli_num_rows($get_papers)>0):
        $res=mysqli_fetch_array($get_papers);
        $papers_list=$res['papers'];
        $paper_list=explode(',', $papers_list);
       $i=2;
        $j=0;
        while($j<sizeof($paper_list)):
  echo'
    <div class="grs-22 gre-23 container_4section_'.$i.'" id="box_1"> <center>  <strong>'.$paper_list[$j].'</strong> </center> </div>';
    
      $i++;
      $j++;
      endwhile;
    endif;
    ?>

    <div class="container_11section_1 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_2 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_3 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_4 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_5 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_6 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_7 grs-21 gre-23 " id="box_1"></div>
  
    <div class="container_11section_9 grs-21 gre-23 " id="box_1"></div>
    <div class="container_11section_10 grs-21 gre-23 " id="box_1"></div>
  
    <div class="container_12section_1 grs-21 gre-23 " id="box_1"></div>
    <div class="container_12section_2 grs-21 gre-23 " id="box_1"></div>

    <!-- <div class="container_8section_1" id="box"><center>FN:Forenoon</center></div> -->
    <div class="container_8section_2" id="box"><center>
    &nbsp
    </center></div>
    <!-- <div class="container_8section_3" id="box"><center>AN:Afternoon</center></div> -->

    <!-- <div class="container_8section_4" id="box">&nbsp</div> -->

    <div class="container_9section_1" id="box">&nbsp&nbsp</div>
    <div class="container_9section_2" id="box">&nbsp&nbsp</div>
    <div class="container_9section_3" id="box">&nbsp&nbsp</div>
    <div class="container_9section_4" id="box"><center></center></div>
    <div class="container_9section_4_1" id="box"><center>SIGNATURE OF THE<br>CANDIDATE</center></div>
    <div class="container_9section_5" id="box"><center></center></div>
    <div class="container_9section_5_1" id="box"><center><?php echo $issued_date['appear_month']; ?> <br>DATE</center></div>
    <div class="container_9section_6" id="box"><center id="sine"><img oncontextmenu="return false;" id="sign" onkeydown="return false;" onmousedown="return false;" src="img/sign.png" alt="clg logo" width="205" height="75"></center></div>
    <div class="container_21section_17" id="box"><center id="sine"><img oncontextmenu="return false;" id="sign" onkeydown="return false;" onmousedown="return false;" src="img/sign.png" alt="clg logo" width="205" height="75"></center></div>
    <div class="container_9section_6_1" id="box"><center>CONTROLLER OF EXAMINATIONS<br>(UG COURSES)</center></div>
    <div class="container_10section_1 note" id="box" >
      <strong><br>NOTE:</strong>
      This Hall Ticket must be produced at the time of writing the examination.
  </div>
    <div class="container_10section_2 note" id="box"><center>Any form of malpractice in the Examination Hall will be severely dealt with. The punishment normally varies from</center></div>
    <div class="container_10section_3 note" id="box">cancellation of all papers for which the candidate is appearing in the current semester to the expulsion from the college.</div>
    <div class="container_10section_4" id="box"></div>
    <div class="container_10section_5" id="box"><strong><br>PRINCIPAL</strong></div>

  </div>



  <!-- Hall Ticket Form Container Ends -->
























    </div>
    

    <?php
    if(isset($_POST['semester']))
    {
      
      $sql = mysqli_query($connect,"SELECT * FROM `student_master` WHERE register_no= '".$_SESSION['admin']."'");
      $row = mysqli_fetch_array($sql);
      $path="../PG/php/output/hallticket/".$row['dept_code']."/".$row['academic_year']."/".$_POST['semester']."/".$_SESSION['admin'].".pdf";
      if (mysqli_num_rows($sql) < 0)
        echo"<script type='text/javascript'> swal({
             title: 'Unable to fetch your hallticket may be due to wrong semester value or your hallticket is not yet ready',
             type: 'info',
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            }); </script>";

      else if($row['hallticket_stat']==0)
        echo"<script type='text/javascript'> swal({
             title: 'You are not permitted to receive your hallticket please contact controller of examination for more details...!',
             type: 'info',
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            }); </script>";
      elseif (!(file_exists($path))) {
                echo"<script type='text/javascript'> swal({
             title: 'Unable to fetch your hallticket may be due to wrong semester value or your hallticket is not yet ready',
             type: 'info',
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            }); </script>";

            }
    else
      echo"<script type='text/javascript'> swal({
        html:true,
             title: \"<a href='".$path."' download='hallticket ".$_SESSION['admin'].".pdf'>click me </a> to download\",
             type: 'info',
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            }); </script>";
    }
    ?>
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
<?php  

// if($student_data['ap_flag']==1 )
//   echo '<script>window.location.replace("pop_up.php");</script>'; 
if($student_data['hallticket_stat'] == 2){
  ?>
  <script> 
    $("#print_claim_table").empty();
    $.toaster('You are blocked by the controller . Please contact the controller !!' ,'warning');
  </script>
  <?php
}
?>
  <script type="text/javascript">
// add hall ticket details start
    function get_pdf(){
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
   alert("You can't Download the Hallticket from the Mobile ")
}else if(parseInt(screen.width)<1024 || parseInt(screen.height<768))
{
    alert("Your screen resolution is low and we unable to start the download process");
}
else{
    var code='';
      var formData = new FormData();
  formData.append("op","get_pdf");
  $.ajax({
      url : 'php/hallticket3.php',
      type : 'POST',
      processData: false,
      contentType: false,
      async : false,
      data :formData,
      success:function(result) {
          obj = JSON.parse(result);
          //var code = '';
          if (obj.err==0) {
              code=obj.code;
          }
         // $('#sign').empty();
         // $('#sign').html(code);
      }
  })
        var container=code;
        var options = {
          filename:     'HallTicket.pdf',
          image:{ type: 'jpeg', quality: 0.98 },
          jsPDF:{ unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(options).from(container).save();
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

function print_hallticket(){
  var container=document.getElementById("hallticket_container").outerHTML;
  var win=window.open('');
  win.document.write("<link rel='stylesheet' href='hallticket.scss'>");
  win.document.write("<style> .header{ display:none } .footer{ display:none} </style>");
  win.document.write(container);
  win.print();
  win.close();
  }
  get_sign();
function get_sign(){
  // document.getElementById('printer').style.display = "block";
  var formData = new FormData();
  formData.append("op","sign");
  $.ajax({
      url : 'php/sign.php',
      type : 'POST',
      processData: false,
      contentType: false,
      async : false,
      data :formData,
      success:function(result) {
          obj = JSON.parse(result);
          var code = '';
          if (obj.err==0) {
              code=obj.result;
          }
          $('#sign').empty();
          $('#sign').html(code);
      }
  })
  
code='<img oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" src="img/sign.png" width="205" height="75">';
          $('#sine').empty();
          $('#sine').html(code);

}

  </script>
<script>
            window.onload = function() {
                var labels = document.getElementsByTagName('label');
                for (var i = 0; i < labels.length; i++) {
                    disableSelection(labels[i]);
                }
            };
            function disableSelection(element) {
                if (typeof element.onselectstart != 'undefined') {
                    element.onselectstart = function() { return false; };
                } else if (typeof element.style.MozUserSelect != 'undefined') {
                    element.style.MozUserSelect = 'none';
                } else {
                    element.onmousedown = function() { return false; };
                }
                }
                
                </script>


