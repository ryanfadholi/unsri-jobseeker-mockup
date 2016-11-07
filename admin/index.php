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
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="deletemodalbtn" >Save changes</button>
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
        <button type="button" class="btn btn-primary" id="editmodalbtn">Save changes</button>
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
      echo $email;
      $query = "DELETE FROM jobseeker_registration WHERE email='$email'";
      echo $query;
      mysqli_query($koneksi->link,$query) or $result='warning';
      
      echo '<button type="button" class="btn btn-primary btn-lg" >
  Launch demo modal
</button>';
      return $result;
    }
  ?>

<div class="container-fluid" id="content">
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
      $html_row = '<th scope="row">' . $row_number . '</th>';
      $html_row .= '<td>' . $row['email'] . '</td>';
      $html_row .= '<td>' . $row['name'] . '</td>';
      $html_row .= '<td>' . '<button class="btn btn-primary editbtn" data-toggle="modal" data-target="#editModal" data-id="' . $row['email'] . '" >Edit</button>' . '<button type="button" class="btn btn-danger deletebtn" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['email'] . '">Delete</button>' . '</td>';
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
  function populateEditForm(formData){
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

  function clearEditForm(){
    //Traverse the editModal div, empty the value of every input and textarea found.
    $('#editModal').find('input').val('');   
    $('#editModal').find('textarea').val('');  
  }

  $('.deletebtn').click( function() {
    var userID = $(this).data('id');
    $(".modal-body #bookId").val(userID);
  }); //end deletebtn OnClick

  $('.editbtn').click( function() {
    var userID = $(this).data('id');
    $('input[name=email]').val(userID);
    //$(".modal-body #bookId").val(userID);
  }); //end deletebtn OnClick

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

  $('#editmodalbtn').click( function() {
    var ajaxData = $('#form_jobseeker').serializeArray();
    ajaxData.push({name: 'act', value: 'update'});
    console.log(ajaxData);
    $.ajax({
      type: "POST",
      data: ajaxData,
      url: '../applications/controllers/crud_controller.php'
    }).done(function( msg ) {
          console.log(msg);
      }); //end done function
    $("#content").load("../applications/views/memberlist_table.php");

  }); //end deletemodalbtn

  
  $('#editModal').on('shown.bs.modal', function(e) {
    /*
    When an editModal is shown, fill the form based on the
    email provided when the editModal is called.
    */
    var ajaxData = { 'act' : 'getuserbyemail',
                     'email' : $('input[name=email]').val()}
    console.log(ajaxData['email']);
    $.ajax({
      type: "POST",
      data: ajaxData,
      url: '../applications/controllers/crud_controller.php'
    }).done(function(result_json) {
      console.log(result_json);
          var formData = $.parseJSON(result_json);
          populateEditForm(formData);
      }); //end done function
  }); //end modal.shown event handler

  //When the modal is closed, clear the form data
  $('#editModal').on('hidden.bs.modal', function () {
    clearEditForm();
})
</script>
</body>