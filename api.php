<?php

// Config Here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "native_realtime_chat";



// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "CREATE DATABASE IF NOT EXISTS $dbname;";
mysqli_query($conn, $query);

$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "CREATE TABLE IF NOT EXISTS message (
  `username` varchar(40) NOT NULL,
  `message` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
mysqli_query($conn, $query);


if ( isset($_GET["username"]) && isset($_GET["message"]) ) {
  $query = "INSERT INTO message VALUES ('{$_GET["username"]}','{$_GET["message"]}')";
  mysqli_query($conn, $query);
}

$query = "SELECT * FROM message";
$sth = mysqli_query($conn, $query);
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);

$conn->close();
?>
