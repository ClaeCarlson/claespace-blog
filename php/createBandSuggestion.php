<?php

require 'header.php';

$bandname = $_POST['bandname'];
$credit = $_POST['credit'];

$stmt = $mysqli->prepare("INSERT INTO bandsuggestion (bandname, credit) VALUES (?, ?)");

$stmt->bind_param("ss", $bandname, $credit);

if ($stmt->execute()) {
	echo "success";
}else{
	echo $stmt->error;
}

?>