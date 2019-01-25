<?php
$servername = "localhost";
$username = "root";
$password = "hermann2117";
$db = "h2val";

// Create connection
$con = new mysqli($servername, $username, $password, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
