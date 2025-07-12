function addBatchButton() {
	document.getElementById('batchFields').style.display = "block";
	document.getElementById('batch_tab').style.display = "block";
	document.getElementById('reporting_time').style.display = "none";
	document.getElementById('time_duration').style.display = "none";
	document.getElementById('report_tab').style.display = "none";
	document.getElementById('duration_tab').style.display = "none";
}

function addReportingTimeButton() {
	document.getElementById('reporting_time').style.display = "block";
	document.getElementById('report_tab').style.display = "block";
	document.getElementById('batchFields').style.display = "none";
	document.getElementById('time_duration').style.display = "none";
	document.getElementById('batch_tab').style.display = "none";
	document.getElementById('duration_tab').style.display = "none";
}

function addTimeDurationButton() {
	document.getElementById('time_duration').style.display = "block";	
	document.getElementById('duration_tab').style.display = "block";
	document.getElementById('reporting_time').style.display = "none";
	document.getElementById('batchFields').style.display = "none";
	document.getElementById('batch_tab').style.display = "none";
	document.getElementById('report_tab').style.display = "none";
}

function clear() {
	$('#batch').val('');
	$('#r_t').val('');
	$('#t_d').val('');
	$('#academic_year').val('Select Academic Year');
	$('#semester').val('Select Semester');
	$('#date').val('');
	$('#batch').val('Select Batch Type');
	$('#report_time').val('Select Reporting Time');
	$('#time_duration').val('Select Time Duration');
	$('#ug_lab').val('');
	$('#pg_lab').val('');
}

// batch start ...
function addBatchDetails(obj) {
	if ($('#batch').val() == '') {
		swal("Batch is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","addBatchDetails");
		formData.append("batch",$('#batch').val());
		swal({
			title: "Add New Batch",
			text: "Add Batch " + $("#batch").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						loadBatchType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadBatchType();
					}); 
				});
			}
		});
	}
}

function loadBatchType() {
	var formData = new FormData();
	formData.append("ak","loadBatchType");
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		var code = '';
		var n;
		for (n in getValue.data) {
			code = code + '<tr>' +
			'<td>'+(parseInt(n)+1)+'</td>' +
			'<td>'+getValue.data[n].batch+'</td>'+
			'<td><img id="editBatchTabEle" src="img/edit.svg" width="35px" height="35px" data-toggle="modal" data-target="#myModal" onclick="editBatchTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit">&nbsp;&nbsp;<img id="deleteBatchTabEle" src="img/trash.svg" width="35px" height="35px" onclick="deleteBatchTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit"></td></tr>';
		} 
	} else {
		swal(getValue.result);
	}
	$('#loadBatchType').empty();
	$('#loadBatchType').html(code);
}
setTimeout(function () {
	loadBatchType();
});
var id;
function editBatchTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","editBatchTabEle");
	formData.append("id",$(obj).attr('data-id'));
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		id = getValue.id;
		$('#batch').val(getValue.batch);
		$('#batch').focus();
		$('#update').show();
		$('#add').hide();
	}
}

function deleteBatchTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","deleteBatchTabEle");
	formData.append("id",$(obj).attr('data-id'));
	swal({
		title: "Delete this Batch Type",
		type: "error",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},function(){
		var getValue = ajax_req(formData, "onlinetest.php");
		if (getValue.err == 0) {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "success",
				},function(){
					loadBatchType();
				}); 
			});
		} else {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "success",
				},function(){
					loadBatchType();
				}); 
			});
		}
	});
	loadBatchType();
}

function updateBatchDetails(obj) {
	if ($('#batch').val() == '') {
		swal("Batch is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","updateBatchDetails");
		formData.append("batch",$('#batch').val());
		formData.append("id",id);
		swal({
			title: "Update a Batch",
			text: "Update Batch " + $("#batch").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						$('#add').show();
						$('#update').hide();
						loadBatchType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadBatchType();
					}); 
				});
			}
		});
	}
}
// batch details end...
// report time start...
function addReportTimeDetails(obj) {
	if ($('#r_t').val() == '') {
		swal("Reporting Time is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","addReportTimeDetails");
		formData.append("r_t",$('#r_t').val());
		swal({
			title: "Add New Reporting Time",
			text: "Add Reporting Time " + $("#r_t").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						loadReportType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadReportType();
					}); 
				});
			}
		});
	}
}

