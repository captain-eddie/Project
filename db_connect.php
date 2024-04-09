<?php
$host = "localhost";
$user = "trodriguez10";
$pass = "trodriguez10";
$dbname = "trodriguez10";

//Create connection
$conn = new mysqli($host,$user,$pass,$dbname);
//Check connection
if($conn->connect_error)
{
	echo "Could not connect to server\n";
	die("Connection failed: ". $conn->connect_error);
}


?>
