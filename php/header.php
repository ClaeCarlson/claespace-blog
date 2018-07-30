<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'blog';
  	$mysqli = mysqli_connect($host, $user, $pass, $db) or die($mysqli->error);

  	$_SESSION['username'] = "";

  	if ($mysqli->connect_error) {
  		die("Failed:" . $conn->connection_error);
  	}
 ?>