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
        <li><a href="index.php">Jobseeker List</a></li>
        <li class="active"><a href="#">Search Jobseeker by email</a></li>
        <li><a href="search.php">Search</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href=".."><span class="glyphicon glyphicon-log-in"></span> Go to Main Page</a></li>
      </ul>
    </div>
  </div>
</nav>

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
    //$("#memberlist_table").load("../applications/views/memberlist_table.php");
  });

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