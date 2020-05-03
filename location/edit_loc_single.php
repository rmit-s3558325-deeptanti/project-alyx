<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["lid"]))
	{
    	$loc_id = $_POST["locid"];
    	
    	$sql = "SELECT * FROM locations WHERE id = ?";
    	
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_bind_param($stmt, "i", $loc_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    	$data = [];
        $i = 0;
    	
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        	{
        		foreach ($row as $r)
        		{
        		    $data[$i] = $r;
        			$i++;
        		}
        	}
    
        mysqli_stmt_close($stmt);
	}	
	
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["lid"]))
	{
	    $sql = "UPDATE locations SET name=?, x=?, y=?, description=?, min_time=? WHERE id=?";
			 
    	$stmt = mysqli_prepare($conn, $sql);
    	
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "sddsii", $param_name, $param_x, $param_y, $param_desc, $param_min_time,$param_id);
		
		// Set parameters
		$param_name = ucfirst(trim($_POST["name"]));
		$param_x = $_POST["x"];
		$param_y = $_POST["y"];
		$param_desc = $_POST["description"];
		$param_min_time = $_POST["mintime"];
		$param_id = $_POST["lid"];
		
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt))
		{
			// Redirect to admin page
			header("location: edit_location.php");
		}
		
		else
		{
			echo "Something went wrong. Please try again later.";
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Project Alyx | Edit Location</title>
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
        <li class="breadcrumb-item active" aria-current="page">Edit Location</li>
      </ol>
      
    </nav>
    
    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
                <div class="cards__heading">
                    <h3><?php echo (ucfirst($_SESSION["type"])); ?></span> - Edit Location<span></span></h3>
                </div>
                <div class="card-body">
                    <form action="edit_loc_single.php" method="post">
                        <div class="form-group">
                            <label for="name" class="input__label">Name*</label>
                            <input type="text" class="form-control input-style" name="name" id="name"
                                aria-describedby="nameHelp" value="<?php echo $data[1]; ?>" required>
                            <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="x" class="input__label">X Co ordinates*</label>
                                <input type="text" class="form-control input-style" name ="x" id="x"
                                    placeholder="Enter X (eg. 13.123)" value="<?php echo $data[2]; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="y" class="input__label">Y Co ordinates*</label>
                                <input type="text" class="form-control input-style" name="y" id="y"
                                    placeholder="Enter Y (eg. 42.069)" value="<?php echo $data[3]; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="input__label">Description</label>
                            
                            <textarea rows="4" cols="50" class="form-control input-style" name="description" id="description"> <?php echo $data[4]; ?> </textarea>
                            <small id="descHelp" class="form-text text-muted">(500 Characters max)</small>
                        </div>
                        <div class="form-group">
                            <label for="mintime" class="input__label">Minimum Time to be spent on the Location*</label>
                            <input type="text" class="form-control input-style" name="mintime" id="mintime"
                                aria-describedby="nameHelp" placeholder="Enter Min Time in seconds" value="<?php echo $data[5]; ?>" required>    
                        </div>
                        <input type="hidden" name="lid" value="<?php echo $data[0]; ?>">
                        <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                    </form>
                </div>
            </div>

  </div>
<?php
    include('footer.php');
?>