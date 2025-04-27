<?php
	require_once 'db.php';
	require_once 'constant.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;
		// department module start...
		if ($op == 'result_publish') {
			$academic_year =  mysqli_real_escape_string($connect, $_POST['academic_year']);
			$graduate =  mysqli_real_escape_string($connect, $_POST['graduate']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$online_date =  mysqli_real_escape_string($connect, $_POST['online_date']);

			$sql = mysqli_query($connect,"INSERT INTO `publish`(`aca_yr`, `year`, `sem`, `date`) VALUES('".$academic_year."','".$graduate."', '".$semester."','".$online_date."')");

			if ($sql === true) {
				$res['err'] = 0;
				$res['result'] = "Published Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 1;
				$res['result'] = "Published Failed";
				echo json_encode($res);
			}
		} elseif ($op == 'hall_ticket_request') {
			$academic_year =  mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);

			require_once '../vendor/mailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;

    	$mail->SMTPDebug = 0;
    	$mail->IsSMTP(); // Enable verbose debug output
  		$mail->SMTPOptions  = array('ssl' => array('verify_peer' => false,'verify_peer_name'=>false, 'allow_self_signed'=>true) );                                 // TCP port to connect
    	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    	$mail->SMTPAuth = true;                               // Enable SMTP authentication
    	$mail->Username = MAIL_ID;                 // SMTP username
    	$mail->Password = MAIL_PASS;                           // SMTP password
    	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    	$mail->Port = 465;                                    // TCP port to connect

			$mail->setFrom(MAIL_ID, 'PG CONTROLLER OFFICE');
			$mail->addAddress(MAIL_ID);     // Add a recipient
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Hall Ticket';
			$url = "http://localhost:8000/adminPanel/adminpanel/hallticket_permission.php?aca_yr=".$academic_year."&sem=".$semester;
		 	$mail->Body = '<p>Respected Sir., <br><br> I am in the process of generating regular paper hall ticket for' .$semester.' semester of ' .$academic_year.' academic year students.I am requesting permission to use your signature. <br><br>
			Please <a href="'.$url.'"  target="_blank">click here</a> to  permit generate hall ticket </p>';

			if ($mail->send()) {
				$res['err'] = 0;
				$res['result'] = "Request Sending Successfully";
				echo json_encode($res);
			} else {
				$res['err'] = 100;
				$res['result'] = "Request Sending Failed";
				echo json_encode($res);
			}
		}

		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
               /*<td><form method='post'><a href='deldept.php?del=$id' class='btn btn-primary' role='button' >DELETE</a></td>
               <td><form method='post'><a href='#?edit=$id'  data-toggle='modal'  class='btn btn-primary' data-target='#dept' role='button'>EDIT</a></td></form>*/
	require_once 'db_close.php';
?>
