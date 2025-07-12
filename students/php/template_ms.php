<?php
class template
{


function generate_marksheet($register_no,$name,$class,$course,$admitted_in,$Photo,$dob,$cgpa,$subject_code,$subject_name,$credits,$Max_Int,$Max_Ext,$Max_Tot,$internal,$external,$total,$grade_point,$grade,$result,$year,$date,$randomnum,$core_credits_secured,$core_credits,$elective_credits_secured,$elective_credits,$supportive_credits_secured,$supportive_credits,$total_credits_secured,$total_credits,$get_sem,$month,$sem_year,$overall_grade,$classification)
{

$html= <<<EOT
<body>
  <div class="container">
  <div class="logo" id="box"></div>
  <div class="heading" id="box"></div>
  <div class="degree" id="box"><center>$class</center></div>
  <div class="empty" id="box"></div>
  <div class="degree_1" id="box"><center>$sem_year&nbsp&nbsp$month</center></div>
  <div class="photo" id="box"><center><img src="$register_no.jpg" style= "height:100px;width:100px"></center></div>
  <div class="marksheet_no" id="box"><center>$randomnum</center></div>
  <div class="section2_container1" id="box"></div>
  <div class="section2_container2" id="box"><p>$name</p><p>$course</p></div>
  <div class="section2_container3" id="box"></div>
  <div class="section2_container4" id="box"><p>$register_no</p><p>$admitted_in</p></div>
  <div class="section3" id="box"></div>
  <div class="semester" id="box">$get_sem</div>
  <div class="subject_code" id="box">$subject_code</div>
  <div class="title_paper" id="box">$subject_name</div>
  <div class="credit" id="box">$credits</div>
  <div class="max_int_marks" id="box">$Max_Int</div>
  <div class="max_ext_marks" id="box">$Max_Ext</div>  
  <div class="max_tot_marks" id="box">$Max_Tot</div> 
  <div class="int_marks_secured" id="box">$internal</div>
  <div class="ext_marks_secured" id="box">$external</div>
  <div class="tot_marks_secured" id="box">$total</div>
  <div class="grade_point" id="box">$grade_point</div>
  <div class="grade" id="box">$grade</div>
  <div class="result" id="box">$result</div>
  <div class="month_year" id="box">$year</div>
  <div class="section4_container1" id="box"></div>

  <div class="section4_container2" id="box"></div>
  <div class="section4_container21" id="box"></div>
   <div class="section4_container9" id="box">$core_credits_secured</div>
  <div class="section4_container10" id="box">$elective_credits_secured</div>
  <div class="section4_container11" id="box">$supportive_credits_secured</div>
  <div class="section4_container12" id="box">$total_credits_secured</div>

  <div class="section4_container7" id="box"></div>
  <div class="section4_container22" id="box"></div>
  <div class="section4_container13" id="box">/</div>
  <div class="section4_container14" id="box">/</div>
  <div class="section4_container15" id="box">/</div>
  <div class="section4_container16" id="box">/</div>

  <div class="section4_container8" id="box"></div>
  <div class="section4_container23" id="box"></div>
  <div class="section4_container17" id="box">$core_credits</div>
  <div class="section4_container18" id="box">$elective_credits</div>
  <div class="section4_container19" id="box">$supportive_credits</div>
  <div class="section4_container20" id="box">$total_credits</div>

  <div class="section4_container3" id="box"></div>
  <div class="section4_container4" id="box"></div>
  <div class="section4_container24" id="box">$overall_grade</div>
  <div class="section4_container25" id="box">$cgpa</div>
  <div class="section4_container26" id="box">$classification</div>
  <div class="section4_container27" id="box"></div>
  <div class="section4_container5" id="box">$dob</div>
  <div class="section4_container6" id="box">
  </div>
  <div class="section5_container1" id="box"></div>
  <div class="section5_container2" id="box"></div>
  <div class="section5_container3" id="box">
      <center>$date</center>
  </div>
  <div class="section5_container4" id="box"></div>
  <div class="section5_container5" id="box">
     <center> Dr. C. Ashok </center>
  </div>
  <div class="section5_container6" id="box">
     <center> Dr. P. Sivasamy </center>
  </div>
  <div class="section5_container7" id="box"></div>
  </div>
</body>

style
  include:scss marksheet.scss
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







