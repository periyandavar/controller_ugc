<?php
  require_once 'db.php';
  require_once 'constant.php';
  if(true)
  {
      echo '<script>window.location.replace("https://anjaccoe.org/students/");</script>';
  }
  else
  {

  $sql = "SELECT `user` FROM `admin`";
  $ele = mysqli_fetch_array(mysqli_query($connect,$sql));
  require_once '../vendor/mailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;

  $mail->SMTPDebug = 0;  // disable debug msg
  $mail->IsSMTP(); // Enable verbose debug output
  $mail->SMTPOptions  = array('ssl' => array('verify_peer' => false,'verify_peer_name'=>false, 'allow_self_signed'=>true) );                                 // TCP port to connect
  $mail->Host = 'anjaccoe.org ';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username ='ugcontroller@anjaccoe.org';                 // SMTP username
  $mail->Password = 'AnjacCs2k19';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect

  $mail->setFrom('ugcontroller@anjaccoe.org', 'clg PG Control Office');
  $mail->addAddress('sharans961999@gmail.com');     // Add a recipient
  $mail->isHTML(true);               // Set email format to HTML
  $mail->Subject = 'Forgot Password';
  $mail->Body    = '<p>Forgot Your Password Please <a href="http://localhost:8000/AdminPanel/AdminPanel/forgot_password/index.php" target="_blank">click here </a>to create a New Password </p>';

  if ($mail->send()) {
    echo '<!DOCTYPE html>
    <html>
    <head>
    	<title>Forgot Password</title>
        <link rel="stylesheet" href="../css/custom.css">
    </head>
    <body>
    	<div id="navbar">
    		<img src="../uploads/clg/clg.png" alt="clg LOGO" align="left" height="150px" width="150px">
    		<p> <b> <center> <h3> AYYA NADAR JANAKI AMMAL COLLEGE (Autonomous), SIVAKASI </h3> <center> </b> </p>
    		<p> <b> <center> <h4> OFFICE OF THE CONTROLLER OF EXAMINATIONS (P.G. COURSES) <br><br> TERMINAL EXAMINATIONS </h4> </center> </b> </p>
    	</div>
      <div class="card_custom">
      	<div class="content" align="center">
          <img src="../img/success.png" height="150px" width="150px">
      		<label><b><h2> Mail Sending Successfully !!! </h2></b></label> <br><br>
      		<h3><label> Please Check Your Mail Mr.Admin </label>
          <p><label> Then click a link and create your password. The link expries in 15 minutes </label></p></h3>
          <h4><label> Thank You </label></h4>
      	</div>
      </div>
    	<!-- start footer -->
    	<div class="footer">
    		<label style="color: #000; font-weight: bold;"> Designed &amp; Developed By </label>
    		<a href="arunandroid.anjanainfotech.in" target="_blank" style="margin-right: 3em;"> Arun Kumar G (16US41) </a>
    	</div>
    	<!-- stop footer -->
    </body>
    </html>
';
  } else {
    echo '<!DOCTYPE html>
    <html>
    <head>
    	<title>Forgot Password</title>
        <link rel="stylesheet" href="../css/custom.css">
    </head>
    <body>
    	<div id="navbar">
    		<img src="../uploads/clg/clg.png" alt="clg LOGO" align="left" height="150px" width="150px">
    		<p> <b> <center> <h3> AYYA NADAR JANAKI AMMAL COLLEGE (Autonomous), SIVAKASI </h3> <center> </b> </p>
    		<p> <b> <center> <h4> OFFICE OF THE CONTROLLER OF EXAMINATIONS (P.G. COURSES) <br><br> TERMINAL EXAMINATIONS </h4> </center> </b> </p>
    	</div>
      <div class="card_custom">
      	<div class="content" align="center">
          <img src="../img/error.png" height="150px" width="150px">
      		<label><b><h2> Mail Sending Failed !!! </h2></b></label> <br><br>
      		<h3><label> Please Contact Developer </label>
          <p><label> It has something went wrong so admin contact to developer immediately </label></p></h3>
          <h4><label> Thank You </label></h4>
      	</div>
      </div>
    	<!-- start footer -->
    	<div class="footer">
    		<label style="color: #000; font-weight: bold;"> Designed &amp; Developed By </label>
    		<a href="#" target="_blank" style="margin-right: 3em;">ComputerScience(UG-R)</a>
    	</div>
    	<!-- stop footer -->
    </body>
    </html>
  ';
  }
  }
  require_once 'db_close.php';
?>
