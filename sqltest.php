Example 10-6. Inserting and deleting using sqltest.php
<?php
	require_once 'login.php';
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    if ($conn->connect_error) die($conn->connect_error);

    if (isset($_POST['delete']) && isset($_POST['id']))
    {
        $id = get_post($conn, 'id');
        $query = "DELETE FROM user WHERE id='$id'";
        $result = $conn->query($query);
        
        if (!$result) echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['pass']))
    {
        $id	= get_post($conn, 'id');
        $name 	= get_post($conn, 'name');
        $pass= get_post($conn, 'pass');
		
        $query = "INSERT INTO user VALUES" . "('$id', '$name', '$pass')";
        $result = $conn->query($query);

        if (!$result) echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    echo <<<_END
    <form action="sqltest.php" method="post"><pre>
        User ID   <input type="text" name="id">
        User Name <input type="text" name="name">
        User Pass <input type="text" name="pass">
                  <input type="submit" value="REGISTER">
    </pre></form>
_END;

    $query = "SELECT * FROM user";

    $result = $conn->query($query);

    if (!$result) die ("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j)
    {

        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
	<pre>
	------------------------------------------------------
	ID     $row[0]
	Name   $row[1]
	Pass   $row[2]
	<form action="sqltest.php" method="post">
	<input type="hidden" name="delete" value="yes">
	<input type="hidden" name="id" value="$row[0]">
	<input type="submit" value="DELETE RECORD">
	</pre></form>
_END;
	}

    $result->close();
    $conn->close();

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }
?>
