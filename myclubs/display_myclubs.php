<?php
session_start();
if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

require_once('../php/club_functions.php');

connectToDatabase();

$myusername = $_SESSION['myusername'];

//search for user id
$myuserid = getUserId($myusername);

echo "Username: ". $myusername . "<br/><br/>";
echo "Clubs added: <br/>";

$check = mysql_query("SELECT clubid FROM MyClubs WHERE userid='$myuserid'");
if(mysql_num_rows($check) == 0)
{
    exit("No clubs saved.<br/>");
}

//notify the user when there's a club meeting
$notifications = array();

//get the current day of the week
date_default_timezone_set('America/New_York');
$currentday = date("l");

while ($row = mysql_fetch_assoc($check)) 
{
    $myclubid = $row['clubid'];

    //search for club name 
    $sql = "SELECT * FROM Clubs WHERE clubid='$myclubid'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubname = $db_field['name'];
    $meetingdays = $db_field['day_time'];

    //print each club found (provide a link to the clubpage)
    echo "<a href=http://rclubs.me/clubpage/" . $db_field['urlname'] . ">";
    echo $myclubname . "</a>";
    echo "<br/>";

    //notify the user if there is a meeting on this day (for example Friday)
    //make sure to mention the time
    $days = explode(";", $meetingdays);
    $size = count($days);
    for ($i = 0; $i < $size; $i++)
    {
       if (strpos($days[$i], $currentday) !== false)
       {
           $hours = explode("_", $days[$i]);
           $start_time = $hours[1];
           $notifications[] = $myclubname . " at " . date('h:i a', strtotime($start_time)) . " in " . $db_field['location'] . "<br/>"; 
       }
    }
}

echo "<br/><h3>Today is " . $currentday . "</h3>";

//Creates a notification message string
if (!empty($notifications)) {
    $message = "You have meetings for the following clubs:<br/>";
    foreach($notifications as $msg) {
        $message .=  $msg;
    }
    echo $message;
}
else
{
    echo "You have no club meetings today.<br/>";
}
?>