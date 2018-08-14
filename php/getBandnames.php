<?php

require 'header.php';


$sql = "SELECT bandname, author from bandname";

$result = $mysqli->query($sql);

$count = 0;

echo "<div class='bandtitle'><h2>$result->num_rows Band Names!</h2></div>";
echo "<div class='bandsuggest'>
		<form onsubmit='return false;'>
		<input type='text' class='bandinput' id='bandsearchinput' placeholder='Search...' autocomplete='off'><button class='bandsubmit' onclick='bandsearch(bandsearchinput.value)' id='search'>Find</button></form>
	</div>";
/*echo "<br><div class='bandrow'>
		<div class='bandcol'>Band name</div>
		<div class='bandcol' style='color: #4f88a3'>Credit</div>
	</div>";*/
echo "<table style='border-spacing: 0px 10px;' class='bandtable'><tr style='background-color: rgba(0, 0, 0, 0)'><th>Band name</th><th style='color: #4f88a3'>Credit</th></tr>";


while($row = $result->fetch_assoc()) {
	$bn = $row['bandname'];
	$c = $row['author'];

	/*echo "<li  class='bandname'>
			<span class='bandli' >$bn
			<span style='color: #4f88a3; text-align: right;'> • $c</span></span>
		</li>";*/
	echo "<tr><td width='20%' style='border-left: 1px solid white; border-top-left-radius: 5px; border-bottom-left-radius: 5px'>$bn</td><td width='10%' style='border-right: 1px solid white; border-top-right-radius: 5px; border-bottom-right-radius: 5px; color: #4f88a3'>$c</td></tr>";
}

//echo "<div class='bandname'> </div>"


?>