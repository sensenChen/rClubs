<?php
   session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
?>

<html>
<head>
<title>Chatroom</title>
<link type="text/css" rel="stylesheet" href="../css/main.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
    // jQuery Document
    $(document).ready(function(){
        setInterval (loadLog, 1000);
    });

    //Load the file containing the chat log
    function loadLog(){		
	var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
	$.ajax({
	    url: "log.html",
	    cache: false,
	    success: function(html){		
		$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
		//Auto-scroll			
		var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
		if(newscrollHeight > oldscrollHeight){
			$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
			}				
		  },
	    });
    }

</script>
</head>

<?php
    include ("../header.php");
?>
 
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <?php echo $_SESSION['myusername']; ?> <b></b></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox">
<?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?>
</div>
     
    <form name="message" action="post.php" method="post">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>

</body>
</html>