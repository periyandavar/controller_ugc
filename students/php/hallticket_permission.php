<?php
  require_once 'db.php';
  $res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

  if (isset($_POST['op']) && $_POST['op'] != '') {
    $op = $_POST['op'];
    $res['tag'] = $op;

    if ($op == "accepted") {
      $sem = mysqli_real_escape_string($connect,$_POST['sem']);
      $aca_yr = mysqli_real_escape_string($connect,$_POST['aca_yr']);

      if($sem == 1) {
        $sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=1 WHERE academic_year='".$aca_yr."'");
			}elseif ($sem == 2) {
				$sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=2 WHERE academic_year='".$aca_yr."'");
			}elseif ($sem == 3) {
				$sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=3 WHERE academic_year='".$aca_yr."'");
			}elseif ($sem == 4) {
				$sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=4 WHERE academic_year='".$aca_yr."'");
			}elseif ($sem == 5) {
				$sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=5 WHERE academic_year='".$aca_yr."'");
			}elseif ($sem == 6) {
				$sql = mysqli_query($connect,"UPDATE student_master SET  hallticket_stat=6 WHERE academic_year='".$aca_yr."'");
			}

      if ($sql === true) {
        $res['err'] = 0;
        $res['result'] = "Thank You";
        $res['query'] = "UPDATE student_master SET  hallticket_stat=1 WHERE academic_year='".$aca_yr."'";
      } else {
        $res['err'] = 1;
        $res['result'] = "Oops!!! something went wrong";
      }
      echo json_encode($res);
    } elseif ($op == "decline") {
      $res['err'] = 2;
      $res['result'] = "Process Denied !!!";
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
