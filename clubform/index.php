<?php
    /*session_start();
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
    $textnotification = $db_field['textnotification'];*/
?>
<?php 
    include ( "../header.php" ); 
?>

<html>
    <body>
        <center>
        <form method="post" action="account.php">
            <div class="account" id="accountname"><//?php echo "$username"; ?></div>
            <div class="accountbutton" id="accountedit"><input class="accountbutton" id="accountsave" type="submit" value="Save"></div>
            <div class="account" id="accountleft">
                <?php 
                    echo "<p>Club Name</p>";
                    echo "<p>Location</p>";
                    echo "<p>Meeting times</p>";
                ?>
            </div>
            <div class="account" id="accountmid">
                <?php 
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                ?>
            </div>
            <div class="account" id="accountright">
                <p><input name="clubName" type="text" required></p>
                <p><input name="location" type="text" required></p>
                <p>
                    <select name="meetingDay" required>
                        <option value="">Day...</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    <select>
                    from
                    <p><input name="startTime" type="time" required></p> 
                    to
                    <p><input name="endTime" type="time" required></p> 
                </p>        
            </div>
        </form>
        </center>
    </body>
</html>     