<?php

require 'header.php';


$title = $_POST['title'];
$cat = $_POST['category'];
$body = $_POST['body'];
$imgId = '';
$video = $_POST['video'];

if ($video != "") {
	if (strpos($video, 'v=')){
		$video = substr($video, strpos($video, "v=") + 2, 11);
	}
	else if (strpos($video, 'youtu.be')){
		$video = substr($video, strpos($video, "be/") + 3, 11);
	}
	else if (strpos($video, 'embed')){
		$video = substr($video, strpos($video, "embed/") + 6, 11);
	}
}



$uploadOk = 1;
$targetDir = '../imgs/';
$fileName = basename($_FILES['file']['name'][0]);

//echo $targetFile;

if ($fileName != "") {

insertPost($title, $cat, $body, 1, $video, $mysqli);
$result = $mysqli->query("SELECT LAST_INSERT_ID() as id") or die($mysqli->error);
$result = $result->fetch_assoc();
$post_id = $result['id'];

/*
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else {
	$count = 0;
	foreach($_FILES['file']['name'] as $file) {
		
		echo "upload\n";
		$tmp_name = $_FILES['file']['tmp_name'][$count];
		$fileName = basename($_FILES['file']['name'][$count]);

		$fileUrl = 'imgs/' . $fileName;
		$targetFile = ($targetDir . $fileName);

		$count++;

		//echo $targetFile;

		$moved = move_uploaded_file($tmp_name, $targetFile);

		if($moved){
			$sql = "INSERT INTO img (post_id, name, url) VALUES ('$post_id', '$fileName', '$fileUrl')";

			if ( $mysqli->query($sql) ){

			}
			else {
				echo $mysqli->error;
			}
		}

		else {
			echo "Error: " . $file["error"];
		}

	}

	echo '<script> window.location.replace("../") </script>';




} 

}

else {
	insertPost($title, $cat, $body, 0, $video, $mysqli);
	echo '<script> window.location.replace("../") </script>';
}




function insertPost($t, $c, $b, $i, $v, $mysqli){

	$stmt = $mysqli->prepare("INSERT INTO post (title, category, create_time, body, has_img, video) VALUES " .
		"(?, ?, NOW(), ?, ?, ?)");
	$stmt->bind_param("sssis", $t, $c, $b, $i, $v);

	if ($stmt->execute()){
		//echo '<script> window.location.replace("../") </script>';
	}else{
		echo $stmt->error;
	}

}

?>