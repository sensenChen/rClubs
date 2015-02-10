<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
    require_once('../php/club_functions.php');
    connectToDatabase();
    $username = $_SESSION['myusername'];
    $query = "SELECT * FROM Users WHERE username='$username'";
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) != 1) {
    	echo mysql_num_rows($result);
    	echo " instances of user in database.";
    	echo $username;
    	exit();
    }
    $db_field = mysql_fetch_assoc($result);
    $firstname = $db_field['firstname'];
    $lastname = $db_field['lastname'];
    $email = $db_field['email'];
    $phonenumber = $db_field['phonenumber'];
    $emailnotification = $db_field['emailnotification'];
    $textnotification = $db_field['textnotification'];
?>
<?php 
    include ( "../header.php" ); 
?>                          
                            
<html>
    <body>
        <center>
            <div class="account" id="accountname"><?php echo "$username"; ?></div>
            <div class="accountbutton" id="accountedit"><a href="http://rclubs.me/account/edit.php"><p>Edit</p></a></div>
            <div class="account" id="accountleft">
                <?php 
                    echo "<p>First Name</p>";
                    echo "<p>Last Name</p>";
                    echo "<p>E-mail</p>";
                    echo "<p>Phone Number</p>";
                ?>
            </div>
            <div class="account" id="accountmid">
                <?php 
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                ?>
            </div>
            <div class="account" id="accountright">
                <?php 
                    if($firstname == ""){ echo "<p>N/A</p>"; } else { echo "<p>$firstname</p>"; }
                    if($lastname == ""){ echo "<p>N/A</p>"; } else { echo "<p>$lastname</p>"; }
                    if($email == ""){ echo "<p>N/A</p>"; } else { echo "<p>$email</p>"; }
                    if($phonenumber == ""){ echo "<p>N/A</p>"; } else { echo "<p>$phonenumber</p>"; }

                ?>
            </div>
        </center>
    </body>
</html>               
                            