<?php

require 'header.php';

$sql = "SELECT name from category";

$result = $mysqli->query($sql);

while($row = $result->fetch_assoc()) {
	$option = $row['name'];

	switch ($row['name']){
				case "Thoughts":
					$url = "../thumbs/thoughts.png";
					break;
				case "Books":
					$url = "../thumbs/books.png";
					break;
				case "Memes":
					$url = "../thumbs/memes.png";
					break;
				case "Videos":
					$url = "../thumbs/videos.png";
					break;
				case "Pics":
					$url = "../thumbs/pics.png";
					break;
				case "Music":
					$url = "../thumbs/music.png";
					break;
				case "Art":
					$url = "../thumbs/art.png";
					break;
				case "TIL":
					$url = "../thumbs/til.png";
					break;
				default:
					$url = "imgs/default.png";
			}

	//echo "<div class='categoryTile' style='background-image: url($url); background-size: contain; background-color: rgba(255, 255, 255, 1)'>$option</div>";
	echo "<div onclick='goToCategory(this.innerText);' class='categoryTile'><img src=$url>$option</div>";
}

?>