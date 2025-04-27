<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['ak']) && $_POST['ak'] != '') {
		$op = $_POST['ak'];
		$res['tag'] = $op;

		if ($op == 'addBatchDetails') {
			$batch = mysqli_real_escape_string($connect, $_POST['batch']);
			$query = "INSERT INTO `online_batches`(`batch`, `status`) VALUES ('".$batch."',b'1')";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'loadBatchType') {
			$query = "SELECT * FROM `online_batches` WHERE status = b'1'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['batch'] = $ele['batch'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = "Fetched Successfully";
			} else {
				$res['err'] = 2;
				$res['result'] = "Fetched Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'editBatchTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "SELECT * FROM `online_batches`WHERE status = b'1' AND id = '".$id."'";
			$sql = mysqli_fetch_array(mysqli_query($connect, $query));
			$res['id'] = $sql['id'];
			$res['batch'] = $sql['batch'];
			$res['err'] = 0;
			$res['result'] = "Fetched Successfully";
			echo json_encode($res);
		} elseif ($op == 'deleteBatchTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "DELETE FROM `online_batches` WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Deleted Successfully";
			} else {
				$Res['err'] = 3;
				$res['result'] = "Deleted Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'updateBatchDetails') {
			$batch = mysqli_real_escape_string($connect, $_POST['batch']);
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "UPDATE `online_batches` SET`batch`= '".$batch."' WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
			} else{
				$res['err'] = 4;
				$res['result'] = "Updated Failed";
			}
			echo json_encode($res); // end batch details...
		} elseif ($op == 'addReportTimeDetails') {
			$r_t = mysqli_real_escape_string($connect, $_POST['r_t']);
			$query = "INSERT INTO `online_report_time`(`reporting_time`, `status`) VALUES ('".$r_t."',b'1')";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
			} else {
				$res['err'] = 5;
				$res['result'] = "Insert Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'loadReportType') {
			$query = "SELECT * FROM `online_report_time` WHERE status = b'1'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['r_t'] = $ele['reporting_time'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = "Fetched Successfully";
			} else {
				$res['err'] = 6;
				$res['result'] = "Fetched Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'editReportTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "SELECT * FROM `online_report_time`WHERE status = b'1' AND id = '".$id."'";
			$sql = mysqli_fetch_array(mysqli_query($connect, $query));
			$res['id'] = $sql['id'];
			$res['r_t'] = $sql['reporting_time'];
			$res['err'] = 0;
			$res['result'] = "Fetched Successfully";
			echo json_encode($res);
		} elseif ($op == 'deleteReportTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "DELETE FROM `online_report_time` WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Deleted Successfully";
			} else {
				$Res['err'] = 7;
				$res['result'] = "Deleted Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'updateReportTimeDetails') {
			$r_t = mysqli_real_escape_string($connect, $_POST['r_t']);
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "UPDATE `online_report_time` SET `reporting_time`= '".$r_t."' WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
			} else{
				$res['err'] = 8;
				$res['result'] = "Updated Failed";
			}
			echo json_encode($res); // end reporting time
		} elseif ($op == 'addTimeDurationDetails') {
			$t_d = mysqli_real_escape_string($connect, $_POST['t_d']);
			$query = "INSERT INTO `online_time_duration`(`time_duration`, `status`) VALUES ('".$t_d."',b'1')";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
			} else {
				$res['err'] = 9;
				$res['result'] = "Insert Failed";
			}
			echo json_encode($res);
		} else if ($op == 'loadTimeType') {
			$query = "SELECT * FROM `online_time_duration` WHERE status = b'1'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['t_d'] = $ele['time_duration'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = "Fetched Successfully";
			} else {
				$res['err'] = 10;
				$res['result'] = "Fetched Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'editTimeTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "SELECT * FROM `online_time_duration`WHERE status = b'1' AND id = '".$id."'";
			$sql = mysqli_fetch_array(mysqli_query($connect, $query));
			$res['id'] = $sql['id'];
			$res['t_d'] = $sql['time_duration'];
			$res['err'] = 0;
			$res['result'] = "Fetched Successfully";
			echo json_encode($res);
		} elseif ($op == 'deleteTimeTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "DELETE FROM `online_time_duration` WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Deleted Successfully";
			} else {
				$Res['err'] = 11;
				$res['result'] = "Deleted Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'updateTimeDurationDetails') {
			$t_d = mysqli_real_escape_string($connect, $_POST['t_d']);
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "UPDATE `online_time_duration` SET `time_duration`= '".$t_d."' WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
			} else{
				$res['err'] = 12;
				$res['result'] = "Updated Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'comp_exam') { // end time duration...
			$academic_year = mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester = mysqli_real_escape_string($connect, $_POST['semester']);
			$date = mysqli_real_escape_string($connect, $_POST['date']);
			$batch = mysqli_real_escape_string($connect, $_POST['batch']);
			$report_time = mysqli_real_escape_string($connect, $_POST['report_time']);
			$time_duration = mysqli_real_escape_string($connect, $_POST['time_duration']);
			$ug_lab = mysqli_real_escape_string($connect, $_POST['ug_lab']);
			$pg_lab = mysqli_real_escape_string($connect, $_POST['pg_lab']);
			$query = "INSERT INTO `comprehension_exam`(`academic_year`, `sem`, `date`, `batch`, `reporting_time`, `time_duration`, `ug_lab`, `pg_lab`, `status`) VALUES ('".$academic_year."', '".$semester."', '".$date."', '".$batch."', '".$report_time."', '".$time_duration."', '".$ug_lab."', '".$pg_lab."', b'1')";

			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				$res['query'] = $query;
			} else {
				$res['err'] = 13;
				$res['result'] = "Insert Failed";
				$res['query'] = $query;
			}
			echo json_encode($res);
		} elseif ($op == 'loadOnlineExamDate') {
			$query = "SELECT * FROM `comprehension_exam` WHERE status = b'1'";
			$sql = mysqli_query($connect, $query);
			if (mysqli_num_rows($sql) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($sql)) {
					$data['id'] = $ele['id'];
					$data['year'] = $ele['academic_year'];
					$data['semester'] = $ele['sem'];
					$data['date'] = $ele['date'];
					$data['batch'] = $ele['batch'];
					$data['r_t'] = $ele['reporting_time'];
					$data['t_d'] = $ele['time_duration'];
					$data['uglab'] = $ele['ug_lab'];
					$data['pglab'] = $ele['pg_lab'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = "Fetched Successfully";
			} else {
				$res['err'] = 14;
				$res['result'] = "Fetched Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'editOnlineExamTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "SELECT * FROM `comprehension_exam` WHERE status = b'1' AND id = '".$id."'";
			$ele = mysqli_fetch_array(mysqli_query($connect, $query));
			$res['id'] = $ele['id'];
			$res['academic_year'] = $ele['academic_year'];
			$res['semester'] = $ele['sem'];
			$res['date'] = $ele['date'];
			$res['batch'] = $ele['batch'];
			$res['report_time'] = $ele['reporting_time'];
			$res['time_duration'] = $ele['time_duration'];
			$res['uglab'] = $ele['ug_lab'];
			$res['pglab'] = $ele['pg_lab'];
			$res['err'] = 0;
			$res['result'] = "Fetched Successfully";
			echo json_encode($res);
		} elseif ($op == 'deleteOnlineExamTabEle') {
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "DELETE FROM `comprehension_exam` WHERE id = '".$id."' AND status = b'1'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Deleted Successfully";
			} else {
				$Res['err'] = 15;
				$res['result'] = "Deleted Failed";
			}
			echo json_encode($res);
		} elseif ($op == 'update_comp_ecam') {
			$academic_year = mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester = mysqli_real_escape_string($connect, $_POST['semester']);
			$date = mysqli_real_escape_string($connect, $_POST['date']);
			$batch = mysqli_real_escape_string($connect, $_POST['batch']);
			$report_time = mysqli_real_escape_string($connect, $_POST['report_time']);
			$time_duration = mysqli_real_escape_string($connect, $_POST['time_duration']);
			$ug_lab = mysqli_real_escape_string($connect, $_POST['ug_lab']);
			$pg_lab = mysqli_real_escape_string($connect, $_POST['pg_lab']);
			$id = mysqli_real_escape_string($connect, $_POST['id']);
			$query = "UPDATE `comprehension_exam` SET `academic_year`= '".$academic_year."',`sem`= '".$semester."',`date`= '".$date."',`batch`= '".$batch."',`reporting_time`= '".$report_time."',`time_duration`= '".$time_duration."',`ug_lab`= '".$ug_lab."',`pg_lab`= '".$pg_lab."' WHERE status = b'1' AND id = '".$id."'";
			$sql = mysqli_query($connect, $query);
			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Updated Successfully";
			} else{
				$res['err'] = 16;
				$res['result'] = "Updated Failed";
			}
			echo json_encode($res);
		}
  
		// end if block...
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
