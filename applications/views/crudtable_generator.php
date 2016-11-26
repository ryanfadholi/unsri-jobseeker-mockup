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
	      echo '<tr>';
	      echo $html_row;
	      echo '</tr>'; 
	      $row_number++;
	    }
    	?>
        </tbody>
  	</table>

<?php 
}
 ?>
