<?php   
  $_GET['isajaxcall'] = false;
  require_once('../controllers/crud_controller.php');
  require_once('crudtable_generator.php');
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
    generate_jobseeker_table ($query_result);
  } 
?>
