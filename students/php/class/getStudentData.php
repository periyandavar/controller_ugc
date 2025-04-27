
<?php
require_once "db.php";

class getStudentData{
public $register_no;
public $sem;
    function personal_detail(){
        $disp=mysqli_query($GLOBALS['connect'], "SELECT register_no,name,class,course,Photo,email_id from student_master where register_no='$this->register_no'");
        while($row=mysqli_fetch_array($disp)){
            $p_d[]= $row['register_no'];
            $p_d[]= $row['name'];
            $p_d[]= $row['class'];
            $p_d[]= $row['course'];
            $p_d[]= $row['Photo'];}
    return $p_d;}
    function subject_1(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
            $count= count($subject_code);
            $SubjectCode=$SubjectCode.$subject_code[0]." ";
    return $SubjectCode;}
    function subject_2(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
            $count= count($subject_code);
            $SubjectCode=$SubjectCode.$subject_code[1]." ";
    return $SubjectCode;}
    function subject_3(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[2]." ";
    return $SubjectCode;}
    function subject_4(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[3]." ";
    return $SubjectCode;}
    function subject_5(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[4]." ";
    return $SubjectCode;}
    function subject_6(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[5]." ";
    return $SubjectCode;}
    function subject_7(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[6]." ";
    return $SubjectCode;}
    function subject_8(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[7]." ";
    return $SubjectCode;}
    function subject_9(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem ");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[8]." ";
    return $SubjectCode;}
    function exam_year(){
        $year="";
        $year=date("Y");
    return $year;}
    function issue_date(){
        $issue_date="";
        $issue_date=date("d F Y");
    return strtoupper($issue_date);}
    function logo(){
        $img = '..\..\img\hallticket\logo.png';
        $photo='<img src="'.$img.'" style= "height:100px;width:100px">';
        return $photo;}
    function controller_sign(){
        $img = '..\..\img\hallticket\sign.png';
        $controller_sign='<img src="'.$img.'" style= "height:40px;width:200px">';
    return $controller_sign;}
    function principal_sign(){
        $img = '..\..\img\hallticket\sign.png';
        $principal_sign='<img src="'.$img.'" style= "height:40px;width:200px">';
    return $principal_sign;}
    function date_1(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[0]." ";
    return $ExamDate;}
    function date_2(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[1]." ";
    return $ExamDate;}
    function date_3(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[2]." ";
    return $ExamDate;}
    function date_4(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[3]." ";
    return $ExamDate;}
    function date_5(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[4]." ";
    return $ExamDate;}
    function date_6(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[5]." ";
    return $ExamDate;}
    function date_7(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[6]." ";
    return $ExamDate;}
    function date_8(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[7]." ";
    return $ExamDate;}
    function date_9(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[8]." ";
    return $ExamDate;}
    function session_1(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[0]." ";
    return $ExamSession;}
    function session_2(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[1]." ";
    return $ExamSession;}
    function session_3(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[2]." ";
    return $ExamSession;}
    function session_4(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[3]." ";
    return $ExamSession;}
    function session_5(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[4]." ";
    return $ExamSession;}
    function session_6(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[5]." ";
    return $ExamSession;}
    function session_7(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[6]." ";
    return $ExamSession;}
    function session_8(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[7]." ";
    return $ExamSession;}
    function session_9(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem ");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[8]." ";
    return $ExamSession;}
    function arrear_subject_1(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[0]." ";
    return $SubjectCode;}
    function arrear_subject_2(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[1]." ";
    return $SubjectCode;}
    function arrear_subject_3(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[2]." ";
    return $SubjectCode;}
    function arrear_subject_4(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[3]." ";
    return $SubjectCode;}
    function arrear_subject_5(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[4]." ";
    return $SubjectCode;}
    function arrear_subject_6(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[5]." ";
    return $SubjectCode;}
    function arrear_subject_7(){
        $SubjectCode="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT subject_code FROM mark_details WHERE register_no='$this->register_no' AND sem<=$this->sem AND result='RA'");
        $s_c = array("subject_code");
        $subject_code=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($subject_code,$sc['subject_code']);}
        $count= count($subject_code);
        $SubjectCode=$SubjectCode.$subject_code[6]." ";
    return $SubjectCode;}
    function arrear_date_1(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[0]." ";
    return $ExamDate;}
    function arrear_date_2(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[1]." ";
    return $ExamDate;}
    function arrear_date_3(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[2]." ";
    return $ExamDate;}
    function arrear_date_4(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[3]." ";
    return $ExamDate;}
    function arrear_date_5(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[4]." ";
    return $ExamDate;}
    function arrear_date_6(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[5]." ";
    return $ExamDate;}
    function arrear_date_7(){
        $ExamDate="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.exam_date from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR' ");
        $s_c = array("date");
        $exam_date=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_date,$sc['date']);}
        $count= count($exam_date);
        $ExamDate=$ExamDate.$exam_date[6]." ";
    return $ExamDate;}
    function arrear_session_1(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' AND examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[0]." ";
    return $ExamSession;}
    function arrear_session_2(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[1]." ";
    return $ExamSession;}
    function arrear_session_3(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[2]." ";
    return $ExamSession;}
    function arrear_session_4(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[3]." ";
    return $ExamSession;}
    function arrear_session_5(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[4]." ";
    return $ExamSession;}
    function arrear_session_6(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[5]." ";
    return $ExamSession;}
    function arrear_session_7(){
        $ExamSession="";
        $sub_code=mysqli_query($GLOBALS['connect'],"SELECT examschedule.session from examschedule INNER JOIN mark_details ON examschedule.sub_code=mark_details.subject_code WHERE mark_details.register_no='$this->register_no' AND mark_details.sem<=$this->sem AND mark_details.result='RA' and examschedule.type = 'AR'");
        $s_c = array("date");
        $exam_session=array();
        while ($sc=mysqli_fetch_array($sub_code)){
            array_push($exam_session,$sc['session']);}
        $count= count($exam_session);
        $ExamSession=$ExamSession.$exam_session[6]." ";
    return $ExamSession;}}
?>
