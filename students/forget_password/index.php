<!DOCTYPE html>
<html>
<head>
  <title> Forgot Password </title>
  <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link href="../js/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <style>
      .card_container {
        margin-left: auto;
        margin-right: auto;
        margin-top: 2em;
        margin-bottom: 5em;
        width: 50%;
      }
      /* footer */
      .footer {
         position: fixed;
         left: 0;
         bottom: 0;
         width: 100%;
         background-color: #4680ff;
         color: white;
         text-align: right;
         margin-right: 3em;
         padding: 10px;
         font-size: 15px;
      }

      .footer a{
        text-decoration: none;
        color: #FFF;
        font-size: 15px;
      }
      .align_center {
        margin: auto;
        text-align: center;
      }
    </style>
</head>
<body>
  <div class="navbar" style="background-color: #4680ff;color: #FFF;">
    <img src="../uploads/clg/clg.png" alt="clg LOGO" align="left" height="150px" width="150px">
    <div class="align_center">
      <h5> AYYA NADAR JANAKI AMMAL COLLEGE (Autonomous), SIVAKASI </h5>
      <h6> OFFICE OF THE CONTROLLER OF EXAMINATIONS (P.G. COURSES) </h6>
    </div>
  </div>
  <div class="container-fluid card_container">
        <div class="card">
          <div class="card-header" align="center">
            <h6 class="text-uppercase mb-0">Create Password</h6>
          </div>
          <div class="card-body">
              <div class="form-group row">
                <label class="form-control-label text-uppercase col-md-6">Admin's Mail ID</label>
                <div class="col-md-6">
                  <input type="text" name="mail" id="mail" class="form-control" placeholder="Admin's Mail ID">
                </div>
              </div>
              <div class="form-group row">
                <label class="form-control-label text-uppercase col-md-6">New Password</label>
                <div class="col-md-6">
                  <input type="password" name="new_pass" id="new_pass" class="form-control" title="Header" data-toggle="popover" data-placement="right" data-content="Content" onchange="validatePassword()" placeholder="New Password">
                </div>
              </div>
              <div class="form-group row">
                <label class="form-control-label text-uppercase col-md-6">Confirm Password</label>
                <div class="col-md-6">
                    <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" placeholder="Confirm Password">
                </div>
              </div>
            <div class="line"></div>
            <div class="row" align="right">
              <div class="col-lg-12 mb-12">
                <button type="reset" class="btn btn-secondary" name="clear" onclick="clear(this);"> CLEAR </button>
                <button type="submit" class="btn btn-primary" name="submit" id="submit"  onclick="create_password(this);" style="margin: 10px;"> CREATE PASSWORD </button>
              </div>
            </div>
          </div>
        </div>
  </div>
  <!-- start footer -->
  <div class="footer">
    <label style="color: #000;"> Designed &amp; Developed By </label>
    <a href="arunandroid.anjanainfotech.in" target="_blank" style="margin-right: 3em;font-weight: bold;"> Arun Kumar G (16US41) </a>
  </div>
  <!-- stop footer -->
  <!-- starting scripts  -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../vendor/popper.js/umd/popper.min.js"></script>
  <script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>
  <script src="../js/jquery.toaster.js"></script>
  <script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
  </script>

  <script type="text/javascript">
  function validatePassword() {
    var newPassword = document.getElementById('new_pass').value;
    var minNumberofChars = 8;
    var maxNumberofChars = 16;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
    // (?=.*[0-9]) - Assert a string has at least one number;
    // (?=.*[!@#$%^&*]) - Assert a string has at least one special character.

    if(!regularExpression.test(newPassword)) {
      if(newPassword.length < minNumberofChars || newPassword.length > maxNumberofChars){
          $.toaster('','Password Must be Greater than 8 and lesser than 16','danger')
      }
        $.toaster('','Password should contain atleast one number','info');
        $.toaster('','password should contain atleast one special character','danger');
    }
  }
    function create_password(obj) {
      if($('#mail').val() == '') {
        $.toaster('Required Field','Admin\'s Mail Id is','danger')
      } else if($('#new_pass').val() == '') {
        $.toaster('Required Field','New Password is','danger')
      } else if($('#confirm_pass').val() == '') {
        $.toaster('Required Field','Confirm Password is','danger');
      } else if($('#new_pass').val() != $('#confirm_pass').val()) {
        $.toaster('Mismatched','Password is','danger');
      } else {
        var formData = new FormData();
        formData.append("op","create_password");
        formData.append("mail",$('#mail').val());
        formData.append("new_pass",$('#new_pass').val());
        formData.append("confirm_pass",$('#confirm_pass').val());
        swal({
          title: "Create Password",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        },
        function() {
          $.ajax({
            url: 'createpassword.php',
            type: 'POST',
            processData: false,
            contentType: false,
            async: false,
            data: formData,
            success:function(result) {
              obj = JSON.parse(result);
              if (obj.err == 0) {
                setTimeout(function(){
                  swal(obj.result,"","success");
                window.location.replace("../index.php");
                });
                $.toaster('',obj.result,'success');
                $('#mail').val('');
                $('#new_pass').val('');
                $('#confirm_pass').val('');
              } else {
                setTimeout(function() {
                  swal(obj.result,"","error")
                });
              }
            }
          });
        });
      }
    }

    function clear(obj) {
      $('#mail').val('');
      $('#new_pass').val('');
      $('#confirm_pass').val('');
    }
  </script>
</body>
</html>
