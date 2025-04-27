<?php
	require_once 'db.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");
//  INSERT INTO `fees_structure`(`id`, `theory`, `practical1`, `practical2`, `comprehension`, `mini_project`, `arrear_theory`, `arrear_practical1`,
// `arrear_practical2`, `arrear_comprehension`, `arrear_mini_project`, `mark_stmt_amt`, `university_fees`, `provisional_fees`, `certificate_fees`,
// `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `type`, `status`)
// VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],
// [value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22])
	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'pgaided_fees') {
			$theory =  mysqli_real_escape_string($connect, $_POST['theory']);
			$prac4 =  mysqli_real_escape_string($connect, $_POST['prac4']);
			$prac6 =  mysqli_real_escape_string($connect, $_POST['prac6']);
			$com =  mysqli_real_escape_string($connect, $_POST['com']);
			$arr_theory =  mysqli_real_escape_string($connect, $_POST['arr_theory']);
			$arr_prac4 =  mysqli_real_escape_string($connect, $_POST['arr_prac4']);
			$arr_prac6 =  mysqli_real_escape_string($connect, $_POST['arr_prac6']);
			$arr_com =  mysqli_real_escape_string($connect, $_POST['arr_com']);
			$mark =  mysqli_real_escape_string($connect, $_POST['mark_stmt_amt']);
			$ld =  mysqli_real_escape_string($connect, $_POST['last_date']);
			$fine1 =  mysqli_real_escape_string($connect, $_POST['first_fine_amt']);
			$fine1d =  mysqli_real_escape_string($connect, $_POST['first_fine_last_date']);
			$finalfine =  mysqli_real_escape_string($connect, $_POST['final_fine_amt']);
			$finalfined =  mysqli_real_escape_string($connect, $_POST['final_fine_last_date']);
			$pro_fees =  mysqli_real_escape_string($connect, $_POST['pro_fees']);
			$certify_fees =  mysqli_real_escape_string($connect, $_POST['certi_fees']);

			$query = "INSERT INTO `fees_structure`(`theory`, `practical1`, `practical2`, `comprehension`, `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`,`mark_stmt_amt`,`last_date`,`first_fine_amt`,`first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`,`provisional_fees`, `certificate_fees`, `type`, `status`) VALUES ('".$theory."','".$prac4."','".$prac6."','".$com."','".$arr_theory."','".$arr_prac4."','".$arr_prac6."','".$arr_com."','".$mark."','".$ld."','".$fine1."','".$fine1d."','".$finalfine."','".$finalfined."','".$pro_fees."','".$certify_fees."','aided', b'0')";
			$sql = mysqli_query($connect,$query);

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Insert Successfully";
				$res['query'] = $query;
			} else {
				$res['err'] = 1;
				$res['result'] = "Insert Failed";
				$res['query'] = $query;
			}
			echo json_encode($res);
		} elseif ($op == 'pgaided_table') {
		$fetch = mysqli_query($connect, "SELECT * FROM `fees_structure` WHERE type='aided'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['id'];
					$data['theory'] = $ele['theory'];
					$data['prac_I'] = $ele['practical1'];
					$data['prac_II'] = $ele['practical2'];
					$data['com'] = $ele['comprehension'];
					$data['arr_theory'] = $ele['arrear_theory'];
					$data['arr_prac_I'] = $ele['arrear_practical1'];
					$data['arr_prac_II'] = $ele['arrear_practical2'];
					$data['arr_com'] = $ele['arrear_comprehension'];
					$data['mark_stmt_amt'] = $ele['mark_stmt_amt'];
					$data['pro_fees'] = $ele['provisional_fees'];
					$data['certi_fees'] = $ele['certificate_fees'];
					$data['last_date'] = $ele['last_date'];
					$data['first_fine_amt'] = $ele['first_fine_amt'];
					$data['first_fine_date'] = $ele['first_fine_last_date'];
					$data['final_fine_amt'] = $ele['final_fine_amt'];
					$data['final_fine_date'] = $ele['final_fine_last_date'];
					$data['status'] = $ele['status'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Fees Amount was loaded';
			}else{
				$res['err'] = 2;
				$res['result'] = 'Fees Amount was not found';
			}
			echo json_encode($res);
	} elseif ($op == 'pgself_fees') {
		$theory =  mysqli_real_escape_string($connect, $_POST['theory']);
		$prac3 =  mysqli_real_escape_string($connect, $_POST['prac3']);
		$prac9 =  mysqli_real_escape_string($connect, $_POST['prac9']);
		$com =  mysqli_real_escape_string($connect, $_POST['com']);
		$mini =  mysqli_real_escape_string($connect, $_POST['mini']);
		$arr_theory =  mysqli_real_escape_string($connect, $_POST['arr_theory']);
		$arr_prac3 =  mysqli_real_escape_string($connect, $_POST['arr_prac3']);
		$arr_prac9 =  mysqli_real_escape_string($connect, $_POST['arr_prac9']);
		$arr_com =  mysqli_real_escape_string($connect, $_POST['arr_com']);
		$arr_mini =  mysqli_real_escape_string($connect, $_POST['arr_mini']);
		$mark =  mysqli_real_escape_string($connect, $_POST['mark_stmt_amt']);
		$ld =  mysqli_real_escape_string($connect, $_POST['last_date']);
		$fine1 =  mysqli_real_escape_string($connect, $_POST['first_fine_amt']);
		$fine1d =  mysqli_real_escape_string($connect, $_POST['first_fine_last_date']);
		$finalfine =  mysqli_real_escape_string($connect, $_POST['final_fine_amt']);
		$finalfined =  mysqli_real_escape_string($connect, $_POST['final_fine_last_date']);
		$pro_fees =  mysqli_real_escape_string($connect, $_POST['pro_fees']);
		$certify_fees =  mysqli_real_escape_string($connect, $_POST['certi_fees']);

		$query = "INSERT INTO `fees_structure`(`theory`, `practical1`, `practical2`, `comprehension`, `mini_project`, `arrear_theory`, `arrear_practical1`, `arrear_practical2`, `arrear_comprehension`, `arrear_mini_project`, `mark_stmt_amt`, `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `provisional_fees`, `certificate_fees`, `type`, `status`) VALUES ('".$theory."', '".$prac3."', '".$prac9."','".$com."', '".$mini."', '".$arr_theory."', '".$arr_prac3."', '".$arr_prac9."', '".$arr_com."', '".$arr_mini."', '".$mark."', '".$ld."','".$fine1."', '".$fine1d."', '".$finalfine."', '".$finalfined."', '".$pro_fees."', '".$certify_fees."', 'self' , b'0')";
		$sql = mysqli_query($connect,$query);

		if ($sql === true) {
			$res['err'] = 0;
			$res['result'] = "Insert Successfully";
			$res['query'] = $query;
		} else {
			$res['err'] = 3;
			$res['result'] = "Insert Failed";
			$res['query'] = $query;
		}
		echo json_encode($res);
	} elseif ($op == 'pgself_table') {
	$fetch = mysqli_query($connect, "SELECT * FROM `fees_structure` WHERE type = 'self'");
		if (mysqli_num_rows($fetch) > 0) {
			$data = array();
			$res['data'] = array();
			while ($ele = mysqli_fetch_array($fetch)) {
				$data['id'] = $ele['id'];
				$data['theory'] = $ele['theory'];
				$data['prac_I'] = $ele['practical1'];
				$data['prac_II'] = $ele['practical2'];
				$data['com'] = $ele['comprehension'];
				$data['mini'] = $ele['mini_project'];
				$data['arr_theory'] = $ele['arrear_theory'];
				$data['arr_prac_I'] = $ele['arrear_practical1'];
				$data['arr_prac_II'] = $ele['arrear_practical2'];
				$data['arr_com'] = $ele['arrear_comprehension'];
				$data['arr_mini'] = $ele['arrear_mini_project'];
				$data['mark_stmt_amt'] = $ele['mark_stmt_amt'];
				$data['last_date'] = $ele['last_date'];
				$data['first_fine_amt'] = $ele['first_fine_amt'];
				$data['first_fine_date'] = $ele['first_fine_last_date'];
				$data['final_fine_amt'] = $ele['final_fine_amt'];
				$data['final_fine_date'] = $ele['final_fine_last_date'];
				$data['pro_fees'] = $ele['provisional_fees'];
				$data['certi_fees'] = $ele['certificate_fees'];
				$data['status'] = $ele['status'];
				array_push($res['data'], $data);
			}
			$res['err'] = 0;
			$res['result'] = 'Fees Amount was loaded';
		}else{
			$res['err'] = 4;
			$res['result'] = 'Fees Amount was not found';
		}
		echo json_encode($res);
	}elseif ($op == 'pgdiploma_fees') {
		$theory =  mysqli_real_escape_string($connect, $_POST['theory']);
		$prac =  mysqli_real_escape_string($connect, $_POST['prac']);
		$arr_theory =  mysqli_real_escape_string($connect, $_POST['arr_theory']);
		$arr_prac =  mysqli_real_escape_string($connect, $_POST['arr_prac']);
		$mark =  mysqli_real_escape_string($connect, $_POST['mark_stmt_amt']);
		$ld =  mysqli_real_escape_string($connect, $_POST['last_date']);
		$fine1 =  mysqli_real_escape_string($connect, $_POST['first_fine_amt']);
		$fine1d =  mysqli_real_escape_string($connect, $_POST['first_fine_last_date']);
		$finalfine =  mysqli_real_escape_string($connect, $_POST['final_fine_amt']);
		$finalfined =  mysqli_real_escape_string($connect, $_POST['final_fine_last_date']);
		$pro_fees =  mysqli_real_escape_string($connect, $_POST['pro_fees']);
		$certify_fees =  mysqli_real_escape_string($connect, $_POST['certi_fees']);

		$query = "INSERT INTO `fees_structure`(`theory`, `practical1`, `arrear_theory`, `arrear_practical1`, `mark_stmt_amt`, `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `provisional_fees`, `certificate_fees`, `type`, `status`) VALUES ('".$theory."', '".$prac."', '".$arr_theory."', '".$arr_prac."', '".$mark."', '".$ld."', '".$fine1."', '".$fine1d."','".$finalfine."', '".$finalfined."', '".$pro_fees."', '".$certify_fees."', 'diploma', b'0')";
		$sql = mysqli_query($connect,$query);

		if ($sql === true) {
			$res['err'] = 0;
			$res['result'] = 'Insert Successfully';
			$res['query'] = $query;
		} else {
			$res['err'] = 5;
			$res['result'] = 'Insert Failed';
			$res['query'] = $query;
		}
		echo json_encode($res);
	} elseif ($op == 'pgdiploma_table') {
		$fetch = mysqli_query($connect, "SELECT * FROM `fees_structure` WHERE type = 'diploma'");
		if (mysqli_num_rows($fetch) > 0) {
			$data = array();
			$res['data'] = array();
			while ($ele = mysqli_fetch_array($fetch)) {
				$data['id'] = $ele['id'];
				$data['theory'] = $ele['theory'];
				$data['prac_I'] = $ele['practical1'];
				$data['arr_theory'] = $ele['arrear_theory'];
				$data['arr_prac_I'] = $ele['arrear_practical1'];
				$data['mark_stmt_amt'] = $ele['mark_stmt_amt'];
				$data['last_date'] = $ele['last_date'];
				$data['first_fine_amt'] = $ele['first_fine_amt'];
				$data['first_fine_date'] = $ele['first_fine_last_date'];
				$data['final_fine_amt'] = $ele['final_fine_amt'];
				$data['final_fine_date'] = $ele['final_fine_last_date'];
				$data['pro_fees'] = $ele['provisional_fees'];
				$data['certi_fees'] = $ele['certificate_fees'];
				$data['status'] = $ele['status'];
				array_push($res['data'], $data);
			}
			$res['err'] = 0;
			$res['result'] = 'Fees Amount was loaded';
		}else{
			$res['err'] = 6;
			$res['result'] = 'Fees Amount was not found';
		}
		echo json_encode($res);
	} elseif ($op == 'pgcertify_fees') {
		$theory =  mysqli_real_escape_string($connect, $_POST['theory']);
		$prac =  mysqli_real_escape_string($connect, $_POST['prac']);
		$arr_theory =  mysqli_real_escape_string($connect, $_POST['arr_theory']);
		$arr_prac =  mysqli_real_escape_string($connect, $_POST['arr_prac']);
		$mark =  mysqli_real_escape_string($connect, $_POST['mark_stmt_amt']);
		$pro_fees =  mysqli_real_escape_string($connect, $_POST['pro_fees']);
		$certify_fees =  mysqli_real_escape_string($connect, $_POST['certi_fees']);
		$ld =  mysqli_real_escape_string($connect, $_POST['last_date']);
		$fine1 =  mysqli_real_escape_string($connect, $_POST['first_fine_amt']);
		$fine1d =  mysqli_real_escape_string($connect, $_POST['first_fine_last_date']);
		$finalfine =  mysqli_real_escape_string($connect, $_POST['final_fine_amt']);
		$finalfined =  mysqli_real_escape_string($connect, $_POST['final_fine_last_date']);

		$query = "INSERT INTO `fees_structure`(`theory`, `practical1`, `arrear_theory`, `arrear_practical1`, `mark_stmt_amt`, `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `provisional_fees`, `certificate_fees`, `type`, `status`) VALUES ('".$theory."', '".$prac."', '".$arr_theory."', '".$arr_prac."', '".$mark."', '".$ld."', '".$fine1."', '".$fine1d."','".$finalfine."', '".$finalfined."', '".$pro_fees."', '".$certify_fees."', 'certificate', b'0')";
		$sql = mysqli_query($connect,$query);

		if ($sql === true) {
			$res['err'] = 0;
			$res['result'] = 'Insert Successfully';
			$res['query'] = $query;
		} else {
			$res['err'] = 7;
			$res['result'] = 'Insert Failed';
			$res['query'] = $query;
		}
		echo json_encode($res);
	} elseif ($op == 'pgcertify_table') {
		$fetch = mysqli_query($connect, "SELECT * FROM `fees_structure` WHERE type = 'certificate'");
		if (mysqli_num_rows($fetch) > 0) {
			$data = array();
			$res['data'] = array();
			while ($ele = mysqli_fetch_array($fetch)) {
				$data['id'] = $ele['id'];
				$data['theory'] = $ele['theory'];
				$data['prac_I'] = $ele['practical1'];
				$data['arr_theory'] = $ele['arrear_theory'];
				$data['arr_prac_I'] = $ele['arrear_practical1'];
				$data['mark_stmt_amt'] = $ele['mark_stmt_amt'];
				$data['pro_fees'] = $ele['provisional_fees'];
				$data['certi_fees'] = $ele['certificate_fees'];
				$data['last_date'] = $ele['last_date'];
				$data['first_fine_amt'] = $ele['first_fine_amt'];
				$data['first_fine_date'] = $ele['first_fine_last_date'];
				$data['final_fine_amt'] = $ele['final_fine_amt'];
				$data['final_fine_date'] = $ele['final_fine_last_date'];
				$data['status'] = $ele['status'];
				array_push($res['data'], $data);
			}
			$res['err'] = 0;
			$res['result'] = 'Fees Amount was loaded';
		}else{
			$res['err'] = 8;
			$res['result'] = 'Fees Amount was not found';
		}
		echo json_encode($res);
	} elseif ($op == 'mphil_fees') {
		$theory =  mysqli_real_escape_string($connect, $_POST['theory']);
		$prac =  mysqli_real_escape_string($connect, $_POST['prac']);
		$arr_theory =  mysqli_real_escape_string($connect, $_POST['arr_theory']);
		$arr_prac =  mysqli_real_escape_string($connect, $_POST['arr_prac']);
		$mark =  mysqli_real_escape_string($connect, $_POST['mark_stmt_amt']);
		$univer_fees =  mysqli_real_escape_string($connect, $_POST['univer_fees']);
		$ld =  mysqli_real_escape_string($connect, $_POST['last_date']);
		$fine1 =  mysqli_real_escape_string($connect, $_POST['first_fine_amt']);
		$fine1d =  mysqli_real_escape_string($connect, $_POST['first_fine_last_date']);
		$finalfine =  mysqli_real_escape_string($connect, $_POST['final_fine_amt']);
		$finalfined =  mysqli_real_escape_string($connect, $_POST['final_fine_last_date']);
		$pro_fees =  mysqli_real_escape_string($connect, $_POST['pro_fees']);
		$certify_fees =  mysqli_real_escape_string($connect, $_POST['certi_fees']);

		$query = "INSERT INTO `fees_structure`(`theory`, `practical1`, `arrear_theory`, `arrear_practical1`, `mark_stmt_amt`, `university_fees`, `last_date`, `first_fine_amt`, `first_fine_last_date`, `final_fine_amt`, `final_fine_last_date`, `provisional_fees`, `certificate_fees`, `type`, `status`) VALUES ('".$theory."', '".$prac."', '".$arr_theory."', '".$arr_prac."', '".$mark."', '".$univer_fees."', '".$ld."', '".$fine1."', '".$fine1d."', '".$finalfine."', '".$finalfined."', '".$pro_fees."', '".$certify_fees."', 'mphil', b'0')";
		$sql = mysqli_query($connect,$query);

		if ($sql === true) {
			$res['err'] = 0;
			$res['result'] = "Insert Successfully";
			$res['query'] = $query;
		} else {
			$res['err'] = 9;
			$res['result'] = "Insert Failed";
			$res['query'] = $query;
		}
		echo json_encode($res);
	} elseif ($op == 'mphil_table') {
	$fetch = mysqli_query($connect, "SELECT * FROM `fees_structure` WHERE type = 'mphil'");
		if (mysqli_num_rows($fetch) > 0) {
			$data = array();
			$res['data'] = array();
			while ($ele = mysqli_fetch_array($fetch)) {
				$data['id'] = $ele['id'];
				$data['theory'] = $ele['theory'];
				$data['prac_I'] = $ele['practical1'];
				$data['arr_theory'] = $ele['arrear_theory'];
				$data['arr_prac_I'] = $ele['arrear_practical1'];
				$data['mark_stmt_amt'] = $ele['mark_stmt_amt'];
				$data['univer_fees'] = $ele['university_fees'];
				$data['last_date'] = $ele['last_date'];
				$data['first_fine_amt'] = $ele['first_fine_amt'];
				$data['first_fine_date'] = $ele['first_fine_last_date'];
				$data['final_fine_amt'] = $ele['final_fine_amt'];
				$data['final_fine_date'] = $ele['final_fine_last_date'];
				$data['pro_fees'] = $ele['provisional_fees'];
				$data['certi_fees'] = $ele['certificate_fees'];
				$data['status'] = $ele['status'];
				array_push($res['data'], $data);
			}
			$res['err'] = 0;
			$res['result'] = 'Fees Amount was loaded';
			echo json_encode($res);
		}else{
			$res['err'] = 10;
			$res['result'] = 'Fees Amount was not found';
			echo json_encode($res);
		}
	} elseif ($op == 'pgaided_feesActivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$row = mysqli_query($connect,"SELECT `status` FROM `fees_structure` WHERE status = b'1' AND type = 'aided'");
		if (mysqli_num_rows($row) > 0) {
			$res['err'] = 101;
			$res['result'] = 'Not permitted to activated fees structure';
		} else {
			$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Activated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Activated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'";
			}
		}
		echo json_encode($res);
	} elseif ($op == 'pgaided_feesDeactivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Dectivated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Deactivated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'aided'";
			}
		echo json_encode($res);
	} elseif ($op == 'pgself_feesActivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$row = mysqli_query($connect,"SELECT `status` FROM `fees_structure` WHERE status = b'1' AND type = 'self'");
		if (mysqli_num_rows($row) > 0) {
			$res['err'] = 102;
			$res['result'] = 'Not permitted to activated fees structure';
		} else {
			$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Activated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'";
			} else {
				$res['err'] = 202;
				$res['result'] = 'Activated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'";
			}
		}
		echo json_encode($res);
	} elseif ($op == 'pgself_feesDeactivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Dectivated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Deactivated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'self'";
			}
		echo json_encode($res);
	} elseif ($op == 'pgdiploma_feesActivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$row = mysqli_query($connect,"SELECT `status` FROM `fees_structure` WHERE status = b'1' AND type = 'diploma'");
		if (mysqli_num_rows($row) > 0) {
			$res['err'] = 103;
			$res['result'] = 'Not permitted to activated fees structure';
		} else {
			$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Activated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'";
			} else {
				$res['err'] = 203;
				$res['result'] = 'Activated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'";
			}
		}
		echo json_encode($res);
	} elseif ($op == 'pgdiploma_feesDeactivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Dectivated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Deactivated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'diploma'";
			}
		echo json_encode($res);
	} elseif ($op == 'pgcertify_feesActivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$row = mysqli_query($connect,"SELECT `status` FROM `fees_structure` WHERE status = b'1'  AND type = 'certificate'");
		if (mysqli_num_rows($row) > 0) {
			$res['err'] = 104;
			$res['result'] = 'Not permitted to activated fees structure';
		} else {
			$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Activated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'";
			} else {
				$res['err'] = 204;
				$res['result'] = 'Activated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'";
			}
		}
		echo json_encode($res);
	} elseif ($op == 'pgcertify_feesDeactivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Dectivated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Deactivated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'certificate'";
			}
		echo json_encode($res);
	} elseif ($op == 'mphil_feesActivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$row = mysqli_query($connect,"SELECT `status` FROM `fees_structure` WHERE status = b'1' AND type = 'mphil'");
		if (mysqli_num_rows($row) > 0) {
			$res['err'] = 105;
			$res['result'] = 'Not permitted to activated fees structure';
		} else {
			$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Activated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'";
			} else {
				$res['err'] = 205;
				$res['result'] = 'Activated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'";
			}
		}
		echo json_encode($res);
	} elseif ($op == 'mphil_feesDeactivated') {
		$status = mysqli_real_escape_string($connect,$_POST['status']);
		$id = mysqli_real_escape_string($connect,$_POST['id']);
		$ele = mysqli_query($connect,"UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'");
			if ($ele === true) {
				$res['err'] = 0;
				$res['result'] = 'Dectivated successfully';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'";
			} else {
				$res['err'] = 201;
				$res['result'] = 'Deactivated Failed';
				$res['query'] = "UPDATE `fees_structure` SET `status`=b'".$status."' WHERE `id` = '".$id."' AND type = 'mphil'";
			}
		echo json_encode($res);
	} else {
		$res['err'] = 120;
		$res['result'] = "Invalid op tag";
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
