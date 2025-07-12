<?php 
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");
	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'student_view') {
			$sql = mysqli_query($connect,"SELECT * FROM `student_master`");

			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['dept_code'] = $ele['dept_code'];
					$data['year'] = $ele['academic_year'];
					$data['reg_no'] = $ele['register_no'];
					$data['name'] = $ele['name'];
					array_push($res['data'], $data); 
				}
				$res['err'] = 0;
				$res['result'] = 'Students are loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Students are not found';
				echo json_encode($res);				
			}
		} else {
			$res['err'] = 2;
			$res['result'] = "Invalid op tag";
			echo json_encode($res);
		}
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>