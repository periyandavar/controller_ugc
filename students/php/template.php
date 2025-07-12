<?php
class template
{

function generate_marksheet($register_no,$name,$class,$course,$Photo,$class_year,$subject_1,$subject_2,$subject_3,$subject_4,$subject_5,$subject_6,$subject_7,$subject_8,$subject_9,$exam_year,$month,$issue_date,$date_1,$date_2,$date_3,$date_4,$date_5,$date_6,$date_7,$date_8,$date_9,$session_1,$session_2,$session_3,$session_4,$session_5,$session_6,$session_7,$session_8,$session_9,$arrear_subject_1,$arrear_subject_2,$arrear_subject_3,$arrear_subject_4,$arrear_subject_5,$arrear_subject_6,$arrear_subject_7,$arrear_date_1,$arrear_date_2,$arrear_date_3,$arrear_date_4,$arrear_date_5,$arrear_date_6,$arrear_date_7,$arrear_session_1,$arrear_session_2,$arrear_session_3,$arrear_session_4,$arrear_session_5,$arrear_session_6,$arrear_session_7,$logo,$path)

{

$html= <<<EOT
<body>
<div class="container">
  <div class="logo" id="box"><center>$logo</center></div>
  <div class="collegeName" id="box"><center>AYYA NADAR JANAKI AMMAL COLLEGE,SIVAKASI.</center></div>
  <div class="collegeName_1" id="box"><center>(An Autonomous Institution Affiliated to the Madurai Kamaraj University, Madurai)</center></div>
  <div class="degree_1" id="box"><center>TERMINAL</center></div>
  <div class="degree_2" id="box"> EXAMINATIONS,</div>
  <div class="degree_3" id="box">$month&nbsp&nbsp$exam_year</div>
  <div class="photo" id="box"><center><img src="$register_no.jpg" style= "height:100px;width:100px"></center></div>
  <div class="title" id="box"><center><strong>HALL TICKET</strong></center></div>
  <div class="name" id="box">NAME :</div>
  <div class="studentName" id="box">$name</div>
  <div class="empty" id="box"></div>
  <div class="class" id="box">CLASS:</div>
  <div class="studentYear" id="box">$class_year</div>
  <div class="studentCourse" id="box">$class</div>
  <div class="studentClass" id="box">$course</div>
  <div class="register_container" id="box_2"></div>
  <div class="registerNo" id="box"><center>REGISTER No :</center></div>
  <div class="studentRegisterNo" id="box"><center>$register_no</center></div>
  <div class="container_7" id="box"><center>*Appearing for</center></div>
  <div class="container_1section_1" id="box_1"><strong>Regular</strong></div>
  <div class="container_1section_2" id="box_1"><strong>$subject_1</strong></div>
  <div class="container_1section_3" id="box_1"><strong>$subject_2</strong></div>
  <div class="container_1section_4" id="box_1"><strong>$subject_3</strong></div>
  <div class="container_1section_5" id="box_1"><strong>$subject_4</strong></div>
  <div class="container_1section_6" id="box_1"><strong>$subject_5</strong></div>
  <div class="container_1section_7" id="box_1"><strong>$subject_6</strong></div>
  <div class="container_1section_8" id="box_1"><strong>$subject_7</strong></div>
  <div class="container_1section_9" id="box_1"><strong>$subject_8</strong></div>
  <div class="container_1section_10" id="box_1"><strong>$subject_9</strong></div>
  <div class="container_1section_11" id="box_1"><strong></strong></div>

  <div class="container_2section_1" ><strong>Exam</strong></div>
  <div class="container_2section_2" ><strong>$date_1</strong></div>
  <div class="container_2section_3" ><strong>$date_2</strong></div>
  <div class="container_2section_4" ><strong>$date_3</strong></div>
  <div class="container_2section_5" ><strong>$date_4</strong></div>
  <div class="container_2section_6" ><strong>$date_5</strong></div>
  <div class="container_2section_7" ><strong>$date_6</strong></div>
  <div class="container_2section_8" ><strong>$date_7</strong></div>
  <div class="container_2section_9" ><strong>$date_8</strong></div>
  <div class="container_2section_10" ><strong>$date_9</strong></div>
  <div class="container_2section_11" ><strong></strong></div>

  <div class="container_3section_1"><strong>Date & Time</strong></div>
  <div class="container_3section_2"><strong>$session_1</strong></div>
  <div class="container_3section_3"><strong>$session_2</strong></div>
  <div class="container_3section_4"><strong>$session_3</strong></div>
  <div class="container_3section_5"><strong>$session_4</strong></div>
  <div class="container_3section_6"><strong>$session_5</strong></div>
  <div class="container_3section_7"><strong>$session_6</strong></div>
  <div class="container_3section_8"><strong>$session_7</strong></div>
  <div class="container_3section_9"><strong>$session_8</strong></div>
  <div class="container_3section_10"><strong>$session_9</strong></div>
  <div class="container_3section_11"><strong></strong></div>

  <div class="container_4section_1" id="box_1"><strong>Arrear</strong></div>
  <div class="container_4section_2" id="box_1"><strong>$arrear_subject_1</strong></div>
  <div class="container_4section_3" id="box_1"><strong>$arrear_subject_2</strong></div>
  <div class="container_4section_4" id="box_1"><strong>$arrear_subject_3</strong></div>
  <div class="container_4section_5" id="box_1"><strong>$arrear_subject_4</strong></div>
  <div class="container_4section_6" id="box_1"><strong>$arrear_subject_5</strong></div>
  <div class="container_4section_7" id="box_1"><strong>$arrear_subject_6</strong></div>
  <div class="container_4section_8" id="box_1"><strong>$arrear_subject_7</strong></div>
  <div class="container_4section_9" id="box_1"><strong></strong></div>
  <div class="container_4section_10" id="box_1"><strong></strong></div>
  <div class="container_4section_11" id="box_1"><strong></strong></div>

  <div class="container_5section_1" ><strong>Exam</strong></div>
  <div class="container_5section_2" ><strong>$arrear_date_1</strong></div>
  <div class="container_5section_3" ><strong>$arrear_date_2</strong></div>
  <div class="container_5section_4" ><strong>$arrear_date_3</strong></div>
  <div class="container_5section_5" ><strong>$arrear_date_4</strong></div>
  <div class="container_5section_6" ><strong>$arrear_date_5</strong></div>
  <div class="container_5section_7" ><strong>$arrear_date_6</strong></div>
  <div class="container_5section_8" ><strong>$arrear_date_7</strong></div>
  <div class="container_5section_9" ><strong></strong></div>
  <div class="container_5section_10" ><strong></strong></div>
  <div class="container_5section_11" ><strong></strong></div>

  <div class="container_6section_1"><strong>Date & Time</strong></div>
  <div class="container_6section_2"><strong>$arrear_session_1</strong></div>
  <div class="container_6section_3"><strong>$arrear_session_2</strong></div>
  <div class="container_6section_4"><strong>$arrear_session_3</strong></div>
  <div class="container_6section_5"><strong>$arrear_session_4</strong></div>
  <div class="container_6section_6"><strong>$arrear_session_5</strong></div>
  <div class="container_6section_7"><strong>$arrear_session_6</strong></div>
  <div class="container_6section_8"><strong>$arrear_session_7</strong></div>
  <div class="container_6section_9"><strong></strong></div>
  <div class="container_6section_10"><strong></strong></div>
  <div class="container_6section_11"><strong></strong></div>

  <div class="container_11section_1" id="box_1"></div>
  <div class="container_11section_2" id="box_1"></div>
  <div class="container_11section_3" id="box_1"></div>
  <div class="container_11section_4" id="box_1"></div>
  <div class="container_11section_5" id="box_1"></div>
  <div class="container_11section_6" id="box_1"></div>
  <div class="container_11section_7" id="box_1"></div>
  <div class="container_11section_8" id="box_1"></div>
  <div class="container_11section_9" id="box_1"></div>
  <div class="container_11section_10" id="box_1"></div>
  <div class="container_11section_11" id="box_1"></div>

  <div class="container_12section_1" id="box_1"></div>
  <div class="container_12section_2" id="box_1"></div>

  <div class="container_8section_1" id="box"><center>FN:Forenoon</center></div>
  <div class="container_8section_2" id="box"><center>This Hall Ticket must be produced at the time of appearing for the examination.</center></div>
  <div class="container_8section_3" id="box"><center>AN:Afternoon</center></div>
  <div class="container_8section_4" id="box">The results would be sent to</div>
  <div class="container_8section_6" id="box">your e-mail ID</div>
  <div class="container_8section_7_1" id="box">in</div>
  <div class="container_8section_7_2" id="box">the</div>
  <div class="container_8section_7_3" id="box">II</div>
  <div class="container_8section_7_4" id="box">week</div>
  <div class="container_8section_7_5" id="box">of</div>
  <div class="container_8section_7_6" id="box">June&nbsp&nbsp$exam_year</div>

  <div class="container_8section_5" id="box">*You are asked to verify this personalized time-table with the Department-wise time-table sent to your e-mail ID.</div>

  <div class="container_9section_1" id="box"></div>
  <div class="container_9section_2" id="box"><center>$issue_date</center></div>
  <div class="container_9section_3" id="box"><center><style="text-align:top"></center></div>
  <div class="container_9section_4" id="box"><center>SIGNATURE OF THE </center></div>
  <div class="container_9section_4_1" id="box"><center>CANDIDATE</center></div>
  <div class="container_9section_5" id="box"><center></center></div>
  <div class="container_9section_5_1" id="box"><center>DATE</center></div>
  <div class="container_9section_6" id="box"><center>CONTROLLER OF EXAMINATIONS</center></div>
  <div class="container_9section_6_1" id="box"><center>(P.G COURSES)</center></div>
  <div class="container_10section_1" id="box"><strong>NOTE:</strong></div>
  <div class="container_10section_2" id="box"><center>Any form of malpractice in the Examination Hall will be severely dealt with. The punishment normally varies from</center></div>
  <div class="container_10section_3" id="box">cancellation of all papers for which the candidate is appearing in the current semester to the expulsion from the college</div>
  <div class="container_10section_4" id="box"></div>
  <div class="container_10section_5" id="box"><strong>PRINCIPAL</strong></div>

  </div>
</body>

style
  include:scss hallticket.scss
EOT;
return $html;

}

function write_image($register_no,$photo,$path){

$file_name=$path.$register_no.'.jpg';
$file = fopen("$file_name","w");

fwrite($file,$photo);
fclose($file);
}

function generate_pdf($register_no,$html,$path){
$file_name=$path.$register_no.'.pug';
$file = fopen("$file_name","w");
fwrite($file,$html);
fclose($file);
}

}


?>
