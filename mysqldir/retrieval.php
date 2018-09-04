<?php // retrieval.php
/*
Programmer:	Angel Tapia
File Name:	retrieval.php
Description:	This program retrieves all the data from 
		the class_data in the angel_miracosta_fall2018 database.
*/
require_once 'login.php';

$db_server = mysqli_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysqli_connect_error());//. mysql_error());

mysqli_select_db($db_server, $db_database)
or die("Unable to select database: " . mysqli_connect_error());//. mysql_error());

$query = "SELECT * FROM class_data";
$result = mysqli_query($db_server, $query);
if (!$result) die ("Database access failed: " . mysqli_connect_error());//. mysql_error());

$rows = mysqli_num_rows($result);
for ($j = 0 ; $j < $rows ; ++$j)
{
	$row = mysqli_fetch_row($result);
	echo 'Class Number: '	. $row[0] . '<br>';
	echo 'Course Title: '	. $row[1] . '<br>';
	echo 'Class Time: '	. $row[2] . '<br>';
	echo 'Instructor Name: '. $row[3] . '<br>';
	echo 'Classroom: '	. $row[4] . '<br><br>';
}

mysqli_free_result($result);
mysql_close($db_server);
?>

