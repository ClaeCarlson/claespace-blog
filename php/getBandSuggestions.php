<?php

require 'header.php';


$sql = "SELECT bandname, credit from bandsuggestion";

$result = $mysqli->query($sql);

$count = 0;

echo "<div class='bandtitle'><h2>$result->num_rows Band Suggestions</h2></div>";
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
	$c = $row['credit'];

	/*echo "<li  class='bandname'>
			<span class='bandli' >$bn
			<span style='color: #4f88a3; text-align: right;'> • $c</span></span>
		</li>";*/
	if ($_POST['admin'] == 1){
	echo "
	<tr>
	<td class='suggestedband'>
		$bn</td>
	<td class='suggestedcredit'>
		$c</td>
	<td width='50px' style=' border: 1px solid white; border-right: 1px solid white; border-left: 1px solid white; border-radius: 5px'>
		<i class='fas fa-thumbs-up bandapprove' onclick='reviewBand(\"approve\", this)'></i>
		<i class='fas fa-thumbs-down bandreject' onclick='reviewBand(\"reject\", this)'></i>";
	}
	else{
		echo "<tr>
	<td width='20%' style='border-left: 1px solid white; border-top-left-radius: 5px; border-bottom-left-radius: 5px'>
		$bn</td>
	<td width='10%' style='color: #4f88a3; border-right: 1px solid white; border-top-right-radius: 5px; border-bottom-right-radius: 5px'>
		$c</td>";
	}
	
	echo "</td></tr>";
	$count++;
}

//echo "<div class='bandname'> </div>"


?>