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
?>
<!doctype html>
<html lang="en">

<head>
  
  <title>Project Alyx | Edit Locations</title>

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
        <li class="breadcrumb-item active" aria-current="page">Edit Locations</li>
      </ol>
      
    </nav>
    <div class="welcome-msg pt-3 pb-4">
      <h1><span class="text-primary"><?php echo ucfirst(($_SESSION["type"])); ?></span> Dashboard - Edit Locations</h1>
      <p>You can edit the Locations from here. Be careful, changes made here cannot be reverted.</p>
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
					<form action="edit_loc_single.php" method="post">
					<input type="hidden" name="locid" id="locid" value="<?php echo $data[$i][0]; ?>" />
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
  