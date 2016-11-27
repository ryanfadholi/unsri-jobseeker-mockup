<!DOCTYPE html>
<html lang="en">
<head>
  <title>Exact Search - by Email</title>
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
  include('header.php');
?>

<div class="container">
  <div class="row">
        <div class="col-md-4">
          <div id="search-label" align="right">
            <h2>Search For:</h2>
          </div>
        </div>
        <div class="col-md-8">
            <div id="custom-search-input">
            <br>
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Type the email...." id="searchfield" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button" id="searchbtn">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
  </div>
</div>

<div class="container-fluid" id="content">
</div>

<script>

  $(document).ready(function(){
    $("#view_single").addClass("active");
   }); //end document.ready

  $('#searchbtn').click(function(){

    //Get email inputted by user
    var email = $.trim($("#searchfield").val());

    //if the field IS NOT empty, do search
    if (email != "") {
      $('#content').load("../applications/views/admin_viewbyemail_table.php?email=" + email);
    //if the field IS empty, show a toastr warning.
    } else {
      toastr.warning("Please type an email first.");
    }    
  }); //end search button OnClick
</script>