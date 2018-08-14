<?php

require 'header.php';

$review = $_POST['review'];
$bandname = $_POST['bandname'];
$credit = $_POST['credit'];

if ($review == "approve"){

	$stmt = $mysqli->prepare("INSERT INTO bandname (author, bandname) VALUES (?, ?)");

	$stmt->bind_param("ss", $credit, $bandname);

	if ($stmt->execute()) {
		echo "success";
	}else{
	echo $stmt->error;
	}

}

$stmt = $mysqli->prepare("DELETE FROM bandsuggestion WHERE bandname=? AND credit=?");

$stmt->bind_param("ss", $bandname, $credit);

if ($stmt->execute()) {
	echo "success";
}else{
	echo $stmt->error;
}
// Remove from suggestios either way

?>