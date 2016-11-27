<?php   
  $_GET['isajaxcall'] = false;
  require_once('../controllers/crud_controller.php');
  require_once('crudtable_generator.php');

  //Determine the email queried by URL.
    if(isset($_GET['email'])){
      $email_query = $_GET['email'];
    }else{
      //If the URL doesn't send an email, 
      //set the field as blank instead.
      $email_query = '';
    }

  $crudcon = new CRUDController($email_query);
  $query_result = $crudcon->getuserbyemail($email_query, false);

  if(!$query_result){
    echo "<h1>No results found!</h1>";
  } else {
      generate_jobseeker_table($query_result);
  }
    ?>
