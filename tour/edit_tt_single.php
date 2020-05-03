<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["lid"]))
	{
    	$loc_id = $_POST["locid"];
    	
    	$sql = "SELECT * FROM tour_types WHERE id = ?";
    	
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
	    $sql = "UPDATE tour_types SET name=? WHERE id=?";
			 
    	$stmt = mysqli_prepare($conn, $sql);
    	
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "si", $param_name, $param_id);
		
		// Set parameters
		$param_name = ucfirst(trim($_POST["name"]));
		
		$param_id = $_POST["lid"];
		
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt))
		{
			// Redirect to admin page
			header("location: edit_tour_type.php");
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
  <title>Project Alyx | Edit Tour Types</title>
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
        <li class="breadcrumb-item active" aria-current="page">Edit Tour Types</li>
      </ol>
      
    </nav>
    
    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
        <div class="cards__heading">
            <h3><?php echo (ucfirst($_SESSION["type"])); ?></span> - Edit Tour Types<span></span></h3>
        </div>
        <div class="card-body">
            <form action="edit_tt_single.php" method="post">
                <div class="form-group">
                    <label for="name" class="input__label">Name*</label>
                    <input type="text" class="form-control input-style" name="name" id="name"
                        aria-describedby="nameHelp" value="<?php echo $data[1]; ?>" required>
                    <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
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