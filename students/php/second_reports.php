<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// student details reports start...
		if ($op == 'personal_care') {
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);
			$data = array();
			$res['data'] = array();

			$query = "SELECT register_no,sem,name,subject_code,subject_name,internal,ext,tot,result FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."'";
			$sql = mysqli_query($connect,$query);
				if (mysqli_num_rows($sql) > 0) {
					while ($ele = mysqli_fetch_array($sql)) {
						$data['reg_no'] = $ele['register_no'];
						$data['name'] = $ele['name'];
						$data['class'] = '1';
						$data['sem'] = $ele['sem'];
						$data['sub_code'] = $ele['subject_code'];
						$data['sub_name'] = $ele['subject_name'];
						$mark = mysqli_query($connect,"SELECT max_int,max_ext,max_tot FROM `subject_master` where subject_code = '".$ele["subject_code"]."'");
						if (mysqli_num_rows($mark) > 0) {
							while($row = mysqli_fetch_array($mark)) {
								$data['int'] = $row['max_int'];
								$data['ext'] = $row['max_ext'];
								$data['tot'] = $row['max_tot'];
							}
						} else {
							$data['int'] = "-";
							$data['ext'] = "-";
							$data['tot'] = "-";
						}
						$data['intscore'] = $ele['internal'];
						$data['extscore'] = $ele['ext'];
						$data['totscore'] = $ele['tot'];
						$data['result'] = $ele['result'];
						array_push($res['data'],$data);
					}
					$res['err'] = 0;
					$res['query'] = $query;
					$res['result'] = 'Report was loaded';
				} else {
					$res['err'] = 12345;
					$res['query'] = $query;
					$res['result'] = 'Report was not loaded';
				}
				echo json_encode($res);
		} else if ($op == 'check_list') {
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);
			$sub_code = mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sql = mysqli_query($connect,"SELECT * FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND subject_code='".$sub_code."'");
				if (mysqli_num_rows($sql) > 0) {
					$data = array();
					$res['data'] = array();
					while ($ele = mysqli_fetch_array($sql)) {
						$sub_name = $ele['subject_name'];
						$data['reg_no'] = $ele['register_no'];
						$data['int'] = $ele['internal'];
						$data['ext'] = $ele['ext'];
						$data['tot'] = $ele['tot'];
						$data['gp'] = $ele['grade_point'];
						$data['g'] = $ele['grade'];
						$data['result'] = $ele['result'];
						array_push($res['data'], $data);
						}
				$res['err'] = 0;
				$res['result'] = 'Report was loaded';
				$res['sub_name'] = $sub_name;
				$res['query'] = "SELECT * FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND subject_code='".$sub_code."'";
			} else {
				$res['err'] = 1;
				$res['result'] = 'Report was not found';
				$res['query'] = "SELECT * FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND subject_code='".$sub_code."'";
			}
			echo json_encode($res);
		} else if ($op == 'sub_pass') {
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$aca_yr =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$sem =  mysqli_real_escape_string($connect, $_POST['sem']);

			$sql = mysqli_query($connect,"SELECT DISTINCT register_no FROM mark_details  WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."'");
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_assoc($sql)) {
					$data['reg_no'] = $ele['register_no'];
					$query = mysqli_query($connect,"SELECT DISTINCT subject_code FROM mark_details WHERE academic_year='".$aca_yr."' AND sem='".$sem."' AND dept_code='".$dept_name."' AND register_no = '".$ele['register_no']."' AND result='P'");
					if (mysqli_num_rows($query) > 0) {
						$sub = array();
						$data['sub_code'] = array();
						$i = 0;
						while ($row = mysqli_fetch_array($query)) {
							$sub[$i] = $row['subject_code'];
							$i++;
						}
						array_push($data['sub_code'], $sub);
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
		} elseif ($op == 'fees_list') {
			// SELECT `id`, `theory`, `practical1`, `practical2`, `comprehension`, `mini_project`, `arrear_theory`, `arrear_practical1`,
			// `arrear_practical2`, `arrear_comprehension`, `arrear_mini_project`, `mark_stmt_amt`, `university_fees`, `provisional_fees`,
			// `certificate_fees`, `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `type`,
			// `status` FROM `fees_structure` WHERE 1
			$dept_code = mysqli_real_escape_string($connect,$_POST['dept_name']);
			$aca_yr = mysqli_real_escape_string($connect,$_POST['aca_yr']);
			$sem = mysqli_real_escape_string($connect,$_POST['sem']);
			$query = "SELECT course FROM `department` where coursecode = '".$dept_code."'";
			$course = mysqli_fetch_array(mysqli_query($connect, $query));
			$sql = '';
			$total = '';
			$arr_total = '';
			$data = array();
			$res['data'] = array();
			$dob = "SELECT register_no,dob FROM `student_master` WHERE dept_code = '".$dept_code."' and academic_year = '".$aca_yr."'";
			$stud_query = "SELECT DISTINCT register_no,name,result FROM `mark_details` WHERE academic_year = '".$aca_yr."' and sem = '".$sem."' and dept_code = '".$dept_code."'";
			$dob_sql = mysqli_query($connect, $dob);
			$stud_sql = mysqli_query($connect, $stud_query);
			if (mysqli_num_rows($stud_sql) > 0) {
				if (mysqli_num_rows($dob_sql) > 0) {
					while ($dob = mysqli_fetch_array($dob_sql)) {
						while ($stud = mysqli_fetch_array($stud_sql)) {
							if ($dob['register_no'] == $stud['register_no'] && $stud['result'] == 'P') {
								$data['reg_no'] = $stud['register_no'];
								$data['name'] = $stud['name'];
								$data['dob'] = $dob['dob'];

								if($course == 'Aided Course') {
									$query = "SELECT `theory`, `practical1`, `practical2`, `comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 230;
										$res['result'] = "Please Activate Fees Structure Status";
									}
								} elseif ($course == 'MPhil Course') {
									$query = "SELECT `theory`, `practical1`, `practical2`, `comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 231;
										$res['result'] = "Please Activate Fees Structure Status";
									}
								} elseif ($course == 'Self Finance Course') {
									$query = "SELECT `theory`, `practical1`, `practical2`, `comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 232;
										$res['result'] = "Please Activate Fees Structure Status";
									}
								} elseif ($course == 'Diploma Course') {
									$query = "SELECT `theory`, `practical1`, `practical2`, `comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 233;
										$res['result'] = "Please Activate Fees Structure Status";
									}
								} elseif ($course == 'Certificate Course') {
									$query = "SELECT `theory`, `practical1`, `practical2`, `comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['reg_fees'] = $row['theory'] + $row['practical1'] + $row['practical2'] + $row['comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 234;
										$res['result'] = "Please Activate Fees Structure Status";
									}
								}
							} elseif ($dob['register_no'] == $stud['register_no'] && $stud['result'] == 'RA') {
								$data['reg_no'] = $stud['register_no'];
								$data['name'] = $stud['name'];
								$data['dob'] = $dob['dob'];

								if($course == 'Aided Course') {
									$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
									$sql = mysqli_query($connect, $query);
									if(mysqli_num_rows($sql) > 0) {
										while ($row = mysqli_fetch_array($sql)) {
											if ($sem < 3 || $sem == 5) {
												$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
											} elseif ($sem == 4 || $sem == 6) {
												$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
											}
											array_push($res['data'],$data);
										}
									} else {
										$res['err'] = 235;
										$res['result'] = "Please Activate Fees Structure Status";
									}
							} elseif($course == 'Self Finance Course') {
								$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
								$sql = mysqli_query($connect, $query);
								if(mysqli_num_rows($sql) > 0) {
									while ($row = mysqli_fetch_array($sql)) {
										if ($sem < 3 || $sem == 5) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
										} elseif ($sem == 4 || $sem == 6) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
										}
										array_push($res['data'],$data);
									}
								} else {
									$res['err'] = 236;
									$res['result'] = "Please Activate Fees Structure Status";
								}
							} elseif($course == 'Mphil Course') {
								$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
								$sql = mysqli_query($connect, $query);
								if(mysqli_num_rows($sql) > 0) {
									while ($row = mysqli_fetch_array($sql)) {
										if ($sem < 3 || $sem == 5) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
										} elseif ($sem == 4 || $sem == 6) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
										}
										array_push($res['data'],$data);
									}
								} else {
									$res['err'] = 237;
									$res['result'] = "Please Activate Fees Structure Status";
								}
							} elseif($course == 'Diploma Course') {
								$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
								$sql = mysqli_query($connect, $query);
								if(mysqli_num_rows($sql) > 0) {
									while ($row = mysqli_fetch_array($sql)) {
										if ($sem < 3 || $sem == 5) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
										} elseif ($sem == 4 || $sem == 6) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
										}
										array_push($res['data'],$data);
									}
								} else {
									$res['err'] = 235;
									$res['result'] = "Please Activate Fees Structure Status";
								}
							} elseif($course == 'Certificate Course') {
								$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
								$sql = mysqli_query($connect, $query);
								if(mysqli_num_rows($sql) > 0) {
									while ($row = mysqli_fetch_array($sql)) {
										if ($sem < 3 || $sem == 5) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
										} elseif ($sem == 4 || $sem == 6) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
										}
										array_push($res['data'],$data);
									}
								} else {
									$res['err'] = 235;
									$res['result'] = "Please Activate Fees Structure Status";
								}
							} elseif($course == 'Aided Course') {
								$query = "SELECT `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `mark_stmt_amt`, `provisional_fees`, `certificate_fees` FROM `fees_structure` WHERE type = 'aided' AND status = b'1'";
								$sql = mysqli_query($connect, $query);
								if(mysqli_num_rows($sql) > 0) {
									while ($row = mysqli_fetch_array($sql)) {
										if ($sem < 3 || $sem == 5) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'];
										} elseif ($sem == 4 || $sem == 6) {
											$data['arr_fees'] = $row['arrear_theory']+ $row['arrear_practical1'] + $row['arrear_practical2']+ $row['arrear_comprehension'] + $row['mark_stmt_amt'] + $row['provisional_fees'] + $row['certificate_fees'];
										}
										array_push($res['data'],$data);
									}
								} else {
									$res['err'] = 235;
									$res['result'] = "Please Activate Fees Structure Status";
								}
							}
						}
					}
					array_push($res['data'],$data);
				}
			}
		}
	$res['err'] = 0;
	$res['result'] = "Fees List was found";
			// else {
			// 		$res['err'] = 54321;
			// 		$res['result'] = "Invalid Course Type";
			// 		$res['query'] = $query;
			// 		$res['dept'] = $dept_course;
			// }
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
