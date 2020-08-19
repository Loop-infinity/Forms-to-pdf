<?php 
	 session_start();
	 
	if($_SESSION['valid'] == true)
    {
        echo ' Well Come ' . $_SESSION['name'].'<br/>';
    }
    else
    {
        header("location:login.php");
		exit;
    }
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    

    <!-- CSS -->
    
	<link rel="stylesheet" href="styles.css">
    <title>Form</title>
  </head>
  <body>
  
  <a href="form.php">Submit a response</a>
  <a href="logout.php?logout">Logout</a>
  
  <h1>RESPONSES</h1>  
	
	<?php
	
	include('server.php') ;
	
	$sql = "SELECT * FROM response";
	$result = mysqli_query($conn, $sql);
	$number_of_result = mysqli_num_rows($result);  
    //determine the total number of pages available
	$results_per_page = 5;
    $number_of_page = ceil ($number_of_result / $results_per_page); 
	
	
	 if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
	
	$page_start = ($page-1) * $results_per_page; 
	$sql = "SELECT * FROM response ORDER BY response_id LIMIT $page_start,$results_per_page";
	$result = mysqli_query($conn, $sql);

	?>
	
	<table>
		<tr>
			<th>Photo</th>
			<th>Name</th>
			<th>Downloads</th>
		</tr>
	<?php 
	
	while( ($row = mysqli_fetch_assoc($result)) )
	{   
	$id = $row['response_id'];
	?>	
		<tr>
			<td><?php echo "<img src='images/".$row['image']."' width='130px' height='150px'>"; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo "<a href='download.php?response_id=$id'>Download</a>"; ?></td>
		</tr>
	<?php
	} 
	?>	
	</table>
	
	<?php 
	for($page = 1; $page<= $number_of_page; $page++) 
	{  
		echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>'; 
	}
	?>

  </body>
</html>