var formData = new FormData();
var academic_year;
// result publish
function sem() {
    if (document.getElementById('graduate').selectedIndex == 1) {
        document.getElementById('semester').options.length = 0;
        document.getElementById('semester').options.add(new Option('1'));
        document.getElementById('semester').options.add(new Option('2'));
    } else if (document.getElementById('graduate').selectedIndex == 2) {
        document.getElementById('semester').options.length = 0;
        document.getElementById('semester').options.add(new Option('3'));
        document.getElementById('semester').options.add(new Option('4'));
    } else {
        document.getElementById('semester').options.length = 0;
        document.getElementById('semester').options.add(new Option('5'));
        document.getElementById('semester').options.add(new Option('6'));
    }
}

// print option
function print_claim() {
    var divContent = document.getElementById('print_claim_table').outerHTML;
    newWin = window.open("");
    newWin.document.write('<html><head><title>Print Contents</title><style type="text/css">table th, table td {' +
    'border:1px solid #000;}</style></head><body>');
    newWin.document.write(divContent);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.focus();
    newWin.print();
    newWin.close();
}
/*
function print_claim() {
    var claim = document.getElementById('print_claim_table');
    // claim.classList.add("table-bordered");
    newWindow = window.open("");
    newWindow.document.write(claim.outerHTML);
    newWindow.print();
    newWindow.close();
}*/

