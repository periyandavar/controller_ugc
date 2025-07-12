<?php
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'db.php';
	require_once 'constant.php';
	require_once 'class/getStudentData.php';
	require_once 'class/getRegisterNo.php';
	require_once 'template.php';
	require_once 'savePDF.php';
	require_once 'class/getPath.php';
	require_once '../generate_vendor/vendor/autoload.php';

	$studentData = new getStudentData;
	$hallTicketTemplate = new template;
	$hallTicketRegisterNo = new getRegisterNo;
	$hallTicketSave = new savePDF;

	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'reg_hall_ticket') { // start regular exam time table
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$academic_yr =  mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester =  mysqli_real_escape_string($connect, $_POST['semester']);
			$month =  mysqli_real_escape_string($connect, $_POST['month']);
			$fetch = mysqli_fetch_array(mysqli_query($connect,"SELECT count(*) as status FROM `student_master` WHERE hallticket_stat != 0"));

			if ($fetch['status'] == 0) {
				$res['err'] = "111";
				$res['result'] = "Please acquire a  Permission first !!!";
				$res['status'] = $fetch['status'];
				$res['query'] = "SELECT count(*) as status FROM `student_master` WHERE hallticket_stat != 0";
			} else {
				$path = "output/hallticket/$dept_code/$academic_yr/$semester/";
				$file_save = $hallTicketSave->save_folder($path);
				$hallTicketRegisterNo->academic_year = $academic_yr;
				$hallTicketRegisterNo->dept_code = $dept_code;
				$studentData->sem = $semester;
				$register_no_input = $hallTicketRegisterNo->register_no();
				$count = count($register_no_input);
				for ($i=0; $i < $count; $i++) {
					$studentData->register_no = $register_no_input[$i];
					$personal_detail = $studentData->personal_detail();
					list($register_no,$name,$class,$course,$photo) = $studentData->personal_detail();
					$subject_1 = $studentData->subject_1();
					$subject_2 = $studentData->subject_2();
					$subject_3 = $studentData->subject_3();
					$subject_4 = $studentData->subject_4();
					$subject_5 = $studentData->subject_5();
					$subject_6 = $studentData->subject_6();
					$subject_7 = $studentData->subject_7();
					$subject_8 = $studentData->subject_8();
					$subject_9 = $studentData->subject_9();
					$exam_year = $studentData->exam_year();
					$issue_date = $studentData->issue_date();
					$date_1 = $studentData->date_1();
					$date_2 = $studentData->date_2();
					$date_3 = $studentData->date_3();
					$date_4 = $studentData->date_4();
					$date_5 = $studentData->date_5();
					$date_6 = $studentData->date_6();
					$date_7 = $studentData->date_7();
					$date_8 = $studentData->date_8();
					$date_9 = $studentData->date_9();
					$arrear_subject_1 = $studentData->arrear_subject_1();
					$arrear_subject_2 = $studentData->arrear_subject_2();
					$arrear_subject_3 = $studentData->arrear_subject_3();
					$arrear_subject_4 = $studentData->arrear_subject_4();
					$arrear_subject_5 = $studentData->arrear_subject_5();
					$arrear_subject_6 = $studentData->arrear_subject_6();
					$arrear_subject_7 = $studentData->arrear_subject_7();
					$arrear_date_1 = $studentData->arrear_date_1();
					$arrear_date_2 = $studentData->arrear_date_2();
					$arrear_date_3 = $studentData->arrear_date_3();
					$arrear_date_4 = $studentData->arrear_date_4();
					$arrear_date_5 = $studentData->arrear_date_5();
					$arrear_date_6 = $studentData->arrear_date_6();
					$arrear_date_7 = $studentData->arrear_date_7();
					$arrear_session_1 = $studentData->arrear_session_1();
					$arrear_session_2 = $studentData->arrear_session_2();
					$arrear_session_3 = $studentData->arrear_session_3();
					$arrear_session_4 = $studentData->arrear_session_4();
					$arrear_session_5 = $studentData->arrear_session_5();
					$arrear_session_6 = $studentData->arrear_session_6();
					$arrear_session_7 = $studentData->arrear_session_7();
					$logo = $studentData->logo();

					$hallticket_html = $hallTicketTemplate->generate_marksheet($register_no,$name,$class,$course,$photo,$class_year,$subject_1,$subject_2,$subject_3,$subject_4,$subject_5,$subject_6,$subject_7,$subject_8,$subject_9,$exam_year,$month,$issue_date,$date_1,$date_2,$date_3,$date_4,$date_5,$date_6,$date_7,$date_8,$date_9,$session_1,$session_2,$session_3,$session_4,$session_5,$session_6,$session_7,$session_8,$session_9,$arrear_subject_1,$arrear_subject_2,$arrear_subject_3,$arrear_subject_4,$arrear_subject_5,$arrear_subject_6,$arrear_subject_7,$arrear_date_1,$arrear_date_2,$arrear_date_3,$arrear_date_4,$arrear_date_5,$arrear_date_6,$arrear_date_7,$arrear_session_1,$arrear_session_2,$arrear_session_3,$arrear_session_4,$arrear_session_5,$arrear_session_6,$arrear_session_7,$logo,$path);

					$hallticket_pdf=$hallTicketTemplate->generate_pdf($register_no,$hallticket_html,$path);
	        $hallticket_pdf=$hallTicketTemplate->write_image($register_no,$photo,$path);
	        $file_save=$hallTicketSave->run_pdf($path);

					if (!$file_save) {
						$res['err'] = 0;
						$res['result'] = 'Generating Successfully';
					} else {
						$res['err'] = 100;
						$res['result'] = 'Generating Failed';
					}
				}
			}
			echo json_encode($res);
		} elseif ($op == 'missed_hall_ticket') {
				$register_no = mysqli_real_escape_string($connect,$_POST['reg_no']);
				$semester = mysqli_real_escape_string($connect,$_POST['semester']);
				$hallticketPath = new getPath;
				$hallticketPath->register_no = $register_no;
				list($dept_code,$academic_year) = $hallticketPath->filePath();
				// echo $dept_code;
				// echo $academic_year;
				$path = "output/hallticket/$dept_code/$academic_year/$semester/";
				$file_path=$path.$register_no.'.pdf';
				if ($file_path) {
					$res['err'] = 0;
					$res['result'] = 'Fetching Successfully';
					$res['path'] = OUTPUT_PATH.$file_path;
				} else {
					$res['err'] = 10;
					$res['result'] = 'Fetching Failed';
					$res['path'] = OUTPUT_PATH.$file_path;
				}
				echo json_encode($res);
		} elseif ($op == 'send_hall_ticket') {
			$dept_code =  mysqli_real_escape_string($connect, $_POST['dept_code']);
			$semester = mysqli_real_escape_string($connect, $_POST['sem']);
			$academic_year = mysqli_real_escape_string($connect, $_POST['aca_yr']);
			$path = "output/hallticket/$dept_code/$academic_year/$semester/";
			if($semester==1) {
			    $hallticket_stat=1;
			}elseif($semester==2) {
			    $hallticket_stat=2;
			}elseif($semester==3) {
			    $hallticket_stat=3;
			}elseif($semester==4) {
			    $hallticket_stat=4;
			}elseif($semester==5) {
			    $hallticket_stat=5;
			}elseif($semester==6) {
			    $hallticket_stat=6;
			}
			$disp=mysqli_query($connect,"SELECT register_no,email_id,name FROM student_master WHERE dept_code='$dept_code' AND academic_year='$academic_year' AND hallticket_stat='$hallticket_stat'");
			if (mysqli_num_rows($disp) > 0) {
				while($row = mysqli_fetch_array($disp)) {
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

					$mail->setFrom(MAIL_ID, 'clg PG CONTROLLER OFFICE');
					$mail->addAddress($row['email_id']);     // Add a recipient
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'HALL TICKET';
					$mail->addAttachment($path.$row['register_no'].'.pdf');
				 	$mail->Body = '<p>Dear '.$row["name"].'., <br><br> Please see the attached file for your hall ticket. The hard copy of the hall ticket should be submitted, on demand, for verification by the supervisor during the terminal. <br><br>
					P.SIVASAMY <br> COE (P.G. Courses) <br> Please do not reply to this automated e-mail. Request you to contact the office of COE (P.G. Courses) in case you have any queries.
					<br><br>'.$path.$row["register_no"].'.pdf</p>';
					$send = $mail->send();
				}
				if ($send) {
					$res['err'] = 0;
					$res['result'] = "Sending Successfully";
					echo json_encode($res);
				} else {
					$res['err'] = 100;
					$res['result'] = "Sending Failed";
					echo json_encode($res);
				}
			}
		}
		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}

	require_once 'db_close.php';
?>
