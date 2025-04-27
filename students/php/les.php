<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

    if ($op == 'addles') { // end paper type module start lesduation module
			$les =  mysqli_real_escape_string($connect, $_POST['les']);

			$sql = mysqli_query($connect,"INSERT INTO `later_entry`(`entryDetail`, `status`) VALUES('".$les."',b'1')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
			}
      echo json_encode($res);
		} elseif ($op == 'addles_tab') {
			$fetch = mysqli_query($connect, "SELECT * FROM `later_entry` WHERE `status` = b'1'");
			if (mysqli_num_rows($fetch) > 0) {
				$res['data'] = array();
				$data = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['les'] = $ele['entryDetail'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Later Entry was loaded';
			}else{
				$res['err'] = 2;
				$res['result'] = 'Later Entry was not found';
			}
      echo json_encode($res);
		} elseif ($op == 'delles') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$fetch = mysqli_query($connect, "DELETE FROM `later_entry` WHERE id='".$id."' AND status=b'1'");
			if ($fetch) {
				$res['err'] = 0;
				$res['result'] = 'Later Entry was Deleted';
			}else{
				$res['err'] = 3;
				$res['result'] = 'Later Entry was not Deleted';
			}
      echo json_encode($res);
		} elseif ($op =='editles') {
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `later_entry` WHERE id ='".$id."' AND status=b'1'"));
			$res['id'] = $ele['id'];
			$res['les'] = $ele['entryDetail'];
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} elseif ($op == 'updateles') {
			$les = mysqli_real_escape_string($connect,$_POST['les']);
			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$ele = mysqli_query($connect,"UPDATE `later_entry` SET `entryDetail`='".$les."' WHERE `status`= b'1' AND `id` = '".$id."'");
			if ($ele > 0) {
				$res['err'] = 0;
				$res['result'] = 'Update Successfully';
			} else {
				$res['err'] = 4;
				$res['result'] = 'Update Failed';
			}
      echo json_encode($res);
		}


		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>
