                                <?php
    session_start();
?>
<html>
    <head>
        <title>rClubs</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="js/autocomplete.js"></script>
    </head>
    <body>
        <div class="heading">
            <a href="http://rclubs.me"><img class="homebutton" src="images/rClubs.png"></a>
            <ul>
                <a href="http://rclubs.me/about"><li class="topbutton" id="left">About</li></a>
                <a href="http://rclubs.me/feedback"><li class="topbutton" id="left">Feedback</li></a>
                <a href="http://rclubs.me/signup"><li class="topbutton" id="right" style="margin-right:3vw;">
                	<?php
                	if (!isset($_SESSION['myusername']))
    				{echo("Signup");}
    			?>
                </li></a>
                <a href="http://rclubs.me/login"><li class="topbutton" id="right">
                	<?php
                	if (!isset($_SESSION['myusername']))
    				{echo("Login");}
    			?>
                </li></a>
                <a href="http://rclubs.me/login/logout.php"><li class="topbutton" id="right">
                	<?php
                	if (isset($_SESSION['myusername']))
    				{echo("Logout");}
    			?>
                </li></a>
                <a href="http://rclubs.me/myclubs/"><li class="topbutton" id="right">
                	<?php
                	if (isset($_SESSION['myusername']))
    				{echo("MyClubs");}
    			?>
                </li></a>
            </ul>
        </div>
        <div class="heading_underline"></div>
        <div class="search">
            <div class="logo">
                <center>
                    <img src="/images/rClubs.png" width="20%;">
                </center>
            </div>
            <center>
                <div class="ui-widget">
                    <form method="post" action="php/display_result.php">
                        <input name="mysearch" id="homesearchbar" type="text" placeholder="Search Clubs"/>
                    </form>
                </div>
            </center>
        </div>
        <div class="footer">
            <center>
                <ul class="footbar">
                    <a href="#"><li class="bottombutton"><font color="#af0000">r</font><font color="#797979">Clubs</font></li></a>
                    <a href="http://rcos.rpi.edu/projects/rpi-tradebook/"><li class="bottombutton"><font color="#af0000">@RCOS</font></li></a>
                </ul>
            </center>
        </div>
    </body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            