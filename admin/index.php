<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="../css/toastr.css" rel="stylesheet"/>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/toastr.js"></script>
</head>
<body>

<?php
    require_once('../applications/controllers/crud_controller.php');
    require_once('../applications/views/crudtable_generator.php');

    //Constants, change as needed.
    $default_page_num = 1;
    $default_data_per_page = 10;

    //Determine the current page by URL.
    if(isset($_GET['page'])){
      $page_num = $_GET['page'];
    }else{
      //If the URL doesn't send a variable, 
      //use default value instead.
      $page_num = $default_page_num;
    }

      //Determine data shown per page by URL.
    if(isset($_POST['act'])){
      if($_POST['act'] == 'delete'){
        delete($_POST['dataid']);
     }
   }

    //Determine data shown per page by URL.
    if(isset($_GET['data'])){
      $data_per_page = $_GET['data'];
    }else{
      //If the URL doesn't send a variable, 
      //use default value instead.
      $data_per_page = $default_data_per_page;
    }

    $query_limit_start = ($page_num - 1) * 10 ;

    $crudcon = new CRUDController(array());
    $query_result = $crudcon->viewall($query_limit_start, $data_per_page, false);

    $query_full_result = count($query_result);

  $first_page = 1;
  $last_page = ceil($query_full_result / $data_per_page);
  //If it's already on the first page, prevent the user from going off-limits.
  $prev_page = ($page_num == $first_page ? $first_page : $page_num - 1);
  //If it's already on the last page, prevent the user from going off-limits.
  $next_page = ($page_num == $last_page ? $last_page : $page_num + 1);

    function delete($email) {
      $result='SUCCESS';
      $koneksi = new Koneksi();
      $koneksi->connect();
      echo $email;
      $query = "DELETE FROM jobseeker_registration WHERE email='$email'";
      echo $query;
      mysqli_query($koneksi->link,$query) or $result='warning';
            
      return $result;
    }

    include('header.php');
  ?>

<div class="container-fluid" id="content">
  <p align="center"><?php echo $query_full_result . " results found.<br>";
              echo $data_per_page . " results per page shown."; ?></p>

  <hr><br><br>

  <p align="center"><?php echo "PAGE <span class=\"page_num\">$page_num</span>/$last_page" ?></p>

  <!--Generate Primary Data Table -->
  <?php 
    generate_jobseeker_table($query_result);
  ?>

  <!-- Pagination Navigation buttons -->
  <nav aria-label="Registered Users List Navigation">
  <ul class="pager">
    <li><a href=<?php echo "?page=$first_page" ?>>First</a></li>
    <li><a href=<?php echo "?page=$prev_page" ?>>Previous</a></li>
    <li><a href=<?php echo "?page=$next_page" ?>>Next</a></li>
    <li><a href=<?php echo "?page=$last_page" ?>>Last</a></li>
  </ul>
  </nav>

<script>

  $(document).ready(function(){
    $("#jobseeker_list").addClass("active");
   }); //end document.ready

</script>

