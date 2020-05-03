<?php
	// Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
 
    // Initialize the session
	session_start(); 
 
	// Define variables and initialize with empty values
	$first_name = $last_name = $type = "";
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	 // Validate username
		if(empty(trim($_POST["username"])))
		{
			$username_err = "Please enter a username.";
		} 
		else
		{
			// Prepare a select statement
			$sql = "SELECT id FROM user WHERE username = ?";
			
			if($stmt = mysqli_prepare($conn, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["username"]);
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					/* store result */
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1)
					{
						$username_err = "This username is already taken.";
					} 
					else
					{
						$username = trim($_POST["username"]);
					}
				} 
				else
				{
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}
		
		// Validate password
		if(empty(trim($_POST["password"])))
		{
			$password_err = "Please enter a password.";     
		} 
		elseif(strlen(trim($_POST["password"])) < 6)
		{
			$password_err = "Password must have atleast 6 characters.";
		} 
		else
		{
			$password = trim($_POST["password"]);
		}
		
		// Validate confirm password
		if(empty(trim($_POST["confirm_password"])))
		{
			$confirm_password_err = "Please confirm password.";     
		} 
		else
		{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password))
			{
				$confirm_password_err = "Passwords did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			
			// Prepare an insert statement
			$sql = "INSERT INTO user (first_name, last_name, username, password, type) VALUES (?, ?, ?, ?, ?)";
			 
			if($stmt = mysqli_prepare($conn, $sql))
			{
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "sssss", $param_fname, $param_lname, $param_username, $param_password, $param_type);
				
				// Set parameters
				$param_fname = ucfirst(trim($_POST["first_name"]));
				$param_lname = ucfirst(trim($_POST["last_name"]));
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				$param_type = trim($_POST["type"]);
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt))
				{
					// Redirect to Admin Dashboard
					header("location: ../admin.php");
				} 
				else
				{
					echo "Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}
		
		// Close connection
		mysqli_close($conn);
	}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Project Alyx | Add User</title>

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
        
        <li class="menu-list active">
          <a href="#"><i class="fa fa-user"></i>
            <span>Users <i class="lnr lnr-user"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="add_user.php">Add User</a> </li>
            <li><a href="delete_user.php">Delete Users</a> </li>
          </ul>
        </li>
        
        <li class="menu-list">
          <a href="#"><i class="fa fa-map-marker"></i>
            <span>Locations <i class="lnr lnr-map-marker"></i></span></a>
          <ul class="sub-menu-list">
            <li><a href="../location/add_location.php">Add Location </a> </li>
            <li><a href="../location/edit_location.php">Edit Locations </a> </li>
            <li><a href="../location/copy_location.php">Copy Locations </a> </li>
            <li><a href="../location/delete_location.php">Delete Locations </a> </li>
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
                  <li class="logout"> <a href="logout.php"><i class="fa fa-power-off"></i> Logout</a> </li>
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
        <li class="breadcrumb-item"><?php echo ucfirst(($_SESSION["type"])); ?></li>
        <li class="breadcrumb-item"><a href="../<?php echo ($_SESSION["type"]); ?>.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add User</li>
      </ol>
      
    </nav>


    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
        <div class="cards__heading">
            <h1><span><?php echo ucfirst(($_SESSION["type"])); ?> Dashboard - Add User</span></h1>
            <?php
                if (!empty($username_err)) echo '<p>* '.$username_err.'</p>';
                if (!empty($password_err)) echo '<p>* '.$password_err.'</p>';
                if (!empty($confirm_password_err)) echo '<p>* '.$confirm_password_err.'</p>';
            ?>
        </div>
        <div class="card-body">
            
            <form action="add_user.php" method="post">
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name" class="input__label">First Name</label>
                        <input type="text" class="form-control input-style" id="first_name" name="first_name" placeholder="First Name">
                        <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name" class="input__label">Last Name</label>
                        <input type="text" class="form-control input-style" id="last_name" name="last_name" placeholder="Last Name">
                        <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="input__label">Username</label>
                        <input type="text" class="form-control input-style" name="username" id="username"
                            aria-describedby="nameHelp" placeholder="Enter Username" required>
                        <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password" class="input__label">Password</label>
                        <input type="password" class="form-control input-style" name ="password" id="password"
                           aria-describedby="passHelp" placeholder="Enter Password" required>
                        <small id="passHelp" class="form-text text-muted">(6 Characters min)</small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="confirm_password" class="input__label">Confirm Password</label>
                        <input type="password" class="form-control input-style" name ="confirm_password" id="confirm_password" aria-describedby="passHelp" placeholder="Enter Password" required>
                        <small id="passHelp" class="form-text text-muted">(6 Characters min)</small>
                    </div>
                </div>
                
				<div class="form-group">
					<label for="type" class="input__label">Account Type</label>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="radio" id="admin" name="type" value="admin" checked>
							<label class="form-check-label" for="gridRadios1">
								Admin
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" id="assistant" name="type" value="assistant">
							<label class="form-check-label" for="gridRadios2">
								Assistant
							</label>
						</div>
					</div>
				</div>
                
                <button type="submit" class="btn btn-primary btn-style mt-4">Sign up</button>
            </form>
        </div>
    </div>
    
<?php
    include('footer.php');
?>