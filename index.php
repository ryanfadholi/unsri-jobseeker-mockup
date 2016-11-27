<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Link asli Bootstrap & jQuery
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/toastr.css" rel="stylesheet"/>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/toastr.js"></script>
</head>
<body>
<?php 
function create_placeholder($page){
  include(__DIR__ . '\applications\views\placeholder.php');
}
 ?> 
<div class="jumbotron text-center">
  <h1>Jobseeker Registration</h1>
  <p>Welcome to Unsri Job Fair 2017!</p>
</div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Navigation</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="sidebar active" id="home"><a href="#section1"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li class="sidebar" id="jobfair"><a href="#section2"><span class="glyphicon glyphicon-education"></span> Job Fair</a></li>
        <li class="sidebar" id="registration"><a href="#section3"><span class="glyphicon glyphicon-user"></span> Registration</a></li>
        <li class="sidebar" id="guide"><a href="#section4"><span class="glyphicon glyphicon-file"></span> Guide</a></li>
        <li class="sidebar" id="admin"><a href="admin"><span class="glyphicon glyphicon-log-in"></span> Go to Admin Page</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9" id="content">
    <?php create_placeholder("Home"); ?>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">

  // $(document).ready(function(){
  //   $("#home").addClass("active");
  //   $("#content").load("applications/views/placeholder.php?page=Home");
  //   changeTitle("Home")
  // });
  
  function changeTitle(name){
     jquery("#article-title").text(name);
  }

  function showToastr(){
     toastr.info("Hello World!");
  }

  $(".sidebar").click(function(){
    $(".sidebar").removeClass("active");
  })

  $("#home").click(function(){
     $("#home").addClass("active");
     $("#content").load("applications/views/placeholder.php?page=Home");
     changeTitle("Home")
   })

  $("#jobfair").click(function(){
     $("#jobfair").addClass("active");
     $("#content").load("applications/views/placeholder.php?page=JobFair");
     changeTitle("Job Fair Information");
  })

  $("#registration").click(function(){
     $("#registration").addClass("active");
     $('#content').load("applications/views/registration.php");
     changeTitle("Registration");
  })

  $("#guide").click(function(){
     $("#guide").addClass("active");
     $("#content").load("applications/views/placeholder.php?page=Guide");
     changeTitle("Guide");
  })

  $("#test").click(function(){
      toastr.info("Hello World!");
  })
</script>