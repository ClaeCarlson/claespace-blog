<?php 

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "";
    $_SESSION['admin'] = 0;
    $_SESSION['user_id'] = "";
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>ClaeSpace Band Names</title>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Galada|Roboto|Press+Start+2P" rel="stylesheet">
	<link rel="icon" href="../cs.png">
	<link rel="stylesheet" type="text/css" href="../main.css">
    <script src="../js/jqueryv3_3_1.js"></script>
    <script src="../js/blog.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){

		$.ajax({
                url: '../php/getBandnames.php',
                success: function(data) {
                    $("#bandcontent").html(data);
                }
            });
		});

		
	</script>
</head>
<body>
	<img id="background" class="background" crossorigin="" src="https://source.unsplash.com/featured/?nature">
	<img class="background" src="../thumbs/tp_back.png">
	<div id="header" class="categoryheader">
		<div id="headeritems">
            <!--<img class="icon" src="../csicon_cut.png" onclick="history.go(0)">-->
        	<p id="blog" style="font-family: Futura; font-size: 24px"><span style="letter-spacing: 8px;">CLAESPACE</span><br><span style="letter-spacing: 4px;">BAND NAMES</span></p>
        	<hr style="width: 80%">
        	<p id="menu">
        		<span class="menuitem" onclick="window.location='../projects'">Projects</span> • 
                <?php
                    if ($_SESSION['username'] != "") {
                      echo '<span class="menuitem logout">Log out (' . $_SESSION['username'] . ')</span>'; 
                    }
                    else
                        echo '<span onclick="showlogin()" class="menuitem">Log in</span>';
                    
                ?>
                <div id="logindropdown" class="dropdown-content">
                    <form method="post" action="../php/login.php" id="loginform">
                    <input id='loginuser' placeholder="User" type="text" name="user" required>
                    <input id='loginpass' placeholder="Pass" type="password" name="pass" required>
                    <input type="submit" name="">
                    <span style="color: black; font-size: 12px;">Don't have an account? <span id="register" onclick="showsignup()">Fuck you</span></span>
                    </form>

                </div>

        </div>
    <?php 
    	if ($_SESSION['admin'] == 1){
    		echo "<div class='bandsuggest'>
    		<div>Add Bandname • <a href='./suggestions' style='color: white'>Suggestions</a></div>
    		<form>
    		<input required id='adminbandinput' class='bandinput' type='text' autocomplete='off' name='adminbandname'>
    		<button class='bandsubmit' id='adminbandsubmit'>Submit</button></form>
    		</div>";
    	}
    	else{
    		echo "<div id='bandsuggest' class='bandsuggest'><div>Suggest a name • <a href='./suggestions' style='color: white'>Suggestions</a></div>
		<form onsubmit='return false;'>
    	<input maxlength='255' style='width: 33%;' placeholder='Band name' id='bandsuggestinput' class='bandinput' type='text' autocomplete='off' name='bandname'><input maxlength='55' style='width: 33%; margin-left: 10px' placeholder='Your name' id='bandsuggestcredit' class='bandinput' type='text' autocomplete='off'><button class='bandsubmit' id='bandsuggestsubmit' >Submit</button></form>

    </div>

    <div id='bandsuggested'>
    <span class='bandsuggest'>Thank you!</span><button id='suggestmore'>Another</button>
	</div>";
    	}
    ?>

    <ul id="bandcontent"></ul>


<div id="nav" style="display: none;"></div>
	<div id="footer" style="display: none;"></div>
	</div>
	

	

</body>
</html>