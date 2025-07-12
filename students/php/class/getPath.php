<?php
// $conn = mysqli_connect("localhost","root","","master_table");
require_once 'db.php';

class getPath{


public $register_no;


function filePath()
{
$disp=mysqli_query($GLOBALS['connect'],"SELECT dept_code,academic_year  FROM student_master WHERE register_no='$this->register_no'");

while ($row=mysqli_fetch_array($disp,MYSQL_ASSOC))
{

	$f_P[]= $row['dept_code'];
    $f_P[]= $row['academic_year'];

}

return $f_P;
}
}


?>
