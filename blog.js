 

 var page = 0;
 var home = 0;

        var category = "";

        $(document).ready(function(){

            $("body").click(function(e){
                var container = $("#menu");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $("#archivedropdown").css("display","none");
                }
                
            });

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

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function showdropdown() {
    //document.getElementById("archivedropdown").classList.toggle("show");
    document.getElementById("archivedropdown").style.display = "block";
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




// When the user clicks on the button, open the modal 
createpost.onclick = function() {
    modal.style.display = "block";
    newpost.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
closenewpost.onclick = function() {
    modal.style.display = "none";
    newpost.style.display = "none";

}
closefullpost.onclick = function() {
    modal.style.display = "none";
    fullpost.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        fullpost.style.display = "none";
        newpost.style.display = "none";
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
        var img = el.getElementsByClassName("img")[0].src;
        var body = el.getElementsByClassName("postbody")[0].innerText;
        var video = el.getElementsByClassName("video")[0].innerText;
        var defimg = el.getElementsByClassName("defimg")[0].innerText;


        if (defimg == "1"){
            img = "";
        }


        document.getElementById("fulltitle").innerText = title;
        document.getElementById("fullcat").innerText = cat;
        document.getElementById("fulltime").innerText = time;
        document.getElementById("fullimg").src = img;
        document.getElementById("fullbody").innerText = body;

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

