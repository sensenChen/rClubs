<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        echo "You must be logged in to view this page";
        exit(0);
    }
?>
<?php 
    include ( "../header.php" ); 
?>

<html>
    <body>
        <center>
        <form method="post" action="submit.php">
            <div class="account" id="accountname"><//?php echo "$username"; ?></div>
            <div class="accountbutton" id="accountedit"><input class="accountbutton" id="accountsave" type="submit" value="Submit"></div>
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
                <p><input name="clubname" type="text" required></p>
                <p><input name="location" type="text" required></p>
                <p>
                    <select name="meetingday1" required>
                        <option value="">Day of the Week...</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    <select>
                    from
                    <input name="starttime1" type="time" required>
                    to
                    <input name="endtime1" type="time" required> 
                </p>      
                                <p>
                    <select name="meetingday2">
                        <option value="">Day of the Week...</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    <select>
                    from
                    <input name="starttime2" type="time">
                    to
                    <input name="endtime2" type="time"> 
                </p> 
                <p>
                    <select name="meetingday3">
                        <option value="">Day of the Week...</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    <select>
                    from
                    <input name="starttime3" type="time"> 
                    to
                    <input name="endtime3" type="time"> 
                </p>   
            </div>
        </form>
        </center>
    </body>
</html>     