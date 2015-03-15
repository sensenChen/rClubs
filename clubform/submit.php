
<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
    require_once('../php/club_functions.php');
    connectToDatabase();
    $username = $_SESSION['myusername'];
    $userid = getUserId($username);
    $clubName=$_POST['clubName'];
    $location=$_POST['location'];
    $meetingDay=$_POST['meetingDay'];
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    

    $message='The user' . $username . ' with id ' . $userid . ' would like to add the club ' . 
            $clubName . " to rClubs\n" . 'Location: ' . $location . "\n" . 
            'Meetings: ' . $meetingDay . ' from ' . $startTime . ' to ' . $endTime;
    mail("rclubsme@gmail.com","Rclubs: Request to Add New Club",$message);
    echo "A request to add this club to rClubs has been sent.";
    echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>
