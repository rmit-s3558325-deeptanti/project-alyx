<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
	
	    $sql = "SELECT id, name, x, y, description, min_time FROM locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	mysqli_stmt_store_result($stmt);
    	$numrows = mysqli_stmt_num_rows($stmt);
    	mysqli_stmt_free_result($stmt);
    	mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, name, x, y, description, min_time FROM locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	
    	$data [$numrows][6] = array();
    	$i = $j = 0;
    	
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $data[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	
    	
    	// Close statement
    	mysqli_stmt_close($stmt);
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	    $lid = $_POST["locid"];
	    
	    $sql = "INSERT INTO locations (name, x, y, description, min_time) VALUES (?, ?, ?, ?, ?)";
			 
    	if($stmt = mysqli_prepare($conn, $sql)){
    		// Bind variables to the prepared statement as parameters
    		mysqli_stmt_bind_param($stmt, "sddsi", $param_name, $param_x, $param_y, $param_desc, $param_min_time);
    		
    		// Set parameters
            		$param_name = $_POST["name"].'(2)';
            		$param_x = $_POST["x"];
            		$param_y = $_POST["y"];
            		$param_desc = $_POST["desc"];
            		$param_min_time = $_POST["mintime"];
    	    
    		// Attempt to execute the prepared statement
    		if(mysqli_stmt_execute($stmt))
    		{
    			// Redirect to admin page
    			header("location: copy_location.php");
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
  <title>Project Alyx | Copy Locations</title>

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
        <li class="breadcrumb-item active" aria-current="page">Copy Locations</li>
      </ol>
      
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1><span class="text-primary"><?php echo ucfirst(($_SESSION["type"])); ?></span> Dashboard - Copy Locations</h1>
      <p>You can copy the Locations here.</p>
    </div>

    <!-- statistics data -->
    <div class="statistics">
      <div class="row">
        <div class="col-xl-12 pr-xl-4">
          <div class="row">
            
			<?php
					for($i=0;$i<$numrows;$i=$i+1)
                {?>
                
            <div class="col-sm-3 pr-sm-2 statistics-grid">
				<div class="card card_border border-primary-top p-4">
					<i class="lnr lnr-map-marker"> </i>
					
					<h3 class="text-primary number"><?php echo $data[$i][1]; ?></h3>
					<p class="stat-text">X: <?php echo $data[$i][2]; ?> | Y: <?php echo $data[$i][3]; ?></p>
					<p class="stat-text">Description: <?php echo ucfirst($data[$i][4]); ?></p>
					<p class="stat-text">Min Time: <?php echo $data[$i][5]; ?> secs</p>
					<form action="copy_location.php" method="post">
					<input type="hidden" name="locid" id="locid" value="<?php echo $data[$i][0]; ?>" />
					<input type="hidden" name="name" id="name" value="<?php echo $data[$i][1]; ?>" />
					<input type="hidden" name="x" id="x" value="<?php echo $data[$i][2]; ?>" />
					<input type="hidden" name="y" id="y" value="<?php echo $data[$i][3]; ?>" />
					<input type="hidden" name="desc" id="desc" value="<?php echo $data[$i][4]; ?>" />
					<input type="hidden" name="mintime" id="mintime" value="<?php echo $data[$i][5]; ?>" />
					<input type="submit" value="Copy">
					</form>
					
				
				</div>
            </div>
                	  
                <?php
                	}
				?>
          </div>
        </div>
      </div>
    </div>
    <!-- //statistics data -->

  </div>
<?php
    include('footer.php');
?>