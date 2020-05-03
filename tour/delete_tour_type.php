<?php
    // Establish Connection
	require_once '../connection.php';
	$conn = OpenCon();
	
	// Initialize the session
	session_start();
	
	$sql = "SELECT id, name FROM tour_types";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$numrows = mysqli_stmt_num_rows($stmt);
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	
	$sql = "SELECT id, name FROM tour_types";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	$data [$numrows][2] = array();
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
		$typeid = $_POST["id"];
		
		$sql = "DELETE FROM tour_types WHERE id = ?";
		
		if($stmt = mysqli_prepare($conn, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "i", $typeid);
			
			// Attempt to execute the prepared statement
			mysqli_stmt_execute($stmt);
			
        	mysqli_stmt_close($stmt);
		}
		
		// Refresh the page
		header("location: delete_tour_type.php");
	}
?>
<!doctype html>
<html lang="en">

<head>
  
  <title>Project Alyx | Delete Tour Types</title>

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
        <li class="breadcrumb-item active" aria-current="page">Delete Tour Types</li>
      </ol>
      
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1><span class="text-primary"><?php echo ucfirst(($_SESSION["type"])); ?></span> Dashboard - Delete Tour Types</h1>
      <p>You can delete the Tour Types from here. Be careful, changes made here cannot be reverted.</p>
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
					
					<h3 class="text-primary number"><?php echo $data[$i][1]; ?></h3>
				
					<form action="delete_tour_type.php" method="post">
					<input type="hidden" name="id" value="<?php echo $data[$i][0]; ?>" />
					<input type="submit" value="Delete">
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
  