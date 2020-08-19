<?php

session_start();
	 
	if($_SESSION['valid'] == true)
    {
        echo ' Well Come ' . $_SESSION['name'].'<br/>';
        echo '<a href="logout.php?logout">Logout</a>';
    }
    else
    {
        header("location:login.php");
		exit;
    }
require_once __DIR__ . '/vendor/autoload.php';

$response_id = $_GET['response_id'];

include("server.php");

$sql = "SELECT * FROM response 
		WHERE response_id = $response_id";
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_assoc($result);

$mpdf = new \Mpdf\Mpdf();

$data = '';
$data .= "<html><head><link rel='stylesheet' href='pdf.css'></head><body>";

$data .= '<h2>Response</h2><br>'; 

$data .= "<table>";
$data .= "<tr><td align='center'><img src='images/".$row['image']."' width='220px' height='250px'></td></tr>";
$data .= '<tr><td>Name : '.$row['name'].'</td></tr><tr><td>Age : '.$row['age'].'</td></tr><tr><td>Gender : '.$row['gender'].'</td></tr><tr><td>Email : '.$row['email'].'</tr><tr><td>Address : '.$row['address'].
		 '</td></tr><tr><td>Mobile Number : '.$row['contactno'].'<td></tr>';
$data .= "</table></body></html>";

$mpdf->WriteHTML($data);
$mpdf->Output('Response.pdf','D');
exit;

?>