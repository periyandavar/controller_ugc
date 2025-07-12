<?php
// $connect = mysqli_connectect("localhost","root","","master_table");
require_once 'db.php';
class getStudentData{


public $register_no;
public $sem;
public $max_length;
public $min_length;

 function personal_detail(){
$disp=mysqli_query($GLOBALS['connect'], "SELECT register_no,name,class,course,admitted_in,Photo,dob,cgpa from student_master where register_no='$this->register_no'");
      while($row=mysqli_fetch_array($disp,MYSQL_ASSOC)){
      $p_d[]= $row['register_no'];
      $p_d[]= $row['name'];
      $p_d[]= $row['class'];
      $p_d[]= $row['course'];
      $p_d[]= $row['admitted_in'];
      $p_d[]= $row['Photo'];
      $p_d[]= $row['dob'];
      $p_d[]=$row['cgpa'];
      }
  return $p_d;


}

function rank(){
if($this->sem==4){
$disp=mysqli_query($GLOBALS['connect'], "SELECT overall_grade,classification from student_master where register_no='$this->register_no'");
      while($row=mysqli_fetch_array($disp,MYSQL_ASSOC)){
      $p_d[]= $row['overall_grade'];
      $p_d[]= $row['classification'];
      }
  return $p_d;
}

else{
      $p_d[]='--';
      $p_d[]='--';

  return $p_d;

}

}


function total_credits()
{
//$Subject_Credits="";
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$c_m = array("credits");
$tot_credits=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($tot_credits,$c['credits']);
}
$tot_credit=array_sum($tot_credits);
return $tot_credit;
}


function total_credits_secured()
{

$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='P'");
$c_m = array("credits");
$tot_credits_secured=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($tot_credits_secured,$c['credits']);
}
$tot_credit_secured=array_sum($tot_credits_secured);
return $tot_credit_secured;
}


function core_credits()
{
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND subject_code LIKE 'C%'");
$c_m = array("credits");
$core_credits=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($core_credits,$c['credits']);
}
$core_cred=array_sum($core_credits);
return $core_cred;
}


function elective_credits()
{
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND subject_code LIKE 'E%'");
$c_m = array("credits");
$elective_credits=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($elective_credits,$c['credits']);
}
$elective_credit= array_sum($elective_credits);
return $elective_credit;
}


function supportive_credits()
{
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND subject_code LIKE 'S%'");
$c_m = array("credits");
$supportive_credits=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($supportive_credits,$c['credits']);
}
$supportive_credit= array_sum($supportive_credits);
return $supportive_credit;
}


function core_credits_secured()
{
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='P' AND subject_code LIKE 'C%'");
$c_m = array("credits");
$core_credits_secured=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($core_credits_secured,$c['credits']);
}
$core_credit_secured=array_sum($core_credits_secured);
return $core_credit_secured;
}


function elective_credits_secured()
{

$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='P' AND subject_code LIKE 'E%'");
$c_m = array("credits");
$elective_credits_secured=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($elective_credits_secured,$c['credits']);
}
$elective_credit_secured=array_sum($elective_credits_secured);
return $elective_credit_secured;
}

function supportive_credits_secured()
{
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='P' AND subject_code LIKE 'S%'");
$c_m = array("credits");
$supp_credits_secured=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($supp_credits_secured,$c['credits']);
}
$supportive_credit_secured =array_sum($supp_credits_secured);
return $supportive_credit_secured;
}

function subject_code()
{
$SubjectCode="";
//$query="register_no='17PS02' AND sem=1";
$sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");

$s_c = array("subject_code");
$subject_code=array();
while ($sc=mysqli_fetch_array($sub_code,MYSQL_ASSOC))
{
array_push($subject_code,$sc['subject_code']);
}
$count= count($subject_code);
for($i=0;$i<$count;$i++){
$SubjectCode=$SubjectCode.$subject_code[$i]." ";
}
return $SubjectCode;
}


