<?php

require 'header.php';

$sql = "SELECT name from category";

$result = $mysqli->query($sql);

while($row = $result->fetch_assoc()) {
	$option = $row['name'];

	echo "<option value='$option'>$option</option>";
}

?>