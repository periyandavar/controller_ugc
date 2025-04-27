<?php require_once 'include/header.php';
require_once 'php/db.php';
$sql = mysqli_query($connect,"SELECT * FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);
if($row['ap_flag']==1 )
   header( "Location: pop_up " ); 
 $yr=$row['academic_year'];
$str_array = explode("-", $yr);
// print_r($str_array);
$dt=date('m');

$syear=(int)$str_array[1];
$eyear=(int)(date('Y'));
$dif=$syear-$eyear;
$sem=0;
if($dt>5&& $dt<11)
{
  if($dif==3)
    $sem=1;
  else if($dif==2)
    $sem=3;
  else if($dif==1)
    $sem=5;
   else if($dif==0)
    $sem=7;
}
else if(($dt>=1 && $dt<6)or $dt==12)
{
 if($dif==2)
   $sem=2;
  else if($dif==1)
    $sem=4;
  else if($dif==0)
    $sem=6;
}
$semester=$sem;//." ".$dt." ".$dif." ".$eyear;
    ?>

<div class="row">
  <div class="col-lg-12 mb-10">
    <div class="card">
      <div class="card-header" align="center">
        <div class="row">
          <div class="col-lg-2 mb-1" align="left">
            <img src="img/clg.png" width="119" height="125">
          </div>
          <div class="col-lg-8 mb-5" align="center">
            <!-- <h6 class="text-uppercase mb-0">Student Details</h6> --><br>
            <h6 class="text-uppercase mb-0"><b>AYYA NADAR JANAKI AMMAL COLLEGE(Autonomous),</b> <br>
  SIVAKASI-626 124</h6>
  <h6 class="text-uppercase mb-0">Under-graduate Degree Courses</h6>
  <br><h6>STUDENT PROFIE</h6>

      </div>
      <div class="col-lg-2 mb-1" align="right">
            <img src="..\ug\uploads\photos\students\<?php echo $row['dept_code'].'/'.$row['academic_year'].'/'.$_SESSION['admin']; ?>.jpg" width="119" height="115">
          </div>
    </div>
      </div>
      <div class="card-body">
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class= "form-group">
            <label class="form-control-label text-uppercase">Roll No:</label>
            
            <input type="text" placeholder="Roll No" value=<?php echo $_SESSION['admin'] ?> name="dept_name" id="roll" class="form-control" readonly>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Course</label>
            <input  class="form-control" name="course" id="course" value="<?php echo $row['class'] ?>" class="form-control"readonly>
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Subject</label>
            <input  class="form-control" name="subject" id="subject" value="<?php echo $row['course'] ?>" class="form-control"readonly>
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Semester</label>
            <input  class="form-control" name="sem" id="sem" value="<?php echo $semester; ?>" class="form-control" readonly>
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Name</label>
            <input  class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control" readonly>
              
          </div>
        </div>
                <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Gender</label>
            <select  class="form-control" name="gen" id="gen" value="<?php echo $row['community'] ?>" class="form-control" <?php echo "readonly"; ?> >
              <option style="display: none;" value="">Select Gender</option>
              <option <?php if ($row['gender']=="Male") {
                # code...
                echo "selected";
              } ?> value="Male">Male</option>
              <option <?php if ($row['gender']=="Female") {
                # code...
                echo "selected";
              } ?> value="Female">Female</option>
              
            </select>

              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Father's Name</label>
            <input  class="form-control" readonly name="fname" id="fname" value="<?php echo $row['father_name'] ?>" class="form-control" >
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Date of Birth</label>
            <input  class="form-control datepicker-here" data-language='en' name="dob" data-date-format="dd/mm/yyyy" placeholder="Date of Birth" id="dob" value="<?php echo $row['dob'] ?>" class="form-control"  <?php echo "readonly"; ?>>
              
          </div>
        </div>
        
        
                    
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Permanent Address</label>
            <input  class="form-control" name="address" id="address" value="<?php echo $row['address'] ?>"readonly class="form-control" required>
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Pin Code</label>
            <input type="text" class="form-control" name="pin" id="pin" pattern="[0-9]{6}" value="<?php echo $row['pincode'] ?>" readonly class="form-control" max=6>
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Phone No</label>
            <input  class="form-control" name="phone" id="phone" value="<?php echo $row['mobile_no'] ?>" class="form-control" <?php echo "readonly"; ?>>
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Community</label>
            <select  class="form-control" name="com" id="com" value="<?php echo $row['community'] ?>" class="form-control" <?php echo "readonly"; ?> >
              <option style="display: none;">Select Community</option>
              <option <?php if ($row['community']=="OC") {
                # code...
                echo "selected";
              } ?> value="OC">OC</option>
              <option <?php if ($row['community']=="BC") {
                # code...
                echo "selected";
              } ?> value="BC">BC</option>
              <option <?php if ($row['community']=="MBC") {
                # code...
                echo "selected";
              } ?> value="MBC">MBC</option>
              <option <?php if ($row['community']=="SC") {
                # code...
                echo "selected";
              } ?> value="SC">SC</option>
              <option <?php if ($row['community']=="ST") {
                # code...
                echo "selected";
              } ?> value="ST">ST</option>
            </select>


              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Caste</label>
            <input  class="form-control" name="caste" id="caste" value="<?php echo $row['caste'] ?>" class="form-control" <?php echo "readonly"; ?> >
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">E-Mail</label>
            <input  class="form-control" name="mail" id="mail" value="<?php echo $row['email_id'] ?>" class="form-control" <?php echo "readonly"; ?> >
               
          </div>
        </div>







        
        
        
        
      </div>
   
        
     
    <div class="footer"></div>
    </div>
  </div>
</div>


<?php require_once 'include/footer.php';

?>

  </script>