function subject_name()
{
$Subject_Name="";
//$query="register_no='17PS02' AND sem=1";
$sub_name=mysqli_query($GLOBALS['connect'],"SELECT subject_name FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$s_n = array("subject_name");
$subject_name=array();
while ($sn=mysqli_fetch_array($sub_name,MYSQL_ASSOC))
{
array_push($subject_name,$sn['subject_name']);
}
$count= count($subject_name);
for($i=0;$i<$count;$i++){
$Subject_Name=$Subject_Name.$subject_name[$i]."<br>";
}
return $Subject_Name;
}

function credits()
{

$Subject_Credits="";
//$query="register_no='17PS02' AND sem=1";
$credits=mysqli_query($GLOBALS['connect'],"SELECT credits FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$c_m = array("credits");
$sub_credits=array();
while ($c=mysqli_fetch_array($credits,MYSQL_ASSOC))
{
array_push($sub_credits,$c['credits']);
}
$count= count($sub_credits);
for($i=0;$i<$count;$i++){
$Subject_Credits=$Subject_Credits.$sub_credits[$i]." ";
}
return $Subject_Credits;
}



function internal()
{
$Internal_Mark="";
//$query="register_no='17PS02' AND sem=1";
$int=mysqli_query($GLOBALS['connect'],"SELECT internal FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$i_m = array("internal");
$int_mark=array();
while ($im=mysqli_fetch_array($int,MYSQL_ASSOC))
{
array_push($int_mark,$im['internal']);
}
$count= count($int_mark);
for($i=0;$i<$count;$i++){
$Internal_Mark=$Internal_Mark.$int_mark[$i]."<br>";
}
return $Internal_Mark;
}

function external()
{
$External_Mark="";
//$query="register_no='17PS02' AND sem=1";
$ext=mysqli_query($GLOBALS['connect'],"SELECT ext FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$e_m = array("ext");
$ext_mark=array();
while ($em=mysqli_fetch_array($ext,MYSQL_ASSOC))
{
array_push($ext_mark,$em['ext']);
}
$count= count($ext_mark);
for($i=0;$i<$count;$i++){
$External_Mark=$External_Mark.$ext_mark[$i]."<br>";
}
return $External_Mark;
}

function total()
{
$Total_Mark="";
//$query="register_no='17PS02' AND sem=1";
$tot=mysqli_query($GLOBALS['connect'],"SELECT tot FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$t_m = array("tot");
$tot_mark=array();
while ($tm=mysqli_fetch_array($tot,MYSQL_ASSOC))
{
array_push($tot_mark,$tm['tot']);
}
$count= count($tot_mark);
for($i=0;$i<$count;$i++){
$Total_Mark=$Total_Mark.$tot_mark[$i]."<br>";
}
return $Total_Mark;
}

function grade_point()
{
$Grade_Percentage="";
//$query="register_no='17PS02' AND sem=1";
$grade_point=mysqli_query($GLOBALS['connect'],"SELECT grade_point FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$g_p = array("grade_point");
$grade_per=array();
while ($gp=mysqli_fetch_array($grade_point,MYSQL_ASSOC))
{
array_push($grade_per,$gp['grade_point']);
}
$count= count($grade_per);
for($i=0;$i<$count;$i++){@
$Grade_Percentage=$Grade_Percentage.$grade_per[$i]." ";
}
return $Grade_Percentage;
}


function grade()
{
$Sub_Grade="";
//$query="register_no='17PS02' AND sem=1";
$grade=mysqli_query($GLOBALS['connect'],"SELECT grade FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$g = array("grade");
$grade_mark=array();
while ($gm=mysqli_fetch_array($grade,MYSQL_ASSOC))
{
array_push($grade_mark,$gm['grade']);
}
$count= count($grade_mark);
for($i=0;$i<$count;$i++){
$Sub_Grade=$Sub_Grade.$grade_mark[$i]."<br>";
}
return $Sub_Grade;
}

function result()
{

$Result="";
//$query="register_no='17PS02' AND sem=1";
$result=mysqli_query($GLOBALS['connect'],"SELECT result FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$r_m = array("result");
$res=array();
while ($r=mysqli_fetch_array($result,MYSQL_ASSOC))
{
array_push($res,$r['result']);
}
$count= count($res);
for($i=0;$i<$count;$i++){
$Result=$Result.$res[$i]."<br>";
}
return $Result;
}


function year()
{

$Year="";
//$query="register_no='17PS02' AND sem=1";
$year=mysqli_query($GLOBALS['connect'],"SELECT year FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem");
$y_m = array("year");
$year_pass=array();
while ($y=mysqli_fetch_array($year,MYSQL_ASSOC))
{
array_push($year_pass,$y['year']);
}
$count= count($year_pass);
for($i=0;$i<$count;$i++){
$Year=$Year.$year_pass[$i]." ";
}
return $Year;
}

function get_sem()
{

for($i=0;$i<=$this->sem;$i++)
{
$count_paper[$i]=mysqli_query($GLOBALS['connect'],"SELECT count(sem) FROM mark_details WHERE register_no='$this->register_no' AND sem=$i ");
while ($c_p=mysqli_fetch_array($count_paper[$i],MYSQL_ASSOC))
{
 $this->semester_papers[$i]=$c_p['count(sem)'];
}
}
$j=1;
$space_sem="";

while($j<=$this->sem){

$space_sem=$space_sem.$j.str_repeat("<br>",$this->semester_papers[$j]);

$j++;
}

return $space_sem;
}

function max_int()
{
$Max_Int="";
  $max_internal=mysqli_query($GLOBALS['connect'],"SELECT max_int FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
  $m_i= array("max_int");
  $int_max_mark=array();
  while($int=mysqli_fetch_array($max_internal,MYSQL_ASSOC))
  {
    array_push($int_max_mark,$int['max_int']);
  }
  $count=count($int_max_mark);
  for($i=0;$i<$count;$i++)
  {
    $Max_Int=$Max_Int.$int_max_mark[$i]."<br>";
  }
  return $Max_Int;
}


function max_ext()
{
$Max_Ext="";
  $max_external=mysqli_query($GLOBALS['connect'],"SELECT max_ext FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
  $m_e= array("max_ext");
  $ext_max_mark=array();
  while($ext=mysqli_fetch_array($max_external,MYSQL_ASSOC))
  {
    array_push($ext_max_mark,$ext['max_ext']);
  }
  $count=count($ext_max_mark);
  for($i=0;$i<$count;$i++)
  {
    $Max_Ext=$Max_Ext.$ext_max_mark[$i]."<br>";
  }
  return $Max_Ext;
}

function max_tot()
{
 $Max_Tot="";
  $max_tot=mysqli_query($GLOBALS['connect'],"SELECT max_tot FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
  $m_t= array("max_tot");
  $tot_mark=array();
  while($tot=mysqli_fetch_array($max_tot,MYSQL_ASSOC))
  {
    array_push($tot_mark,$tot['max_tot']);
  }
  $count=count($tot_mark);
  for($i=0;$i<$count;$i++)
  {
    $Max_Tot=$Max_Tot.$tot_mark[$i]."<br>";
  }
  return $Max_Tot;
}



function date()
{
  $date="";
    $date=date("d F Y");
      return $date;
}

function sem_year()
{
  $sem_year="";
    $sem_year=date("Y");
      return $sem_year;
}

function randomnum()
{



$myRange = range($this->min_length, $this->max_length);
shuffle($myRange);
return $myRange;



}
}


?>
