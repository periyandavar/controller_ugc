<?php
	//error_reporting(E_ALL ^ E_NOTICE);
session_start();
	require_once 'db.php';
	require_once 'constant.php';
	require_once 'class/getStudentData.php';
	require_once 'class/getRegisterNo.php';
	require_once 'template.php';
	require_once 'savePDF.php';
	require_once 'class/getPath.php';
	require_once '../generate_vendor/vendor/autoload.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");
    
	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

	if($op=="get_ticket" or $op=='get_record')
	{
		if($op=="get_ticket")
        $fil="hallticket";
        else $fil="personalcare";
		$sql = mysqli_query($connect,"SELECT * FROM `student_master` WHERE register_no= '".$_SESSION['admin']."'");
      $row = mysqli_fetch_array($sql);
      if($row['hallticket_stat']==0)
      {
      	$res['err'] = 10;
					$res['result'] = 'You are not permitted to get the '.$fil.' Please contact the controller of exam for more details...!';
					$res['path'] = "";
      }
      else if($_POST['semester']=="Semester")
      {
      				$res['err'] = 10;
					$res['result'] = 'Please select the semester..!';
					$res['path'] = "";	
      }
      
else if ((file_exists("../"."../PG/php/output/".$fil."/".$row['dept_code']."/".$row['academic_year']."/".$_POST['semester']."/".$_SESSION['admin'].".pdf"))) {
	$path="../PG/php/output/".$fil."/".$row['dept_code']."/".$row['academic_year']."/".$_POST['semester']."/".$_SESSION['admin'].".pdf";
					$res['err'] = 0;
					$res['result'] = 'Fetching Successfully';
					$res['path'] = $path;
				} else {
					$res['err'] = 10;
					$res['result'] = $fil.' is not yet ready for the Semester - '.$_POST['semester'];
					$res['path'] = "";
				}
				echo json_encode($res);
	}
}


	require_once 'db_close.php';
?>
