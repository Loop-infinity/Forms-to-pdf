<?php 

$nameErr = $emailErr = $genderErr = $ageErr = $addressErr = $pnameErr = $bdateErr = $contactnoErr = $imageErr = "";
$name = $email = $gender = $age = $address = $pname = $bdate = $contactno = "";

$count=0;
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	
	//Validation
   if (empty($_POST["studentname"])) {
		$nameErr = "Name is required";
		$count++;
   }
   else 
   {
		$name = test_input($_POST['studentname']);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name))
		{
		  $nameErr = "Only letters and white space allowed"; 
		  $count++;
		}
  }
  
    if (empty($_POST["email"]))
	{
		$emailErr = "Email is required";
		$count++;
	}
	else
	{
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		  $emailErr = "Invalid email format"; 
		  $count++;
		}
	}

  if (empty($_POST["age"])) 
  {
    $ageErr = "Age is Required";
	$count++;
  }
  else
  {
		$age= test_input($_POST['age']);
		if (!preg_match("/^[0-9 ]*$/",$age)) 
		{
		  $ageErr = "Invalid Age"; 
		  $count++;
		}
  }

 /* if (empty($_POST["bdate"])) {
    $bdateErr = "Birthdate is Required";
	$count++;
  } 
  else
  {
	  $bdate = $_POST['bdate'];
  } */

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
	$count++;
  } 
  else
  {
	  $gender = test_input($_POST['gender']);
  }
  
    if (empty($_POST["address"]))
	{
		$addressErr = "address is required";
		$count++;
    }
    else 
    {
		$address = test_input($_POST['address']);
    }
	
	if (empty($_POST["contactno"])) 
    {
		$contactnoErr = "Contact No is required";
		$count++;
    } 
    else 
    {
		$contactno = test_input($_POST['contactno']);
		// check if name only contains letters and whitespace
		if (!preg_match('/^[0-9]{10}+$/',$contactno))
		{
		  $contactnoErr = "Invalid Mobile Number"; 
		  $count++;
		}
	}
	
	
	
	if(empty($_FILES['image']['name']))
	{
		$imageErr = "image is Required";
		$count++;
	}
	else
	{
		$image = $_FILES['image']['name'];	
		$target = "images/".basename($image);
		$imageFileType = $imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
		{
			$imageErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$count++;
		}
	}
	
	
	
	//No Errors
	if($count == 0)
	{
		include('server.php') ;
				//insert data in db conn
				$image = "IMG_".$contactno.".jpg";			
				$sql = "INSERT INTO response (name, age, gender, email, address, contactno,image)
						VALUES ('$name',$age,'$gender','$email','$address', '$contactno', '$image')";

					if (mysqli_query($conn, $sql)) 
					{
						echo "New record created successfully";	
							
							// image file directory	
						$target = "images/".basename($image);
						
						if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
						{
							echo "Image uploaded successfully";
							header("location:formSubmitSuccess.html");
						}
						else
						{
							echo "Failed to upload image";
						}		
							
					} 
					else 
					{
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}	
							
						
						
						
	}
   
   
}
//mysqli_close();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    
	<link rel="stylesheet" href="styles.css">
    <title>Form</title>
  </head>
  <body>
  <div class="rt" align="right">
	<a href="index.php">Login</a>
  </div>
  <h1>SUBMIT YOUR RESPONSE</h1>  
	
	<div class = "form-container">
      
         <form class = "form-response" action = <?php echo htmlspecialchars("form.php"); ?> method = "post" enctype="multipart/form-data">
			
		<label for="sname">Full Name</label>	<br>
		<input type="text" id="sname" name="studentname" value="<?php echo  $name?>" ><br>
		<span class="error"> <?php echo $nameErr;?></span> <br>
		
		<label for="ag">Age</label>	<br>
		<input type="text" id="ag" name="age" maxlength="3" value="<?php echo  $age?>"><br>
		<span class="error"> <?php echo $ageErr;?></span>		<br><br>
		
		<label>Sex :</label>			
		<input type="radio" name="gender" value="male" checked><label > Male</label>
		<input type="radio" name="gender" value="female"><label > Female</label>
		<input type="radio" name="gender" value="other"> <label>Other</label> <br><br>
		
		
<!--	<label>Birthdate :</label>
		<input type="date" name="bdate" >
		<span class="error">* <?php echo $bdateErr;?></span> <br><br> -->
		
		<label>Email id</label> <br>
		<input type="text" id="email" name="email" value="<?php echo  $email?>"><br>
		<span class="error"> <?php echo $emailErr;?></span>
		<span id="er"></span><br>
		
		<label for="">Address</label><br>
		<input type="text" name="address" value="<?php echo $address?>"> <br>
		<span class="error"><?php echo $addressErr;?></span> <br>
		
		<label for="">Contact No</label>	<br>
		<input type="text" name="contactno" maxlength="10" value="<?php echo $contactno?>"><br> 
		<span class="error"><?php echo $contactnoErr;?></span><br><br>
		
		
		  <input type="file" name="image" style="width: 177px"><br>
		  <span class="error"> <?php echo $imageErr;?></span><br>
		
			      
            <button class = "sub-btn" type = "submit" 
               name = "submit">Submit</button><br>
			
         </form>
			
         
      </div> 
	
    

  </body>
</html>