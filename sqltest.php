Example 10-6. Inserting and deleting using sqltest.php
<?php // sqltest.php
/*
Programmer:	Angel Tapia
File Name:	sqltest.php
Description:	This is a personalized version of the sqltest.php program.
		This version uses the student_data from 
		angel_miracosta_fall2018 database.
*/
    require_once 'login.php';
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    if ($conn->connect_error) die($conn->connect_error);

    if (isset($_POST['delete']) && isset($_POST['student_id']))
    {
        $student_id = get_post($conn, 'student_id');
        $query = "DELETE FROM student_data WHERE student_id='$student_id'";
        $result = $conn->query($query);
        
        if (!$result) echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    if (isset($_POST['student_id']) &&
        isset($_POST['student_name']) &&
        isset($_POST['units_completed']) &&
        isset($_POST['phone_number']) &&
        isset($_POST['gpa']))
    {
        $student_id	= get_post($conn, 'student_id');
        $student_name 	= get_post($conn, 'student_name');
        $units_completed= get_post($conn, 'units_completed');
        $phone_number	= get_post($conn, 'phone_number');
        $gpa 		= get_post($conn, 'gpa');
        $query = "INSERT INTO student_data VALUES" .
            "('$student_id', '$student_name', '$units_completed', '$phone_number', '$gpa')";
        $result = $conn->query($query);

        if (!$result) echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    echo <<<_END
    <form action="sqltest.php" method="post"><pre>
        Student ID	<input type="text" name="student_id">
        Student Name	<input type="text" name="student_name">
        Units Completed	<input type="text" name="units_completed">
        Phone Number	<input type="text" name="phone_number">
        GPA     	<input type="text" name="gpa">
        	 	<input type="submit" value="ADD RECORD">
    </pre></form>
_END;

    $query = "SELECT * FROM student_data";

    $result = $conn->query($query);

    if (!$result) die ("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j)
    {

        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
	<pre>
	Student ID	$row[0]
	Student Name	$row[1]
	Units completed	$row[2]
	Phone Number	$row[3]
	GPA 		$row[4]
	</pre>
	<form action="sqltest.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type="hidden" name="student_id" value="$row[3]">
	<input type="submit" value="DELETE RECORD"></form>
_END;
	}

    $result->close();
    $conn->close();

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }


?>
