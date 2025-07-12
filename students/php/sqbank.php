<?php
  require_once 'db.php';
  $res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

  if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

    if ($op == 'get_qbank') {
      $reg=$_POST['reg'];
			$fetch = mysqli_query($connect, "SELECT * FROM `question` WHERE dept_code=(SELECT dept_code FROM student_master where register_no='$reg') order by sub_code");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($row = mysqli_fetch_array($fetch)) {
					$data['code'] = $row['sub_code'];
					$data['type'] = $row['quest_type'];
					$data['path'] = $row['question'];
					array_push($res['data'], $data);
				}
				$res['err'] = 0;
				$res['result'] = 'Fetched Successfully';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'No Data to fetch';
				echo json_encode($res);
			}
		}
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
