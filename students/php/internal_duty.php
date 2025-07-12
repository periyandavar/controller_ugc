<?php
	require_once 'db.php';
	require_once 'constant.php';
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'internal_duty') {
			$sub_code =  mysqli_real_escape_string($connect, $_POST['sub_code']);
			$sql = "SELECT * FROM `internal_duty` WHERE subcode = '".$sub_code."' AND hours > 2";
			$ele = mysqli_fetch_array(mysqli_query($connect,$sql));
			$res['subject'] = $ele['subject'];
			$res['staff_name'] = $ele['stname'];
			$res['staff_id'] = $ele['staffid'];
			$res['query'] = $sql;
			$res['result'] = 'Data Fetched';
			$res['err'] = 0;
			echo json_encode($res);
		} else if ($op == 'mail_service') {
			$sub_code1 =  mysqli_real_escape_string($connect, $_POST['sub_code1']);
			$sub_code2 =  mysqli_real_escape_string($connect, $_POST['sub_code2']);
			$sub_code3 =  mysqli_real_escape_string($connect, $_POST['sub_code3']);
			$sub_title1 =  mysqli_real_escape_string($connect, $_POST['sub_title1']);
			$sub_title2 =  mysqli_real_escape_string($connect, $_POST['sub_title2']);
			$sub_title3 =  mysqli_real_escape_string($connect, $_POST['sub_title3']);
			$d_o_e1 =  mysqli_real_escape_string($connect, $_POST['d_o_e1']);
			$d_o_e2 =  mysqli_real_escape_string($connect, $_POST['d_o_e2']);
			$d_o_e3 =  mysqli_real_escape_string($connect, $_POST['d_o_e3']);

			$staffid =  mysqli_real_escape_string($connect, $_POST['staffid']);
			$name =  mysqli_real_escape_string($connect, $_POST['name']);

			$sql = "SELECT * FROM `staff_details` WHERE staff_id = '".$staffid."'";
			$ele = mysqli_fetch_array(mysqli_query($connect,$sql));
			require_once '../vendor/mailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;

    	$mail->SMTPDebug = 3;
    	$mail->IsSMTP(); // Enable verbose debug output
  		$mail->SMTPOptions  = array('ssl' => array('verify_peer' => false,'verify_peer_name'=>false, 'allow_self_signed'=>true) ); // TCP port to connect
    	$mail->Host = 'smtp.gmail.com';  					 // Specify main and backup SMTP servers
    	$mail->SMTPAuth = true;                    // Enable SMTP authentication
    	$mail->Username = MAIL_ID;                 // SMTP username
    	$mail->Password = MAIL_PASS;              // SMTP password
    	$mail->SMTPSecure = 'ssl';               // Enable TLS encryption, `ssl` also accepted
    	$mail->Port = 465;                      // TCP port to connect

			$mail->setFrom(MAIL_ID, 'clg PG Control Office');
			$mail->addAddress($ele['staff_mail']);    // Add a recipient
			$mail->isHTML(true);                      // Set email format to HTML
			$mail->Subject = 'PG Control Office';
			$mail->Body    = '<!DOCTYPE html>
<html>
<head>
	<title>Demo Module</title>
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
	<div id="navbar">
		<img src="../uploads/clg/clg.png" alt="clg LOGO" align="left" height="150px" width="150px">
		<p> <b> <center> <h3> AYYA NADAR JANAKI AMMAL COLLEGE (Autonomous), SIVAKASI </h3> <center> </b> </p>
		<p> <b> <center> <h4> OFFICE OF THE CONTROLLER OF EXAMINATIONS (P.G. COURSES) <br><br> TERMINAL EXAMINATIONS </h4> </center> </b> </p>
	</div>
	<div class="content">
		<label>Dear '.$name.' </label> <br><br>
		<label>You are assigned the following duty pertaining to (April 2018) Terminal Examinations</label>
	</div>
	<div class="content">
		<table border="1" cellpadding="13px" align="center">
			<thead align="center">
				<th>Code</th>
				<th>Title of the Paper</th>
				<th>Date of Exam</th>
				<th>Nature of the Duty</th>
			</thead>
			<tbody align="center">
				<tr>
					<td>'.$sub_code1.'</td>
					<td>'.$sub_title1.'</td>
					<td>'.$d_o_e1.'</td>
					<td>A</td>
				</tr>
				<tr>
					<td>'.$sub_code2.'</td>
					<td>'.$sub_title2.'</td>
					<td>'.$d_o_e2.'</td>
					<td>B</td>
				</tr>
				<tr>
					<td>'.$sub_code3.'</td>
					<td>'.$sub_title3.'</td>
					<td>'.$d_o_e3.'</td>
					<td>C</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="content">
		<label>Thank You</label> <br><br>
		<label align="right"> Yours sincerely, </label>
	</div>
</body>
</html>';
			// $val = $mail->send();

			if ($mail->send()) {
				$res['result'] = "Mail Sending Successfully";
				$res['err'] = 0;
			} else {
				$res['result'] = "Mail Sending Failed";
				$res['err'] = 100;
			}
			echo json_encode($res);
		} else if ($op == "preview") {
			$sc1 =  mysqli_real_escape_string($connect, $_POST['sc1']);
			$sc2 =  mysqli_real_escape_string($connect, $_POST['sc2']);
			$sc3 =  mysqli_real_escape_string($connect, $_POST['sc3']);
			$s1 =  mysqli_real_escape_string($connect, $_POST['s1']);
			$s2 =  mysqli_real_escape_string($connect, $_POST['s2']);
			$s3 =  mysqli_real_escape_string($connect, $_POST['s3']);
			$sid1 =  mysqli_real_escape_string($connect, $_POST['sid1']);
			$sid2 =  mysqli_real_escape_string($connect, $_POST['sid2']);
			$sid3 =  mysqli_real_escape_string($connect, $_POST['sid3']);
			$sn1 =  mysqli_real_escape_string($connect, $_POST['sn1']);
			$sn2 =  mysqli_real_escape_string($connect, $_POST['sn2']);
			$sn3 =  mysqli_real_escape_string($connect, $_POST['sn3']);

			require_once "../vendor/phptopdf/phpToPDF.php";

// PUT YOUR HTML IN A VARIABLE
$my_html='<!DOCTYPE html>
<html>
<head>
	<title>Demo Module</title>
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
	<div id="navbar">
		<img src="../uploads/clg/clg.png" alt="clg LOGO" align="left" height="130px" width="130px">
		<p> <b> <center> <h3> AYYA NADAR JANAKI AMMAL COLLEGE (Autonomous), SIVAKASI </h3> <center> </b> </p>
		<p> <b> <center> <h4> OFFICE OF THE CONTROLLER OF EXAMINATIONS (P.G. COURSES) <br><br> TERMINAL EXAMINATIONS </h4> </center> </b> </p>
	</div>
	<div class="content">
		<label>Dear : </label> <br><br>
		<label>You are assigned the following duty pertaining to (April 2018) Terminal Examinations</label>
	</div>
	<div class="content">
		<table border="1" cellpadding="13px" align="center">
			<thead align="center">
				<th>Code</th>
				<th>Title of the Paper</th>
				<th>Date of Exam</th>
				<th>Nature of the Duty</th>
			</thead>
			<tbody align="center">
				<tr>
					<td>SE004</td>
					<td>Advance Java</td>
					<td>1/5/2019</td>
					<td>A</td>
				</tr>
				<tr>
					<td>SE004</td>
					<td>Advance Java</td>
					<td>1/5/2019</td>
					<td>B</td>
				</tr>
				<tr>
					<td>SE004</td>
					<td>Advance Java</td>
					<td>1/5/2019</td>
					<td>C</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="content">
		<label>Thank You</label> <br><br>
		<label align="right"> Yours sincerely, </label>
	</div>
	<!-- start footer -->
	<div class="footer">
		<label style="color: #000; font-weight: bold;"> Designed &amp; Developed By </label>
		<a href="arunandroid.anjanainfotech.in" target="_blank"><b> clg TECHNICAL TEAM</b></a>
	</div>
	<!-- stop footer -->
</body>
</html>';

// SET YOUR PDF OPTIONS
// FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
$pdf_options = array(
  "source_type" => 'html',
  "source" => $my_html,
  "action" => 'view',
  "save_directory" => '',
  "file_name" => 'demo.pdf');

// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

// OPTIONAL - PUT A LINK TO DOWNLOAD THE PDF YOU JUST CREATED
// echo ("<a href='html_01.pdf'>Download Your PDF</a>");
		/*$res['err'] = 0;
		$res['result'] = "Successfully";
echo json_encode($res);*/
		}
		// end of if condition op tag below
	} else {
		$res['err'] = 501;
		$res['result'] = "Empty op tag";
		echo json_encode($res);
	}
	require_once 'db_close.php';
?>
