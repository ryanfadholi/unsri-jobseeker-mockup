<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- START MODAL HEADER -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
      </div>
      <!-- END MODAL HEADER -->
      <!-- START MODAL BODY -->
      <div class="modal-body">
        <p>Do you really want to delete the account of <b><span class="insert_useremail"  id="useremail"></span></b>?</p>

        <!-- START PANEL GROUP -->
        <div class="panel panel-default" id="deleteuserdetails">
          <!-- START PANEL HEADING -->
          <div class="panel-heading">
            <button class ="btn btn-default pull-left" data-toggle="collapse" href="#userdetails" id="detail-toggler">
              <span id="toggle-status">Show</span> User Details - <span class="insert_useremail"></span>
            </button>

            <div class="clearfix"></div>
          </div>
          <!-- END PANEL HEADING-->
          <!-- START COLLAPSIBLE USER DETAILS -->
          <div id="userdetails" class="panel-collapse collapse">
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Nama</h5>
              <p class="list-group-item-text" id="details-nama"></p>
            </a>
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Nomor KTP</h5>
              <p class="list-group-item-text" id="details-noktp"></p>
            </a>
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Gender</h5>
              <p class="list-group-item-text" id="details-gender"></p>
            </a>
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Tempat Lahir</h5>
              <p class="list-group-item-text" id="details-birthplace"></p>
            </a>
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Tanggal Lahir</h5>
              <p class="list-group-item-text" id="details-birthdate"></p>
            </a>
            <a class="list-group-item">
              <h5 class="list-group-item-heading">Alamat</h5>
              <p class="list-group-item-text" id="details-address"></p>
            </a>
          </div> 
          <!-- END COLLAPSIBLE USER DETAILS -->
        </div>
        <!-- END PANEL GROUP -->
      </div>
      <!-- END MODAL BODY -->
      <!-- START MODAL FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deletemodalbtn" >Save changes</button>
      </div>
      <!-- END MODAL FOOTER -->
    </div>
  </div>
</div>

<script>
  function deleteModalInitialValue(userEmail){
    /*
    Set email on deleteModal details, which is required for another functions
    MAKE SURE to set this first when using this modal, preferably
    on the buttonclick event of the button that calls the modal. 
    */
    $('.insert_useremail').text(userEmail);
  }

   function populateModalDetails(formData){
    /*
    Fill the form in the modal based on the formData object,
    which is a parse result from the JSON provided by the Jobseeker DAO.
    */
    $("#deleteuserdetails #details-nama").text(formData.name);
    $("#deleteuserdetails #details-noktp").text(formData.noktp);
    if(formData.gender == 'L'){
      $("#deleteuserdetails #details-gender").text('Laki-Laki');
    } else {
      $("#deleteuserdetails #details-gender").text('Perempuan');
    }
    $("#deleteuserdetails #details-birthplace").text(formData.birthplace);
    $("#deleteuserdetails #details-birthdate").text(formData.birthdate);
    $("#deleteuserdetails #details-address").text(formData.address);
  }

    $('#detail-toggler').click(function(){
    /*
    Calls the detailToggle, and sets the modal
    for actions.
    */
    if($('#toggle-status').text() == "Show"){
      $('#toggle-status').text("Hide");
    } else {
      $('#toggle-status').text("Show");
    }
  }); //end deletebtn OnClick

   $('#deleteModal').on('shown.bs.modal', function(e) {
    /*
    When an deleteModal is shown, fill the form based on the
    email provided when the deleteModal is calle  d.
    */
     var ajaxData = { 'act' : 'getuserbyemail',
                     'email' : $('#useremail').text()}
    $.ajax({
      type: "POST",
      data: ajaxData,
      url: '../applications/controllers/crud_controller.php'
    }).done(function(result_json) {  
        // The argument is expected to be a JSON data parsed from
        // mysqli_fetch_array(), which is an array.
        var formData = $.parseJSON(result_json);

        //Output is in array, extract the value first.
        populateModalDetails(formData[0]);
      }); //end done function
  }); //end modal.shown event handler


</script>
