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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Unsri Jobseeker - Admin Panel</a>
    </div>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Jobseeker List</a></li>
        <li><a href="#">Add New Jobseeker</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- <nav class="collapse navbar-collapse" id=bs-navbar> 
  <ul class="nav navbar-nav"> 
    <li class=active> <a href=../getting-started/ >Getting started</a> </li> 
    <li> <a href=../css/ >Input New Member</a> </li> 
    <li> <a href=../components/ >View Member</a> </li> 
    <li> <a href=../javascript/ >Edit Member</a> </li> 
    <li> <a href=../customize/ ></a> </li> 
  </ul> 
  <ul class="nav navbar-nav navbar-right"> 
    <li><a href=http://themes.getbootstrap.com onclick='ga("send","event","Navbar","Community links","Themes")'>Themes</a></li>
    <li><a href=http://expo.getbootstrap.com onclick='ga("send","event","Navbar","Community links","Expo")'>Expo</a></li>
    <li><a href=http://blog.getbootstrap.com onclick='ga("send","event","Navbar","Community links","Blog")'>Blog</a></li> 
  </ul> 
</nav>
<div class="col-sm-12" id="content"> -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" >
  Launch demo modal
</button>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
         <input type="text" name="bookId" id="bookId" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="modaldeletebtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
        This is where we put the form.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" >Save changes</button>
      </div>
    </div>
  </div>
</div>

  <?php
    require_once("../libs/koneksi.php");

    //Constants, change as needed.
    $default_page_num = 1;
    $default_data_per_page = 10;

    $koneksi = new Koneksi();
    $koneksi->Connect();

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
    }else{
      //If the URL doesn't send a variable, 
      //use default value instead.
      $data_per_page = $default_data_per_page;
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

    $query = "SELECT *
              FROM jobseeker_registration";

    $query_full_result = mysqli_num_rows(mysqli_query($koneksi->link,$query));
    $query_result = mysqli_query($koneksi->link, $query . " LIMIT $query_limit_start, $data_per_page");

    $first_page = 1;
    $last_page = ceil($query_full_result / $data_per_page);
    //If it's already on the first page, prevent the user from going off-limits.
    $prev_page = ($page_num == $first_page ? $first_page : $page_num - 1);
    //If it's already on the last page, prevent the user from going off-limits.
    $next_page = ($page_num == $last_page ? $last_page : $page_num + 1);

    function tablebtn($key){
      $editbtn = "<button type=\"button\" class=\"btn btn-primary\" href=\"..\">Edit</button>";
      return $editbtn;
    }

    function delete($email) {
      $result='SUCCESS';
      $koneksi = new Koneksi();
      $koneksi->connect();
      mysqli_query($koneksi->link,"DELETE FROM jobseeker_registration WHERE email=$email") or $result='warning';
      
      
      return $result;
    }
  ?>


  <p align="center"><?php echo $query_full_result . " results found.<br>";
              echo $data_per_page . " results per page shown."; ?></p>

  <hr><br><br>
  <p align="center"><?php echo "PAGE $page_num/$last_page" ?></p>


  <!-- Pagination Navigation buttons -->
  <nav aria-label="Registered Users List Navigation">
  <ul class="pager">
    <li><a href=<?php echo "?page=$first_page" ?>>First</a></li>
    <li><a href=<?php echo "?page=$prev_page" ?>>Previous</a></li>
    <li><a href=<?php echo "?page=$next_page" ?>>Next</a></li>
    <li><a href=<?php echo "?page=$last_page" ?>>Last</a></li>
  </ul>
  </nav>
  
  <!--Primary Data Table -->
  <table class="table">
    <thead>
      <th>No.</th>
      <th>Email</th>
      <th>Name</th>
      <th>Action</th>
    </thead>
    <tbody>
    <?php
    $row_number = $query_limit_start + 1;
    while($row = mysqli_fetch_assoc($query_result)){
      $html_row = '<th scope="row">' . $row_number . '</td>';
      $html_row .= '<td>' . $row['email'] . '</td>';
      $html_row .= '<td>' . $row['name'] . '</td>';
      $html_row .= '<td>' . '<button class="btn btn-primary" role="button" >Edit</button>' . '<button type="button" class="btn btn-danger deletebtn" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['email'] . '">Delete</button>' . '</td>';
      echo '<tr>';
      echo $html_row;
      echo '</tr>'; 
      $row_number++;
    }
    ?>
    </tbody>
  </table>
  <?php
    $koneksi->Disconnect();
  ?>
</div>
<script type="text/javascript">
  $('.deletebtn').click( function() {
    var userID = $(this).data('id');
    $(".modal-body #bookId").val(userID);
  });

  $('#modaldeletebtn').click( function() {
    var ajaxData = { 'act' : 'delete',
                     'dataid' : $("#bookId").val()}
    console.log(ajaxData['dataid']);
    $.ajax({
      type: "POST",
      data: ajaxData
    }).done(function( msg ) {
        toastr.success(msg);
    }); //end done button 
 }); //end modaldeletebtn
</script>
</body>