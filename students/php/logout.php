<?php 
	session_start();
	if (isset($_SESSION['admin']) && $_SESSION['admin'] != '') {
		session_unset();
		session_destroy();
	}
	echo "<script>window.location.replace('../index.php');</script>";
?>