<?php 
	session_start();
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'change_password') {
			$old_pass =  mysqli_real_escape_string($connect, $_POST['old_pass']);
			$new_pass =  mysqli_real_escape_string($connect, $_POST['new_pass']);
			$confirm_pass =  mysqli_real_escape_string($connect, $_POST['confirm_pass']);

			$sql = "select * from `student_master` WHERE pass = '".$old_pass."' and register_no='".$_SESSION['admin']."'";
			$ele = mysqli_query($connect,$sql);
			if(mysqli_num_rows($ele)<1)
			{
	$res['err'] = 1;
				$res['result'] = 'Please enter correct current password';
			}else{
			$sql = "UPDATE `student_master` SET `pass`= '".$new_pass."' WHERE pass = '".$old_pass."' and register_no='".$_SESSION['admin']."'";
			$ele = mysqli_query($connect,$sql);
			if ($ele === true) {
				$res['err'] = 0;	
			 	$res['result'] = 'Updated Successfully';
			} else {
				$res['err'] = 1;
				$res['result'] = 'Updated Failed';
			}}
			echo json_encode($res);
		} elseif ($op == 'change_credential') {
			$mail_id =  mysqli_real_escape_string($connect, $_POST['mail_id']);
			$pass =  mysqli_real_escape_string($connect, $_POST['pass']);

			$sql = "UPDATE `admin` SET `user`= '".$mail_id."',`pass`= '".$pass."' WHERE `status`= b'0'";
			$ele = mysqli_query($connect,$sql);
			if ($ele === true) {
				$res['err'] = 0;	
			 	$res['result'] = 'Updated Successfully';
			} else {
				$res['err'] = 1;
				$res['result'] = 'Updated Failed';
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