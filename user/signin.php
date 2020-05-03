<?php
	// Initialize the session
	session_start();
	 
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
	  header("location: ../redirect.php");
	  exit;
	}
	 
	// Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	 
	// Define variables and initialize with empty values
	$fname = $lname = $type = "";
	$username = $password = "";
	$username_err = $password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	 	$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		
		// Prepare a select statement
		$sql = "SELECT id, first_name, last_name, username, password, type FROM user WHERE username = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);
				
				// Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
					// Bind result variables
					mysqli_stmt_bind_result($stmt, $id, $fname, $lname, $username, $hashed_password, $type);
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
							
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username; 
							$_SESSION["fname"] = $fname; 
							$_SESSION["lname"] = $lname; 
							$_SESSION["type"] = $type; 
							
							// Close statement
							mysqli_stmt_close($stmt);
							
							
							// Redirect user to welcome page
							header("location: ../redirect.php");
						} else{
							// Display an error message if password is not valid
							$password_err = "The password you entered was not valid.";
						}
					}
				} else{
					// Display an error message if username doesn't exist
					$username_err = "No account found with that username.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
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

  <title>Project Alyx | Sign In</title>

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
	
      
    </div>
  </div>
  <!-- //sidebar menu end -->
  <!-- header-starts -->
  <div class="header sticky-header">

    <!-- notification menu start -->
    <div class="menu-right">
      <div class="navbar user-panel-top">
        <h1><a href="../index.php">Project Alyx</a></h1>
        
      </div>
    </div>
    <!--notification menu end -->
  </div>
  <!-- //header-ends -->
  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
        <div class="cards__heading">
            <h1><span>Sign In</span></h1>
            <?php
                if (!empty($username_err)) echo '<p>* '.$username_err.'</p>';
                if (!empty($password_err)) echo '<p>* '.$password_err.'</p>';
            ?>
        </div>
        <div class="card-body">
            <form action="signin.php" method="post">
                <div class="form-group col-md-6">
                    <label for="username" class="input__label">Username</label>
                    <input type="text" class="form-control input-style" name="username" id="username"
                        aria-describedby="nameHelp" placeholder="Enter Username" required>
                    <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="password" class="input__label">Password</label>
                    <input type="password" class="form-control input-style" name ="password" id="password"
                       aria-describedby="passHelp" placeholder="Enter Password" required>
                    <small id="passHelp" class="form-text text-muted">(6 Characters min)</small>
                </div>
                
                <button type="submit" class="btn btn-primary btn-style mt-4">Sign In</button>
            </form>
        </div>
    </div>
    
<?php
    include('footer.php');
?>