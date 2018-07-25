<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	if (empty($_GET)) {
		echo "No Cat selected";
	}
	else{
		echo "Category: " . $_GET['category'];
	}
	?>

</body>
</html>