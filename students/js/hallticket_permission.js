function accepted($sem,$aca_yr) {
  var formData = new FormData();
  formData.append("op","accepted");
  formData.append("sem",$sem);
  formData.append("aca_yr",$aca_yr);
  var getValue = ajax_req(formData);
  swal({
    title: getValue,
  },function(){
    window.close();
  });
}

function decline() {
  var formData = new FormData();
  formData.append("op","decline");
  var getValue = ajax_req(formData);
  swal(getValue,"","error");
}

function ajax_req(formData) {
    var obj;
    $.ajax({
      url : 'php/hallticket_permission.php',
      type : 'POST',
      processData: false,
      contentType: false,
      async : false,
      data :formData,
      success:function(result) {
        obj = JSON.parse(result);
      }
    });
    return obj.result;
}
