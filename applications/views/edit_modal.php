<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="editModalLabel">Edit Member Data</h4>
      </div>
      <div class="modal-body">
        <form id="form_jobseeker">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" id="email" type="email" name="email" required readonly></input>
              </div>
              <div class="form-group">
                  <label for="name">Nama:</label>
                  <input class="form-control" id="name" name="name"></input>
              </div>
              <div class="form-group">
                <label for="ktp_id">No. KTP:</label>
                <input class="form-control" id="ktp_id" name="ktp_id"></input>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="birthplace">Tempat Lahir:</label>
                <input class="form-control" id="birthplace" name="birthplace"></input>
              </div>
              <div class="form-group">
                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"></input>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="address">Alamat:</label>
                <textarea class="form-control" id="address" name="address" rows="4"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="editmodalbtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  function clearEditForm(){
    //Traverse the editModal div, empty the value of every input and textarea found.
    $('#editModal').find('input').val('');   
    $('#editModal').find('textarea').val('');  
  }

  function populateModalData(formData){
    /*
    Fill the form in the modal based on the formData object,
    which is a parse result from the JSON provided by the Jobseeker DAO.
    */
    $("#form_jobseeker #name").val(formData.name);
    $("#form_jobseeker #ktp_id").val(formData.noktp);
    $("#form_jobseeker #gender").val(formData.gender);
    $("#form_jobseeker #birthplace").val(formData.birthplace);
    $("#form_jobseeker #birthdate").val(formData.birthdate);
    $("#form_jobseeker #address").val(formData.address);
  }

  function editModalInitialValue(userEmail){
    /*
    Set email on editModal, which is required for another functions
    MAKE SURE to set this first when using this modal, preferably
    on the buttonclick event of the button that calls the modal. 
    */
    $('input[name=email]').val(userEmail);
  }

  $('#editModal').on('shown.bs.modal', function(e) {
    /*
    When an editModal is shown, fill the form based on the
    email provided when the editModal is called.
    */
    var ajaxData = { 'act' : 'getuserbyemail',
                     'email' : $('input[name=email]').val()}
    $.ajax({
      type: "POST",
      data: ajaxData,
      url: '../applications/controllers/crud_controller.php'
    }).done(function(result_json) {
        /*
        The argument is expected to be a JSON data parsed from
        mysqli_fetch_array(), which is an array.
        */
        var formData = $.parseJSON(result_json);
        //Output is in array, extract the value first.
        populateModalData(formData[0]);
      }); //end done function
  }); //end modal.shown event handler

  $('#editModal').on('hidden.bs.modal', function () {
    /*
    When the modal is closed, clear the form data
    */
    clearEditForm();
  }); //end modal.hidden event handler
  
  $('#editmodalbtn').click( function() {
    /*
    When the button is clicked, call the ajax function.
    */ 
    var ajaxData = $('#form_jobseeker').serializeArray();
    ajaxData.push({name: 'act', value: 'update'});
    console.log(ajaxData);
    $.ajax({
      type: "POST",
      data: ajaxData,
      url: '../applications/controllers/crud_controller.php'
    }).done(function( msg ) {
          console.log(msg);
          location.reload();
      }); //end done function
  }); //end deletemodalbtn
</script>