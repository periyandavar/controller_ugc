<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'create_password') {
			$mail =  mysqli_real_escape_string($connect, $_POST['mail']);
			$new_pass =  mysqli_real_escape_string($connect, $_POST['new_pass']);
			$confirm_pass =  mysqli_real_escape_string($connect, $_POST['confirm_pass']);

			$sql = "UPDATE `constant` SET `pass`= '".$new_pass."' WHERE user = '".$mail."'";
			$ele = mysqli_query($connect,$sql);
			if ($ele === true) {
				$res['err'] = 0;
			 	$res['result'] = 'Create Password Successfully';
			} else {
				$res['err'] = 1;
				$res['result'] = 'Create Password Failed';
			}
			echo json_encode($res);
		} else {
			$res['err'] = 101;
			$res['result'] = "Invalid tag";
			echo json_encode($res);
		}
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
