<?php

require_once 'login.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);


$user_id = $_POST["user_id"];
$user_name = $_POST["user_name"];
$user_pass = $_POST["user_pass"];

//$mysql_qry = "INSERT INTO users(user_id, user_pass) VALUES('$user_id', '$user_pass');";
$mysql_qry = "INSERT INTO users VALUES('$user_id', '$user_pass');";
mysqli_query($conn, "INSERT INTO last_activity VALUES('".time()."', '$user_id');");//timestamp:user_id



if (mysqli_query($conn, $mysql_qry) && !empty($_POST))//isset($_POST["post"]))
{
	echo "$user_name is registered with id [$user_id] and pass [$user_pass]";
}
else
{
	echo "connection FAILED!!!";
}

	
$result->close();
$conn->close();



?>