function loadReportType() {
	var formData = new FormData();
	formData.append("ak","loadReportType");
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		var code = '';
		var n;
		for (n in getValue.data) {
			code = code + '<tr>' +
			'<td>'+(parseInt(n)+1)+'</td>' +
			'<td>'+getValue.data[n].r_t+'</td>'+
			'<td><img id="editReportTabEle" src="img/edit.svg" width="35px" height="35px" data-toggle="modal" data-target="#myModal" onclick="editReportTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit">&nbsp;&nbsp;<img id="deleteReportTabEle" src="img/trash.svg" width="35px" height="35px" onclick="deleteReportTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit"></td></tr>';
		} 
	} else {
		swal(getValue.result);
	}
	$('#loadReportType').empty();
	$('#loadReportType').html(code);
}
setTimeout(function () {
	loadReportType();
});
var id;
function editReportTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","editReportTabEle");
	formData.append("id",$(obj).attr('data-id'));
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		id = getValue.id;
		$('#r_t').val(getValue.r_t);
		$('#r_t').focus();
		$('#update1').show();
		$('#add1').hide();
	}
}

function deleteReportTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","deleteReportTabEle");
	formData.append("id",$(obj).attr('data-id'));
	swal({
		title: "Delete this Report Time",
		type: "error",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},function(){
		var getValue = ajax_req(formData, "onlinetest.php");
		if (getValue.err == 0) {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "success",
				},function(){
					loadReportType();
				}); 
			});
		} else {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "success",
				},function(){
					loadReportType();
				}); 
			});
		}
	});
	loadReportType();
}

function updateReportTimeDetails(obj) {
	if ($('#r_t').val() == '') {
		swal("Reporting TIme is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","updateReportTimeDetails");
		formData.append("r_t",$('#r_t').val());
		formData.append("id",id);
		swal({
			title: "Update Reporting Time",
			text: "Update Reporting Time" + $("#r_t").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						$('#add1').show();
						$('#update1').hide();
						loadReportType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadReportType();
					}); 
				});
			}
		});
	}
}
// report time end ...
// time duration start ...
function addTimeDurationDetails(obj) {
	if ($('#t_d').val() == '') {
		swal("Time Duration is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","addTimeDurationDetails");
		formData.append("t_d",$('#t_d').val());
		swal({
			title: "Add New Time Duration",
			text: "Add Time Duration " + $("#t_d").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						loadTimeType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadTimeType();
					}); 
				});
			}
		});
	}
}

function loadTimeType() {
	var formData = new FormData();
	formData.append("ak","loadTimeType");
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		var code = '';
		var n;
		for (n in getValue.data) {
			code = code + '<tr>' +
			'<td>'+(parseInt(n)+1)+'</td>' +
			'<td>'+getValue.data[n].t_d+'</td>'+
			'<td><img id="editTimeTabEle" src="img/edit.svg" width="35px" height="35px" data-toggle="modal" data-target="#myModal" onclick="editTimeTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit">&nbsp;&nbsp;<img id="deleteTimeTabEle" src="img/trash.svg" width="35px" height="35px" onclick="deleteTimeTabEle(this);" data-id="'+getValue.data[n].id+'" type="submit"></td></tr>';
		} 
	} else {
		swal(getValue.result);
	}
	$('#loadTimeType').empty();
	$('#loadTimeType').html(code);
}
setTimeout(function () {
	loadTimeType();
});
var id;
function editTimeTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","editTimeTabEle");
	formData.append("id",$(obj).attr('data-id'));
	var getValue = ajax_req(formData, "onlinetest.php");
	if (getValue.err == 0) {
		id = getValue.id;
		$('#t_d').val(getValue.t_d);
		$('#t_d').focus();
		$('#update2').show();
		$('#add2').hide();
	}
}

function deleteTimeTabEle(obj) {
	var formData = new FormData();
	formData.append("ak","deleteTimeTabEle");
	formData.append("id",$(obj).attr('data-id'));
	swal({
		title: "Delete this Time Duration",
		type: "error",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},function(){
		var getValue = ajax_req(formData, "onlinetest.php");
		if (getValue.err == 0) {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "success",
				},function(){
					loadTimeType();
				}); 
			});
		} else {
			setTimeout(function(){
				swal({
					title: getValue.result,
					type: "error",
				},function(){
					loadTimeType();
				}); 
			});
		}
	});
	loadTimeType();
}

