<?php
// error_reporting(0);
session_start();
//require_once 'include/header1.php';
require_once 'db.php';
$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null","code"=>'');
$register_number=$_SESSION['admin'];

$get_student_data = mysqli_query($connect,"SELECT * FROM student_master where register_no='$register_number'");
$student_data=mysqli_fetch_array($get_student_data);
$get_exam_year=mysqli_query($connect,"SELECT * FROM `app_form` WHERE id=6");
$exam_year=mysqli_fetch_array($get_exam_year);
$get_issued_date=mysqli_query($connect,"SELECT * FROM `app_form` WHERE id=7");
$issued_date=mysqli_fetch_array($get_issued_date);
// if($student_data['ap_flag']==1 )
//   header( "Location: pop_up.php" );
 if($student_data['hallticket_stat']!=3 )
  echo '<script>window.location.replace("invalid.php");</script>';

$student_semester='';
$class_year=get_class_year($exam_year['appear_month'],$student_data['academic_year']);
// $get_arrear_papers = mysqli_query($connect,"select subject_code, subject_name,type from `mark_details` where register_no='".$register_number."' and `result`='RA'");

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

$get_papers=mysqli_query($connect,"select papers from Arrear_ticket where reg_no ='".$register_number."'");
//echo'well';
if($_POST['op']='get_pdf'){
    $sql =mysqli_fetch_array(mysqli_query($connect,"SELECT session FROM `student_master` WHERE register_no= '".$_SESSION['admin']."'"));
  if($sql['session']!=sha1($_SESSION['id']))
        {
            $res['err']=5;
    $res['result']='Invalid operation';
    echo json_encode($res);
        }else{
      $code='<link rel="stylesheet" href="hallticket.scss"> <div class="card-body" oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" id="hallticket_container">
  <div class="container" id="print_claim_table"><link rel="stylesheet" href="hallticket.scss">
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
      REPEAT EXAMINATIONS, <span style="color:black">'. $exam_year['appear_month'].'</span>
      </center>
    </div>
    <div class="space">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
    <!-- <div class="degree_2" id="box">
     EXAMINATIONS,
     </div> -->

    <!-- <div class="degree_3" id="box">
      &nbsp&nbsp'.$exam_year['appear_month'].'
    </div> -->

    <div class="photo" id="box">
      <center>
        <img src="../ug/uploads/photos/students//'.$student_data['dept_code'].'/'.$student_data['academic_year'].'/'.$_SESSION['admin'].'.jpg" style= "height:100px;width:100px"> 
        
      </center>
    </div>

    <div class="title" id="box">
      <center>
        <strong>HALL TICKET</strong>
      </center>
    </div>


    <div class="name" id="box">NAME :</div>

    <div class="studentName" id="box">
      '.$student_data['name'].'
    </div>


    <!-- <div class="class" id="box"></div> -->

    <div class="studentYear" id="box" align="right">
    CLASS: '. $class_year.' '.$student_data['class'].' '.$student_data['course'].'</div>


    <div class="register_container" align="center" id="box_2"></div>
    <div class="registerNo" id="box"> 
    <center>REGISTER NO : '. $register_number.'</center>
    </div>
    <div class="studentRegisterNo" id="box"></div>

    <div class="container_7" id="box"><center>&nbsp</center></div>
    

    <div class="container_1section_1 grs-21 gre-22" id="box_1" style="border-right:1px solid black"><strong>Papers Appearing</strong></div>
<div class="grs-22 gre-23 container_4section_1" id="box_1" style="border-right:1px solid black"><strong>Arrear Papers</strong></div>
    <div class="first_row_border grs-21 gre-22"><strong></strong></div>
    <div class="second_row_border grs-22 gre-23"><strong></strong></div>';
    
      
      if(mysqli_num_rows($get_papers)>0):
        $res=mysqli_fetch_array($get_papers);
        $papers_list=$res['papers'];
        $paper_list=explode(',', $papers_list);
       $i=2;
        $j=0;
        while($j<sizeof($paper_list)):
    $code=$code.'
    <div class="grs-22 gre-23 container_4section_'.$i.'" id="box_1"> <center>  <strong>'.$paper_list[$j].'</strong> </center> </div>';
    
      $i++;
      $j++;
      endwhile;
    endif;
    

    
    $code=$code.'<div class="container_11section_1 grs-21 gre-23 " id="box_1"></div>
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
    <div class="container_9section_5_1" id="box"><center>'. $issued_date['appear_month'].'<br>DATE</center></div>
    <div class="container_9section_6" id="box"><center id="sine"><img oncontextmenu="return false;" id="sign" onkeydown="return false;" onmousedown="return false;" src="../ug/uploads/photos/ControllerSign/sign.png" alt="clg logo" width="205" height="75"></center></div>
    <div class="container_21section_17" id="box"><center id="sine"><img oncontextmenu="return false;" id="sign" onkeydown="return false;" onmousedown="return false;" src="../ug/uploads/photos/ControllerSign/sign.png" alt="clg logo" width="205" height="75"></center></div>
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


</div>';

//echo $code;
$res['err'] = 0;
$res['result'] = "Downloading..!";
$res['code']=$code;
				echo json_encode($res);
}
}
else
{
    $res['err']=5;
    $res['result']='Invalid operation';
    echo json_encode($res);
}
?>















    
   

