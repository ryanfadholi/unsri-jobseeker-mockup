<?php   
  $_GET['isajaxcall'] = false;
  include '../controllers/crud_controller.php';

  //Determine the email queried by URL.
    if(isset($_GET['query'])){
      $query = $_GET['query'];
    }else{
      //If the URL doesn't send an email, 
      //set the field as blank instead.
      $query = '';
    }

  $crudcon = new CRUDController(array());
  $query_result = $crudcon->search($query, false);

  if(!$query_result){
    echo "<h1>No results found!</h1>";
  } else {
    //generate table and its headings
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
    foreach ($query_result as $value) {
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

  <?php } ?>
