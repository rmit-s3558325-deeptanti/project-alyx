<?php
	// Initialize the session
	session_start();
	
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
	  header("location: redirect.php");
	  exit;
	}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Project Alyx | Home</title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
<section>
  <!-- sidebar menu start -->
  <div class="sidebar-menu sticky-sidebar-menu">

    <!-- logo start -->
    <div class="logo">
      <h1><a href="index.php">Project Alyx</a></h1>
    </div>

    <div class="logo-icon text-center">
      <a href="index.php" title="logo"><img src="assets/images/logo.png" alt="logo-icon"> </a>
    </div>
    <!-- //logo end -->

    <div class="sidebar-menu-inner">
	
      
    </div>
  </div>
  <!-- //sidebar menu end -->
  <!-- header-starts -->
  <div class="header sticky-header">

    <!-- notification menu start -->
    <div class="menu-right">
      <div class="navbar user-panel-top">
        <h1><a href="index.php">Project Alyx</a></h1>
        
      </div>
    </div>
    <!--notification menu end -->
  </div>
  <!-- //header-ends -->
  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    
    <div class="welcome-msg pt-3 pb-4">
      <h1>Hi! Welcome to <span class="text-primary"></span>Project Alyx</h1>
      <br>
      <p>The project is for the development of an application that will configure NGV’s humanoid robots. It will be only accessible on the web, therefore can be accessed by all different platform as long they have an internet connection. The user interface will be designed as part of the project but will contain at the minimum, the ability to add and remove users; add, configure, copy and remove locations; create, configure and remove tours. Each of these are accessible by admins, who also can grant attendants access to the application.</p>
    </div>

    <!-- statistics data -->
    <div class="statistics">
      <div class="row">
        <div class="col-xl-12 pr-xl-2">
          <div class="row">
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-users"> </i>
				<a href="user/signup.php">
                <h3 class="text-primary number">Sign Up</h3>
                <p class="stat-text">Make a new account</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-user"> </i>
				<a href="user/signin.php">
                <h3 class="text-primary number">Sign In</h3>
                <p class="stat-text">Log in to your existing account</p>
				</a>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
    <!-- //statistics data -->

  </div>

<?php
    include('footer.php');
?>