<?php 

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "";
    $_SESSION['admin'] = 0;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>ClaeSpace</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Galada|Roboto|Press+Start+2P" rel="stylesheet">
    <link rel="icon" href="cs.png">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="blog.js"></script>
    <script type="text/javascript">
        
        home = 1;

        function logout(){

            window.location = "php/logout.php";

        }

        $(document).ready(function(){


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

    <div id="nav">
        <img class="icon navicon" src="csicon_cut.png" onclick="history.go(0)">
        <span class="navitem">Projects</span>
        <span class="navitem">About</span>
        <span class="navitem">Archive</span>
        <span class="navitem" style="float: right; margin-right: 20px">Log in</span>
    </div>

    <!--<img id="background" src="bgs/autumn.jpg">!-->
    <img class="background" id="background" crossorigin="" src="https://source.unsplash.com/featured/?nature">
    <div id="header" class="header">
        <div id="headeritems">
            <img class="icon" src="csicon_cut.png" onclick="history.go(0)">
        <!--<span id="headerText">ClaeSpace</span>!-->
        <p id="blog">ClaeSpace • Blog</p>
        <hr style="width: 80%">
        <p id="menu">
            <span class="menuitem">Projects</span> • 
            <span class="menuitem">About</span> • 
            <span onclick="showdropdown()" class="menuitem">Archive</span> • 
                <span id="archivedropdown" class="dropdown-content">
                    <a href="">All posts</a>
                    <a href="./categories">Browse by category</a>
                    <a href="#">Browse by date</a>
                </span>

                <?php
                    if ($_SESSION['username'] != "") {
                      echo '<span onclick="logout()" class="menuitem">Log out (' . $_SESSION['username'] . ')</span>'; 
                    }
                    else
                        echo '<span onclick="showlogin()" class="menuitem">Log in</span>';
                    
                ?>

            
                <div id="logindropdown" class="dropdown-content">
                    <form method="post" action="php/login.php" id="loginform">
                    <input placeholder="User" type="text" name="user" required>
                    <input placeholder="Pass" type="password" name="pass" required>
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
                echo '<div id="newpost"><div id="createpost">New Post</div></div>';
        ?>
        


        <div class="post" onclick="fullPost(this)">

            <div class="imgframe">
            <img class="img" src="https://prettymuchamazing.com/.image/t_share/MTM3NjY0ODE2MTM4NDMwMTEw/sufjan-stevensjpg.jpg">
            </div>
            
            <!-- Title max 32 char-->


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
          
    </div>

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
            <input type="file" name="file" id="file" ><br>
            <input type="submit" name="submit" id="submit" value="Submit">


        </form>
  </div>

  <div class="fullpost">
    <span class="close" id="closefull">&times;</span>
    <span id="fulltitle"></span>
    <div id="cattime">
    <span id="fullcat"></span>
    •
    <span id="fulltime"></span>
    </div>
    <img id="fullimg" src="">
    <div id="videocontainer"></div>
    <div id="fullbody"></div>
    <div id="fullcomments">
    2 Comments
        <div class="comment">
            <div class="commentpicframe">
            <img class="commentpic" src="thumbs/portrait.png">
            </div>
            <div class="commentauthor">Crispy Cringus</div>
            <span class="commenttime">12:12pm - 07.27.18</span>
            <div class="commenttext">This is very funny, good job</div>
        </div>
        <div class="comment">
            <div class="commentpicframe">
            <img class="commentpic" src="thumbs/portrait.png">
            </div>
            <div class="commentauthor">John Wilkes Booth</div>
            <span class="commenttime">12:20pm - 07.27.18</span>
            <div class="commenttext">Lol yeah</div>
        </div>
    </div>
    <?php 
        if ($_SESSION['username'] != "") {

            echo "Comment as <span style='color: #4f88a3'>" . $_SESSION['username'] . "</span><div id='addcomment'>
        
    <textarea id='commentbox' placeholder='Comment...'></textarea>
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
        <form action="php/register.php" method="post" enctype="multipart/form-data">
            <div>Username:</div>
            <textarea type="text" name="username" required></textarea><br>
            <div>Password</div>
            <textarea style="-webkit-text-security : disc" type="password" name="pass" required></textarea><br>
            <div>Confirm Password</div>
            <textarea style="-webkit-text-security : disc" type="password" name="pass2" required></textarea><br>
            <div style="margin-bottom: 10px">(Optional) Profile Picture</div>
            <label id="profupload" for="profpic">
            <input style="display: none" id="profpic" type="file" name="file">
            <i class="far fa-file-image"></i> Choose Img
            </label><br>
            <input id="signupsubmit" type="submit" name="">

        </form>

  </div>

</div>
    


</body>
</html>