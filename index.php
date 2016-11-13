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
  echo "<h1> Hello! " . $page . " is still under construction. Please come back later!</h1>";
  echo "<h1>Try registering by clicking the Registration button on the left sidebar! </h1>";
 //<h1>Try registering by clicking the "Registration" button on the left sidebar! </h1>"
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
        <li class="sidebar" id="home"><a href="#section1">Home</a></li>
        <li class="sidebar" id="jobfair"><a href="#section2">Job Fair</a></li>
        <li class="sidebar" id="registration"><a href="#section3">Registration</a></li>
        <li class="sidebar" id="guide"><a href="#section4a">Guide</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9" id="content">
      <!-- <h4><small>RECENT POSTS</small></h4>
      <hr>
      <h2 id="article-title">I Love Food</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>
      <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><br> -->
      
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