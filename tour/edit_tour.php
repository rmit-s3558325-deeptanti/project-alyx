<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
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
	
	$sql = "SELECT id, name, min_duration, type FROM tours";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$tours = array();
	$i = $j = 0;
	
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
	{
		foreach ($row as $r)
		{
		    $tours[$i][$j] = $r;
			$j++;
		}
		$j = 0;
		$i++;
	}
	mysqli_stmt_close($stmt);
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$tourid = $_POST["id"];
		
		$sql = "DELETE FROM tours WHERE id = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "i", $tourid);
			
			// Attempt to execute the prepared statement
			mysqli_stmt_execute($stmt);
			
        	mysqli_stmt_close($stmt);
		}
		
		$sql = "DELETE FROM tour_locations WHERE tour_id = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "i", $tourid);
			
			// Attempt to execute the prepared statement
			mysqli_stmt_execute($stmt);
			
        	mysqli_stmt_close($stmt);
		}
		
		// Refresh the page
		header("location: delete_tour.php");
	}
?>
<!doctype html>
<html lang="en">

<head>
  
  <title>Project Alyx | Edit Tours</title>

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
        <li class="breadcrumb-item active" aria-current="page">Edit Tours</li>
      </ol>
      
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1><span class="text-primary"><?php echo ucfirst(($_SESSION["type"])); ?></span> Dashboard - Edit Tours</h1>
      <p>You can edit the Tours from here. Be careful, changes made here cannot be reverted.</p>
    </div>

    <!-- statistics data -->
    <div class="statistics">
      <div class="row">
        <div class="col-xl-12 pr-xl-4">
          <div class="row">
            
			<?php
					for($i=0;$i<count($tours);$i++)
                {?>
                
            <div class="col-sm-3 pr-sm-2 statistics-grid">
				<div class="card card_border border-primary-top p-4">
					
					<h3 class="text-primary number"><?php echo $tours[$i][1]; ?></h3>
					<p class="stat-text"><b>Min Duration:</b> <?php echo $tours[$i][2]; ?> secs</p>
					<?php
					    for($j=0;$j<count($tour_types);$j++)
					    {
					        if ($tours[$i][3] == $tour_types[$j][0])
					        {
					?>
					
					<p class="stat-text"><b>Type:</b> <?php echo $tour_types[$j][1]; ?></p>
					            
					<?php
					        }
					    }
					?>
					
					<p class="stat-text"><b>Locations:</b></p>
					
					<?php
					    for($k=0;$k<count($tour_locations);$k++)
					    {
					        if ($tours[$i][0] == $tour_locations[$k][1])
					        {
					            for($x=0;$x<count($locations);$x++)
					            {
					                if($tour_locations[$k][2] == $locations[$x][0])
					                {
					            
					    
					?>
					
					<p class="stat-text">- <?php echo $locations[$x][1]; ?></p>
					            
					<?php
					        
					                    
					                }
					            }
					        }
					    }
					?>
				
					
					<form action="edit_tour_single.php" method="post">
					<input type="hidden" name="t_id" id="t_id" value="<?php echo $tours[$i][0]; ?>" />
					<input type="submit" value="Edit">
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
  