<?php
  require_once 'db.php';
  if(!empty($_FILES["student_master_table"]["name"])) {
    $output = '';
    $allowed_ext = array("csv");
    $extension = end(explode(".", $_FILES["student_master_table"]["name"]));
    if(in_array($extension, $allowed_ext))
    {
         $file_data = fopen($_FILES["student_master_table"]["tmp_name"], 'r');
         fgetcsv($file_data);
          while($row = fgetcsv($file_data)) {
            $reg_no = mysqli_real_escape_string($connect, $row[0]);
            $class = mysqli_real_escape_string($connect, $row[1]);
            $course = mysqli_real_escape_string($connect, $row[2]);
            $name = mysqli_real_escape_string($connect, $row[3]);
            $dob = mysqli_real_escape_string($connect, $row[4]);
            $gender = mysqli_real_escape_string($connect, $row[5]);
            $dept_code = mysqli_real_escape_string($connect, $row[6]);
            $email_id = mysqli_real_escape_string($connect, $row[7]);
            $mobile_no = mysqli_real_escape_string($connect, $row[8]);
            $address = mysqli_real_escape_string($connect, $row[9]);
            $caste = mysqli_real_escape_string($connect, $row[10]);
            $admitted_in = mysqli_real_escape_string($connect, $row[11]);
            $academic_year = mysqli_real_escape_string($connect, $row[12]);
            $stat_flag = mysqli_real_escape_string($connect, $row[13]);
            $photo = mysqli_real_escape_string($connect, $row[14]);

            $query = "INSERT INTO `student_master`(`register_no`, `class`, `course`, `name`, `dob`, `gender`, `dept_code`, `email_id`, `mobile_no`, `address`, `caste`, `admitted_in`, `academic_year`, `stat_flag`, `Photo`) VALUES ('".$reg_no."','".$class."','".$course."','".$name."','".$dob."','".$gender."','".$dept_code."','".$email_id."','".$mobile_no."','".$address."','".$caste."','".$admitted_in."','".$academic_year."','".$stat_flag."','".$photo."')";
            $sql = mysqli_query($connect, $query);
              // echo $query;
              if ($sql) {
                echo "Insert Successfully";
              } else {
                echo "Insert Failed";
              }
         }
    }
    else {
      echo "Please select csv file";
    }
} else {
  echo 'Invalid File';
}

?>
