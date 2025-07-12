
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> clg | Students PANEL </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="description" content="AYYA NADAR JANAKI AMMMAL COLLEGE, SIAVAKASI.
Controller Of Examination">
  <meta name="keywords" content="clg, clg, anjaccoe, anjaccoe.org , anjaccoe org ,
anjaccollege">
  <meta name="author" content="Computer Science">
  <meta name="copyright" content="Computer Science(UG-R)">
  <meta name="email" content="controller@anjaccoe.org">
  <meta name="Charset" content="US-ASCII">
  <meta name="Rating" content="General">
  <meta name="Distribution" content="Global">
  <meta name="Robots" content="INDEX,FOLLOW">
  <meta name="Revisit-after" content="365 Days">
  <meta name="expires" content="no">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <link rel="shortcut icon" href="img/favicon.png">
  </head>
  <body>
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="card login" style="background-image: url('img/user-profile-bg.jpg');">
          <div class="row align-items-center py-5 login">
            <div class="col-5 col-lg-5 mx-auto mb-5 mb-lg-0">
              <div class="pr-lg-5" align="center"><img src="img/avatar.png" alt="" class="img-fluid" style="width: 65%;"></div>
            </div>
            <div class="col-lg-7 px-lg-4">
              <center><h1 class="text-base text-dark text-uppercase mb-4">clg UG Students Login</h1>
              <h2 class="mb-4">Welcome back! </h2> </center>

                <div class="form-group mb-4">
                  <input type="email" name="user" style="margin: auto; width: 85%;" id="user" required placeholder="Roll No." class="form-control border-0 shadow form-control-lg">
                </div>
                <div class="form-group mb-4 login">
                  <input type="password" name="pass" style="margin: auto; width: 85%;" id="pass" required placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
                </div>

                <div class="form-group mb-4">
                  <div class="custom-control" align="right">
                    <a href="forgot_password " style="margin-right: 5em;color: #FFF;text-decoration: none;background-color: transparent;"> Forget Password </a>
                  </div>
                </div>
                <div align="center">
                  <button name="submit" type="submit" id="submit" onclick="login(this)" class="btn btn-primary shadow px-5">Login</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
  
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/sweetalert/sweetalert.min.js"></script>
    <script src="js/jquery.toaster.js"></script>

    <script type="text/javascript">
      $("#pass").keyup(function(event){
        if(event.keyCode == 13){
            $("#submit").click();
        }
      });

      function login(obj) {
        var mailpattern=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if ($('#user').val() == '' && $('#pass').val() == '') {
          $.toaster('Required...','All Fields are','warning');
        }else if ($('#user').val() == '') {
          $.toaster('Required Fields...', 'Username is', 'info');
        }else if ($('#pass').val() == '') {
          $.toaster('Required Fields...', 'Password is', 'info');
        } else {
          var formData = new FormData();
          formData.append("op","login");
          formData.append("user",$('#user').val());
          formData.append('pass',$('#pass').val());
          $.ajax({
            url : 'php/login.php',
            type : 'POST',
            processData : false,
            contentType : false,
            async : false,
            data : formData,
            success:function(result) {
              obj = JSON.parse(result);
              if (obj.err == 0) {
                $.toaster('Success',obj.result,'success');
                window.location.replace('dashboard ');
              } else {
                $.toaster('Failed',obj.result,'danger');
              }
            },error:function(result) {
              $.toaster(result,result,'danger');
            }
          })
        }
      }
  </script>
  </body>
</html>
