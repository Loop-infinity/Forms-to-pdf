<?php 
	 session_start();
	 
	if($_SESSION['valid'] == true)
    {
        //echo ' Welcome ' . $_SESSION['name'].'<br/>';
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Form</title>
  </head>
  <body>
  
  <!-- NavBar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FORM-TO-PDF</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Responses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form.php">Submit Response</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <?php echo ' Welcome ' . $_SESSION['name'].'<br/>';?>
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