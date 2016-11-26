<?php 
function generate_jobseeker_table($assoc_array = null){
?>
	<table class="table">
	    <thead>
	      <th>No.</th>
	      <th>Email</th>
	      <th>Name</th>
	    </thead>
	    <tbody>
	    <?php
	    $row_number = 1;
	    foreach ($assoc_array as $value) {
	      $html_row = '<th scope="row">' . $row_number . '</td>';
	      $html_row .= '<td>' . $value['email'] . '</td>';
	      $html_row .= '<td>' . $value['name'] . '</td>';
	      //Generate 'Edit' and 'Delete' buttons
	      $html_row .= '<td>' . '<div class="btn-toolbar"><button class="btn btn-primary editbtn" data-toggle="modal" data-target="#editModal" data-id="' . $value['email'] . '" >Edit</button>' . '<button type="button" class="btn btn-danger deletebtn btn-space" data-toggle="modal" data-target="#deleteModal" data-id="' . $value['email'] . '">Delete</button></div>' . '</td>';
	      echo '<tr>';
	      echo $html_row;
	      echo '</tr>'; 
	      $row_number++;
	    }
    	?>
        </tbody>
  	</table>

<?php 
	include('edit_modal.php');
	include('delete_modal.php');
 ?>
<script>

  $('.deletebtn').click(function(){
    /*
    Calls the deleteModal, and sets the modal
    for actions.
    */
    var userID = $(this).data('id');
    deleteModalInitialValue(userID);
  }); //end deletebtn OnClick

  $('.editbtn').click(function(){
  	/*
  	Calls the editModal, and sets the modal
  	for actions.
  	*/
    var userID = $(this).data('id');
    editModalInitialValue(userID);
    }); //end editbtn OnClick

  $('#deletemodalbtn').click( function() {
    var ajaxData = { 'act' : 'delete',
                     'dataid' : $("#bookId").val()}
    console.log(ajaxData['dataid']);
    $.ajax({
      type: "POST",
      data: ajaxData
    }).done(function( msg ) {
          toastr.success("Deletion Successful! Please Reload the Page.");
      }); //end done function
  }); //end deletemodalbtn
</script>

<?php 
}
 ?>


