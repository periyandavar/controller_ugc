<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'getDeptName') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$sql = "SELECT `department` FROM `department` WHERE coursecode = '".$dept_code."'";
			$ele = mysqli_fetch_array(mysqli_query($connect,$sql));
			$res['query'] = $sql;
			$res['value'] = $ele['department'];
			$res['err'] = 0;
		 	$res['result'] = 'Success';
			echo json_encode($res);
		} elseif ($op == 'getSubCode') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);

			$sql = "SELECT subject_code FROM `subject_master` WHERE dept_code = '".$dept_code."'";
			$ele = mysqli_query($connect,$sql);
			if (mysqli_num_rows($ele) > 0) {
				$data = array();
				$res['data'] = array();
				while ($row = mysqli_fetch_array($ele)) {
					$data['sub_code'] = $row['subject_code'];
					array_push($res['data'], $data);
				}
			}
			$res['err'] = 0;
		 	$res['result'] = 'Success';
			echo json_encode($res);
		} elseif ($op == 'getSubName') {
				$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
				$sql = "SELECT `subject_name` FROM `subject_master` WHERE subject_code = '".$sub_code."'";
				$ele = mysqli_fetch_array(mysqli_query($connect,$sql));
				$res['query'] = $sql;
				$res['value'] = $ele['subject_name'];
				$res['err'] = 0;
			 	$res['result'] = 'Success';
				echo json_encode($res);
	} elseif ($op =='getAcademicYear') {
		$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `academic_year` WHERE `status` =b'1'"));
		$res['aca_yr'] = $ele['during_year'];
		$res['result'] = 'Done';
		$res['err'] = 0;
		echo json_encode($res);
	} else {
			$res['err'] = 101;
			$res['result'] = "Invalid tag";
			echo json_encode($res);
		}
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
