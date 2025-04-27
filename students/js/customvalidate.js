var object_value;
// onkeypress="return functionname(event)" --> use to validation method
// validation methods
function onlyalphaNumaricValidation(e) {
  // onkeypress="return onlyalphaNumaricValidation(event)"
  var regex = new RegExp("^[a-zA-Z0-9 \b]+$");
  var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  var keystobepassedout = "ArrowLeftArrowRightDeleteBackspaceTab";
  if (keystobepassedout.indexOf(e.key) != -1) {
    return true;
  }
  if (!regex.test(key)) {
    e.preventDefault();
    return false;
  }
}

function onlynumberValidation(evt) {
  // onkeypress="return onlynumberValidation(event)"
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

function onlyalphabetValidation(e) {
  // onkeypress="return onlyalphabetValidation(event)"
  var regex = new RegExp("^[a-zA-Z \b]+$");
  var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  var keystobepassedout = "ArrowLeftArrowRightDeleteBackspaceTab";
  if (keystobepassedout.indexOf(e.key) != -1) {
      return true;
  }
  if (!regex.test(key)) {
      e.preventDefault();
      return false;
  }
}

function ajax_req(formData, filename) {
  $.ajax({
      url: 'php/' + filename,
      type: 'POST',
      processData: false,
      contentType: false,
      async: false,
      data: formData,
      success: function(result) {
        object_value = JSON.parse(result);
      },error:function(result) {
        object_value = "Error Occured !";
      }
  });
  return object_value;
}

function datepicker_validate(id_val) {
  $('#' + id_val).datepicker({
      language: 'en',
      autoClose: true,
      dateFormat: 'dd/mm/yyyy',
      minDate: new Date() // Now can select only dates, which goes after today
  });
}

function timepicker_validation(id_val) {
  $('#' + id_val).datepicker({
    dateFormat: ' ',
    language: 'en',
    timepicker: true,
    datepicker: false,
    classes: 'only-timepicker'
  });
}

$(function() {
  $('.sidebar-toggler').on('click', function () {
      $('.sidebar').toggleClass('shrink show');
  });
});
