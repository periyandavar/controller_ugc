var formData = new FormData();
var getValue;
var obj;
var id;

function add_pg_fees(tag) {
  if ($('#theory').val() == '') {
    swal("Regular Theory Paper is Required Fields...", "","error");
  } else if ($('#prac').val() == '') {
    swal("Regular Practical Paper is Required Fields...", "","error");
  } else if ($('#prac4').val() == '') {
    swal("Regular Practical Paper(4-Hours) is Required Fields...","","error");
  } else if ($('#prac6').val() == '') {
    swal("Regular Practical Paper(6-Hours) is Required Fields...","","error");
  } else if ($('#prac3').val() == '') {
    swal("Regular Practical Paper(3-Hours) is Required Fields...","","error");
  } else if ($('#prac9').val() == '') {
    swal("Regular Practical Paper(9-Hours) is Required Fields...","","error");
  } else if ($('#com').val() == '') {
    swal("Regular Comprehension is Required Fields...","","error");
  } else if ($('#mini').val() == '') {
    swal("Regular Mini Project Required Fields...", "","error");
  } else if ($('#arr_theory').val() == '') {
    swal("Arrear Theory Paper Required Fields...", "","error");
  } else if ($('#arr_prac').val() == '') {
    swal("Arrear Practical Paper Required Fields...", "","error");
  } else if ($('#arr_prac4').val() == '') {
    swal("Arrear Practical Paper(4-Hours) Required Fields...","","error");
  } else if ($('#arr_prac6').val() == '') {
    swal("Arrear Practical Paper(6-Hours) Required Fields...","","error");
  } else if ($('#arr_prac3').val() == '') {
    swal("Arrear Practical Paper(3-Hours) Required Fields...","","error");
  } else if ($('#arr_prac9').val() == '') {
    swal("Arrear Practical Paper(9-Hours) Required Fields...","","error");
  } else if ($('#arr_com').val() == '') {
    swal("Arrear Comprehension is Required Fields...","","error");
  } else if ($('#arr_mini').val() == '') {
    swal("Arrear Mini Project Required Fields...", "","error");
  } else if ($('#mark_stmt_amt').val() == '') {
    swal("Mark Statement Amount Required Fields...", "","error");
  } else if ($('#last_date').val() == '') {
    swal("Last Date is Required Fields...","","error");
  } else if ($('#first_fine_amt').val() == '') {
    swal("First Fine Amount Required Fields...", "","error");
  } else if ($('#first_fine_last_date').val() == '') {
    swal("First Fine Amount Last Date Required Fields...","","error");
  } else if ($('#final_fine_amt').val() == '') {
    swal("Final Fine Amount Required Fields...", "","error");
  } else if ($('#final_fine_last_date').val() == '') {
    swal("Final Fine Amount Last Date is Required Fields...","","error");
  } else if ($('#pro_fees').val() == '') {
    swal("Provisional Fees is Required Fields...", "","error");
  } else if ($('#certi_fees').val() == '') {
    swal("Certificate Fees is Required Fields...", "","error");
  } else if ($('#univer_fees').val() == '') {
    swal("University Fees is Required Fields...", "","error");
  } else {
    formData.append("op",tag);
    formData.append("theory",$('#theory').val());
    formData.append("arr_theory",$('#arr_theory').val());
    formData.append("mark_stmt_amt",$('#mark_stmt_amt').val());
    formData.append("pro_fees",$('#pro_fees').val());
    formData.append("certi_fees",$('#certi_fees').val());
    formData.append("last_date",$('#last_date').val());
    formData.append("first_fine_amt",$('#first_fine_amt').val());
    formData.append("first_fine_last_date",$('#first_fine_last_date').val());
    formData.append("final_fine_amt",$('#final_fine_amt').val());
    formData.append("final_fine_last_date",$('#final_fine_last_date').val());
    if (tag == "pgcertify_fees" || tag == "pgdiploma_fees") {
      formData.append("prac",$('#prac').val());
      formData.append("arr_prac",$('#arr_prac').val());
      swal({
         title: "Add this fees structure",
         type: "info",
         showCancelButton: true,
         closeOnConfirm: false,
         showLoaderOnConfirm: true,
        },
         function(){
            var getValue = ajax_req(formData, "fees_schedule.php");
            if (getValue.err == 0) {
              setTimeout(function(){
                swal(getValue.result,"", "success");
              });
            } else {
              setTimeout(function(){
                swal(getValue.result,"", "error");
              });
            }
         });
    } else if (tag == "pgaided_fees") {
      formData.append("prac4",$('#prac4').val());
      formData.append("prac6",$('#prac6').val());
      formData.append("arr_prac4",$('#arr_prac4').val());
      formData.append("arr_prac6",$('#arr_prac6').val());
      formData.append("com",$('#com').val());
      formData.append("arr_com",$('#arr_com').val());
      swal({
         title: "Add this fees structure",
         type: "info",
         showCancelButton: true,
         closeOnConfirm: false,
         showLoaderOnConfirm: true,
        },
         function(){
            var getValue = ajax_req(formData, "fees_schedule.php");
            if (getValue.err == 0) {
              setTimeout(function(){
                swal(getValue.result,"", "success");
              });
            } else {
              setTimeout(function(){
                swal(getValue.result,"", "error");
              });
            }
         });
    } else if (tag == "pgself_fees") {
      formData.append("prac3",$('#prac3').val());
      formData.append("prac9",$('#prac9').val());
      formData.append("arr_prac3",$('#arr_prac3').val());
      formData.append("arr_prac9",$('#arr_prac9').val());
      formData.append("com",$('#com').val());
      formData.append("arr_com",$('#arr_com').val());
      formData.append("mini",$('#mini').val());
      formData.append("arr_mini",$('#arr_mini').val());
      swal({
         title: "Add this fees structure",
         type: "info",
         showCancelButton: true,
         closeOnConfirm: false,
         showLoaderOnConfirm: true,
        },
         function(){
            var getValue = ajax_req(formData, "fees_schedule.php");
            if (getValue.err == 0) {
              setTimeout(function(){
                swal(getValue.result,"", "success");
              });
            } else {
              setTimeout(function(){
                swal(getValue.result,"", "error");
              });
            }
         });
    } else if (tag == "mphil_fees") {
      formData.append("prac",$('#prac').val());
      formData.append("arr_prac",$('#arr_prac').val());
      formData.append("univer_fees",$('#univer_fees').val());
      swal({
         title: "Add this fees structure",
         type: "info",
         showCancelButton: true,
         closeOnConfirm: false,
         showLoaderOnConfirm: true,
        },
         function(){
            var getValue = ajax_req(formData, "fees_schedule.php");
            if (getValue.err == 0) {
              setTimeout(function(){
                swal(getValue.result,"", "success");
                refresh();
              });
            } else {
              setTimeout(function(){
                swal(getValue.result,"", "error");
              });
            }
         });
    }
  }
  clear();
}

