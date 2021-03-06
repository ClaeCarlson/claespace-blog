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
    <title>ClaeSpace Blog</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Galada|Roboto|Press+Start+2P" rel="stylesheet">
    <link rel="icon" href="thumbs/claeicon.png">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="animations.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <script src="js/jqueryv3_3_1.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="js/jscolor.js"></script>
    <script src="js/blog.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <script type="text/javascript">
        
        home = 1;

        $(document).ready(function(){

            if (document.cookie.indexOf("night") != -1){
                night();
            }



            $("#mode").click(function(){
                if ($(this).attr("class") == "fas fa-sun"){
                    document.cookie = 'theme=night';
                    night();
                }
                else {
                    document.cookie = 'theme=day';
                    day();
                }
                
            });
            
            function day(){
                
                $("#mode").removeClass("fa-moon");
                $("#mode").addClass("fa-sun");
                document.documentElement.style.setProperty('--main-bg-color', '#fffff2');
                document.documentElement.style.setProperty('--palette-color-1', 'orange');
                document.documentElement.style.setProperty('--palette-color-2', '#4f88a3');
                document.documentElement.style.setProperty('--text-color', 'grey');
                document.documentElement.style.setProperty('--main-color-hover', 'rgba(0, 0, 0, 0.1)');
                $("hr").css("border", "1px solid lightgrey");
                $("#commentbox").css("color", "black");
            }
            function night(){
                
                $("#mode").removeClass("fa-sun");
                $("#mode").addClass("fa-moon");
                document.documentElement.style.setProperty('--main-bg-color', '#0E191E');
                document.documentElement.style.setProperty('--palette-color-1', 'white');
                document.documentElement.style.setProperty('--palette-color-2', '');
                document.documentElement.style.setProperty('--text-color', 'lightgrey');
                document.documentElement.style.setProperty('--main-color-hover', 'rgba(255, 255, 255, 0.05)');
                $("hr").css("border", "1px solid grey");
                $("#commentbox").css("color", "white");
            }


            $(".lettering").lettering();

            $('.carousel').slick({
                //setting-name: setting-value
                nextArrow: '<div type="button" class="slick-next"><i class="fas fa-chevron-right"></i></div>',
                prevArrow: '<div type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></div>'
            });


            $.ajax({
                url: 'php/get_reddit.php',
                success: function(data) {
                    $("#redditcontent").html(data);
                }
                });

            getBackground();
           

            if (document.URL.indexOf('#cat') != -1) {
                var selectedcat = document.URL.split('-')[1];
                categories(selectedcat);
            }

        });
    </script>
