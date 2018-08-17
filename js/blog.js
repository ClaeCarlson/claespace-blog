 

 var page = 0;
 var home = 0;

        var category = "";

        $(document).ready(function(){

            $("#loginform").submit(function(event){
                event.preventDefault();
                
                postData = "user=" + $("#loginuser").val();
                postData += "&pass=" + $("#loginpass").val();

                $.ajax({
                    url: '/webserver1/portal/php/login.php',
                    type: "POST",
                    data: postData,
                    success: function(data) {
                        location.reload();
                    }
                });

            });

            $(".logout").click(function(){
                $.ajax({
                    url: '/webserver1/portal/php/logout.php',
                    type: "POST",
                    success: function(data) {
                        location.reload();
                    }
                });
            });

            

            $("#submitcomment").click(function(){



                // choose a color to give a second class with color?

                // if admin, allow tags?
                var comment = $("#commentbox").val();
                var effect = "";
                var color = $("#commentcolor").val();
                comment = comment.replace(/<[^>]+>/ig,'');

                if (comment != "") {

                if ($("#decorate-none").prop("checked")){
                    effect = "";
                }
                else if ($("#decorate-fade").prop("checked")){
                    effect = "fade";
                }
                else if ($("#decorate-rainbow").prop("checked")){
                    effect = "rainbow";
                }
                else if ($("#decorate-wave").prop("checked")){
                    effect = "wave lettering";
                }

                if ($("#decorate-rs").prop("checked")){
                    effect += " rs";
                }

                comment = '<span style="color:#' + color + '" class="' + effect + '">' + comment + '</span>';


                $("#commentbox").val("");

                

                    var user = $("#user_id").text();
                    var post_id = $("#fullid").text();


                    var postData = "user=" + user + "&comment=" + comment + "&post_id=" + post_id;

                    $.ajax({
                    url: 'php/createComment.php',
                    type: "POST",
                    data: postData,
                    success: function(data) {
                    //alert(data);
                        postData = "post_id=" + post_id;
                        ajaxComments(postData);
                        $(".lettering").lettering();
                    }
                    });
                }
            });

            $("#navarchive").click(function(){
                $(".archsecondary").toggle();
                $(".navitem").toggle();
            });

            $("#archiveback").click(function(){
                $(".archsecondary").toggle();
                $(".navitem").toggle();
            });

            $("#navlogin").click(function(){
                $(".loginsecondary").toggle();
                $(".navitem").toggle();
            });
            $("#loginback").click(function(){
                $(".loginsecondary").toggle();
                $(".navitem").toggle();
            });


            $("#signupform").submit(function(e){
                if ($("#regpass1").val() == $("#regpass2").val())
                    return;

                else {
                    $("#regerror").css("visibility", "visible");
                    e.preventDefault();
                }
            });

            $("#username").keypress(function(e){
                if(!/[0-9a-zA-Z-_]/.test(String.fromCharCode(e.which)))
                    return false;
            });
            $("#regpass1").keypress(function(e){
                if(!/[0-9a-zA-Z-_]/.test(String.fromCharCode(e.which)))
                    return false;
            });
            $("#regpass2").keypress(function(e){
                if(!/[0-9a-zA-Z-_]/.test(String.fromCharCode(e.which)))
                    return false;
            });

            $("#register").mouseover(function(){
                $("#register").text("Jk sign up :)");
            })
            .mouseout(function(){
                $("#register").text("Fuck you");
            });

            $("#profpic").change(function(){
                var filename = $(this).val();
                filename = filename.split('fakepath\\')[1];
                //filename = filename.substring(filename.indexOf('fakepath\\'));
                $("#selectedfile").text(filename);
            });

            

            $("body").click(function(e){
                var container = $("#menu");
                var container2 = $("#loginform");
                if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) {
                    $("#archivedropdown").css("display","none");
                    $("#logindropdown").css("display","none");
                }
                
            });
            $("#adminbandinput").keypress(function(e){
                if(!/[0-9a-zA-Z-_!@#$%^&*()+{}~,.?''""]/.test(String.fromCharCode(e.which)))
                    return false;
            });
            $("#bandsuggestinput").keypress(function(e){
                if(!/[0-9a-zA-Z-_!@#$%^&*()+{}~,.?''""]/.test(String.fromCharCode(e.which)))
                    return false;
            });
            $("#bandsuggestcredit").keypress(function(e){
                if(!/[0-9a-zA-Z-_!@#$%^&*()+{}~,.?''""]/.test(String.fromCharCode(e.which)))
                    return false;
            });

            $("#bandsuggestsubmit").click(function(){
                

                var bandname = $("#bandsuggestinput").val();
                bandname = bandname.replace(/<[^>]+>/ig,'');
                var credit = $("#bandsuggestcredit").val();
                credit = credit.replace(/<[^>]+>/ig,'');

                
                $("#bandsuggestinput").val("");
                $("#bandsuggestcredit").val("");

                if (credit === ""){
                    credit = "Anonymous";
                }


                if (bandname === ""){ 
                }
                else {
                    $("#bandsuggest").css("display", "none");
                    $("#bandsuggested").css("display", "block");
                    var postData = "bandname=" + bandname;
                    postData += "&credit=" + credit;
                    $.ajax({
                    url: '../php/createBandSuggestion.php',
                    type: "POST",
                    data: postData,
                    success: function(data) {
                    //alert(data);
                    }
                    });
                }

            });
            $("#adminbandsubmit").click(function(){

                var bandname = "bandname=" + $("#adminbandinput").val();
                $("#adminbandinput").val("");


                if (bandname != ""){
                   $.ajax({
                    url: '../php/createBand.php',
                    type: "POST",
                    data: bandname,
                    success: function(data) {
                        window.location = "";
                    }
                    }); 
                }

            });

            $("#suggestmore").click(function(){
                $("#bandsuggest").css("display", "block");
                $("#bandsuggested").css("display", "none");

            });


            // JUST FOR HOME PAGE

        	if (home) {


            $("#pagenum").text('Page ' + (page + 1));

            $("#prev").css("visibility", "hidden");

            $.ajax({
                url: 'php/getPosts.php',
                success: function(data) {
                    $("#content").append(data);
                }
            });

            $.ajax({
                url: 'php/getCategories.php',
                success: function(data) {
                    $("#category").html(data);
                }
            });

            $("#adv").click(function(){
                page++;
                $("#pagenum").text('Page ' + (page + 1));
                $("#prev").css("visibility", "visible");


                $.ajax({
                url: 'php/getPosts.php/?category='+category+'&page='+page,
                success: function(data) {
                    $("#content").html(data);
                }
                });

                $('html, body').animate({ scrollTop: 600 }, 'medium');
            });

            $("#prev").click(function(){
                page--;
                if (page < 1) {
                    $("#prev").css("visibility", "hidden");
                    $('#adv').css('visibility', 'visible');
                }
                $("#pagenum").text('Page ' + (page + 1));


                $.ajax({
                url: 'php/getPosts.php/?category='+category+'&page='+page,
                success: function(data) {
                    $("#content").html(data);
                }
                });

                $('html, body').animate({ scrollTop: 600 }, 'medium');
            });
        
        


        // hide .navbar first
    $("#nav").hide();

    // fade in .navbar
    $(function () {
        $(window).scroll(function () {

            var windowHeight = $(window).height();
            var scroll = $(window).scrollTop();
            if (scroll >= windowHeight) {
                $('#nav').fadeIn(800);
            }
            else {
                $('#nav').fadeOut(800);
            }
        });
    });

  }      
}); 
function bandsearch(str){
    if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  // CODE FOR BROWSERS THAT SUPPORT window.find

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1);
   while (self.find(str,0,1)) continue;
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

  // EXPLORER-SPECIFIC CODE

  if (TRange!=null) {
   TRange.collapse(false);
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange();
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera browsers not supported, sorry...")
  return;
 }
 if (!strFound) alert ("String '"+str+"' not found!")
 return;
}

function reviewBand(review, el){
    parent = (el).parentNode.parentNode;
    bandname = parent.getElementsByClassName("suggestedband")[0].innerText;
    credit = parent.getElementsByClassName("suggestedcredit")[0].innerText;
    
    postData = "review=" + review;
    postData += "&bandname=" + bandname;
    postData += "&credit=" + credit;
    $.ajax({
            type: 'POST',
            url: '../../php/reviewBand.php',
            type: "POST",
            data: postData,
            success: function(data) {
                //alert(data);
                window.location = "";
            }
        });
}

// When the user clicks on the button, open the modal 
function createpost() {
    var newpost = document.getElementsByClassName("modal-content")[0];
    var modal = document.getElementById('myModal');

    modal.style.display = "block";
    newpost.style.display = "block";

}

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function showdropdown() {
    if (document.getElementById("logindropdown"))
        document.getElementById("logindropdown").style.display = "none";
    document.getElementById("archivedropdown").style.display = "block";
}

function showlogin() {
    if (document.getElementById("archivedropdown"))
        document.getElementById("archivedropdown").style.display = "none";
    document.getElementById("logindropdown").style.display = "block";
}

function showsignup() {
    document.getElementById("myModal").style.display = "block";
    document.getElementById("signup").style.display = "block";
}


// Close the dropdown menu if the user clicks outside of it


window.onload = function(){

                // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var createpost = document.getElementById("createpost");

// Get the <span> element that closes the modal
var closenewpost = document.getElementById("closenew");

var closefullpost = document.getElementById("closefull");


var newpost = document.getElementsByClassName("modal-content")[0];
var fullpost = document.getElementsByClassName("fullpost")[0];


// When the user clicks on <span> (x), close the modal
if (closenewpost){
closenewpost.onclick = function() {
    modal.style.display = "none";
    newpost.style.display = "none";

}}
if (closefullpost){
closefullpost.onclick = function() {
    modal.style.display = "none";
    fullpost.style.display = "none";
    $(".carousel").slick("removeSlide", null, null, true);
}}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        fullpost.style.display = "none";
        $(".carousel").slick("removeSlide", null, null, true);
        newpost.style.display = "none";
        document.getElementById("signup").style.display = "none";
    }
}





		};

        function getBackground() {

                var imgEl = document.getElementById("background");
                //imgEl.src = "https://source.unsplash.com/featured/?nature";

                var rgb = getAverageRGB(imgEl);

            

                var header = document.getElementById("header");
                header.style.backgroundColor = "rgba(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ", 0.8)";

                var nav = document.getElementById("nav");
                nav.style.backgroundColor = "rgba(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ", 0.8)";

                var header = document.getElementById("footer");
                header.style.backgroundColor = "rgba(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ", 0.8)";
        }


		function getAverageRGB(imgEl) {

    	var blockSize = 5, // only visit every 5 pixels
        defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        rgb = {r:0,g:0,b:0},
        count = 0;

        if (!context) {
        	alert("default");
        	return defaultRGB;
        }

        height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
        width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

        context.drawImage(imgEl, 0, 0);

        try {
        	data = context.getImageData(0, 0, width, height);
        } catch(e) {
        	alert("def");
        	/* security error, img on diff domain */
        	return defaultRGB;
        }

        length = data.data.length;

        while ( (i += blockSize * 4) < length ) {
        	++count;
        	rgb.r += data.data[i];
        	rgb.g += data.data[i+1];
        	rgb.b += data.data[i+2];
        }

    // ~~ used to floor values
    rgb.r = ~~(rgb.r/count);
    rgb.g = ~~(rgb.g/count);
    rgb.b = ~~(rgb.b/count);

    return rgb;

}

    function fullPost(el){

        
        var title = el.getElementsByClassName("title")[0].innerText;
        var cat = el.getElementsByClassName("cat")[0].innerText;
        var time = el.getElementsByClassName("time")[0].innerText;
        if (el.getElementsByClassName("singleimg")[0])
            var img = el.getElementsByClassName("singleimg")[0].innerText;
        
        var body = el.getElementsByClassName("postbody")[0].innerText;
        var video = el.getElementsByClassName("video")[0].innerText;
        var defimg = el.getElementsByClassName("defimg")[0].innerText;
        var post_id = el.getElementsByClassName("post_id")[0].innerText;

        var postimages = el.getElementsByClassName("postimages");

        [].forEach.call(postimages, function (el) {

            var postimg = el.innerText;
            $(".carousel").slick("slickAdd", "<div><img class='fullimg' src=" + postimg + "></div>");

        });
        $('.carousel').slick('slickGoTo', 0);


        if (defimg == "1"){
            img = "";
        }

        document.getElementById("fullimg").src = img;

        document.getElementById("fulltitle").innerText = title;
        document.getElementById("fullcat").innerText = cat;
        document.getElementById("fulltime").innerText = time;      
        document.getElementById("fullbody").innerText = body;
        document.getElementById("fullid").innerText = post_id;

        if (video != "") {

            var src = 'https://www.youtube.com/embed/' + video;

            document.getElementById("videocontainer").innerHTML = ("<iframe id='fullvideo' allowfullscreen frameborder='0' src=" + src + "></iframe>");
            document.getElementById("videocontainer").style.display = "block";


        }else {
            document.getElementById("videocontainer").innerHTML = "";
            document.getElementById("videocontainer").style.display = "none";
        }

        //open and display modal
        var modal = document.getElementById('myModal');
        modal.style.display = "block";

        var fullpost = document.getElementsByClassName("fullpost")[0];
        fullpost.style.display = "block";

        var post_id = el.getElementsByClassName("post_id")[0].innerText;
        //alert(post_id);

        var postData = "post_id=" + post_id;

        
        ajaxComments(postData);

        

    }

    function ajaxComments(postData){

        $.ajax({
            url: 'php/getComments.php',
            type: "POST",
            data: postData,
            success: function(data) {
                $("#fullcomments").html(data);
                $(".lettering").lettering();
            }
        });
    }

    function categories(cat){
        event.stopPropagation();

        category = cat;

        $.ajax({
                url: 'php/getPosts.php?page=0&category=' + cat,
                success: function(data) {
                    $("#content").html(data);
                }
            });
        $("#prev").css("visibility", "hidden");
        $('#adv').css('visibility', 'visible');
        page = 0;
        $("#pagenum").text('Page ' + (page + 1));

        $('html, body').animate({ scrollTop: 600 }, 'medium');

    }

    function allposts(){
    	window.location = "";
    }

