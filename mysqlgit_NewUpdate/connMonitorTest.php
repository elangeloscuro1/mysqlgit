<?php

require_once 'login.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);


$mysql_qry = "SELECT * FROM last_activity ORDER BY timestamp DESC LIMIT 10;";//DESC/ASC

$result = mysqli_query($conn, $mysql_qry);


if (mysqli_num_rows($result) > 0 && !empty($_POST))//isset($_POST["post"]))
{
	//echo "connection succeed! [" . " Hello $user_name!]";
	$rows = $result->num_rows;

	for ($j = 0 ; $j < $rows ; ++$j)
	{

		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo "$row[0] $row[1]";
		if (($j+1) < $rows)
		{
			echo ",";
		} 
	}
}
else
{
	echo "connection FAILED!!!";
}
	
$result->close();
$conn->close();
	

?>