function refresh() {
  setTimeout(function() {
    location.reload();
  }, 5000);
}

$(document).ready(function() {
  $('#update').hide();
  $('#update1').hide();
  $('#update2').hide();
});

function addLES(obj){
  if ($('#les').val() == '') {
      swal("Later Entry is Required Fields...", "","error");
  }else{
    formData.append("op","addles");
    formData.append("les",$('#les').val());
    swal({
      title: "Add New Later Entry",
      text:  $('#les').val(),
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
    }, function() {
      var getValue = ajax_req(formData, "les.php")
      if(getValue.err==0) {
        setTimeout(function(){ swal(getValue.result,"","success"); });
      } else {
        setTimeout(function(){ swal(getValue.result,"","error"); });
      }
    });
    clear();
  }
  loadDataIntoTab();
}

function clear() {
  $('#les').val('');
}

function editTabEle(obj){
  formData.append("op","editles");
  formData.append("id",$(obj).attr('data-id'));
  obj = ajax_req(formData, "les.php");
  if (obj.err == 0) {
    id = obj.id;
    $('#les').val(obj.les);
    $('#les').focus();
    $('#update').show();
    $('#add').hide();
  }
}

function deleteTabEle(obj){
  formData.append("op","delles");
  formData.append("id",$(obj).attr('data-id'));
  swal({
   title: "Delete this later entry",
   type: "error",
   showCancelButton: true,
   closeOnConfirm: false,
   showLoaderOnConfirm: true,
  }, function(){
    obj = ajax_req(formData, "les.php");
    if (obj.err == 0) {
      setTimeout(function(){ swal(obj.result,"", "success"); });
    } else {
      setTimeout(function(){ swal(obj.result,"", "danger"); });
    }
    loadDataIntoTab();
  });
}

function updateLES(obj){
  if ($('#les').val() == '') {
    swal("Later Entry is Required Fields...", "","error");
  }else{
    formData.append("op","updateles");
    formData.append("les",$('#les').val());
    formData.append("id",id);
    swal({
     title: "Update Later Entry",
     text: $('#les').val(),
     type: "info",
     showCancelButton: true,
     closeOnConfirm: false,
     showLoaderOnConfirm: true,
    }, function(){
      obj = ajax_req(formData, "les.php");
      if(obj.err==0) {
        setTimeout(function(){ swal(obj.result,"","success"); });
        $('#les').val('');
        $('#add').show();
        $('#update').hide();
        loadDataIntoTab();
      }else{
        setTimeout(function(){ swal(obj.result,"","error"); });
      }
    });
  }
}

function perform_stud(obj) {
  document.getElementById('perform_stud_div').style.display="block";
    var formData = new FormData();
    formData.append("ak","perform_stud");
    formData.append("dept_name",$('#dept_code').val());
    formData.append("aca_yr",$('#academic_year').val());
    formData.append("sem",$('#semester').val());
    $.ajax({
        url : 'php/third_report.php',
        type : 'POST',
        processData: false,
        contentType: false,
        async : false,
        data :formData,
        success:function(result) {
            obj = JSON.parse(result);
            var code = '';
            if (obj.err==0) {
                var n;
                for (n in obj.data) {
                    code = code + '<tr>'+
                    '<td>'+(parseInt(n)+1)+'</td>';
                    if (obj.data[n].arrear) {
                      code = code + '<td>'+obj.data[n].reg_no+'</td>' +
                      '<td>'+obj.data[n].name+'</td>' +
                      '<td></td>' +
                      '<td></td>' +
                      '<td></td>' +
                      '<td></td>' +
                      '<td></td>' +
                      '<td>'+obj.data[n].arrear+'</td>';
                    } else {
                        code = code + '<td>'+obj.data[n].reg_no+'</td>' +
                        '<td>'+obj.data[n].name+'</td>' +
                        '<td>'+obj.data[n].total+'</td>' +
                        '<td>'+obj.data[n].grade_point+'</td>' +
                        '<td>'+obj.data[n].grade+'</td>' +
                        '<td>'+obj.data[n].class+'</td>' +
                        '<td>'+obj.data[n].rank+'</td>' +
                        '<td></td>' ;
                    }
                    code = code + '</tr>';
                }
            }else{
                swal(obj.result,'','danger');
            }
            $('#perform_stud').empty();
            $('#perform_stud').html(code);
        }
    })
}
