<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style-starter.css">

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
      <h1><a href="../index.php">Project Alyx</a></h1>
    </div>

    <div class="logo-icon text-center">
      <a href="../index.php" title="logo"><img src="../assets/images/logo.png" alt="logo-icon"> </a>
    </div>
    <!-- //logo end -->

    <div class="sidebar-menu-inner">
	
       <!-- sidebar nav start -->
      <ul class="nav nav-pills nav-stacked custom-nav">
        <li><a href="../admin.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-user"></i>
            <span>Users <i class="lnr lnr-user"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="../user/add_user.php">Add User</a> </li>
            <li><a href="../user/delete_user.php">Delete Users</a> </li>
          </ul>
        </li>
        
        <li class="menu-list active">
          <a href="#"><i class="fa fa-map-marker"></i>
            <span>Locations <i class="lnr lnr-map-marker"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="add_location.php">Add Location </a> </li>
            <li><a href="edit_location.php">Edit Locations </a> </li>
            <li><a href="copy_location.php">Copy Locations </a> </li>
            <li><a href="delete_location.php">Delete Locations </a> </li>
          </ul>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-location-arrow"></i>
            <span>Tours <i class="lnr lnr-location"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="../tour/add_tour.php">Add Tours </a> </li>
            <li><a href="../tour/edit_tour.php">Edit Tours </a> </li>
            <li><a href="../tour/delete_tour.php">Delete Tours </a> </li>
            <li><a href="../tour/add_tour_type.php">Add Tour Types </a> </li>
            <li><a href="../tour/edit_tour_type.php">Edit Tour Types </a> </li>
            <li><a href="../tour/delete_tour_type.php">Delete Tour Types </a> </li>
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
        <h1><a href="../index.php">Project Alyx</a></h1>
        <div class="user-dropdown-details d-flex">
          <div class="profile_details">
            <ul>
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
                  aria-expanded="false">
                  <div class="profile_img">
                    <img src="../assets/images/profileimg.jpg" class="rounded-circle" alt="" />
                    <div class="user-active">
                      <span></span>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                  <li class="user-info">
                    <h5 class="user-name"><?php echo (($_SESSION["fname"])." ".($_SESSION["lname"])); ?></h5>
                  </li>
                  <li class="logout"> <a href="../user/logout.php"><i class="fa fa-power-off"></i> Logout</a> </li>
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