</head>
<body>
    <span id="user_id" style="display: none;"><?php echo $_SESSION['user_id']; ?></span>

    <div id="nav">
        <img class="icon navicon" src="thumbs/claeicon.png" onclick="history.go(0)">
        <span class="navitem" onclick="window.location = './projects'">Projects</span>
        <span class="navitem">About</span>
        <span class="navitem" id="navarchive">Archive</span>
        <span class="archsecondary" onclick="window.location = ''">All posts</span>
        <span class="archsecondary" onclick="window.location = './categories'">Categories</span>
        <span class="archsecondary">By date</span>
        <span class="archsecondary" id="archiveback" style="float: right; margin-right: 20px"><i class="fas fa-arrow-left"></i></span>
        <?php
            if ($_SESSION['username'] != "") {
                echo '<span class="logout navitem" style="float: right; margin-right: 20px">Log out</span>'; 
            }
            else
                echo '<span id="navlogin" class="navitem" style="float: right; margin-right: 20px">Log in</span>
                <div class="loginsecondary">
                    <form style="display: inline-block" method="post" action="php/login.php" >
                    <input placeholder="User" type="text" name="user" required>
                    <input placeholder="Pass" type="password" name="pass" required>
                    <input style="width: 60px" type="submit" name="" onclick="login()">
                    </form>
                    <button onclick="showsignup()" formnovalidate>Register</button>
                    <span id="loginback" style="float: right; margin-right: 20px"><i class="fas fa-arrow-left"></i></span>
                </div>';
        ?>
        
    </div>

    <!--<img id="background" src="bgs/autumn.jpg">

        https://source.unsplash.com/featured/?autumn,nature

        !-->

    <img class="background" id="background" crossorigin="" src="https://source.unsplash.com/featured/?autumn">
    <div id="header" class="header">
        <div id="headeritems">
            <!--<img class="icon" src="csicon_cut.png" onclick="history.go(0)">-->
        <!--<span id="headerText">ClaeSpace</span>!-->
        <p id="blog">ClaeSpace<i id='mode' class="fas fa-sun"></i>Blog</p>
        <hr style="width: 80%">
        <p id="menu">
            <span class="menuitem" onclick="window.location='./projects'">Projects</span> • 
            <span class="menuitem" onclick="window.location='./about'">About</span> • 
            <span onclick="showdropdown()" class="menuitem">Archive</span> • 
                <span id="archivedropdown" class="dropdown-content">
                    <a href="">All posts</a>
                    <a href="./categories">Browse by category</a>
                    <a href="#">Browse by date</a>
                </span>

                <?php
                    if ($_SESSION['username'] != "") {
                      echo '<span class="logout menuitem">Log out (' . $_SESSION['username'] . ')</span>'; 
                    }
                    else
                        echo '<span onclick="showlogin()" class="menuitem">Log in</span>';
                    
                ?>

            
                <div id="logindropdown" class="dropdown-content">
                    <form method="post" action="php/login.php" id="loginform">
                    <input id='loginuser' placeholder="User" type="text" name="user" required>
                    <input id='loginpass' placeholder="Pass" type="password" name="pass" required>
                    <input type="submit" name="" onclick="login()">
                    <span style="color: black; font-size: 12px;">Don't have an account? <span id="register" onclick="showsignup()">Fuck you</span></span>
                    </form>

                </div>
        </p>
        </div>

        <fieldset id="reddit"><legend id="til">Today I Learned</legend><div id="redditcontent"></div></fieldset>
        
    </div>

    
    <div id="container">
    <div id="content">
    

        <!--
        <div id="right">
            <div id="side">Browse posts by category</div>
        </div>-->

        <?php 
            if ($_SESSION['admin'] == 1)
                echo '<div id="newpost"><div id="newpostbtn" onclick="createpost()">New Post</div></div>';
        ?>
        

        <!--
        <div class="post" onclick="fullPost(this)">
            <span class='post_id' style='display: none' id='post_id'>0</span>

            <div class="imgframe">
            <img class="img" src="https://prettymuchamazing.com/.image/t_share/MTM3NjY0ODE2MTM4NDMwMTEw/sufjan-stevensjpg.jpg">
            </div>
            
           Title max 32 char


            <h2 class="title">Part 2: Sufjan Stevens visits me in a dream</h2><span class="cat" onclick="categories(this.innerText)">Thoughts</span><span class="time">2:53pm - 07.18.18</span>
            <span class="comments">0 Comments</span>
            <span class="postbody">
            I saw Sufjan Stevens at a grocery store in Brooklyn yesterday. I told him how cool it was to meet him in person, but I didn't want to be a douche and bother him and ask him for photos or anything.

        He said, "Oh, like you're doing now?"

        I was taken aback, and all I could say was "Huh?" but he kept cutting me off and going "huh? huh? huh?" and closing his hand shut in front of my face. I walked away and continued with my shopping, and I heard him chuckle as I walked off. When I came to pay for my stuff up front I saw him trying to walk out the doors with like fifteen banjos in his hands without paying.

        The girl at the counter was very nice about it and professional, and was like "Sir, you need to pay for those first." At first he kept pretending to be tired and not hear her, but eventually turned back around and brought them to the counter.

    When she took one of the bars and started scanning it multiple times, he stopped her and told her to scan them each individually "to prevent any electrical infetterence," and then turned around and winked at me. I don't even think that's a word. After she scanned each bar and put them in a bag and started to say the price, he kept interrupting her by yawning really loudly.


