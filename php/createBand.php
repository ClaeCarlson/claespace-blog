<?php

require 'header.php';

$bandname = $_POST['bandname'];
$author = 'Clae';

$stmt = $mysqli->prepare("INSERT INTO bandname (bandname, author) VALUES (?, ?)");

$stmt->bind_param("ss", $bandname, $author);

if ($stmt->execute()) {
	echo "success";
}else{
	echo $stmt->error;
}

?>