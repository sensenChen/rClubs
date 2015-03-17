                                                                <?php
    session_start();
    if (isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
?>
<?php 
  	include ( "../header.php" ); 
?>
<html>
    <body>
        <center>
            <div id="bodi">
                <div class="talk">
                    <p id=slogan class="body-text">rClubs</p>
                    <p id="descr" class="body-text">Manage your clubs more easily with our very useful features</p>
                </div>
                <div class="boxes">
                    <form method="post" action="checklogin.php">
                    	<p  class="error-text">
                    	<?php
	                    	$invalid=$_GET['invalid'];
	                    	if($invalid == "true")
	                    		echo("Invalid username or password.");
                   	 ?>
                   	 </p>
                        <input name="myusername" id="fbox" type="text" placeholder="username or email">
                        <input name="mypassword" id="fbox" type="password" placeholder="password">
                        <font size="5vw"><a href="../reset/forgot_password.php">(Forgot Password?)</a></font>
                        <br/>

                        <input id="register" type="submit" value="Login">
                    </form>
                </div>
              
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            