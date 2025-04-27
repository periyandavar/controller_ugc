<?php
// $conn = mysqli_connect("localhost","root","","master_table");

require_once 'db.php';
class getRegisterNo{

public $academic_year;
public $dept_code;

function register_no()
{

$disp=mysqli_query($GLOBALS['connect'],"SELECT register_no FROM student_master WHERE academic_year='$this->academic_year' AND dept_code='$this->dept_code'");
$r_n = array("register_no");
$register=array();
while ($r=mysqli_fetch_array($disp,MYSQL_ASSOC))
{
array_push($register,$r['register_no']);
}


return $register;
}

function emailID()
{

$disp=mysqli_query($GLOBALS['connect'],"SELECT email_id FROM student_master WHERE academic_year='$this->academic_year' AND dept_code='$this->dept_code'");
$r_n = array("email_id");
$emailid=array();
while ($r=mysqli_fetch_array($disp,MYSQL_ASSOC))
{
array_push($emailid,$r['email_id']);
}


return $emailid;
}

}


?>
