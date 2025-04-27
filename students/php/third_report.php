<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['ak']) && $_POST['ak'] != '') {
		$op = $_POST['ak'];
		$res['tag'] = $op;

		if ($op == 'result_analysis_report') {
			$dept_name = mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr = mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem = mysqli_real_escape_string($connect, $_POST['sem']);
			$query = "SELECT * FROM `result_analysis` WHERE dept_code = '".$dept_name."' AND aca_yr = '".$aca_yr."' AND sem = '".$sem."'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['dept_name'] = $ele['dept_name'];
					$data['aca_yr'] = $ele['aca_yr'];
					$data['sem'] = $ele['sem'];
					$data['sub_code'] = $ele['sub_code'];
					$data['sub_name'] = $ele['sub_name'];
					$data['no_of_stud_regd'] = $ele['no_of_stud_regd'];
					$data['no_of_stud_appd'] = $ele['no_of_stud_appd'];
					$data['no_of_stud_passed'] = $ele['no_of_stud_passed'];
					$data['pass_percent'] = $ele['pass_percent'];
					$data['tot_first_eva'] = $ele['tot_first_eva'];
					$data['tot_second_eva'] = $ele['tot_second_eva'];
					$data['difference'] = $ele['difference'];
					$data['dif_per'] = $ele['dif_per'];
					$data['no_of_third_eva'] = $ele['no_of_third_eva'];
					$data['condonation'] = $ele['condonation'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
			}
			echo json_encode($res);
		} elseif ($op == 'gender_wise_analysis_report') {
			$aca_yr = mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem = mysqli_real_escape_string($connect, $_POST['sem']);
			$query = "SELECT * FROM `gender_wise_report` WHERE aca_yr = '".$aca_yr."' AND sem = '".$sem."'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['dept_name'] = $ele['dept_name'];
					$data['aca_yr'] = $ele['aca_yr'];
					$data['sem'] = $ele['sem'];
					$data['tot_stud'] = $ele['tot_stud'];
					$data['male_stud'] = $ele['male_stud'];
					$data['female_stud'] = $ele['female_stud'];
					$data['male_passed'] = $ele['male_passed'];
					$data['female_passed'] = $ele['female_passed'];
					$data['male_failed'] = $ele['male_failed'];
					$data['female_failed'] = $ele['female_failed'];
					$data['male_pass_per'] = $ele['male_pass_per'];
					$data['female_pass_per'] = $ele['female_pass_per'];
					$data['stud_get_degree_no'] = $ele['stud_get_degree_no'];					$data['stud_get_degree_per'] = $ele['stud_get_degree_per'];
					$data['first_dest_class_male'] = $ele['first_dest_class_male'];
					$data['first_dest_class_female'] = $ele['first_dest_class_female'];
					$data['first_class_male'] = $ele['first_class_male'];
					$data['first_class_female'] = $ele['first_class_female'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
			}
			echo json_encode($res);
		} elseif ($op == 'perform_stud') {
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);

			$query = "SELECT register_no,name,grade_point,grade,result FROM `mark_details` WHERE dept_code = '".$dept_name."' and academic_year = '".$aca_yr."' and sem = '".$sem."' OR result = 'RA'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while($ele = mysqli_fetch_array($sql)) {
					$sql_query = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(max_tot) as tot FROM `subject_master` WHERE academic_yr = '".$aca_yr."' and sem = '".$sem."' and dept_code = '".$dept_name."'"));
					$data['reg_no'] = $ele['register_no'];
					$data['total'] = $sql_query['tot'];
					$data['name'] = $ele['name'];
					$data['grade_point'] = $ele['grade_point'];
					$data['grade'] = $ele['grade'];
					$data['class'] = "D++";
					$data['rank'] = "First (D)";
					if ($ele['result'] == 'RA') {
						$data['arrear'] = mysqli_num_rows(mysqli_query($connect, "SELECT result FROM `mark_details` WHERE dept_code = '".$dept_name."' and academic_year = '".$aca_yr."' and sem = '".$sem."' AND result = '".$ele['result']."' and register_no = '".$ele["register_no"]."'"));
					} else {
						$data['arrear'] = 0;
					}
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
			}else{
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
			}
			echo json_encode($res);
		}



	// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>
