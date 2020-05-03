<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	    $sql = "INSERT INTO tour_types (name) VALUES (?)";
			 
    	if($stmt = mysqli_prepare($conn, $sql)){
    		// Bind variables to the prepared statement as parameters
    		mysqli_stmt_bind_param($stmt, "s", $param_name);
    		
    		// Set parameters
    		$param_name = ucfirst(trim($_POST["name"]));
    		
    		// Attempt to execute the prepared statement
    		if(mysqli_stmt_execute($stmt))
    		{
    			// Redirect to admin page
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
?>
<!doctype html>
<html lang="en">

<head>
  <title>Project Alyx | Add Location</title>
    <?php
        include("header.php");
    ?>
  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><?php echo ucfirst(($_SESSION["type"])); ?></li>
        <li class="breadcrumb-item"><a href="../<?php echo ($_SESSION["type"]); ?>.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Tour Type</li>
      </ol>
      
    </nav>
    
    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
        <div class="cards__heading">
            <h3><?php echo (ucfirst($_SESSION["type"])); ?> Dashboard</span> - Add Tour Type<span></span></h3>
        </div>
        <div class="card-body">
            <form action="add_tour_type.php" method="post">
                <div class="form-group">
                    <label for="name" class="input__label">Name*</label>
                    <input type="text" class="form-control input-style" name="name" id="name"
                        aria-describedby="nameHelp" placeholder="Enter Name" required>
                    <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                </div>
                
                <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>
  