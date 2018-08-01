<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'header.php';

$user = $_POST['user'];
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];

$stmt = $mysqli->prepare("INSERT INTO comment (post_id, user_id, create_time, comment) VALUES (?, ?, NOW(), ?)");

$stmt->bind_param("iis", $post_id, $user, $comment);

if ($stmt->execute()) {
	echo "success";
}else{
	echo $stmt->error;
}

?>