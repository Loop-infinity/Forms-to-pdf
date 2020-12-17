<?php
include('server.php') ;
   session_start();
   $email_Err="";
   $password_Err="";
   $msg = "";
	
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
		

	$count=0;

	if (isset($_POST['dummy'])){

		$_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['email'] = 'dummy@account.com';
				  $_SESSION['name'] = 'Dummy Account';
                  
                 
				  header('location: index.php');
	}

	if (isset($_POST['login'])) {
		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		
		
		if (empty($email)) {
			$email_Err = "Email is required";
			$count++;
		}
		else 
		{
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				$email_Err = "Invalid email format"; 
				$count++;
			}
		}
		
		if (empty($password)) {
			$password_Err = "Password is required";
			$count++;
		}
		

		if ($count == 0) {
			//$password = md5($password);
			$query = "SELECT * FROM user WHERE email='$email'";
			$results = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($results);
			
			if (mysqli_num_rows($results) == 1) 
			{
				if ($password == $row["password"]) 
				{
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['email'] = $email;
				  $_SESSION['name'] = $row["name"];
                  
                 // echo 'You have entered valid email and password';
				  header('location: index.php');
               }
			   else 
			   {
                  $msg = 'Wrong username or password';
               }
				
				
			}
			else 
			{
				$email_Err = "Email doesnt exist";
			}
		}
	}
	
	

  
   
}//post

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    
	<link rel="stylesheet" href="styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Login</title>
  </head>
  <body>
	
<!-- NavBar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">FORM-TO-PDF</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Responses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form.php">Submit Response</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Login Form -->

	<div class = "form-container">
      
         <form class = "form-login"
            action = <?php echo htmlspecialchars("login.php");?> method = "post">
			
            <input type = "text" class = "form-control" 
               name = "email" placeholder = "email "><br>
			<span><?php echo $email_Err; ?></span></br> 
			
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" ><br>
			   <span><?php echo $password_Err; ?></span><br>
			   
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button><br>
			   <span><?php echo $msg; ?></span>

			 <br>
        	<button name="dummy" href="index.php">Click here to login with dummy account</a> 
         </form>
		 
      </div> 
	
    

  </body>
</html>