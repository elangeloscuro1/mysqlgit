<?php

require_once 'login.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);


$user_id = $_POST["user_id"];
$user_name = $_POST["user_name"];
$user_pass = $_POST["user_pass"];


$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id LIKE '$user_id' AND user_pass LIKE '$user_pass';");
mysqli_query($conn, "INSERT INTO last_activity VALUES('".time()."', '$user_id');");//timestamp:user_id



if (mysqli_num_rows($result) > 0 && !empty($_POST))//isset($_POST["post"]))
{
	echo "Hello $user_name!";
}
else
{
	echo "connection FAILED!!!";
}
	
$result->close();
$conn->close();
	

?>
