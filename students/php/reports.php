<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// student details reports start...
		if ($op == 'student_details') {
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);

			$sql = mysqli_query($connect,"SELECT `register_no`,`name` FROM `student_master` WHERE dept_code = '".$dept_name."' and academic_year = '".$aca_yr."'");
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['reg_no'] = $ele['register_no'];
					$data['name'] = $ele['name'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
				echo json_encode($res);
			}
		} else if ($op == 'nominal_roll') { // nominal roll reports start...
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);

			$sql = mysqli_query($connect,"SELECT DISTINCT name,register_no FROM mark_details  WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."'");
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_assoc($sql)) {
					$data['reg_no'] = $ele['register_no'];
					$data['name'] = $ele['name'];
					// nominal roll reports...
					$query = mysqli_query($connect,"SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."'");
					if (mysqli_num_rows($query) > 0) {
						$sub = array();
						$data['sub_code'] = array();
						$i = 0;
						while ($row = mysqli_fetch_array($query)) {
							$sub[$i] = $row['subject_code'];
							$i++;
						}
						array_push($data['sub_code'], $sub);
						/*if ($sem == 1) {
							$arr_sem = 1;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						} else if ($sem == 2) {
							$arr_sem = $sem-1;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						} else if ($sem == 3) {
							$arr_sem = $sem-1;
							$arr_sem1 = $sem-2;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' OR sem='".$arr_sem1."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						} else if ($sem == 4) {
							$arr_sem = $sem-1;
							$arr_sem1 = $sem-2;
							$arr_sem2 = $sem-3;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' OR sem='".$arr_sem1."' OR sem='".$arr_sem2."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						} else if ($sem == 5) {
							$arr_sem = $sem-1;
							$arr_sem1 = $sem-2;
							$arr_sem2 = $sem-3;
							$arr_sem3 = $sem-4;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' OR sem='".$arr_sem1."' OR sem='".$arr_sem2."' OR sem='".$arr_sem3."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						}  else if ($sem == 6) {
							$arr_sem = $sem-1;
							$arr_sem1 = $sem-2;
							$arr_sem2 = $sem-3;
							$arr_sem3 = $sem-4;
							$arr_sem4 = $sem-5;
							$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' OR sem='".$arr_sem1."' OR sem='".$arr_sem2."' OR sem='".$arr_sem3."' OR sem='".$arr_sem4."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						}*/
						if ($sem == 1) {
							$arr_sem = 1;
						} else {
							$arr_sem = $sem-1;
						}
						$arrear_query = "SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$arr_sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result = 'RA'";
						$arrear_sql = mysqli_query($connect,$arrear_query);
						if (mysqli_num_rows($arrear_sql) > 0) {
							// nominal roll arrear list
							$arr_sub = array();
							$data['arr_sub'] = array();
							$i = 0;
							while ($ele = mysqli_fetch_array($arrear_sql)) {
								$arr_sub[$i] = $ele['subject_code'];
								$i++;
							}
							array_push($data['arr_sub'], $arr_sub);
						}
					}
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
				$res['query'] = $arrear_query;
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
				echo json_encode($res);
			}
		} else if ($op == 'foil_card') { // foil card reports start...
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);

			$query = "SELECT register_no,name,subject_code,internal FROM mark_details WHERE dept_code='".$dept_name."' AND sem='".$sem."' AND academic_year='".$aca_yr."'";
			$sql = mysqli_query($connect, $query);

			$sub_query = mysqli_query($connect,"SELECT DISTINCT subject_code,internal FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."'");
			if (mysqli_num_rows($sub_query) > 0) {
				$sub = array();
				$res['subject_code'] = array();
				while ($row = mysqli_fetch_array($sub_query)) {
					$sub['sub_code'] = $row['subject_code'];
					$sub['internal'] = $row['internal'];
				}
				array_push($res['subject_code'], $sub);
			}
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['reg_no'] = $ele['register_no'];
					$data['name'] = $ele['name'];
					$data['sub_code'] = $ele['subject_code'];
					$data['internal'] = $ele['internal'];
				}
				array_push($res['data'], $data);
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
				echo json_encode($res);
			} else {
				$res['err'] = 15;
				$res['result'] = 'Report was not found';
				echo json_encode($res);
			}
		} else if ($op == 'arrear_list') { // arrear list reports start...
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);
			// $sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);

			// $sql = mysqli_query($connect,"SELECT register_no,name,result FROM mark_details WHERE dept_code='".$dept_name."' AND sem='".$sem."' AND subject_code='".$sub_code."' AND academic_year='".$aca_yr."' AND result='RA'");
			$sql = mysqli_query($connect,"SELECT register_no,name,result FROM mark_details WHERE dept_code='".$dept_name."' AND sem='".$sem."' AND academic_year='".$aca_yr."' AND result='RA'");

			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_assoc($sql)) {
					$data['reg_no'] = $ele['register_no'];
					$data['name'] = $ele['name'];
					$data['result'] = $ele['result'];
					$query = mysqli_query($connect,"SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result='".$ele['result']."'");
					if (mysqli_num_rows($query) > 0) {
						$arrear = array();
						$data['sub_code'] = array();
						$i = 0;
						while ($row = mysqli_fetch_array($query)) {
							$arrear[$i] = $row['subject_code'];
							$i++;
						}
						array_push($data['sub_code'], $arrear);
					}
					array_push($res['data'], $data);
				}
				/* if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {

					array_push($res['data'], $data);
				}*/
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
				echo json_encode($res);
			}
		}


		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>
