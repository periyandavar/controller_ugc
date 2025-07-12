<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// department module start...
		if ($op == 'addDept') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$course =  mysqli_real_escape_string($connect, $_POST['course']);
			$gra_type =  mysqli_real_escape_string($connect, $_POST['gra_type']);

			$sql = mysqli_query($connect,"INSERT INTO `department`(`gra_type`,`coursecode`,`department`,`course`) VALUES('".$gra_type."','".$dept_code."','".$dept_name."', '".$course."')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addDept_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `department`");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['gra_type'] = $ele['gra_type'];
					$data['dept_code'] = $ele['coursecode'];
					$data['dept_name'] = $ele['department'];
					$data['course'] = $ele['course'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Department was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Department was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delete_dept') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `department` WHERE id='".$id."'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Department was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Department was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='edit_dept') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `department` WHERE id ='".$id."'"));
			$res['id'] = $ele['id'];
			$res['dept_code'] = $ele['coursecode'];
			$res['dept_name'] = $ele['department'];
			$res['course'] = $ele['course'];
			$res['gra_type'] = $ele['gra_type'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'update_dept') {
			$code = mysqli_real_escape_string($connect,$_POST['code']);
			$dept = mysqli_real_escape_string($connect,$_POST['dept']);
			$course = mysqli_real_escape_string($connect,$_POST['course']);
			$gra_type = mysqli_real_escape_string($connect,$_POST['gra_type']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `department` SET `gra_type`='".$gra_type."',`coursecode`='".$code."',`department`='".$dept."',`course`='".$course."' WHERE id='".$id."'");
			if ($ele) {
				$res['err'] = 0;
				$res['query'] = "UPDATE `department` SET `gra_type`='".$gra_type."',`coursecode`='".$code."',`department`='".$dept."',`course`='".$course."' WHERE id='".$id."'";
				$res['result'] = 'Department was Updated';
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['query'] = "UPDATE `department` SET `gra_type`='".$gra_type."',`coursecode`='".$code."',`department`='".$dept."',`course`='".$course."' WHERE id='".$id."'";
				$res['result'] = 'Department was not Updated';
				echo json_encode($res);
			}
		} elseif ($op == 'addSubject') { // start subject module end department module
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$academic_yr =  mysqli_real_escape_string($connect, $_POST['academic_yr']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$papertype =  mysqli_real_escape_string($connect, $_POST['papertype']);
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sub_name =  mysqli_real_escape_string($connect, $_POST['sub_name']);
			$credits =  mysqli_real_escape_string($connect, $_POST['credits']);
			$max_int_mark =  mysqli_real_escape_string($connect, $_POST['max_int_mark']);
			$min_int_mark =  mysqli_real_escape_string($connect, $_POST['min_int_mark']);
			$max_ext_mark =  mysqli_real_escape_string($connect, $_POST['max_ext_mark']);
			$min_ext_mark =  mysqli_real_escape_string($connect, $_POST['min_ext_mark']);
			$min_total_mark=  mysqli_real_escape_string($connect, $_POST['min_total_mark']);
			$exam_hours=  mysqli_real_escape_string($connect, $_POST['exam_hours']);

			$sql = mysqli_query($connect,"INSERT INTO `subject_master`(`academic_yr`, `dept`, `dept_code`, `sem`, `subject_code`, `subject_name`, `credits`, `max_int`, `max_ext`, `min_int`, `min_ext`, `min_tot`, `subject_type`, `hours`, `syllabus`) VALUES('".$academic_yr."', '".$dept_name."','".$dept_code."', '".$semester."','".$sub_code."', '".$sub_name."', '".$credits."', '".$max_int_mark."', '".$max_ext_mark."', '".$min_int_mark."', '".$max_ext_mark."', '".$min_total_mark."',  '".$papertype."','".$exam_hours."','NULL')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addSubject_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `subject_master`");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['dept_name'] = $ele['dept'];
					$data['year'] = $ele['academic_yr'];
					$data['semester'] = $ele['sem'];
					$data['papertype'] = $ele['subject_type'];
					$data['sub_code'] = $ele['subject_code'];
					$data['sub_name'] = $ele['subject_name'];
					$data['credits'] = $ele['credits'];
					$data['max_int_mark'] = $ele['max_int'];
					$data['min_int_mark'] = $ele['min_int'];
					$data['max_ext_mark'] = $ele['max_ext'];
					$data['min_ext_mark'] = $ele['min_ext'];
					$data['min_total_mark'] = $ele['min_tot'];
					$data['exam_hours'] = $ele['hours'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Subject was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Subject was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'edit_sub') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `subject_master` WHERE id ='".$id."'"));
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
		} elseif ($op == 'delete_sub') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `subject_master` WHERE id='".$id."'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Subject was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Subject was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op == 'update_sub') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$dept_name =  mysqli_real_escape_string($connect, $_POST['dept_name']);
			$academic_yr =  mysqli_real_escape_string($connect, $_POST['academic_yr']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$papertype =  mysqli_real_escape_string($connect, $_POST['papertype']);
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sub_name =  mysqli_real_escape_string($connect, $_POST['sub_name']);
			$credits =  mysqli_real_escape_string($connect, $_POST['credits']);
			$max_int_mark =  mysqli_real_escape_string($connect, $_POST['max_int_mark']);
			$min_int_mark =  mysqli_real_escape_string($connect, $_POST['min_int_mark']);
			$max_ext_mark =  mysqli_real_escape_string($connect, $_POST['max_ext_mark']);
			$min_ext_mark =  mysqli_real_escape_string($connect, $_POST['min_ext_mark']);
			$min_total_mark=  mysqli_real_escape_string($connect, $_POST['min_total_mark']);
			$exam_hours=  mysqli_real_escape_string($connect, $_POST['exam_hours']);
			$id =  mysqli_real_escape_string($connect, $_POST['id']);

			$sql = mysqli_query($connect,"UPDATE `subject_master` SET `academic_yr`='".$academic_yr."',`dept`='".$dept_name."',`dept_code`='".$dept_code."',`sem`='".$semester."',`subject_code`='".$sub_code."',`subject_name`='".$sub_name."',`credits`='".$credits."',`max_int`='".$max_int_mark."',`max_ext`='".$max_ext_mark."',`min_int`='".$min_int_mark."',`min_ext`='".$min_ext_mark."',`min_tot`='".$min_total_mark."',`subject_type`='".$papertype."',`hours`='".$exam_hours."' WHERE id='".$id."'");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
				$res['query'] = "UPDATE `subject_master` SET `academic_yr`='".$academic_yr."',`dept`='".$dept_name."',`dept_code`='".$dept_code."',`sem`='".$semester."',`subject_code`='".$sub_code."',`subject_name`='".$sub_name."',`credits`='".$credits."',`max_int`='".$max_int_mark."',`max_ext`='".$max_ext_mark."',`min_int`='".$min_int_mark."',`min_ext`='".$min_ext_mark."',`min_tot`='".$min_total_mark."',`subject_type`='".$papertype."',`hours`='".$exam_hours."' WHERE id='".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Updated Failed";
				$res['query'] = "UPDATE `subject_master` SET `academic_yr`='".$academic_yr."',`dept`='".$dept_name."',`dept_code`='".$dept_code."',`sem`='".$semester."',`subject_code`='".$sub_code."',`subject_name`='".$sub_name."',`credits`='".$credits."',`max_int`='".$max_int_mark."',`max_ext`='".$max_ext_mark."',`min_int`='".$min_int_mark."',`min_ext`='".$min_ext_mark."',`min_tot`='".$min_total_mark."',`subject_type`='".$papertype."',`hours`='".$exam_hours."' WHERE id='".$id."'";
				echo json_encode($res);
			}
		} elseif ($op == 'addCourse') { // end subject module and start course module
			$course =  mysqli_real_escape_string($connect, $_POST['c_n']);

			$sql = mysqli_query($connect,"INSERT INTO `course_details`(`course_name`,`status`) VALUES('".$course."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addCourse_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `course_details` WHERE `status` = b'1'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['c_n'] = $ele['course_name'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Course was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Course was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delete_course') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `course_details` WHERE id='".$id."' AND status=b'1'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Course was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Course was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='edit_course') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `course_details` WHERE id ='".$id."' AND status=b'1'"));
			$res['id'] = $ele['id'];
			$res['c_n'] = $ele['course_name'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'update_course') {
			$course = mysqli_real_escape_string($connect,$_POST['c_n']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `course_details` SET `course_name`='".$course."' WHERE id = '".$id."'");
			if ($ele) {
				$res['err'] = 0;
				$res['result'] = 'Course was Updated';
				$res['query'] = "UPDATE `course_details` SET `course_name`='".$course."' WHERE id = '".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['result'] = 'Course was not Updated';
				$res['query'] = "UPDATE `course_details` SET `course_name`='".$course."' WHERE id = '".$id."'";
				echo json_encode($res);
			}
		} elseif ($op == 'addBatch') { // end course module start academic year module
			$year =  mysqli_real_escape_string($connect, $_POST['yr']);

			$sql = mysqli_query($connect,"INSERT INTO `academic_year`(`during_year`,`status`) VALUES('".$year."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addBatch_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `academic_year` where `status`=b'1'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['aca_yr'] = $ele['during_year'];
					$data['status'] = $ele['status'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Academic Year was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Academic Year was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delBatch') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `academic_year` WHERE id='".$id."'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Academic Year was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Academic Year was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='editBatch') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `academic_year` WHERE id ='".$id."'"));
			$res['id'] = $ele['id'];
			$res['aca_yr'] = $ele['during_year'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'updateBatch') {
			$year = mysqli_real_escape_string($connect,$_POST['yr']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `academic_year` SET `during_year`='".$year."' WHERE `id` = '".$id."'");
			if ($ele > 0) {
				$res['err'] = 0;
				$res['result'] = 'Academic Year was Updated';
				$res['query'] = "UPDATE `academic_year` SET `during_year`='".$year."' WHERE `id` = '".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['result'] = 'Academic Year was not Updated';
				$res['query'] = "UPDATE `academic_year` SET `during_year`='".$year."' WHERE `id` = '".$id."'";
				echo json_encode($res);
			}
		} elseif ($op == 'activeYear') {
			$status = mysqli_real_escape_string($connect,$_POST['status']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$row = mysqli_query($connect,"SELECT `status` FROM `academic_year` WHERE status = b'1'");
			if (mysqli_num_rows($row) > 0) {
				$res['err'] = 123;
				$res['result'] = 'Not permitted to activated academic year';
			} else {
				$ele = mysqli_query($connect,"UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'");
				if ($ele === true) {
					$res['err'] = 0;
					$res['result'] = 'Academic year was activated successfully';
					$res['query'] = "UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'";
				} else {
					$res['err'] = 209;
					$res['result'] = 'Academic year was activated Failed';
					$res['query'] = "UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'";
				}
			}
			echo json_encode($res);
		}elseif ($op == 'deactiveYear') {
			$status = mysqli_real_escape_string($connect,$_POST['status']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'");
			if ($ele > 0) {
				$res['err'] = 0;
				$res['result'] = 'Academic year was deactivated successfully';
				$res['query'] = "UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'";
			} else {
				$res['err'] = 209;
				$res['result'] = 'Academic year was deactivated Failed';
				$res['query'] = "UPDATE `academic_year` SET `status`=b'".$status."' WHERE `id` = '".$id."'";
			}
			echo json_encode($res);
		} elseif ($op == 'addcredit') { // end academic year module start credits module
			$credit =  mysqli_real_escape_string($connect, $_POST['credit']);

			$sql = mysqli_query($connect,"INSERT INTO `credits`(`credits`, `status`) VALUES('".$credit."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addcredit_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `credits` WHERE `status` = b'1' ORDER BY credits ASC");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['credit'] = $ele['credits'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Credits was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Credits was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delcredit') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `credits` WHERE id='".$id."' AND status=b'1'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Credits was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Credits was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='editcredit') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `credits` WHERE id ='".$id."' AND status=b'1'"));
			$res['id'] = $ele['id'];
			$res['credit'] = $ele['credits'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'updatecredit') {
			$credit = mysqli_real_escape_string($connect,$_POST['credit']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `credits` SET `credits`='".$credit."' WHERE `status`= b'1' AND `id` = '".$id."'");
			if ($ele > 0) {
				$res['err'] = 0;
				$res['result'] = 'Credits was Updated';
				$res['query'] = "UPDATE `credits` SET `credits`='".$credit."' WHERE `status`= b'1' AND `id` = '".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['result'] = 'Credits was not Updated';
				$res['query'] = "UPDATE `credits` SET `credits`='".$credit."' WHERE `status`= b'1' AND `id` = '".$id."'";
				echo json_encode($res);
			}
		} elseif ($op == 'addPT') { // end credits module start paper type module
			$pt =  mysqli_real_escape_string($connect, $_POST['pt']);

			$sql = mysqli_query($connect,"INSERT INTO `papertype`(`papers`, `status`) VALUES('".$pt."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addPT_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `papertype` WHERE `status` = b'1'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['pt'] = $ele['papers'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Paper Type was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Paper Type was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delPT') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `papertype` WHERE id='".$id."' AND status=b'1'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Paper Type was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Paper Type was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='editPT') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `papertype` WHERE id ='".$id."' AND status=b'1'"));
			$res['id'] = $ele['id'];
			$res['pt'] = $ele['papers'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'updatePT') {
			$pt = mysqli_real_escape_string($connect,$_POST['pt']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `papertype` SET `papers`='".$pt."' WHERE `status`= b'1' AND `id` = '".$id."'");
			if (count($ele) > 0) {
				$res['err'] = 0;
				$res['result'] = 'Paper Type was Updated';
				$res['query'] = "UPDATE `papertype` SET `papers`='".$pt."' WHERE `status`= b'1' AND `id` = '".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['result'] = 'Paper Type was not Updated';
				$res['query'] = "UPDATE `papertype` SET `papers`='".$pt."' WHERE `status`= b'1' AND `id` = '".$id."'";
				echo json_encode($res);
			}
		} elseif ($op == 'addGraduate') { // end paper type module start graduation module
			$gra =  mysqli_real_escape_string($connect, $_POST['gra']);

			$sql = mysqli_query($connect,"INSERT INTO `graduation`(`graduate_type`, `status`) VALUES('".$gra."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'addGraduate_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `graduation` WHERE `status` = b'1'");
			if (mysqli_num_rows($fetch) > 0) {
				$res['data'] = array();
				$data = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['gra'] = $ele['graduate_type'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Graduation was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Graduation was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delGraduate') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `graduation` WHERE id='".$id."' AND status=b'1'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Graduation was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Graduation was not Deleted';
				echo json_encode($res);
			}
		} elseif ($op =='editGraduate') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `graduation` WHERE id ='".$id."' AND status=b'1'"));
			$res['id'] = $ele['id'];
			$res['gra'] = $ele['graduate_type'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'updateGraduate') {
			$gra = mysqli_real_escape_string($connect,$_POST['gra']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `graduation` SET `graduate_type`='".$gra."' WHERE `status`= b'1' AND `id` = '".$id."'");
			if ($ele > 0) {
				$res['err'] = 0;
				$res['result'] = 'Graduation was Updated';
				echo json_encode($res);
			} else {
				$res['err'] = 109;
				$res['result'] = 'Graduation was not Updated';
				echo json_encode($res);
			}
		}

		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
               /*<td><form method='post'><a href='deldept.php?del=$id' class='btn btn-primary' role='button' >DELETE</a></td>
               <td><form method='post'><a href='#?edit=$id'  data-toggle='modal'  class='btn btn-primary' data-target='#dept' role='button'>EDIT</a></td></form>*/
	require_once 'db_close.php';
?>
