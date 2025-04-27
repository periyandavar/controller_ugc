<?php require_once 'include/header.php'; ?>

<!-- table layout -->
  <div class="row" onload="load_sheets();" >
    <div class="col-lg-12 mb-12">
      <div class="card">
        <div class="card-header" align="center">
          <h6 class="text-uppercase mb-0"> Question Bank </h6>
                <div class="card-body">
        <div class="row">
              
        <div class="card-body table-responsive">
          <table class="table table-striped table-hover card-text">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Subject Code</th>

                <th>Question Type</th>
               
                <th>Question</th>

                
              </tr>
            </thead>
            <tbody id="load_sheets"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php  require_once 'include/footer.php'; ?>

  <script type="text/javascript">
    function load_sheets() {

      var formData = new FormData();
      formData.append("reg","<?php echo$_SESSION['admin'];?>");
      formData.append("op","get_qbank");
      $.ajax({
        url: "php/sqbank.php",
        type: "POST",
        processData: false,
        contentType: false,
        async : false,
        data: formData,
        success:function(result) {
          obj = JSON.parse(result);
          var n,code = '';
          if (obj.err == 0) {
            for(n in obj.data) {
              code = code + '<tr>'+
              '<td>'+(parseInt(n)+1)+'</td>' +
              '<td>'+obj.data[n].code+'</td>' +
              '<td>'+obj.data[n].type+'</td>' +
              '<td> <a href="uploads/questions/'+obj.data[n].path+'" target="_blank">Download</a></td>' ;
              
              
              
              code = code + '</tr>';
            }
        }else{
          swal(obj.result,'','error');
        }
        $('#load_sheets').empty();
        $('#load_sheets').html(code);
        }
      });
    }

    load_sheets();

   
  </script>
