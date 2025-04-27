elseif ($op == 'edit_sub2') {
			$semester = mysqli_real_escape_string($connect,$_POST['semester']);
			$reg = mysqli_real_escape_string($connect,$_POST['reg']);
			$paper = mysqli_real_escape_string($connect,$_POST['paper']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `mark_details` WHERE register_no ='".$reg."' and subject_code='$paper'"));
			$res['id'] = $ele['id'];
			$res['dept_code'] = $ele['dept_code'];
			$res['dept_name'] = $ele['dept'];
			$res['year'] = $ele['academic_yr'];
			$res['semester'] = $ele['sem'];
			$res['papertype'] = $ele['subject_type'];
			$res['sub_code'] = $ele['subject_code'];
			$res['sub_name'] = $ele['subject_name'];
			$res['credits'] = $ele['credits'];
			$res['max_int_mark'] = $ele['max_int'];
			$res['min_int_mark'] = $ele['min_int'];
			$res['max_ext_mark'] = $ele['max_ext'];
			$res['min_ext_mark'] = $ele['min_ext'];
			$res['exam_hours'] = $ele['hours'];
			$res['min_total_mark'] = $ele['min_tot'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		}