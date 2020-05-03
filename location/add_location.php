<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	    $sql = "INSERT INTO locations (name, x, y, description, min_time) VALUES (?, ?, ?, ?, ?)";
			 
    	if($stmt = mysqli_prepare($conn, $sql)){
    		// Bind variables to the prepared statement as parameters
    		mysqli_stmt_bind_param($stmt, "sddsi", $param_name, $param_x, $param_y, $param_desc, $param_min_time);
    		
    		// Set parameters
    		$param_name = ucfirst(trim($_POST["name"]));
    		$param_x = $_POST["x"];
    		$param_y = $_POST["y"];
    		$param_desc = $_POST["description"];
    		$param_min_time = $_POST["mintime"];
    		
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
    include('header.php');
  ?>
  
  <!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><?php echo ucfirst(($_SESSION["type"])); ?></li>
        <li class="breadcrumb-item"><a href="../<?php echo ($_SESSION["type"]); ?>.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Location</li>
      </ol>
      
    </nav>
    
    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3><?php echo (ucfirst($_SESSION["type"])); ?> Dashboard</span> - Add Location<span></span></h3>
                </div>
                <div class="card-body">
                    <form action="add_location.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="input__label">Name*</label>
                                <input type="text" class="form-control input-style" name="name" id="name"
                                    aria-describedby="nameHelp" placeholder="Enter Name" required>
                                <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="x" class="input__label">X Co ordinates*</label>
                                <input type="text" class="form-control input-style" name ="x" id="x"
                                    placeholder="Enter X (eg. 13.123)" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="y" class="input__label">Y Co ordinates*</label>
                                <input type="text" class="form-control input-style" name="y" id="y"
                                    placeholder="Enter Y (eg. 42.069)" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="description" class="input__label">Description</label>
                                
                                <textarea rows="4" cols="50" class="form-control input-style" name="description" id="description">Enter Description </textarea>
                                <small id="descHelp" class="form-text text-muted">(500 Characters max)</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mintime" class="input__label">Minimum Time to be spent on the Location*</label>
                                <input type="text" class="form-control input-style" name="mintime" id="mintime"
                                    aria-describedby="nameHelp" placeholder="Enter Min Time in seconds" required>    
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                    </form>
                </div>
            </div>

  </div>
<?php
    include('footer.php');
?>
  