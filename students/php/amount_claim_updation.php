<?php 
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'claim_amount') {
			$qpset =  mysqli_real_escape_string($connect, $_POST['qp']);
			$sov =  mysqli_real_escape_string($connect, $_POST['sov']);
			$vp =  mysqli_real_escape_string($connect, $_POST['vp']);
			$pract =  mysqli_real_escape_string($connect, $_POST['pra']);
			$vv =  mysqli_real_escape_string($connect, $_POST['vv']);

			$sql = "UPDATE `claim_amount_updation` SET `qp_settings`='".$qpset."',`scheme_of_val`='".$sov."',`val_paper`='".$vp."',`practical`='".$pract."',`viva`='".$vv."' WHERE `status`=b'1'";
			$ele = mysqli_query($connect,$sql);
			if ($ele === true) {
				$res['query'] = $sql;
				$res['err'] = 0;	
			 	$res['result'] = 'Updated Successfully';
			} else {
				$res['query'] = $sql;
				$res['err'] = 100;	
			 	$res['result'] = 'Updated Failed';
			}
			echo json_encode($res);
		} elseif ($op == 'claim_amount_tab') {
			$sql = "SELECT * FROM `claim_amount_updation` WHERE status = b'1'";
			$ele = mysqli_query($connect,$sql);
			if (mysqli_num_rows($ele) > 0) {
				$data = array();
				$res['data'] = array();
				while ($row = mysqli_fetch_array($ele)) {
					$data['qp'] = $row['qp_settings'];
					$data['sov'] = $row['scheme_of_val'];
					$data['vp'] = $row['val_paper'];
					$data['pra'] = $row['practical'];
					$data['vv'] = $row['viva'];
					array_push($res['data'], $data);
				}
			}
			$res['err'] = 0;
		 	$res['result'] = 'Success';
			echo json_encode($res);
		} elseif ($op == 'claim_payment_tab') {
			$sql = "SELECT * FROM `claimform`";
			$ele = mysqli_query($connect,$sql);
			if (mysqli_num_rows($ele) > 0) {
				$data = array();
				$res['data'] = array();
				while ($row = mysqli_fetch_array($ele)) {
					$data['name'] = $row['name'];
					$data['dept_name'] = $row['dept_name'];
					$data['clg_name'] = $row['clg_name'];
					$data['mail_id'] = $row['mail_id'];
					$data['mobile_no'] = $row['mobile_no'];
					$data['qp_setting'] = $row['qp_setting'];
					$data['scheme_of_val'] = $row['scheme_of_val'];
					$data['val_paper'] = $row['val_paper'];
					$data['practical'] = $row['practical'];
					$data['viva'] = $row['viva'];
					$data['internal'] = $row['internal'];
					$data['external'] = $row['external'];
					$data['total_amount'] = $row['total_amount'];
					$data['da_ta_amount'] = $row['da_ta_amount'];
					array_push($res['data'], $data);
				}
			}
			$res['err'] = 0;
		 	$res['result'] = 'Success';
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