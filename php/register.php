<?php

require 'header.php';

$login = $_POST['username'];
$pass = $_POST['pass'];
$imgId = '';

$pass = password_hash($pass, PASSWORD_DEFAULT);


$uploadOk = 1;
$targetDir = '../imgs/profs/';
$fileName = basename($_FILES['file']['name']);
$targetFile = $targetDir . $login . "_" . basename($_FILES['file']['name']);
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

//echo $targetFile;

if ($fileName != "") {

if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

        	$imgId = $login . "_" . basename($_FILES['file']['name']);

			insertPost($login, $pass, $imgId, $mysqli);

			}
		else {
			echo $mysqli->error;
		}



    }
}

else {
	insertPost($login, $pass, NULL, $mysqli);
}

function insertPost($l, $pass, $pic, $mysqli){

	$sql = "INSERT INTO user (login, pass, pic) VALUES " . 
	"('$l', '$pass', '$pic')";

	if ( $mysqli->query($sql) ){
		session_start();
		$_SESSION['username'] = $l;
		echo '<script> window.location.replace("../") </script>';
	}
	else {
		echo $mysqli->error;
	}

}
?>