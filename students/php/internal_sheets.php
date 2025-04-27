<?php
  require_once 'db.php';
  $res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

  if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

    if ($op == 'manage_sheets') {
			$fetch = mysqli_query($connect, "SELECT * FROM `internalsheets` WHERE isSubmittedToController='1'");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($row = mysqli_fetch_array($fetch)) {
					$data['dept_code'] = $row['departmentId'];
					$data['year'] = $row['batch'];
					$data['semester'] = $row['semester'];
					$data['sub_code'] = $row['subjectCode'];
					$data['sheetid'] = $row['sheetid'];
					$data['status'] = $row['isStudentViewable'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'submitted Sheets are loaded Successfully';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'submitted Sheets are loaded Failed';
				echo json_encode($res);
			}
		} else if($op == 'updatesheetstatus'){
      $sheetid =  mysqli_real_escape_string($connect, $_POST['sheetid']);
      $status =  mysqli_real_escape_string($connect, $_POST['status']);

      $sql = "UPDATE `sheets` SET status='$status' WHERE uniqueid='$sheetid';";
      if (mysqli_query($connect, $sql)) {
        $res['err'] = 0;
				$res['result'] = 'Updated Successfully';
      } else {
        $res['err'] = 100;
				$res['result'] = 'Updated Failed';
      }
  } else if($op == "submitSheet"){
    $status = mysqli_real_escape_string($connect, $_POST['status']);
    $sheetId = mysqli_real_escape_string($connect, $_POST['sheetId']);
    $departmentId = mysqli_real_escape_string($connect, $_POST['departmentId']);
    $query="UPDATE `internalsheets` SET isStudentViewable='$status' WHERE sheetid='$sheetId'";
    $result['query']=$query;
    if(mysqli_query($connect,$query)){
			$res['err']=0;
			$res['msg']="Update Sheet Successfully !!";
			// $result['appendData']=sheetsData($departmentId);
			echo json_encode($res);
    }else{
			$res['err']=1;
			// $result['appendData']='';
			$res['msg']="Unable To Update a Sheet !!";
			echo json_encode($res);
    }
	} elseif ($op == 'add_marks') {
    $sheetid = mysqli_real_escape_string($connect, $_POST['sheetid']);
    $dept_code = mysqli_real_escape_string($connect, $_POST['dept_code']);
    $sem = mysqli_real_escape_string($connect, $_POST['sem']);
    $sub_code = mysqli_real_escape_string($connect, $_POST['sub_code']);
    $year = mysqli_real_escape_string($connect, $_POST['year']);
    $query = "SELECT * FROM $sheetid";
    $sql = mysqli_query($connect, $query);
    $connectInsert = array();
    if (mysqli_num_rows($sql) > 0) {
      while ($row = mysqli_fetch_array($sql)) {
        $insert = "INSERT INTO `mark_details`(`dept_code`, `academic_year`, `register_no`, `name`, `sem`, `subject_code`, `subject_name`, `credits`, `max_int`, `max_ext`, `max_tot`, `internal`) VALUES ";
        $insert .= "'".$dept_code."','".$year."',";
        $insert .= "'".$row['rollnumber']."',";
        $insert .= "'".$row['name']."',";
        $insert .= "'".$sem."','".$sub_code."',"; //'"1","CS101","Advanced Java","5","50","50","100",';
        $subject_query = mysqli_fetch_array(mysqli_query($connect, "SELECT subject_name, credits, max_int, max_ext, max_tot FROM `subject_master` where subject_code = '".$sub_code."'"));

        $insert .= "'".$subject_query['subject_name']."','".$subject_query['credits']."','".$subject_query['max_int']."','".$subject_query['max_ext']."','".$subject_query['max_tot']."',";
        $insert .= "'".$row['Total']."')";
        array_push($connectInsert, $insert);
      }
    } else {
      $res['result'] = "Nothing to else";
      $res['query'] = $query;
    }
    $flags = 0;
    for ($i=0; $i <count($connectInsert); $i++) {
      mysqli_query($connect, $connectInsert[$i]);
      if (mysqli_error($connect)) {
        $flags++;
      }
    }
    $res['query'] = array();
    array_push($res['query'], $connectInsert);
    if ($flags == 0) {
      $res['err'] = 0;
      $res['result'] = "Added Successfully";
      $res['query'] = $query;
      $res['flag'] = $flags;
    } else {
      $res['err'] = 110;
      $res['result'] = "Added Failed";
      $res['flag'] = $flags;
      $res['query'] = $query;
    }
    echo json_encode($res);
  }
  // end if clause
  } else {
  		$res['err'] = 501;
  		$res['result'] = "Empty op tag";
  		echo json_encode($res);
  	}

		require_once 'db_close.php';

		/*function sheetsData($departmentId){
			$response=mysqli_query($connect,"SELECT * FROM `internalsheets` WHERE isSubmittedToController='1'");
			$data='';
			if(mysqli_num_rows($response)>0){
				while($row=mysqli_fetch_array($response)){
						$data.="<tr>";
						$data.="<td>".$row['batch']."</td>";
						$data.="<td>".$row['semester']."</td>";
						$data.="<td>".$row['subjectCode']."</td>";
						$getSubjectName=mysqli_fetch_array(mysqli_query($connect,"SELECT subject_name FROM `subject_master` WHERE subject_code='".$row['subjectCode']."'"));
						$data.="<td>".$getSubjectName['subject_name']."</td>";
						if($row['isStudentViewable'] == 1){
							$data.="<td><button class='btn btn-success btn-sm' onclick=changeStatus(0,'".$row['sheetid']."','".$departmentId."')>Visible</td>";
						}else{
							$data.="<td><button class='btn btn-danger btn-sm' onclick=changeStatus(1,'".$row['sheetid']."','".$departmentId."')>Not Visible</td>";
						}
						$data.="<td>
						<button class='btn btn-primary btn-sm' onclick=viewSheet('".$row['sheetid']."')>View</button>
						</td>";

						$data.="</tr>";
				}
				return $data;
			}
		}*/

  ?>
