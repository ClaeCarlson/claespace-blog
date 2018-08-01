<?php

require 'header.php';

$user = $_POST["user"];
$pass = $_POST["pass"];

$sql = "SELECT user_id, login, pass, admin FROM user WHERE login = '$user'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

	$result = $result->fetch_assoc();
	$hashpass = password_hash($pass, PASSWORD_DEFAULT);

	if (password_verify($pass, $result["pass"])) {
		echo "yes";
		session_start();
		$_SESSION['username'] = $user;
		$_SESSION['user_id'] = $result['user_id'];

		if ( $result["admin"] == 1) {
			$_SESSION['admin'] = 1;
		}

		header("location: ../");
	}
	else {
		echo "Incorrect password!";
	}

}
else {
	echo "No account with that username!";
}


?>