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
                    <form method="post" action="signup.php">
                        <input name="myusername" id="fbox" type="text" placeholder="username">
                        <input name="mypassword" id="fbox" type="password" placeholder="password">
                        <input name="repassword" id="fbox" type="password" placeholder="re-password">
                        <input name="myemail" id="fbox" type="text" placeholder="email address">
                        
                        <input id="register" type="submit" value="REGISTER">
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            