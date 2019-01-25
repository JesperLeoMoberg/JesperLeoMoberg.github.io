<?php
/*
CONNECT-DB.PHP
Allows PHP to connect to your database
*/
// Database Variables (edit with your own server information)
$server = 'localhost';
$user = 'root';
$pass = '';
$db = '';
// Connect to Database
$connection = mysqli_connect($server, $user, $pass, $db)
or die ("Could not connect to server ... \n" . mysqli_error());
?>
