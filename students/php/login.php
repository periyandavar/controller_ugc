<?php
    // ini_set('session.use_cookies', false);
    ini_set('session.use_trans_sid', false);
	session_start();
    
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'login') {
			$user =  mysqli_real_escape_string($connect, $_POST['user']);
			$pass =  mysqli_real_escape_string($connect, $_POST['pass']);

			$sql = mysqli_query($connect,"SELECT * FROM `student_master` WHERE register_no= '".$user."'");
			if (mysqli_num_rows($sql) > 0) {
				$row = mysqli_fetch_array($sql);
					if($row['pass']==$pass){
					$id=gethostbyaddr($_SERVER['REMOTE_ADDR']).'-'.generateRandomString().'-'.$_SERVER['HTTP_USER_AGENT'].$row['name'];
					$unique_id =sha1($id);
					$unique_id=md5($id);
					$sql = mysqli_query($connect,"update `student_master` set session='".sha1($unique_id)."' WHERE register_no= '".$user."'");
					$_SESSION['id']=$unique_id;
					$_SESSION['admin'] = $row['register_no'];
					$_SESSION['type'] = "C";
					$res['err'] = 0;
				$res['result'] = "Login Successfully";
				$res['admin'] = $_SESSION['admin'];
				echo json_encode($res);
				}
			else {
				$res['err'] = 1;
				$res['result'] = "Login Failed!!!";
				echo json_encode($res);
			}
				
			} else {
				$res['err'] = 1;
				$res['result'] = "Login Failed!!!";
				echo json_encode($res);
			}
		} else {
			$res['err'] = 2;
			$res['result'] = "Invalid op tag";
			echo json_encode($res);
		}
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>
