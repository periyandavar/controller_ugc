<?php
	require_once 'db.php';


	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"null");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		$op = $_POST['op'];
		$res['tag'] = $op;

		if ($op == 'reg_mark_sheet') { // start regular exam time table
			$dept_code = mysqli_real_escape_string($connect, $_POST['dept_code']);
			$academic_yr = mysqli_real_escape_string($connect, $_POST['academic_year']);
			$semester = mysqli_real_escape_string($connect, $_POST['semester']);
			$month = mysqli_real_escape_string($connect, $_POST['month']);
			$min_length = mysqli_real_escape_string($connect, $_POST['min_length']);
			$max_length = mysqli_real_escape_string($connect, $_POST['max_length']);

			$path = "output/marksheet/$dept_code/$academic_yr/$semester/";
			$file_save = $marksheetSave->save_folder($path);
			$marksheetRegisterNo->academic_year = $academic_yr;
			$marksheetRegisterNo->dept_code = $dept_code;
			$studentData->sem = $semester;
			$register_no_input = $marksheetRegisterNo->register_no();
			$count = count($register_no_input);
			for ($i=0; $i < $count; $i++) {
				if ($semester == 1) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_1 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row = mysqli_fetch_array($disp);
					if ($row['marksheet_sem_1'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 1;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				} elseif ($semester == 2) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_2 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row=mysqli_fetch_array($disp,MYSQL_ASSOC);
					if ($row['marksheet_sem_2'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 2;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				} elseif ($semester == 3) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_3 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row=mysqli_fetch_array($disp,MYSQL_ASSOC);
					if ($row['marksheet_sem_3'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 3;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				} elseif ($semester == 4) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_4 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row=mysqli_fetch_array($disp,MYSQL_ASSOC);
					if($row['marksheet_sem_4'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 4;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				} elseif ($semester == 5) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_4 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row=mysqli_fetch_array($disp,MYSQL_ASSOC);
					if($row['marksheet_sem_5'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 5;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				} elseif ($semester == 6) {
					$disp=mysqli_query($connect,"SELECT marksheet_sem_4 FROM student_master  WHERE register_no='$register_no_input[$i]'");
					$row=mysqli_fetch_array($disp,MYSQL_ASSOC);
					if($row['marksheet_sem_6'] === NULL) {
						header("Location:topdf.php?dept_code=". urlencode(serialize($_POST['dept_code']))."&academic_year=". urlencode(serialize($_POST['academic_year']))."&semester=". urlencode(serialize($_POST['semester']))."&month=".urlencode(serialize($_POST['month']))."&min_length=".urlencode(serialize($_POST['min_length']))."&max_length=".urlencode(serialize($_POST['max_length'])) );
					} else {
						$res['err'] = 6;
						$res['result'] = 'ALREADY EXISTING FILES';
					}
				}
			}
			echo json_encode($res);
		}elseif ($op == 'reg_mark_sheet1') { // start regular exam time table
			$dept_code = mysqli_real_escape_string($connect, $_POST['dept_code']);
			$academic_yr = mysqli_real_escape_string($connect, $_POST['academic_year']);
			require('fpdf/fpdf.php');
  // Width of Current Page
                $query=mysqli_query($connect,"SELECT * FROM crop");
               
                $row1=mysqli_fetch_array($query1);
                 // $i=1;
                $pdf=new FPDF('P','pt',array(816,1344));
                $pdf->SetFont('Courier','B',9);
                // $up=($connect,"UPDATE mark_details set imp='1' where part='I'");

                $retrive=($connect,"SELECT register_no FROM student_master where stat_flag='1' and dept_code='$dept_code' and academic_year=$academic_yr");
                while ($ret=mysqli_fetch_array($retrive)) {
                	# code...
$pdf->AddPage();
// $pdf->Image('uploads/photos/temp/temp.png', 0, 0, 816,1344);

 $query1=mysqli_query($connect,"SELECT * FROM `mark_details` where register_no='".$ret['register_no']."' ORDER BY `mark_details`.`sem` , mark_details.part  ASC ");
                $c=array();
                $cgp=array();
                $ce=array();
                $c['1']=0;
                 $c['2']=0;
                 $c['3']=0;
                 $c["4"]=0;
                 $c['5']=0;
                 $c['t']=0;
                 $cgp['1']=0;
                 $cgp['2']=0;
                 $cgp['3']=0;
                 $cgp['4']=0;
                 $cgp['5']=0;
                 $ce['1']=0;
                 $ce['2']=0;
                 $ce['3']=0;
                 $ce['4']=0;
                 $ce['5']=0;
                 $ce['t']=0;
                 // $j=0;
                 $k=1;
                 $i=1;
                while($row=mysqli_fetch_array($query))
                {
$j=0;
                  
                  // $row3=mysqli_fetch_array($query)
if($row['id']==1)
{
$pdf->setXY((float)$row['x'],(float)$row['y']);
                    $pdf->Cell((float)$row['width'],(float)$row['height'], "Sample");
}
else if($row['id']<=4)
                  	{
                  		$pdf->setXY((float)$row['x'],(float)$row['y']);
                  	$pdf->Cell((float)$row['width'],(float)$row['height'], $row1[$row['label']]);
                   }
                 if($row['id']>=5 and $row['id']<=19)
                 {
                    $query1=mysqli_query($connect,"SELECT * FROM `mark_details` where register_no='19us01' ORDER BY `mark_details`.`sem` , mark_details.part  ASC ");
                while($row1=mysqli_fetch_array($query1))
                {
                  if($row['id']<9)
                	{$pdf->setXY((float)$row['x'],(float)$row['y']+$j);
                	$pdf->Cell((float)$row['width'],(float)$row['height'], $row1[$row['label']]);}
                   else if($row['id']>=10 && $row['id']<=15)
                   {
                    $value=$row1[$row['label']];
                    if( $row1[$row['label']]=="0" or $row1[$row['label']]=="0 ")
                      $value="   ";
                    elseif (strlen($value)==1)
                    {
                      $value="  ".$value;
                    }
                    elseif(strlen($value)==2)
                    {
                      $value=" ".$value;
                    }

                    $pdf->setXY((float)$row['x'],(float)$row['y']+$j);
                  $pdf->Cell((float)$row['width'],(float)$row['height'], $value);
                   }
                   elseif( $row['id']>15 && $row['id'<20])
                   {
                    $pdf->setXY((float)$row['x'],(float)$row['y']+$j);
                  $pdf->Cell((float)$row['width'],(float)$row['height'], $row1[$row['label']]);
                   }
                    // echo"<div id='textEx' style='left:".((int)$row['x'])."px ;top:".((int)$row['y']+$j)."px ; width:".$row['width']."px ; height:".$row['height']."px '>". $row1[$row['label']]."</div>";
                    // $i=(int)$row['width'];
                    if($row['id']==9)
                    {
                      if($row1['part']=='I')
                      { 
                        $c['1']=$c['1']+(int)$row['credits'];
                        if($row1['result']=="P")
                        $ce['1']=$ce['1']+(int)$row1['credits'];
                      }
                      if($row1['part']=='II')
                      {
                        $c['2']=$c['2']+(int)$row1['credits'];
                        if($row1['result']=="P")
                        $ce['2']=$ce['2']+(int)$row1['credits'];
                      }
                      if($row1['part']=='III')
                      {
                        $c['3']=$c['3']+(int)$row1['credits'];
                        if($row1['result']=="P")
                        $ce['3']=$ce['3']+(int)$row1['credits'];
                      }
                      if($row1['part']=='IV')
                      {
                        $c['4']=$c['4']+(int)$row1['credits'];
                        if($row1['result']=="P")
                        $ce['4']=$ce['4']+(int)$row1['credits'];
                      }
                      if($row1['part']=='V')
                      {
                        $c['5']=$c['5']+(int)$row1['credits'];
                        if($row1['result']=="P")
                        $ce['5']=$ce['5']+(int)$row1['credits'];
                      }
                      $c['t']=$c['t']+$row1['credits'];
                    }
                    $j=$j+(int)$row['height'];
                }
                 }
}
}
$pdf->Output('D','MarkSheet_for_'.$academic_yr'and_'.$dept_code.'.pdf');
$res['err'] = 0;
$res['result'] = 'Generated Successfully';
echo json_encode($res);
		} elseif ($op == 'arrear_mark_sheet') {
			
		} elseif ($op == 'missed_mark_sheet') {
			$register_no = mysqli_real_escape_string($connect,$_POST['roll_no']);
			$semester = mysqli_real_escape_string($connect,$_POST['semester']);
			$marksheetPath = new getPath;
			$marksheetPath->register_no = $register_no;
			list($dept_code,$academic_year) = $marksheetPath->filePath();
			$path = "output/marksheet/$dept_code/$academic_year/$semester/";
			$file_path=$path.$register_no.'.pdf';
			if ($file_path) {
				$res['err'] = 0;
				$res['result'] = 'Fetching Successfully';
				$res['path'] = OUTPUT_PATH.$file_path;
			} else {
				$res['err'] = 10;
				$res['result'] = 'Fetching Failed';
				$res['path'] = OUTPUT_PATH.$file_path;
			}
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
