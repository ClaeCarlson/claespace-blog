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
$fileName = basename($_FILES['file']['name']);
$fileUrl = 'imgs/' . $fileName;
$targetFile = $targetDir . basename($_FILES['file']['name']);
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

//echo $targetFile;

if ($fileName != "") {

if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";


    	$sql = "INSERT INTO img (name, url) VALUES ('$fileName', '$fileUrl')";

		if ( $mysqli->query($sql) ){
			$result = $mysqli->query("SELECT LAST_INSERT_ID() as id") or die($mysqli->error);
			$result = $result->fetch_assoc();


			$imgId = $result['id'];

			insertPost($title, $cat, $body, $imgId, $video, $mysqli);

			}
		else {
			echo $mysqli->error;
		}



    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}

else {
	insertPost($title, $cat, $body, null, $video, $mysqli);
}




function insertPost($t, $c, $b, $i, $v, $mysqli){

	$stmt = $mysqli->prepare("INSERT INTO post (title, category, create_time, body, img_id, video) VALUES " .
		"(?, ?, NOW(), ?, ?, ?)");
	$stmt->bind_param("sssis", $t, $c, $b, $i, $v);

	if ($stmt->execute()){
		echo '<script> window.location.replace("../") </script>';
	}else{
		echo $stmt->error;
	}

}

?>