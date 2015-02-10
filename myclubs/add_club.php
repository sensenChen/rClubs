<?php
session_start();
if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

require_once('../php/club_functions.php');

connectToDatabase();

//Get data
$myclub=$_GET['club'];
$myusername = $_SESSION['myusername'];

//Get the user and club id
list($myuserid, $myclubid) = getUserAndClubId($myusername, $myclub);

//Checks to see if the user already added the club to the MyClubs list
if (isClubAdded($myuserid, $myclubid)){
    exit("This club has already been added to your MyClubs list.<br/>");
}

addClub($myuserid, $myclubid);

//automatically redirect to the MyClubs page
echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>