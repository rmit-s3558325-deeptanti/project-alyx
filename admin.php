<?php
	// Initialize the session
	session_start();
	
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Project Alyx | Admin Dashboard</title>

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
	
      <!-- sidebar nav start -->
      <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="active"><a href="admin.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-user"></i>
            <span>Users <i class="lnr lnr-user"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="user/delete_user.php">Deactivate Users</a> </li>
          </ul>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-map-marker"></i>
            <span>Locations <i class="lnr lnr-map-marker"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="location/add_location.php">Add Location </a> </li>
            <li><a href="location/edit_location.php">Edit Locations </a> </li>
            <li><a href="location/copy_location.php">Copy Locations </a> </li>
            <li><a href="location/delete_location.php">Delete Locations </a> </li>
          </ul>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-location-arrow"></i>
            <span>Tours <i class="lnr lnr-location"></i></span></a>
          <ul class="sub-menu-list">
              
            <li><a href="tour/add_tour.php">Add Tours </a> </li>
            <li><a href="tour/edit_tour.php">Edit Tours </a> </li>
            <li><a href="tour/delete_tour.php">Delete Tours </a> </li>  
            <li><a href="tour/add_tour_type.php">Add Tour Types </a> </li>
            <li><a href="tour/edit_tour_type.php">Edit Tour Types </a> </li>
            <li><a href="tour/delete_tour_type.php">Delete Tour Types </a> </li>
          </ul>
        </li>
      </ul>
      <!-- //sidebar nav end -->
    </div>
  </div>
  <!-- //sidebar menu end -->
  <!-- header-starts -->
  <div class="header sticky-header">

    <!-- notification menu start -->
    <div class="menu-right">
      <div class="navbar user-panel-top">
        <h1><a href="index.php">Project Alyx</a></h1>
        <div class="user-dropdown-details d-flex">
          <div class="profile_details">
            <ul>
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
                  aria-expanded="false">
                  <div class="profile_img">
                    <img src="assets/images/profileimg.jpg" class="rounded-circle" alt="" />
                    <div class="user-active">
                      <span></span>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                  <li class="user-info">
                    <h5 class="user-name"><?php echo (($_SESSION["fname"])." ".($_SESSION["lname"])); ?></h5>
                  </li>
                  <li class="logout"> <a href="user/logout.php"><i class="fa fa-power-off"></i> Logout</a> </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--notification menu end -->
  </div>
  <!-- //header-ends -->
  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><?php echo ucfirst(($_SESSION["type"])); ?><a href="index.php"></a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1>Hi <span class="text-primary"><?php echo ($_SESSION["fname"]); ?></span>, Welcome back</h1>
      <p>This is your <?php echo ucfirst(($_SESSION["type"])); ?> Dashboard.</p>
    </div>

    <!-- statistics data -->
    <div class="statistics">
      <div class="row">
        <div class="col-xl-12 pr-xl-2">
          <div class="row">
              
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-users"> </i>
				<a href="user/add_user.php">
                <h3 class="text-primary number">Add</h3>
                <p class="stat-text">User</p>
				</a>
              </div>
            </div>  
              
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-users"> </i>
				<a href="user/delete_user.php">
                <h3 class="text-primary number">Delete</h3>
                <p class="stat-text">User</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-map-marker"> </i>
				<a href="location/add_location.php">
                <h3 class="text-primary number">Add</h3>
                <p class="stat-text">Locations</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-map-marker"> </i>
				<a href="location/edit_location.php">
                <h3 class="text-primary number">Edit</h3>
                <p class="stat-text">Locations</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-map-marker"> </i>
				<a href="location/copy_location.php">
                <h3 class="text-primary number">Copy</h3>
                <p class="stat-text">Locations</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-map-marker"> </i>
				<a href="location/delete_location.php">
                <h3 class="text-primary number">Delete</h3>
                <p class="stat-text">Locations</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/add_tour_type.php">
                <h3 class="text-primary number">Add</h3>
                <p class="stat-text">Tour Types</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/edit_tour_type.php">
                <h3 class="text-primary number">Edit</h3>
                <p class="stat-text">Tour Types</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/delete_tour_type.php">
                <h3 class="text-primary number">Delete</h3>
                <p class="stat-text">Tour Types</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/add_tour.php">
                <h3 class="text-primary number">Add</h3>
                <p class="stat-text">Tour</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/edit_tour.php">
                <h3 class="text-primary number">Edit</h3>
                <p class="stat-text">Tour</p>
				</a>
              </div>
            </div>
            
            <div class="col-sm-3 pr-sm-2 statistics-grid">
              <div class="card card_border border-primary-top p-4">
                <i class="lnr lnr-location"> </i>
				<a href="tour/delete_tour.php">
                <h3 class="text-primary number">Delete</h3>
                <p class="stat-text">Tour</p>
				</a>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
<?php
    include('footer.php');
?>