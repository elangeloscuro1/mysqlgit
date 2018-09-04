<?php // update.php
/*
Programmer:	Angel Tapia
File Name:	update.php
Description:	This program updates one record of the student_data table
		in the angel_miracosta_fall2018 database.
*/
require_once 'login.php';

$db_server = mysqli_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysqli_connect_error());

mysqli_select_db($db_server, $db_database)
or die("Unable to select database: " . mysqli_connect_error());

echo "student_data before update<br>";
$query = "SELECT * FROM student_data";
displayData($db_server, $query);




echo "student_data updating<br>";
$query = "UPDATE student_data SET gpa='3.5' WHERE student_id='123456789'";
$result = mysqli_query($db_server, $query);
if (!$result) die ("Database access failed: " . mysqli_connect_error());




echo "<br>student_data before update<br>";
$query = "SELECT * FROM student_data";
displayData($db_server, $query);

mysql_close($db_server);

//Display the constent on student_data
function displayData($db_server, $query)
{
	$result = mysqli_query($db_server, $query);
	if (!$result) die ("Database access failed: " . mysqli_connect_error());	
	echo "<pre>Student ID	Student Name	Units completed		Phone Number		GPA </pre>";
	$rows = mysqli_num_rows($result);

	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$row = mysqli_fetch_row($result);
		echo "<pre>$row[0]	$row[1]			$row[2]		$row[3]		$row[4] <pre>";
	}
	mysqli_free_result($result);	
}
?>

