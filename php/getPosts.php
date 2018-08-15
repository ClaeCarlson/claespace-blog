<?php

require 'header.php';


if (empty($_GET['category'])) {

	$sql = "SELECT post_id, title, category, create_time, body, has_img, video FROM post ORDER BY post_id DESC";
}
else {

	$category = $_GET['category'];

	echo "<div id='currentcategory'><span class=currentposts>Posts from <b>$category<b></span> • <span class='allposts' onclick='allposts()'>back to <b>All<b><span></div><br>";

	

	$sql = "SELECT post_id, title, category, create_time, body, has_img, video FROM post WHERE category='$category' ORDER BY post_id DESC";
}

if (empty($_GET['page'])) {

	$page = 0;
	$skip = 0;

}
else {


	$page = $_GET['page'];
	$page = (int)$page;

	$skip = $page * 10;

}

	$result = $mysqli->query($sql);
	$num_items = $result->num_rows;

	if (!$num_items) {
		echo "<hr><div id='endposts'>No more posts to show</div>";
         	echo "<script>
         	$('#adv').css('visibility', 'hidden');</script>";

	}


	$array_index = 0;
	$counter = 0;
	$hrcounter = 0;

	foreach($result as $row){

		if ($skip > 0) {
			$skip--;
			$array_index++;
			continue;
		}
		else
			$array_index++;

		$counter++;
		if ($counter > 10) {
			break;
		}


		$post_id = $row['post_id'];
		$title = $row['title'];
		$cat = $row['category'];
		$time = $row['create_time'];
		$body = $row['body'];
		$has_img = $row['has_img'];
		$video = $row['video'];
		$defimg = "0";


		$time = new DateTime($time);
		$time = $time->format('g:ia \- m.d.y');
		//http://www.php.net/manual/en/function.date.php for examples

		if ($has_img){

			$sql = "SELECT url FROM img WHERE post_id='$post_id'";
			$result = $mysqli->query($sql);
			$first = $result->fetch_assoc();

			$thumb_img = $first['url'];

			if ($result->num_rows > 1) {

			$images = "<span class='singleimg'></span>";
			foreach($result as $row){
				$url = $row['url'];
				$images = $images .  "<span class='postimages'>$url</span>";
			}

			}
			else {
				$images = "<span class='singleimg'>$thumb_img</span>";
			}
		}
		else if ($video != "") {
			$images = "";
			$thumb_img = "http://img.youtube.com/vi/" . $video . "/hqdefault.jpg";
			$defimg = "1";
		}
		else{

			$images = "";

			switch ($cat){
				case "Thoughts":
					$thumb_img = "thumbs/thoughts.png";
					break;
				case "Books":
					$thumb_img = "thumbs/books.png";
					break;
				case "Memes":
					$thumb_img = "thumbs/memes.png";
					break;
				case "Videos":
					$thumb_img = "thumbs/videos.png";
					break;
				case "Pics":
					$thumb_img = "thumbs/pics.png";
					break;
				case "Music":
					$thumb_img = "thumbs/music.png";
					break;
				case "Art":
					$thumb_img = "thumbs/art.png";
					break;
				case "TIL":
					$thumb_img = "thumbs/til.png";
					break;
				default:
					$thumb_img = "thumbs/default.png";
			}

			$defimg = "1";

		}


		$sql = "SELECT * FROM comment WHERE post_id = '$post_id'";
		$result = $mysqli->query($sql);

		$numcomments = 0;

		foreach ($result as $row) {

			$numcomments++;

		}

		if ($numcomments == 1) {
			$numcomments = "1 Comment";
		}
		else
			$numcomments = (string)$numcomments . " Comments";


		if ($hrcounter) {
			echo "<hr>";
		}
		$hrcounter++;

		echo"
		<div class='post' onclick='fullPost(this)'>
			<span class='post_id' style='display: none' id='post_id'>$post_id</span>

            <div class='imgframe'>
            <img class='img' src='$thumb_img'>
            </div>
            
            <!-- Title max ? char-->
            <h2 class='title'>$title</h2>
            <span class='cat' onclick='categories(this.innerText)'>$cat</span>
            <span class='time'>$time</span>
            <span class='comments'>$numcomments</span>
            <span class='postbody'>$body</span>
            <span class='defimg'>$defimg</span>
            $images
            <span class='video'>$video</span>

            </div>";

         if ($array_index == $num_items) {
         	echo "<hr><div id='endposts'>No more posts to show</div>";
         	echo "<script>
         	$('#adv').css('visibility', 'hidden');</script>";
         }

	}

?>