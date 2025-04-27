<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// external mark fetch details
		if ($op == 'external_mark') {
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$fetch = mysqli_query($connect, "SELECT * FROM `mark_details` WHERE subject_code = '".$sub_code."' AND dept_code = '".$dept_code."'");
			if (mysqli_num_rows($fetch) > 0) {
				$result = array();
				$headers=array("Register No","Internal Mark","External Mark","Total Mark","Grade Point","Grade","Result","Year");
				$colWidth=array(200, 100, 100, 100, 100, 100, 100, 100);
		    $colType=array("text", "numeric", "numeric", "numeric", "numeric", "text", "text", "text");
		    $i=0;
				while ($ele = mysqli_fetch_array($fetch)) {
					$result[$i]['register_no'] = $ele['register_no'];
					$result[$i]['internal'] = $ele['internal'];
					$result[$i]['ext'] = $ele['ext'];
					$result[$i]['tot'] = "=SUM(B".($i+1).":C".($i+1).")";
					$gp = "=SUM(D".($i+1)."/10)";
					$result[$i]['grade_point'] = $gp;
					if ($gp > 9.4) {
						$result[$i]['grade'] = "O+";
						$result[$i]['result'] = "P";
					} elseif ($gp > 8.9) {
						$result[$i]['grade'] = "O";
						$result[$i]['result'] = "P";
					} elseif ($gp > 8.4) {
						$result[$i]['grade'] = "D++";
						$result[$i]['result'] = "P";
					} elseif ($gp > 7.9) {
						$result[$i]['grade'] = "D+";
						$result[$i]['result'] = "P";
					} elseif ($gp > 7.4) {
						$result[$i]['grade'] = "D";
						$result[$i]['result'] = "P";
					} elseif ($gp > 6.9) {
						$result[$i]['grade'] = "A++";
						$result[$i]['result'] = "P";
					} elseif ($gp > 6.4) {
						$result[$i]['grade'] = "A+";
						$result[$i]['result'] = "P";
					} elseif ($gp > 5.9) {
						$result[$i]['grade'] = "A";
						$result[$i]['result'] = "P";
					} elseif ($gp > 5.4) {
						$result[$i]['grade'] = "B+";
						$result[$i]['result'] = "P";
					} elseif ($gp == 5.0) {
						$result[$i]['grade'] = "B";
						$result[$i]['result'] = "P";
					} elseif ($gp < 5.0) {
						$result[$i]['grade'] = "U";
						$result[$i]['result'] = "U";
					} elseif ($gp == 'AA') {
						$result[$i]['grade'] = "AA";
						$result[$i]['result'] = "AA";
					} else {
						$result[$i]['grade'] = "AK";
						$result[$i]['result'] = "AK";
					}
					$result[$i]['year'] = "";
					$i++;
				}
				$result[$i] = $headers;
				$i++;
				$result[$i] = $colWidth;
				$i++;
				$result[$i] = $colType;
				$i++;
				$res['err'] = 0;
				$res['result'] = 'Fetch Successfully';
				echo json_encode($result);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Fetch Unsuccessfully';
				echo json_encode($res);
			}
		} elseif ($op == 'add_marks') { // bulk data
			// $data = mysqli_real_escape_string($connect, json_decode($_POST['data']));
			$data = json_decode($_POST['data']);
			$connectUpdate = array();
			for ($i=0; $i < count($data); $i++) {
				$update = "UPDATE `mark_details` SET ";
				$j = 0;
				$roll_no = $data[$i][$j];
				$j++;
				$update .="internal='".$data[$i][$j]."',";
				$j++;
				$update .="ext='".$data[$i][$j]."',";
				$j++;
				$update .="tot='".$data[$i][$j]."',";
				$j++;
				$update .="grade_point='".$data[$i][$j]."',";
				$j++;
				$update .="grade='".$data[$i][$j]."',";
				$j++;
				$update .="result='".$data[$i][$j]."',";
				$j++;
				$update .="year='".$data[$i][$j]."' WHERE register_no = '".$roll_no."'";
				array_push($connectUpdate,$update);
			}
			$flags = 0;
			for ($i=0; $i < count($connectUpdate); $i++) {
				mysqli_query($connect, $connectUpdate[$i]);
				if (mysqli_error($connect)) {
					$flags++;
				}
			}
			$res['query'] = array();
			array_push($res['query'],$connectUpdate);
			if ($flags == 0) {
				$res['err'] = 0;
				$res['result'] = 'Added Successfully';
				$res['flag'] = $flags;
				echo json_encode($res);
			}else{
				$res['err'] = 100;
				$res['result'] = 'Added Failed';
				$res['flag'] = $flags;
				echo json_encode($res);
			}
		} elseif ($op == 'result_analysis') {
			$dept_code = mysqli_real_escape_string($connect, $_POST['dept_code']);
			$aca_yr = mysqli_real_escape_string($connect, $_POST['academic_year']);
			$sem = mysqli_real_escape_string($connect, $_POST['semester']);
			$data = array();
			$res['data'] = array();
			$result = array();
			$headers=array("Department Code","Department Name","Academic Year","Semester","Subject Code","Subject Name","No.of Students Regd","No.of Students Appd","No.of Students Passed","Pass %","First valuation Total Marks","Second valuation Total Marks","Difference","Diff./No.of Students Appeared","No.of III valuation","Condonation\n 1 \t 2");
			$colWidth=array(150, 150, 130, 80, 110, 300, 160, 160, 170, 80, 200, 220, 110, 220, 150, 130);
			$colType=array("text", "text", "numeric", "text", "text", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric");
			$i=0;
			$fetch = mysqli_query($connect, "SELECT DISTINCT dept_code,sem,subject_code,subject_name FROM `mark_details` WHERE dept_code='".$dept_code."' AND academic_year='".$aca_yr."' AND sem='".$sem."'");
			$dept_name = mysqli_fetch_array(mysqli_query($connect,"SELECT `department` FROM `department` WHERE coursecode = '".$dept_code."'"));
			if (mysqli_num_rows($fetch) > 0) {
				while ($ele = mysqli_fetch_array($fetch)) {
					$result[$i]['dept_code'] = $ele['dept_code'];
					$result[$i]['dept_name'] = $dept_name['department'];
					$result[$i]['aca_yr'] = $aca_yr;
					$result[$i]['sem'] = $ele['sem'];
					$result[$i]['subject_code'] = $ele['subject_code'];
					$result[$i]['subject_name'] = $ele['subject_name'];
					$result[$i]['regd'] = "";
					$result[$i]['appd'] = "";
					$result[$i]['passed'] = "";
					$result[$i]['pass_per'] = "";
					$result[$i]['tot_1val'] = "";
					$result[$i]['tot_2val'] = "";
					$result[$i]['dif'] = "";
					$result[$i]['dif_per'] = "";
					$result[$i]['val3'] = "";
					$result[$i]['condonation'] = "";
					$i++;
				}
				$result[$i] = $headers;
				$i++;
				$result[$i] = $colWidth;
				$i++;
				$result[$i] = $colType;
				$i++;
				$res['err'] = 0;
				$res['result'] = 'Fetch Successfully';
				echo json_encode($result);
			} else {
				$res['err'] = 3;
				$res['result'] = "Fetch Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'result_analysis_entry') {
			$data = json_decode($_POST['data']);
			$connectInsert = array();
			for ($i=0; $i < count($data); $i++) {
				$j = 0;
				$insert = "INSERT INTO `result_analysis`(`dept_code`, `dept_name`, `aca_yr`, `sem`, `sub_code`, `sub_name`, `no_of_stud_regd`, `no_of_stud_appd`, `no_of_stud_passed`, `pass_percent`, `tot_first_eva`, `tot_second_eva`, `difference`, `dif_per`, `no_of_third_eva`, `condonation`) VALUES ";
				$insert .= "('".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";//8
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."')"; //15
				array_push($connectInsert, $insert);
			}
			$flags = 0;
			for ($i=0; $i <count($connectInsert); $i++) {
				mysqli_query($connect, $connectInsert[$i]);
				if (mysqli_error($connect)) {
					$flags++;
				}
			}
			$res['query'] = array();
			array_push($res['query'], $connectInsert);
			if ($flags == 0) {
				$res['err'] = 0;
				$res['result'] = "Added Successfully";
				$res['flag'] = $flags;
			} else {
				$res['err'] = 110;
				$res['result'] = "Added Failed";
				$res['flag'] = $flags;
			}
			echo json_encode($res);
		} elseif ($op == 'gender_wise_analysis') {
			$aca_yr = mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem = mysqli_real_escape_string($connect, $_POST['sem']);
			$data = array();
			$res['data'] = array();
			$result = array();
			$headers=array("Department Code","Department Name","Academic Year","Semester","No.of students Regis.","Registered Male",
			"Registered Female","Passed Male","Passed Female","Failed Male","Failed Female","% of Pass Male","% of Pass Female",
			"Students getting their degrees No","Students getting their degrees %","First Class with Distinction Male",
			"First Class with Distinction Female","First Class Male","First Class Female");
			$colWidth=array(140, 200, 120, 80, 160, 130, 150, 110, 120, 110, 130, 120, 130, 250, 250, 230, 250, 130, 140);
			$colType=array("text", "text", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric", "numeric");
			$i=0;
			$fetch = mysqli_query($connect, "SELECT `coursecode`, `department` FROM `department`");
			if (mysqli_num_rows($fetch) > 0) {
				while ($ele = mysqli_fetch_array($fetch)) {
					$result[$i]['dept_code'] = $ele['coursecode'];
					$result[$i]['dept_name'] = $ele['department'];
					$result[$i]['aca_yr'] = $aca_yr;
					$result[$i]['sem'] = $sem;
					$result[$i]['no_regis'] = "";
					$result[$i]['male_reg'] = "";
					$result[$i]['female_reg'] = "";
					$result[$i]['male_pass'] = "";
					$result[$i]['female_pass'] = "";
					$result[$i]['male_fail'] = "";
					$result[$i]['female_fail'] = "";
					$result[$i]['male_per'] = "";
					$result[$i]['female_per'] = "";
					$result[$i]['degree_no'] = "";
					$result[$i]['degree_per'] = "";
					$result[$i]['male_1_d'] = "";
					$result[$i]['female_1_d'] = "";
					$result[$i]['male_1'] = "";
					$result[$i]['female_1'] = "";
					$i++;
				}
				$result[$i] = $headers;
				$i++;
				$result[$i] = $colWidth;
				$i++;
				$result[$i] = $colType;
				$i++;
				$res['err'] = 0;
				$res['result'] = 'Fetch Successfully';
				echo json_encode($result);
			} else {
				$res['err'] = 3;
				$res['result'] = "Fetch Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'gender_result_analysis_entry') {
			$data = json_decode($_POST['data']);
			$connectInsert = array();
			for ($i=0; $i < count($data); $i++) {
				$j = 0;
				$insert = "INSERT INTO `gender_wise_report`(`dept_code`, `dept_name`, `aca_yr`, `sem`, `tot_stud`, `male_stud`, `female_stud`, `male_passed`, `female_passed`, `male_failed`, `female_failed`, `male_pass_per`, `female_pass_per`, `stud_get_degree_no`, `stud_get_degree_per`, `first_dest_class_male`, `first_dest_class_female`, `first_class_male`, `first_class_female`) VALUES ";
				$insert .= "('".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',"; //10
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."',";
				$j++;
				$insert .= "'".$data[$i][$j]."')";
				array_push($connectInsert, $insert);
			}
			$flags = 0;
			for ($i=0; $i <count($connectInsert); $i++) {
				mysqli_query($connect, $connectInsert[$i]);
				if (mysqli_error($connect)) {
					$flags++;
				}
			}
			$res['query'] = array();
			array_push($res['query'], $connectInsert);
			if ($flags == 0) {
				$res['err'] = 0;
				$res['result'] = "Added Successfully";
				$res['flag'] = $flags;
			} else {
				$res['err'] = 110;
				$res['result'] = "Added Failed";
				$res['flag'] = $flags;
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
