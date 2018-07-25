<?php

require 'header.php';


if (empty($_GET['category'])) {

	$sql = "SELECT title, category, create_time, body, img_id, video FROM post ORDER BY post_id DESC";
}
else {

	$category = $_GET['category'];

	echo "<div id='currentcategory'><span class=currentposts>Posts from <b>$category<b></span> • <span class='allposts' onclick='allposts()'>back to <b>All<b><span></div><br>";

	

	$sql = "SELECT title, category, create_time, body, img_id, video FROM post WHERE category='$category' ORDER BY post_id DESC";
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


		$title = $row['title'];
		$cat = $row['category'];
		$time = $row['create_time'];
		$body = $row['body'];
		$img_id = $row['img_id'];
		$video = $row['video'];
		$defimg = "0";


		$time = new DateTime($time);
		$time = $time->format('g:ia \- m.d.y');
		//http://www.php.net/manual/en/function.date.php for examples

		if ($img_id != 0){

			$sql = "SELECT url FROM img WHERE img_id='$img_id'";
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0) {
				$result = $result->fetch_assoc();

				$url = $result['url'];
			}
		}
		else if ($video != "") {
			$url = "http://img.youtube.com/vi/" . $video . "/hqdefault.jpg";
			$defimg = "1";
		}
		else{

			switch ($cat){
				case "Thoughts":
					$url = "thumbs/thoughts.png";
					break;
				case "Books":
					$url = "thumbs/books.png";
					break;
				case "Memes":
					$url = "thumbs/memes.png";
					break;
				case "Videos":
					$url = "thumbs/videos.png";
					break;
				case "Pics":
					$url = "thumbs/pics.png";
					break;
				case "Music":
					$url = "thumbs/music.png";
					break;
				case "Art":
					$url = "thumbs/art.png";
					break;
				case "TIL":
					$url = "thumbs/til.png";
					break;
				default:
					$url = "thumbs/default.png";
			}

			$defimg = "1";

		}

		if ($hrcounter) {
			echo "<hr>";
		}
		$hrcounter++;

		echo"
		<div class='post' onclick='fullPost(this)'>

            <div class='imgframe'>
            <img class='img' src='$url'>
            </div>
            
            <!-- Title max ? char-->
            <h2 class='title'>$title</h2>
            <span class='cat' onclick='categories(this.innerText)'>$cat</span>
            <span class='time'>$time</span>
            <span class='comments'>0 comments</span>
            <span class='postbody'>$body</span>
            <span class='defimg'>$defimg</span>
            <span class='video'>$video</span>

            </div>";

         if ($array_index == $num_items) {
         	echo "<hr><div id='endposts'>No more posts to show</div>";
         	echo "<script>
         	$('#adv').css('visibility', 'hidden');</script>";
         }

	}

?>