</span>
<span class="video"></span>
    <span class='defimg'>0</span>
          
    </div>-->

    <hr>


    

</div>

<div id="footer">
    <div id="prev">Prev</div>
    <span id="pagenum">Page 0</span>
    <div id="adv">Next</div>
</div>

</div>




<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="closenew">&times;</span>
    <form action="php/createPost.php" method="post" enctype="multipart/form-data">
            <textarea type="text" name="title" id="title" placeholder="Title" required="required"></textarea>
            <select name="category" id="category" required="required">
                <option value="" disabled selected hidden>Category</option>
            </select>
            <br>
            <textarea name="body" placeholder="Text..." id="body"></textarea><br>
            <textarea type="text" name="video" id="video" placeholder="Youtube url"></textarea>
            <input type="file" name="file[]" id="file" multiple><br>
            <input type="submit" name="submit" id="submit" value="Submit">


        </form>
  </div>

  <div class="fullpost">
    <span class="close" id="closefull">&times;</span>
    <span style="display: none" id="fullid"></span>
    <span id="fulltitle"></span>
    <div id="cattime">
    <span id="fullcat"></span>
    •
    <span id="fulltime"></span>
    </div>
    <img id="fullimg">

    <div id="arrows"></div>
    <div class="carousel">
    
        
    </div>
    <div id="videocontainer"></div>
    <div id="fullbody"></div>
    <div id="fullcomments">
    <!-- Comments go here-->
    </div>
    <?php 
        if ($_SESSION['username'] != "") {

            echo "Comment as <span id='user' style='color: #4f88a3'>" . $_SESSION['username'] . "</span><div id='addcomment'>
                <textarea id='commentbox' placeholder='Comment...' name='comment'></textarea>
                <div>";

                if ($_SESSION['admin'] == 1){
                    echo "<div>Effect:
                <input id='decorate-none' checked name='decoration' type='radio'>None
                <input id='decorate-fade' name='decoration' type='radio'><span class='fade'>Fade</span>
                <input id='decorate-rainbow' name='decoration' type='radio'><span class='rainbow'>Rainbow</span>
                <input id='decorate-wave' name='decoration' type='radio'><span class='lettering wave'>Wave</span>
                </div>
                <div>Color: <input id='commentcolor' class='jscolor' value='808080'>
                <input id='decorate-rs' type='checkbox'>RS
                </div>";
                }
                
            echo "</div>
                <div id='submitcomment'>Post</div>
                </div>";

        }
        else {
            echo "Log in to comment";
            
        }
    ?>
    
 
  </div>

  <div id="signup">
    <img src="thumbs/portrait.png">
        <h2>Sign up</h2>
        <span id="regerror">Passwords don't match!</span>
        <form id="signupform" action="php/register.php" method="post" enctype="multipart/form-data">
            <textarea id="username" style="font-size: 16px" type="text" name="username" placeholder="Username" required></textarea><br>
            <textarea id="regpass1" style="-webkit-text-security : disc; font-size: 16px" placeholder="Password" type="password" name="pass" required></textarea><br>
            <textarea id="regpass2" style="-webkit-text-security : disc; font-size: 16px" placeholder="Confirm Password" type="password" name="pass2" required></textarea><br>
            <div style="margin-bottom: 10px">(Optional) Profile Picture</div>
            <label id="profupload" for="profpic">
            <input style="display: none" id="profpic" type="file" name="file">
            <i class="far fa-file-image"></i> Choose Img
            </label>
            <span style="padding-left: 5px" id="selectedfile"></span><br>
            <input id="signupsubmit" type="submit" name="">

        </form>

  </div>

</div>
    


</body>
</html>