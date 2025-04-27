<?php
header("Access-Control-Allow-Origin","*");
require_once 'include/header.php';
require_once 'php/db.php';
$sql = mysqli_query($connect,"SELECT * FROM student_master where register_no='".$_SESSION['admin']."'");
$row = mysqli_fetch_array($sql);

$address=$row['address'];
// if($address != ''){
//   $splittedAddressOne=explode("-",$address);
//   $pincode=$splittedAddressOne[1];
//   $splittedAddressTwo=explode(",",$splittedAddressOne[0]);
//   $city=$splittedAddressTwo[0];
//   $district=$splittedAddressTwo[1];
//   $state=$splittedAddressTwo[2];
// }


if($row['ap_flag']==0 or $row['ap_flag']==2);
   // echo '<script>window.location.replace("dashboard ");</script>'; 
 $fetch1 = mysqli_query($connect, "SELECT valid FROM `app_form` where id=1");
$ele1 = mysqli_fetch_array($fetch1);
$dt=date('d-m-Y');
$d1=date_create($dt);
$d2=date_create($ele1['valid']);
// if($d1>$d2)
// {
//    $fetch1 = mysqli_query($connect, "update student_master set ap_flag=0 where register_no='".$_SESSION['admin']."'");

//    echo '<script>window.location.replace("dashboard ");</script>'; 
// }

$sql1 = mysqli_query($connect,"SELECT * FROM app_form where id='1'");
    $row1=mysqli_fetch_array($sql1);

      
    
    $semester=0;

    $str = $row1['appear_month'];
$str_array = explode("-", $str);
// print_r($str_array);
$app_year=(int)$str_array[1];


$academic_year=$row['academic_year'];
$stryr_array = explode("-", $academic_year);
// print_r($stryr_array);
$start_year=(int)$stryr_array[0];



