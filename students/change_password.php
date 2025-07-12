<?php require_once 'include/header.php';?>

<div class="row" style="width: 60%">
  <div class="col-lg-12 md-10">
    <div class="card">
      <div class="card-header" align="center">
        <h6 class="text-uppercase mb-0">Change Password</h6>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="form-control-label text-uppercase col-md-6">Old Password</label>
          <div class="col-md-6">
                <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="Old Password">
            </div>
          </div>
          <div class="form-group row">
            <label class="form-control-label text-uppercase col-md-6">New Password</label>
            <div class="col-md-6">
                <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password">
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
            <button type="submit" class="btn btn-primary" name="submit" id="submit"  onclick="update_password(this);" style="margin: 10px;"> UPDATE PASSWORD </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'include/footer.php';?>

  <script type="text/javascript">
    function update_password(obj) {
      if ($('#old_pass').val() == '') {
        $.toaster('Required Field','Old Password is','danger');
      } else if ($('#new_pass').val() == '') {
        $.toaster('Required Field','New Password is','danger');
      } else if ($('#confirm_pass').val() == '') {
        $.toaster('Required Field','Confirm Password is','danger');
      } else if ($('#new_pass').val() != $('#confirm_pass').val()) {
        $.toaster('Password Does Not Matched','','danger');
      } else {
        var formData = new FormData();
        formData.append("op","change_password");
        formData.append("old_pass",$('#old_pass').val());
        formData.append("new_pass",$('#new_pass').val());
        formData.append("confirm_pass",$('#confirm_pass').val());
        swal({
          title: "Update Password",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        },
        function() {
          $.ajax({
            url: 'php/changepass.php',
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
                });
                $.toaster('',obj.result,'success');
                $('#old_pass').val('');
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
    $('#old_pass').val('');
    $('#new_pass').val('');
    $('#confirm_pass').val('');
  }
  </script>
