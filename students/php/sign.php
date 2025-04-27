<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// external mark fetch details
		if ($op == 'sign') {
				$res['err'] = 0;
				$res['result'] = '<img oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;" src="../UG/uploads/photos/ControllerSign/sign.png" alt="clg logo" width="100" height="100">';
				echo json_encode($res);
			
		} 
		}
		 else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