$year=$app_year-$start_year;
//$year=8;
if($year==2 and ($str_array[0]=="April" or $str_array[0]=="March")){
  $semester=4;
}
elseif($year==1 and ($str_array[0]=="November" or $str_array[0]=="October")){
  $semester=3;
}
elseif($year==1 and ($str_array[0]=="April" or $str_array[0]=="March")){
  $semester=2;
}
elseif($year==0 and ($str_array[0]=="November" or $str_array[0]=="October")){
  $semester=1;
}
elseif($year==3 and ($str_array[0]=="April" or $str_array[0]=="March")){
  $semester=6;
}
elseif($year==2 and ($str_array[0]=="November" or $str_array[0]=="October")){
  $semester=5;
}
$sql3=mysqli_query($connect,"select sem".$semester." from `student_master` where `register_no`= '".$_SESSION['admin']."'");
if($semester==1)
{
  $readonly="";
}
else
{
  $readonly="readonly";
}
// echo"select sem".$semester.",year from `papers` where `reg_no`= '".$_SESSION['admin']."' ".$app_year." ".$start_year;
// echo "select * from `subject_master` where `academic_yr`= '".$row['academic_year']."' and `semester`='".$semester."'";
    // $sql = mysqli_query($connect,"SELECT * FROM subject_master where register_no='".$row['admin']."'");
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
  <h6>Application for the Terminal Examination to be held in <?php echo  $row1['appear_month'];  ?></h6>
      </div>
      <div class="col-lg-2 mb-1" align="right">
            <img src="../ug/uploads/photos/students/<?php echo $row['dept_code'].'/'.$row['academic_year'].'/'.$_SESSION['admin']; ?>.jpg" width="119" height="115">
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
            <input  class="form-control" name="course" id="course" value="<?php echo $row['class'] ?>"" class="form-control" readonly>
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Subject</label>
            <input  class="form-control" name="subject" id="subject" value="<?php echo $row['course'] ?>"" class="form-control" readonly>
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Semester</label>
            <input  class="form-control" name="sem" id="sem" value="<?php echo $semester; ?>"" class="form-control" readonly>
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Name</label>
            <input  class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>"" class="form-control" readonly>
              
          </div>
        </div>
                <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Gender</label>
            <select  class="form-control" name="gen" id="gen" value="<?php echo $row['community'] ?>" class="form-control" <?php echo $readonly; ?> >
              <option style="display: none;" value="">Select Gender</option>
              <option <?php if ($row['gender']=="Male") {
                # code...
                echo "selected";
              } ?> value="Male">Male</option>
              <option <?php if ($row['gender']=="Female") {
                # code...
                echo "selected";
              } ?> value="Female">Female</option>
              <option <?php if ($row['gender']=="Transgender") {
                # code...
                echo "selected";
              } ?> value="Female">Transgender</option>
              
            </select>

              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Father's Name</label>
            <input  class="form-control" name="fname" id="fname" value="<?php echo $row['father_name'] ?>"" class="form-control" >
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Date of Birth</label>
            <input  class="form-control datepicker-here" data-language='en' name="dob" data-date-format="dd/mm/yyyy" placeholder="Date of Birth" id="dob" value="<?php echo $row['dob'] ?>"" class="form-control"  <?php echo $readonly; ?>>
              
          </div>
        </div>
        
                
       <!--  <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">State</label>
            <select name="state" id="state" required class='form-control'>
              <option value="" style="display:none">Select State</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">District</label>
            <select name="district" id="district" required class='form-control'>
            <option value="" style="display:none">Select District</option>
            </select>
          </div>
        </div> -->
      <!--   <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Address</label>
            <input type="text" value="<?php //echo $row['address'];?>" placeholder="Address" name="address" id="address" required class='form-control'>
          
          </div>
        </div> -->
        
                    
        

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Pin Code</label>
            <input type="text" class="form-control" placeholder="Ex:626123" name="pin" id="pin"  value="<?php echo $row['pincode']; ?>" class="form-control" >
              
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Phone No</label>
            <input  class="form-control" name="phone" id="phone" value="<?php echo $row['mobile_no'] ?>"" class="form-control" <?php echo $readonly; ?>>
              
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Community</label>
            <select  class="form-control" name="com" id="com" value="<?php echo $row['community'] ?>" class="form-control" <?php echo $readonly; ?> >
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
            <input  class="form-control" name="caste" id="caste" value="<?php echo $row['caste'] ?>"" class="form-control" <?php echo $readonly; ?> >
              
          </div>
        </div>

        <div class="col-lg-12 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">E-Mail</label>
            <input  class="form-control" name="mail" id="mail" value="<?php echo $row['email_id'] ?>"" class="form-control" <?php echo $readonly; ?> >
               
          </div>
        </div>

        <div class="col-lg-12 mb-4">
          <div class="form-group">
            <label class="form-control-label text-uppercase">Permanent Address</label>
           
            <textarea name="address" id="address" cols="30" rows="5" class='form-control' placeholder="Eg., 165, Nanthavanapatti Middle Street" required><?php if(isset($row['address'])) echo $row['address'] ?></textarea>
          </div>
        </div>





        
        
        
        
      </div>
      <div class="row" style="margin-top: 20px;">