function updateTimeDurationDetails(obj) {
	if ($('#t_d').val() == '') {
		swal("Time Duration is Required Field !");
	} else {
		var formData = new FormData();
		formData.append("ak","updateTimeDurationDetails");
		formData.append("t_d",$('#t_d').val());
		formData.append("id",id);
		swal({
			title: "Update a Time Duration",
			text: "Update Time Duration " + $("#t_d").val(),
			type: "info",
			showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,   
		},function(){
			var getValue = ajax_req(formData, "onlinetest.php");
			if (getValue.err == 0) {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "success",
					},function(){
						clear();
						$('#add2').show();
						$('#update2').hide();
						loadTimeType();
					}); 
				});
			} else {
				setTimeout(function(){ 
					swal({
						title: getValue.result,
						type: "error",
					},function(){
						clear();
						loadTimeType();
					}); 
				});
			}
		});
	}
}
// time duration end...
// comprehension exam schedule start...
// add sub details start
function addDetails(obj){
	if ($('#academic_year').val() == 'Select Academic Year') {
    	swal('Academic Year is Required Fields !');
	}else if ($('#semester').val() == 'Select Semester') {
    	swal('Semester is Required Field !');
  	}else if ($('#date').val() == '') {
        swal('Exam Date is Required Fields !');
	}else if ($('#batch').val() == '') {
    	swal('Batch is Required Fields !');
  	}else if ($('#report_time').val() == '') {
    	swal('Reporting Time is Required Fields !');
  	}else if ($('#time_duration').val() == '') {
    	swal('Time duration is Required Fields !');
  	}else if ($('#ug_lab').val() == '') {
    	swal('UG Lab Subject Code is Required Fields !');
  	}else if ($('#pg_lab').val() == 'Select Type Of Schedule') {
      	swal('PG Lab Subject Code is Required Fields !');
  	}else{
    	var formData = new FormData();
        formData.append("ak","comp_exam");
        formData.append("academic_year",$('#academic_year').val());
        formData.append("semester",$('#semester').val());
        formData.append("date",$('#date').val());
        formData.append("batch",$('#batch').val());
        formData.append("report_time",$('#report_time').val());
        formData.append("time_duration",$('#time_duration').val());
        formData.append("ug_lab",$('#ug_lab').val());
        formData.append("pg_lab",$('#pg_lab').val());
        swal({
           title: "Add New Exam Schedule",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: false,
           showLoaderOnConfirm: true,
          }, function(){
           	obj = ajax_req(formData, "onlinetest.php");
	        if(obj.err == 0) {
            	setTimeout(function(){
                	swal({
                		title: obj.result,
                		type: "success" 
                	},function(){
                    	clear();
                		loadOnlineExamData();
                    });
        	    });
    	    } else {
            	setTimeout(function(){
                	swal({
                		title: obj.result,
                		type: "error" 
                	},function(){
                		clear();
                		loadOnlineExamData();
                	});
            	});
        }
    });
}
}
// end
// start table load fun...
function loadOnlineExamData() {
    var formData = new FormData();
    formData.append("ak","loadOnlineExamDate");
    var obj = ajax_req(formData, "onlinetest.php");
    var code = '';
    if (obj.err==0) {
        var n;
        for (n in obj.data) {
            code = code + '<tr>'+
            '<td>'+(parseInt(n)+1)+'</td>' +
            '<td>'+obj.data[n].year+'</td>' +
            '<td>'+obj.data[n].semester+'</td>' +
            '<td>'+obj.data[n].date+'</td>' +
            '<td>'+obj.data[n].batch+'</td>' +
            '<td>'+obj.data[n].r_t+'</td>' +
          	'<td>'+obj.data[n].t_d+'</td><td>';
          	var ugsub = obj.data[n].uglab.split(',');
          	var pgsub = obj.data[n].pglab.split(',');
          	for (var i = 0; i < ugsub.length; i++) {
          		code = code + ugsub[i] + '<br>';
          	}
          	code = code + '</td><td>';
          	for (var i = 0; i < pgsub.length; i++) {
          		code = code + pgsub[i] + '<br>';
          	}
            code = code +'</td>'+
            '<td><img id="editOnlineExamTabEle" src="img/edit.svg" width="35px" height="35px" onclick="editOnlineExamTabEle(this);" data-id="'+obj.data[n].id+'" type="submit">&nbsp;&nbsp;<img id="deleteOnlineExamTabEle" src="img/trash.svg" width="35px" height="35px" onclick="deleteOnlineExamTabEle(this);" data-id="'+obj.data[n].id+'" type="submit"></td>'+
            '</tr>';
        }
    }else{
        swal(obj.result);
    }
    $('#com_exam_table').empty();
	$('#com_exam_table').html(code);
}
loadOnlineExamData();
// end load fun...
// start edit table fun...
var id;
function editOnlineExamTabEle(obj){
  var formData = new FormData();
  formData.append("ak","editOnlineExamTabEle");
  formData.append("id",$(obj).attr('data-id'));
  obj = ajax_req(formData, "onlinetest.php");
  if (obj.err == 0) {
    id = obj.id;
	$('#academic_year').val(obj.academic_year);
	$('#semester').val(obj.semester);
	$('#date').val(obj.date);
	$('#batch').val(obj.batch);
	$('#report_time').val(obj.report_time);
	$('#time_duration').val(obj.time_duration);
	$('#ug_lab').val(obj.uglab);
	$('#pg_lab').val(obj.pglab);
	$('#update').show();
    $('#submit').hide();
  }
}
//end edit ta fun...
// start delete tab ele fun...
function deleteOnlineExamTabEle(obj){
  var formData = new FormData();
  formData.append("ak","deleteOnlineExamTabEle");
  formData.append("id",$(obj).attr('data-id'));
  swal({
   title: "Delete an Exam Schedule",
   type: "error",
   showCancelButton: true,
   closeOnConfirm: false,
   showLoaderOnConfirm: true,
  },function(){
   	obj = ajax_req(formData, "onlinetest.php");
   	if (obj.err == 0){
          setTimeout(function(){
            swal({
            	title:obj.result,
            	type: "success"
          },function(){
          	loadOnlineExamData();
          });
        });
    } else {
          setTimeout(function(){
            swal({
            	title:obj.result,
            	type: "error"
          },function(){
          	loadOnlineExamData();
          });
  		});
    }
	});
}
// end delete tab fun...
// start update tab fun...
function updateDetails(obj){
	if ($('#academic_year').val() == 'Select Academic Year') {
    	swal('Academic Year is Required Fields !');
	}else if ($('#semester').val() == 'Select Semester') {
    	swal('Semester is Required Field !');
  	}else if ($('#date').val() == '') {
        swal('Exam Date is Required Fields !');
	}else if ($('#batch').val() == '') {
    	swal('Batch is Required Fields !');
  	}else if ($('#report_time').val() == '') {
    	swal('Reporting Time is Required Fields !');
  	}else if ($('#time_duration').val() == '') {
    	swal('Time duration is Required Fields !');
  	}else if ($('#ug_lab').val() == '') {
    	swal('UG Lab Subject Code is Required Fields !');
  	}else if ($('#pg_lab').val() == 'Select Type Of Schedule') {
      	swal('PG Lab Subject Code is Required Fields !');
  	}else{
    	var formData = new FormData();
        formData.append("ak","update_comp_ecam");
        formData.append("academic_year",$('#academic_year').val());
        formData.append("semester",$('#semester').val());
        formData.append("date",$('#date').val());
        formData.append("batch",$('#batch').val());
        formData.append("report_time",$('#report_time').val());
        formData.append("time_duration",$('#time_duration').val());
        formData.append("ug_lab",$('#ug_lab').val());
        formData.append("pg_lab",$('#pg_lab').val());
        formData.append("id",id);
        swal({
           title: "Update an Exam Schedule",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: false,
           showLoaderOnConfirm: true,
          }, function(){
           	obj = ajax_req(formData, "onlinetest.php");
	        if(obj.err == 0) {
            	setTimeout(function(){
                	swal({
                		title: obj.result,
                		type: "success" 
                	},function(){
                    	clear();
                		loadOnlineExamData();
                    });
        	    });
    	    } else {
            	setTimeout(function(){
                	swal({
                		title: obj.result,
                		type: "error" 
                	},function(){
                		clear();
                		loadOnlineExamData();
                	});
            	});
        }
    });
}
}
// end update fun..
// comprehension exam schedule end...