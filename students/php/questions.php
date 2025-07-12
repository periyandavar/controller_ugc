<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// department module start...
		if ($op == 'addquestions') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$quest_type =  mysqli_real_escape_string($connect, $_POST['quest_type']);
			$quest = basename($_FILES['quest']['name']);
			$quest_path = "../uploads/questions/".$quest;
			if ($_FILES['quest']['name'] != '' && $_FILES['quest']['type'] == 'application/pdf') {
				// if(!is_dir(quest_path)) {
				// 	mkdir(quest_path);
				// }
				if (move_uploaded_file($_FILES['quest']['tmp_name'], $quest_path)) {
					$sql = mysqli_query($connect,"INSERT INTO `question`(`dept_code`, `sub_code`, `quest_type`, `question`) VALUES('".$dept_code."','".$sub_code."', '".$quest_type."','".$quest."')");
					if ($sql === true) {
						$res['err'] = 0;
						$res['result'] = "Uploaded Successfully";
						echo json_encode($res);
					} else {
						$res['err'] = 1;
						$res['result'] = "Uploaded Failed";
						echo json_encode($res);
					}
				} else {
					$res['err'] = 101;
					$res['result'] = "Question Does not Uploaded";
					echo json_encode($res);
				}
			} else {
				$res['err'] = 1001;
				$res['result'] = "Type Mismatched";
				echo json_encode($res);
			}
		} elseif ($op == 'addquestions_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `question`");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['dept_code'] = $ele['dept_code'];
					$data['sub_code'] = $ele['sub_code'];
					$data['quest_type'] = $ele['quest_type'];
					$data['quest'] = $ele['question'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Questions was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Questions was not found';
				echo json_encode($res);
			}
		} elseif ($op == 'delete_quest') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `question` WHERE id='".$id."'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Question was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Question was not Deleted';
				echo json_encode($res);
			}
		}

	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