<div class="col-lg-12 mb-12">
    <div class="card">
        <div class="card-header">
            <center><h6 class="text-uppercase mb-0" style="margin-top: 1em;">Papers</h6></center>
        </div>
        <div class="card-body table-responsive" id="print_claim_table">
            <table class="table table-striped table-hover card-text" id="print_table" cellspacing="0" cellpadding="1">
                <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Paper Code</th>
                      <th>Title</th>
                      <th>Fees</th>
                    </tr>
                </thead>
                <tbody id="sub_table">
                  <?php 
                  $amt=0;
                  $sql4 = mysqli_query($connect,"SELECT * FROM fees_structure where type='aided' and status=1");
                  $row4 = mysqli_fetch_array($sql4);
                  $i=1;
                  $row3 = mysqli_fetch_array($sql3);
                  $Subjects=array();
                  $Years=array();
                  $Subject = explode(",", ($row3['sem'.$semester]));
                  for($s=0;$s<sizeof($Subject);$s++){
                  $Subjs = explode("-", $Subject[$s]);
                  $Subjects[$s]=$Subjs[0];
                  $Years[$s]=$Subjs[1];
                   }
                  for($j=0;$j<sizeof($Subjects);$j++) {
                    $sql3i = mysqli_query($connect,"SELECT * FROM subject_master where subject_code='".$Subjects[$j]."' and year='".$Years[$j]."'");
                  $row3i = mysqli_fetch_array($sql3i);
                    if ($row3i['sub_type']=="T") {
                      $val="theory";
                      # code...
                    }
                    else
                    { if($row3i['hours']=='3' or $row3i['hours']=='2' )
                      $val="practical1";
                      else if($row3i['hours']=='6')
                      $val="practical2";
                      else if($row3i['hours']=='9')
                      $val="practical3";

                      }
                        echo "
                    
                      
                  <tr>
                    <td>".$i++."</td>
                    <td>
                    ". $row3i['subject_code']."</td>
                    <td>".$row3i['subject_name']."</td>
                    <td>";
                    if($row3i['fees']=='n'){ echo'-';
                    $row4[$val]=0;
                    }else echo $row4[$val];
                    echo"</td>

                  </tr>";
                  $amt=$amt+$row4[$val];
                  }
                  $p_list=mysqli_fetch_array(mysqli_query($connect,"select papers from Arrear_ticket where reg_no='".$_SESSION['admin']."'"))['papers'];
                  $p_list=explode(",", $p_list);
                  // echo "select papers from Arrear_ticket where reg_no='".$_SESSION['admin']."'";
                  for($ind=0;$ind<sizeof($p_list);$ind++)
                  {
                  $sql5 = mysqli_query($connect,"select subject_code, subject_name,sub_type,hours,fees from `subject_master` where  subject_code='$p_list[$ind]'");
                  while($row5 = mysqli_fetch_array($sql5)){
                    if ($row5['sub_type']=="T") {
                      $val="arrear_theory";
                      # code...
                    }else{                 if($row3i['hours']=='3' or $row3i['hours']=='2' )
                      $val="arrear_practical1";
                      else if($row5['hours']=='6')
                      $val="arrear_practical2";
                      else if($row5['hours']=='9')
                      $val="arrear_practical3";


                    }
                      
                        echo "
              
                  <tr>
                    <td>".$i++."</td>
                    <td>
                    ". $row5['subject_code']."</td>
                    <td>".$row5['subject_name']."   (Arrear) </td>
                    <td>";
                    if($row5['fees']=='n'){ echo'-';
                    $row4[$val]=0;
                    }else echo $row4[$val];
                   echo"</td>

                  </tr>";
                  $amt=$amt+$row4[$val];
                  }
                }
                   ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<div class="line"></div>
      <div class="row" align="left">
        <div class="col-lg-12 mb-12">
          I hereby apply to sit for the terminal examination in the papers listed above<br>
          <br><h4>Fee Schedule</h4><br>
          <pre>For each Theory Paper Rs.<?php echo $row4['theory'];  ?>/- & for each Practical Examination (3 hrs / 6 hrs / 9hrs duration) Rs.<?php echo $row4['practical1']; ?>/<?php echo $row4['practical2']; ?>/Rs.<?php echo $row4['practical3'];?>/-;<br>For each Theory Arrear Paper Rs.<?php echo $row4['arrear_theory'];  ?>/- & for each Practical Arrear Examination (3 hrs / 6 hrs / 9hrs duration) Rs.<?php echo $row4['arrear_practical1']; ?>/<?php echo $row4['arrear_practical2']; ?>/Rs.<?php echo $row4['arrear_practical3'];?>/-;<br>Cost of Application form & Statement of Marks: Rs.<?php echo $row4['mark_stmt_amt']+$row4['certificate_fees']+$row4['provisional_fees']; 
          $amt=$amt+$row4['mark_stmt_amt']+$row4['certificate_fees']+$row4['provisional_fees'];?>.</pre>


          </div>
        </div>
        
      <div class="row" >
        <div class="col-lg-4 mb-8" align="left">
        <h6>Station: Sivakasi<br>
            Date   : <?php echo date('d-m-y') ?>
            <br></h6>
          </div>
          <div class="col-lg-8 mb-1" align="right">
        <h6>
          
        <input type="checkbox" name="check_box1" id="check_box1" >Above given details are true to your knowledge<br>
            Total Amount to be Paid Rs.<?php echo $amt; ?>
        </h6>
          </div>
        </div>
      
      <div class="row" align="center">
        <div class="col-lg-12 mb-12">
          
          <button type="submit" class="btn btn-primary" name="add" id="add"  onclick="confirm(this);" style="margin: 10px;"> Apply </button>
        </div>
      </div>
    </div>
    <div class="footer"></div>
    </div>
  </div>