// preloader
//Call this Function Preloader Show
function openModal() {
    document.getElementById('loadingmodal').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

//Call this function Preloader Hide
function closeModal() {
    document.getElementById('loadingmodal').style.display = 'none';
    document.getElementById('fade').style.display = 'none';
}

// to get depaertment name
function getDepartment() {
    var dept_code = $('#dept_code').val();
    formData.append("op", "getDeptName");
    formData.append("dept_code", dept_code);
    var getValue = ajax_req(formData, "common.php");
    $('#dept_name').val(getValue.value);
}

function getSubjectCode() {
    var dept_code = $('#dept_code').val();
    formData.append("op", "getSubCode");
    formData.append("dept_code", dept_code);
    var getValue = ajax_req(formData, "common.php");
    var count = getValue.data.length;
    var option = '<option value="Select Subject Code" style="display: none;">Select Subject Code</option>';
    for (var i = 0; i < count; i++) {
        option += '<option>' + getValue.data[i].sub_code + '</option>';
    }
    $('#sub_code').empty();
    $('#sub_code').append(option);
}

function getSubjectName() {
    var sub_code = $('#sub_code').val();
    formData.append("op", "getSubName");
    formData.append("sub_code", sub_code);
    var getValue = ajax_req(formData, "common.php");
    $('#sub_name').val(getValue.value);
}

function activeYear(id, val) {
    formData.append("op", "activeYear");
    formData.append("id", id);
    formData.append("status", val);
    var getValue = ajax_req(formData, "addDetails.php");
    if (getValue.err == 0) {
        swal(getValue.result, "", "success");
    } else {
        swal(getValue.result, "", "error");
    }
    loadDataIntoTab();
}

function deactiveYear(id, val) {
    formData.append("op", "deactiveYear");
    formData.append("id", id);
    formData.append("status", val);
    var getValue = ajax_req(formData, "addDetails.php");
    if (getValue.err == 0) {
        swal(getValue.result, "", "success");
    } else {
        swal(getValue.result, "", "error");
    }
    loadDataIntoTab();
}

function getAcademicYear() {
    formData.append("op", "getAcademicYear");
    var getValue = ajax_req(formData, "common.php");
    $('#academic_year').val(getValue.aca_yr);
    academic_year = getValue.aca_yr;
}

/*window.onload = function onloading() {
  loadDataIntoTab();
}*/

function external_mark(obj) {
  formData.append("op","external_mark");
  formData.append("dept_code",$('#dept_code').val());
  formData.append("sub_code",$('#sub_code').val());
  var temp = ajax_req(formData, "mark_updation.php");
  document.getElementById('external').style.display = "block";
  var data = [];
  for(var i=0;i<temp.length-3;i++){
      var jsonValues=Object.values(temp[i]);
      data.push(jsonValues);
      console.log("jsonValues:"+jsonValues);
  }
  var headers=temp[temp.length-3];
  var colWidth=temp[temp.length-2];
  var colType=temp[temp.length-1];
  var col=[];
  for(var i=0;i<colType.length;i++){
      col[i]={ type:colType[i] }
  }
  console.log(col);
  $('#externalTable').jexcel({
      data:data,
      columns: col,
      colHeaders: headers,
      colWidths: colWidth
  });

  // Invoking jExcel Library..
  // $('#externalTable').jexcel('updateSettings',{
  //     table: function (instance, cell, col, row, val, id) {
  //     // Format numbers
  //     if (col != (headers.length-1) && col!=0 && col!=1) {
  //         // Get text
  //        var txt = $(cell).text();
  //         // Format text
  //         txt = numeral(txt).format('0.00');
  //         // Update cell value
  //         $(cell).html(txt);
  //     }
    //
    // if(col == (headers.length-1)) {
    //     // Get text
    //    var txt = $(cell).text();
    //     // Format text
    //     txt = numeral(txt).format('0');
    //     // Update cell value
    //     $(cell).html(txt);
    // }
    // Bold the total row
    // if ($(cell).text() == 'Total Mark') {
    //     $('.r' + row).css('font-weight', 'bold');
    //     $('.r' + row).css('background-color', '#fffaa3');
    // }
  //   }
  // });
}

function add_external_marks(obj) {
  var data = $('#externalTable').jexcel('getData');
  console.log(data);
  console.log(JSON.stringify(data));
  formData.append("op","add_marks");
  formData.append("data",JSON.stringify(data));
  swal({
    title: "Add Marks",
    text: "Are you sure add this marks ?",
    type: "info",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },function(){
    var getValue = ajax_req(formData, "mark_updation.php");
  });
  if (getValue.err == 0) {
    swal(getValue.result,"","success");
  } else {
    swal(getValue.result,"","error");
  }
  document.getElementById('external').style.display = "none";
  $('#dept_code').val('Select Department Code');
  $('#sub_code').val('Select Subject Code');
}

function send_mail(obj) {
  formData.append("op","send_hall_ticket");
  formData.append("dept_code",$('#dept_code').val());
  formData.append("sem",$('#semester').val());
  formData.append("aca_yr",academic_year);
  swal({
     title: "Send Hall ticket to Students",
     text: "Are you sure send hall ticket for this "+$('#dept_code').val(),
     type: "info",
     showCancelButton: true,
     closeOnConfirm: false,
     showLoaderOnConfirm: false,
    },function(){
        var getValue = ajax_req(formData, "hall_ticket.php");
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
}


function clear() {
  alert("clear");
  $('#theory').val('');
  $('#prac').val('');
  $('#prac3').val('');
  $('#prac4').val('');
  $('#prac6').val('');
  $('#prac9').val('');
  $('#com').val('');
  $('#mini').val('');
  $('#arr_theory').val('');
  $('#arr_prac').val('');
  $('#arr_prac3').val('');
  $('#arr_prac4').val('');
  $('#arr_prac6').val('');
  $('#arr_prac9').val('');
  $('#arr_com').val('');
  $('#arr_mini').val('');
  $('#mark_stmt_amt').val('');
  $('#last_date').val('');
  $('#first_fine_amt').val('');
  $('#final_fine_amt').val('');
  $('#first_fine_date').val('');
  $('#final_fine_date').val('');
  $('#pro_fees').val('');
  $('#certi_fees').val('');
  $('#academic_year').val('Select Academic Year');
  $('#dept').val('Select Department Code');
}
// result analysis report function...
function result_analysis(obj) {
  var formData = new FormData();
  formData.append("op","result_analysis");
  formData.append("dept_code",$('#dept_code').val());
  formData.append("academic_year",$('#academic_year').val());
  formData.append("semester",$('#semester').val());
  var temp = ajax_req(formData, "mark_updation.php");
  document.getElementById('report_table').style.display = "block";
  var data = [];
  for(var i=0;i<temp.length-3;i++){
      var jsonValues=Object.values(temp[i]);
      data.push(jsonValues);
      console.log("jsonValues:"+jsonValues);
  }
  var headers=temp[temp.length-3];
  var colWidth=temp[temp.length-2];
  var colType=temp[temp.length-1];
  var col=[];
  for(var i=0;i<colType.length;i++){
      col[i]={ type:colType[i] }
  }
  console.log(col);
  $('#resultTab').jexcel({
      data:data,
      columns: col,
      colHeaders: headers,
      colWidths: colWidth
  });
}

function result_analysis_entry(obj) {
  var data = $('#resultTab').jexcel('getData');
  console.log(data);
  var formData = new FormData();
  formData.append("op","result_analysis_entry");
  formData.append("data",JSON.stringify(data));
  swal({
    title: "Add Details",
    text: "Are you sure add this Details ?",
    type: "info",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },function(){
     obj = ajax_req(formData, "mark_updation.php");
    if (obj.err == 0) {
      setTimeout(function() {
          swal(obj.result,"","success");
      });
    } else {
      setTimeout(function() {
          swal(obj.result,"","error");
      });
    }
  });
  document.getElementById('report_table').style.display = "none";
  $('#dept_code').val('Select Department Code');
  $('#academic_year').val('Select Academic Year');
  $('#semester').val('Select Semester');
}
// gender-wise analysis report...
function gender_wise_analysis(obj) {
  var formData = new FormData();
  formData.append("op","gender_wise_analysis");
  formData.append("aca_yr",$('#academic_year').val());
  formData.append("sem",$('#semester').val());
  var temp = ajax_req(formData, "mark_updation.php");
  document.getElementById('gender_report').style.display = "block";
  var data = [];
  for(var i=0;i<temp.length-3;i++){
      var jsonValues=Object.values(temp[i]);
      data.push(jsonValues);
      console.log("jsonValues:"+jsonValues);
  }
  var headers=temp[temp.length-3];
  var colWidth=temp[temp.length-2];
  var colType=temp[temp.length-1];
  var col=[];
  for(var i=0;i<colType.length;i++){
      col[i]={ type:colType[i] }
  }
  console.log(col);
  $('#gender_report_tab').jexcel({
      data:data,
      columns: col,
      colHeaders: headers,
      colWidths: colWidth
  });
}

function gender_result_analysis_entry(obj) {
    var data = $('#gender_report_tab').jexcel('getData');
    console.log(data);
    var formData = new FormData();
    formData.append("op","gender_result_analysis_entry");
    formData.append("data",JSON.stringify(data));
    swal({
      title: "Add Details",
      text: "Are you sure add this Details ?",
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
    },function(){
       obj = ajax_req(formData, "mark_updation.php");
      if (obj.err == 0) {
        setTimeout(function() {
            swal(obj.result,"","success");
        });
      } else {
        setTimeout(function() {
            swal(obj.result,"","error");
        });
      }
   });
    document.getElementById('gender_report').style.display = "none";
    $('#academic_year').val('Select Academic Year');
    $('#semester').val('Select Semester');
}
