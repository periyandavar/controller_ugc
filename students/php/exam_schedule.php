<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'exam_date') { // start regular exam time table
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$academic_yr =  mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sub_name =  mysqli_real_escape_string($connect, $_POST['sub_name']);
			$date =  mysqli_real_escape_string($connect, $_POST['date']);
			$session =  mysqli_real_escape_string($connect, $_POST['session']);
			$later =  mysqli_real_escape_string($connect, $_POST['later']);
			$type =  mysqli_real_escape_string($connect, $_POST['type']);

			$sql = mysqli_query($connect,"INSERT INTO `examschedule`(`dept_code`, `academic_year`, `semester`, `sub_code`, `sub_name`, `exam_date`, `session`, `later`,`type`) VALUES('".$dept_code."','".$academic_yr."', '".$semester."','".$sub_code."', '".$sub_name."', '".$date."', '".$session."', '".$later."','".$type."')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'time_table') {
			$type = mysqli_real_escape_string($connect,$_POST['type']);
			$fetch = mysqli_query($connect, "SELECT * FROM `examschedule` WHERE `type` = '".$type."'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['year'] = $ele['academic_year'];
					$data['semester'] = $ele['semester'];
					$data['sub_code'] = $ele['sub_code'];
					$data['sub_name'] = $ele['sub_name'];
					$data['date'] = $ele['exam_date'];
					$data['session'] = $ele['session'];
					$data['later'] = $ele['later'];
					$data['type'] = $ele['type'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Exam Schedule was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Exam Schedule was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'all_time_table') {
			$fetch = mysqli_query($connect, "SELECT * FROM `examschedule`");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['year'] = $ele['academic_year'];
					$data['semester'] = $ele['semester'];
					$data['sub_code'] = $ele['sub_code'];
					$data['sub_name'] = $ele['sub_name'];
					$data['date'] = $ele['exam_date'];
					$data['session'] = $ele['session'];
					$data['later'] = $ele['later'];
					$data['type'] = $ele['type'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Exam Schedule was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 3;
				$res['result'] = 'Exam Schedule was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'edit_time_table') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `examschedule` WHERE id ='".$id."'"));
			$res['id'] = $ele['id'];
			$res['dept_code'] = $ele['dept_code'];
			$res['academic_year'] = $ele['academic_year'];
			$res['semester'] = $ele['semester'];
			$res['sub_code'] = $ele['sub_code'];
			$res['sub_name'] = $ele['sub_name'];
			$res['date'] = $ele['exam_date'];
			$res['session'] = $ele['session'];
			$res['later'] = $ele['later'];
			$res['type'] = $ele['type'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'delete_time_table') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `examschedule` WHERE id='".$id."'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Deleted Successfully';
				echo json_encode($res);
			}else{
				$res['err'] = 111;
				$res['result'] = 'Deleted Failed';
				echo json_encode($res);
			}
		} elseif ($op == 'update_sub') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$academic_yr =  mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sub_name =  mysqli_real_escape_string($connect, $_POST['sub_name']);
			$date =  mysqli_real_escape_string($connect, $_POST['date']);
			$session =  mysqli_real_escape_string($connect, $_POST['session']);
			$later =  mysqli_real_escape_string($connect, $_POST['later']);
			$type =  mysqli_real_escape_string($connect, $_POST['type']);
			$id =  mysqli_real_escape_string($connect, $_POST['id']);

			$sql = mysqli_query($connect,"UPDATE `examschedule` SET `dept_code`='".$dept_code."',`academic_year`='".$academic_yr."',`semester`='".$semester."',`sub_code`='".$sub_code."',`sub_name`='".$sub_name."',`exam_date`='".$date."',`session`='".$session."',`later`='".$later."',`type`='".$type."' WHERE `id` = '".$id."'");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
				$res['query'] = "UPDATE `examschedule` SET `dept_code`='".$dept_code."',`academic_year`='".$academic_yr."',`semester`='".$semester."',`sub_code`='".$sub_code."',`sub_name`='".$sub_name."',`exam_date`='".$date."',`session`='".$session."',`later`='".$later."',`type`='".$type."' WHERE `id` = '".$id."'";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Updated Failed";
				$res['query'] = "UPDATE `examschedule` SET `dept_code`='".$dept_code."',`academic_year`='".$academic_yr."',`semester`='".$semester."',`sub_code`='".$sub_code."',`sub_name`='".$sub_name."',`exam_date`='".$date."',`session`='".$session."',`later`='".$later."',`type`='".$type."' WHERE `id` = '".$id."'";
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