</div>


<?php require_once 'include/footer.php';
if($semester==0)
{
  echo'<script type="text/javascript"> swal({
   title: "You are not permitted to access the site since your id is expired..! ",
   type: "error",
   showCancelButton: false,
   closeOnConfirm: false,
   
  },
   function(){
window.location.replace("index ");

  });</script>';
}

?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#update').hide();
    });
    function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if((inputtxt.match(phoneno)))
        {
      return false;
        }
      else
        {
        return true;
        }
}
  function validatePIN(pin) {
  if (/^(\d{6})$/.test(pin)) {
    return false;
  } else {
    return true;
  }
}


    // add sub details start
    function confirm(obj){
      var v=document.getElementById('check_box1');
      var mailpattern=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if ($('#fname').val() == '') {
            $.toaster('Required Fields...', "Father's Name", 'warning');
        }else if ($('#dob').val() == '') {
            $.toaster('Required Fields...', 'Date of Birth', 'warning');
        }else if ($('#phone').val() == '') {
            $.toaster('Required Fields...', 'Phone Numbers', 'warning');
        }else if ($('#gen').val() == '') {
            $.toaster('Required Fields...', 'Gender', 'warning');
        } else if (phonenumber($('#phone').val())) {
            $.toaster('Invalid...', 'Phone Numbers', 'warning');
        }
        else if ($("#state").val() == '') {
            $.toaster('You must to choose state', '', 'warning');
        }
        else if ($("#district").val() == '') {
            $.toaster('You must to choose district', '', 'warning');
        }
        else if ($("#city").val() == '') {
            $.toaster('You must to choose city', '', 'warning');
        }
        else if (validatePIN($('#pin').val())) {
            $.toaster('Invalid Pin Code...',' ', 'warning');
        }else if ($('#address').val() == '') {
            $.toaster('Required Fields...', 'Address', 'warning');
        }
        
        else if ($('#pin').val() == '') {
            $.toaster('Required Fields...', 'Pin Code', 'warning');
        }else if ($('#com').val() == 'Select Community') {
            $.toaster('Required Fields...', 'Community', 'warning');
        }else if ($('#caste').val() == '') {
            $.toaster('Required Fields...', 'Caste', 'warning');
        }else if ($('#mail').val() == '') {
            $.toaster('Required Fields...', 'Mail Id', 'warning');
        }else if (!mailpattern.test($('#mail').val())) {
          $.toaster('', 'Invalid Mail Id', 'info');
        } else if (!(v.checked)) {
            $.toaster('You must agree this form', '', 'warning');
        }
        
        else{
          var formData = new FormData();
          formData.append("op","application");
          formData.append("dob",$('#dob').val());
          formData.append("phone",$('#phone').val());
          formData.append("caste",$('#caste').val());
          formData.append("mail",$('#mail').val());
          formData.append("gen",$('#gen').val());
          formData.append("fname",$('#fname').val());
          let address=$('#address').val();
          formData.append("address",address);
          formData.append("pin",$('#pin').val());
          formData.append("com",$('#com').val());
          
          swal({
             title: "Thus the given Information are correct? ",
             type: "info",
             showCancelButton: true,
             closeOnConfirm: false,
             showLoaderOnConfirm: true,
            },
             function(){
               
              $.ajax({
                  url : 'php/confirm.php',
                  type : 'POST',
                  processData: false,
                  contentType: false,
                  async : false,
                  data :formData,
                  success:function(result)
                  {
                      obj = JSON.parse(result);
                      if(obj.err==0) {
                        setTimeout(function(){
                          swal(obj.result,"", "success");
                        });
                          // alert(obj.result);
                          $.toaster('', obj.result, 'success');
                          
                      }else{
                        setTimeout(function(){
                          swal(obj.result,"","error");
                        });
                          $.toaster('',obj.result,'error');
                      }
                  }
              });
           });
    }
  }
