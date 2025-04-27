
<?php
	require_once 'db.php';
	require_once 'constant.php';
	require_once 'class/marksheet/getStudentData.php';
	require_once 'class/getRegisterNo.php';
	require_once 'template_ms.php';
	require_once 'saveMPDF.php';
	require_once '../generate_vendor/vendor/autoload.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

  $deptment_code= unserialize(urldecode($_GET['dept_code']));
  $academic_year= unserialize(urldecode($_GET['academic_year']));
  $semester= unserialize(urldecode($_GET['semester']));
  $month= unserialize(urldecode($_GET['month']));
  $min_length= unserialize(urldecode($_GET['min_length']));
  $max_length= unserialize(urldecode($_GET['max_length']));

  $studentData=new getStudentData;
  $marksheetTemplate=new template;
  $marksheetRegisterNo=new getRegisterNo;
  $marksheetSave=new savePDF;

$path = "output/marksheet/$deptment_code/$academic_year/$semester/";
$file_save=$marksheetSave->save_folder($path);

$marksheetRegisterNo->academic_year=$academic_year;
$marksheetRegisterNo->dept_code=$deptment_code;
$studentData->sem=$semester;
$register_no_input=$marksheetRegisterNo->register_no();

$count=count($register_no_input);

   for($i=0;$i<$count;$i++)
   {

        $studentData->register_no=$register_no_input[$i];
        $studentData->max_length=$max_length;
        $studentData->min_length=$min_length;

        $personal_detail = $studentData->personal_detail();
        list($register_no,$name,$class,$course,$admitted_in,$Photo,$dob,$cgpa)=$studentData->personal_detail();
        list($overall_grade,$classification)=$studentData->rank();

        //file_put_contents('photo.jpg', $Photo);

        $get_sem=$studentData->get_sem();
        $subject_code = $studentData->subject_code();
        $subject_name = $studentData->subject_name();
        $credits = $studentData->credits();
        $total_credits=$studentData->total_credits();
        $total_credits_secured=$studentData->total_credits_secured();
        $core_credits=$studentData->core_credits();
        $core_credits_secured=$studentData->core_credits_secured();
        $elective_credits=$studentData->elective_credits();
        $elective_credits_secured=$studentData->elective_credits_secured();
        $supportive_credits=$studentData->supportive_credits();
        $supportive_credits_secured=$studentData->supportive_credits_secured();

        $Max_Int = $studentData->max_int();
        $Max_Ext = $studentData->max_ext();
        $Max_Tot = $studentData->max_tot();
        $internal = $studentData->internal();
        $external = $studentData->external();

        $total = $studentData->total();
        $grade_point = $studentData->grade_point();
        $grade = $studentData->grade();
        $result = $studentData->result();
        $year = $studentData->year();
        $date= $studentData->date();
        $sem_year= $studentData->sem_year();
        $randomnum=$studentData->randomnum();
        $send_random = $randomnum[0];

        $marksheet_html=$marksheetTemplate->generate_marksheet($register_no,$name,$class,$course,$admitted_in,$Photo,$dob,$cgpa,$subject_code,$subject_name,$credits,$Max_Int,$Max_Ext,$Max_Tot,$internal,$external,$total,$grade_point,$grade,$result,$year,$date,$send_random,$core_credits_secured,$core_credits,$elective_credits_secured,$elective_credits,$supportive_credits_secured,$supportive_credits,$total_credits_secured,$total_credits,$get_sem,$sem_year,$month,$overall_grade,$classification);
        $marksheet_pdf=$marksheetTemplate->generate_pdf($register_no,$marksheet_html,$path);
        $marksheet_pdf=$marksheetTemplate->write_image($register_no,$Photo,$path);
     }

    $file_save=$marksheetSave->run_pdf($path);

		$pdf = new \Jurosh\PDFMerge\PDFMerger;

    for($i=0;$i<$count;$i++) {
        $file_path=$path.$register_no_input[$i].'.pdf';
				$pdf->addPDF($path.$register_no_input[$i].'.pdf');

        if($semester==1) {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_1='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 1;
						 $res['result'] = "Generated Failed";
					 }
        } elseif ($semester==2) {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_2='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 2;
						 $res['result'] = "Generated Failed";
					 }
        } elseif ($semester==3) {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_3='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 3;
						 $res['result'] = "Generated Failed";
					 }
        } elseif ($semester==4) {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_4='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 4;
						 $res['result'] = "Generated Failed";
					 }
        } elseif ($semester==5) {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_5='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 5;
						 $res['result'] = "Generated Failed";
					 }
        } else {
    	     $disp=mysqli_query($GLOBALS['connect'],"UPDATE student_master SET marksheet_sem_6='OUTPUT_PATH.$file_path' WHERE register_no='$register_no_input[$i]'");
					 if ($disp === true) {
						 $res['err'] = 0;
						 $res['result'] = "Generated Succesfully";
					 } else {
						 $res['err'] = 6;
						 $res['result'] = "Generated Failed";
					 }
        }
    }

		$pdf->merge('file', $path.'output.pdf');
		$res['data'] = array();
		$data['path'] = OUTPUT_PATH.$path."output.pdf";
		array_push($res['data'], $data);
		echo json_encode($res);

// add as many pdfs as you want

// call merge, output format `file`
// $pdf->merge('file', $path.'output.pdf');
// header("location:$path"."output.pdf");

?>
