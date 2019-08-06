<?php

require_once 'login.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);


$user_id = $_POST["user_id"];
$user_name = $_POST["user_name"];
$user_pass = $_POST["user_pass"];


$mysql_qry = "SELECT * FROM users WHERE id LIKE '$user_id' AND name LIKE '$user_name' AND pass LIKE '$user_pass';";

$result = mysqli_query($conn, $mysql_qry);


if (mysqli_num_rows($result) > 0)
{
	echo "connection succeed! [" . " Hello $user_name!]";
}
else
{
	echo "connection FAILED!!!";
}
	
	$result->close();
	$conn->close();
	

?>