// end
// start clear fun...
  function clear(obj) {
    $('#dept_code').val('');
    $('#dept_name').val('');
    $('#academic_year').val('');
    $('#semester').val('');
    $('#papertype').val('');
    $('#sub_code').val('');
    $('#sub_name').val('');
    $('#credits').val('');
    $('#max_int_mark').val('');
    $('#min_int_mark').val('');
    $('#max_ext_mark').val('');
    $('#min_ext_mark').val('');
    $('#min_total_mark').val('');
    $('#exam_hours').val('');
  }
// end clear fun...
// start table load fun...
  
// end update fun...
  </script>

<script src="js/pincode.js"></script>
<script>

// $(document).ready(function(){
//   // for(let i=0;i<state.length;i++){
//   //   let option=document.createElement("option");
//   //   option.innerHTML=state[i];
//   //   // option.setAttribute("value",state[i]);
//   //   // document.getElementById('state').appendChild(option);
//   // }
// })

// $("#state").on('change',function(){
//   let state=$("#state").val();
//   let district=districts[state];
//   $("#district").empty();
//   $("#city").empty();

//   let districtFirstOption=document.createElement("option");
//   districtFirstOption.setAttribute("value","");
//   districtFirstOption.setAttribute("style","display:none");
//   districtFirstOption.innerHTML="Select District";
//   document.getElementById('district').appendChild(districtFirstOption);


//   let cityFirstOption=document.createElement("option");
//   cityFirstOption.setAttribute("value","");
//   cityFirstOption.setAttribute("style","display:none");
//   cityFirstOption.innerHTML="Select City";
//   document.getElementById('city').appendChild(cityFirstOption);


  
//   for(let i=0;i<district.length;i++){
//     let option=document.createElement("option");
//     option.innerHTML=district[i];
//     option.setAttribute("value",district[i]);
//     document.getElementById('district').appendChild(option);
//   }
// })

// $("#district").on('change',function(){
//   let district=$("#district").val();
//   let city=cities[district];
//   $("#city").empty();
//   let cityFirstOption=document.createElement("option");
//   cityFirstOption.setAttribute("value","");
//   cityFirstOption.setAttribute("style","display:none");
//   cityFirstOption.innerHTML="Select City";
//   document.getElementById('city').appendChild(cityFirstOption);
//   for(let i=0;i<city.length;i++){
//     let option=document.createElement("option");
//     option.innerHTML=city[i];
//     option.setAttribute("value",city[i]);
//     document.getElementById('city').appendChild(option);
//   }
// })

// $("#city").on('change',function(){
//   let city=$("#city").val();
//   $.ajax(
//     {
//       url:"https://api.postalpincode.in/postoffice/"+city,
//       method:"GET",
//       success:function(response){
//         // console.log(response);
//         let state=$("#state").val();
//         state=state.replace(" ","");
//         state=state.toLowerCase();
//         // console.log("State : " + state);
//         for(let i=0;i<response[0].PostOffice.length;i++){
//           let tempState=response[0].PostOffice[i].State.toLowerCase();
//           tempState=tempState.replace(" ","");
//           // console.log("Temp State : " + tempState);
//           if(tempState == state){
//             $("#pin").val(response[0].PostOffice[i].Pincode);
//             let address=$('#address').val()+", "+$("#city").val()+", "+$("#district").val()+", "+$("#state").val()+"-"+ $("#pin").val();
//             // console.log(address);

//           }
          
//         }
//       }
//     }
//   );
// }
// )



</script>

