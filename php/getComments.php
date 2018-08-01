<?php

require 'header.php';

$post_id = $_POST['post_id'];

$sql = "SELECT user_id, create_time, comment FROM comment WHERE post_id = '$post_id' ORDER BY create_time ASC";

$result = $mysqli->query($sql);

foreach($result as $row){

	$time = $row['create_time'];

	$time = new DateTime($time);
	$time = $time->format('g:ia \- m.d.y');

	$user_id = $row['user_id'];
	$comment = $row['comment'];

	$sql = "SELECT login, admin, pic FROM user WHERE user_id = '$user_id'";
	$result = $mysqli->query($sql);
	$result = $result->fetch_assoc();

	$login = $result['login'];


	if ($result['pic'] != "") {
		$src = "imgs/profs/" . $result['pic'];
	}

	else
		$src = 'thumbs/portrait.png';


	if ($result['admin'] == 1) {

		echo "<div class='admincomment'>
            <div class='commentpicframe'>
            <img class='commentpic' src='$src'>
            </div>
            <div class='commentauthor'>$login</div>
            <span class='commenttime'>$time</span>
            <div class='commenttext'>$comment</div>
        </div>";

	}

	else {


	echo "<div class='comment'>
            <div class='commentpicframe'>
            <img class='commentpic' src='$src'>
            </div>
            <div class='commentauthor'>$login</div>
            <span class='commenttime'>$time</span>
            <div class='commenttext'>$comment</div>
        </div>";
	}

}



?>