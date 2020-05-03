<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["tid"]))
	{
    	$t_id = $_POST["t_id"];
    	
    	$sql = "SELECT * FROM tours WHERE id = ?";
    	
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_bind_param($stmt, "i", $t_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    	$t_data = [];
        $i = 0;
    	
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $t_data[$i] = $r;
    			$i++;
    		}
    	}
        mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, name, x, y, description, min_time FROM locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$locations = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $locations[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, name FROM tour_types";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$tour_types = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $tour_types[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, tour_id, location_id FROM tour_locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$tour_locations = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $tour_locations[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
	}
	
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tid"]))
	{
	    $tid = $_POST["tid"];
	   
	    $sql = "SELECT id, name, x, y, description, min_time FROM locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$locations = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $locations[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, name FROM tour_types";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$tour_types = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $tour_types[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
    	
    	$sql = "SELECT id, tour_id, location_id FROM tour_locations";
    	$stmt = mysqli_prepare($conn, $sql);
    	mysqli_stmt_execute($stmt);
    	$result = mysqli_stmt_get_result($stmt);
    	$tour_locations = array();
    	$i = $j = 0;
    	
    	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{
    		foreach ($row as $r)
    		{
    		    $tour_locations[$i][$j] = $r;
    			$j++;
    		}
    		$j = 0;
    		$i++;
    	}
    	mysqli_stmt_close($stmt);
    	
    	
        $sel_loc = $_POST['locations'];
        
        $sum_min_count = 0;
        foreach ($sel_loc as $s)
    	{
    	    for($i=0;$i<count($locations);$i++)
            {
                if($s == $locations[$i][0])
                {
                    $sum_min_count = $sum_min_count + $locations[$i][5];
                    break;
                }
            }
    	}
        
        $sql = "UPDATE tours SET name=?, min_duration=?, type=? WHERE id=?";
			 
    	$stmt = mysqli_prepare($conn, $sql);
    	
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "siii", $param_name, $param_min, $param_type, $param_id);
		
		// Set parameters
		$param_name = ucfirst(trim($_POST["name"]));
    	$param_min = $sum_min_count;
    	$param_type = $_POST["type"];
		$param_id = $_POST["tid"];
		
		
		// Attempt to execute the prepared statement
		if(mysqli_stmt_execute($stmt))
		{
		    mysqli_stmt_close($stmt);
		    
			$sql = "DELETE FROM tour_locations WHERE tour_id = ?";
		
		    if($stmt = mysqli_prepare($conn, $sql))
		    {
    			mysqli_stmt_bind_param($stmt, "i", $tid);
    			mysqli_stmt_execute($stmt);
    			mysqli_stmt_close($stmt);
		    }
		    
		    else
    		{
    			echo "Something went wrong. Please try again later.";
    		}
		    
		    foreach ($sel_loc as $s)
	        {
    		    $sql = "INSERT INTO tour_locations (tour_id, location_id) VALUES (?, ?)";
			 
            	if($stmt = mysqli_prepare($conn, $sql))
            	{
            		// Bind variables to the prepared statement as parameters
            		mysqli_stmt_bind_param($stmt, "ii", $param_tour, $param_loc);
            		
            		// Set parameters
            		$param_tour = $tid;
            		$param_loc = $s;
            		
            		// Attempt to execute the prepared statement
            		mysqli_stmt_execute($stmt);
            		mysqli_stmt_close($stmt);
            	}
            }
		    
			// Redirect to admin page
			header("location: edit_tour.php");
		}
		
		else
		{
			echo "Something went wrong. Please try again later.";
		}
	}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Project Alyx | Edit Tours</title>
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
        <li class="breadcrumb-item active" aria-current="page">Edit Tours</li>
      </ol>
      
    </nav>
    
    <!-- statistics data -->
    <div class="card card_border py-2 mb-4">
        <div class="cards__heading">
            <h3><?php echo (ucfirst($_SESSION["type"])); ?> Dashboard</span> - Edit Tours<span></span></h3>
            <p><?php if(!empty($err)) echo "* ".$err; ?></p>
        </div>
        <div class="card-body">
            <form action="edit_tour_single.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name" class="input__label">Name*</label>
                        <input type="text" class="form-control input-style" name="name" id="name"
                            aria-describedby="nameHelp" placeholder="Enter Name" value="<?php echo $t_data[1]; ?>" required>
                        <small id="nameHelp" class="form-text text-muted">(32 Characters max)</small>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type" class="input__label">Type*</label>
                        <select id="type" name="type" class="form-control input-style">
                        <?php
        					for($i=0;$i<count($tour_types);$i++)
                            {
                        ?>
                            <option value = "<?php echo $tour_types[$i][0]; ?>" <?php if($t_data[3] == $tour_types[$i][0]) echo "selected"; ?>><?php echo $tour_types[$i][1]; ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                
                
				<div class="form-group">
					<label for="locations" class="input__label">Locations: </label>
					<div class="col-sm-10">
					    
						<?php
						    $flag = 0;
        					for($i=0;$i<count($locations);$i++)
                            {
                        ?>
                            <div class="form-check check-remember check-me-out">
                                <?php
                                    for($j=0;$j<count($tour_locations);$j++)
                                    {
                                        if($t_id == $tour_locations[$j][1] && $locations[$i][0] == $tour_locations[$j][2])
                                        {
                                ?>
                                <input class="form-check-input checkbox" type="checkbox" name="locations[]" id="<?php echo $locations[$i][0]; ?>" value=<?php echo $locations[$i][0]; ?>" checked>
                                <?php
                                        $flag = 1;
                                        }
                                    }
                                    if($flag == 0)
                                    {
                                ?>
                                <input class="form-check-input checkbox" type="checkbox" name="locations[]" id="<?php echo $locations[$i][0]; ?>" value=<?php echo $locations[$i][0]; ?>">
                                        
                                <?php
                                    }
                                    else
                                        $flag = 0;
                                ?>
                                
                                <label class="form-check-label checkmark" for="<?php echo $locations[$i][0]; ?>">
                                    <?php echo $locations[$i][1]." - X: ".$locations[$i][2]." - Y: ".$locations[$i][3]; ?>
                                </label>
                            </div>
                        	  
                        <?php
                        	}
        				?>
						
					</div>
				</div>
                <input type="hidden" name="tid" value="<?php echo $t_data[0]; ?>">
                
                <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>
  