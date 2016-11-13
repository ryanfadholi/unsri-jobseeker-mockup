<?php   
  $_GET['isajaxcall'] = false;
  include '../controllers/crud_controller.php';

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
    //generate table and its headings
    echo "<table class=\"table\">
    <thead>
      <th>Email</th>
      <th>Name</th>
      <th>Action</th>
    </thead>
    <tbody>";

    $html_row = '<th scope="row">' . $query_result['email'] . '</td>';
    $html_row .= '<td>' . $query_result['name'] . '</td>';
    $html_row .= '<td>' . '<button class="btn btn-primary editbtn" data-toggle="modal" data-target="#editModal" data-id="' . $query_result['email'] . '" >Edit</button>' . '<button type="button" class="btn btn-danger deletebtn" data-toggle="modal" data-target="#deleteModal" data-id="' . $query_result['email'] . '">Delete</button>' . '</td>';

    echo '<tr>';
    echo $html_row;
    echo '</tr>'; 

    }
    ?>
    </tbody>
  </table>
