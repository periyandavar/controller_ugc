<?php
	require_once 'db.php';
	session_start();
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'application') { // start regular exam time table
			
			$sql = mysqli_query($connect,"update student_master set ap_flag=2, father_name='".$_POST['fname']."', pincode='".$_POST['pin']."',address='".$_POST['address']."',community='".$_POST['com']."'	,dob='".$_POST['dob']."' , mobile_no='".$_POST['phone']."',caste='".$_POST['caste']."', email_id='".$_POST['mail']."', gender='".$_POST['gen']."' where register_no='".$_SESSION['admin']."'");

			if ($sql === true) {
				
				$res['err'] = 0;
				$res['result'] = "Applied Successfully..!";
				echo json_encode($res);
				

			}
			else {
				$res['err'] = 1;
				$res['result'] = "Failed...!";
				echo json_encode($res);
			}
		}

			 else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
}
               /*<td><form method='post'><a href='deldept.php?del=$id' class='btn btn-primary' role='button' >DELETE</a></td>
               <td><form method='post'><a href='#?edit=$id'  data-toggle='modal'  class='btn btn-primary' data-target='#dept' role='button'>EDIT</a></td></form>*/
	require_once 'db_close.php';
?>
