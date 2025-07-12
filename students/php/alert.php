<?php
  require_once 'db.php';
  require_once 'constant.php';
  $res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

  if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

    if ($op == 'internal_alert') {
      $receiver = mysqli_real_escape_string($connect, $_POST['receiver']);
      $subject = mysqli_real_escape_string($connect, $_POST['subject']);
      $msg = mysqli_real_escape_string($connect, $_POST['msg']);

      if ($receiver == 'all') {
        $sql = "SELECT staff_mail FROM `staff_details`";
      } else {
        $sql = "SELECT staff_mail FROM `staff_details` WHERE staff_mail = '".$receiver."'";
      }
        $fetch = mysqli_query($connect,$sql);
        if(mysqli_num_rows($fetch) > 0){
          $i=0;
          while($row = mysqli_fetch_assoc($fetch)){
              $result[$i] = $row['staff_mail'];
              $i++;
          }
        }else{
            $response['err']=1;
            $response['msg']="No Data Found !!!";
            echo json_encode($response);
            exit();
        }
          require_once '../vendor/mailer/PHPMailerAutoload.php';
    			$mail = new PHPMailer;

	      	$mail->SMTPDebug = 3;
	      	$mail->IsSMTP(); // Enable verbose debug output
		  	  $mail->SMTPOptions  = array('ssl' => array('verify_peer' => false,'verify_peer_name'=>false, 'allow_self_signed'=>true) );                                 // TCP port to connect
	      	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	      	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	      	$mail->Username = MAIL_ID;                 // SMTP username
	      	$mail->Password = MAIL_PASS;                           // SMTP password
	      	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	      	$mail->Port = 465;                                    // TCP port to connect
          for ($i=0; $i <count($result); $i++) {
              $mail->setFrom($result[$i],"Notification From clg");
              $mail->addAddress($result[$i],"Notification From clg");     // Add a recipient
          }
    			$mail->isHTML(true);                                  // Set email format to HTML
    			$mail->Subject = $subject;
          $mail->Body = $msg;
          $val = $mail->send();

        if ($val) {
          $res['result'] = "Mail Sending Successfully";
          $res['err'] = 0;
          $res['query'] = $sql;
        } else {
          $res['result'] = "Mail Sending Failed";
          $res['err'] = 100;
          $res['query'] = $sql;
        }
  			echo json_encode($res);
    }
  } else {
  		$res['err'] = 501;
  		$res['result'] = "Empty op tag";
  		echo json_encode($res);
  	}

  	require_once 'db_close.php';
  ?>
