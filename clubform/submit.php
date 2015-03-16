<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
    require_once('../php/club_functions.php');
    connectToDatabase();
    $username = $_SESSION['myusername'];
    $clubname=$_POST['clubname'];
    $location=$_POST['location'];
    $meetingday1=$_POST['meetingday1'];
    $starttime1=$_POST['starttime1'];
    $endtime1=$_POST['endtime1'];
    $meetingday2=$_POST['meetingday2'];
    $starttime2=$_POST['starttime2'];
    $endtime2=$_POST['endtime2'];
    $meetingday3=$_POST['meetingday3'];
    $starttime3=$_POST['starttime3'];
    $endtime3=$_POST['endtime3'];    
	
	$meetingdays = array($meetingday1);
	$starttimes = array($starttime1);
	$endtimes = array($endtime1);
	
	if ($meetingday2!="" && isset($starttime2) && isset($endtime2)) {
		array_push($meetingdays, $meetingday2);
		array_push($starttimes, $starttime2);
		array_push($endtimes, $endtime2);
	}
	
	if ($meetingday3!="" && isset($starttime3) && isset($endtime3)) {
		array_push($meetingdays, $meetingday3);
		array_push($starttimes, $starttime3);
		array_push($endtimes, $endtime3);
	}
		

	
    if(insertClub($clubname, $location, $meetingdays, $starttimes, $endtimes)){
    	echo "This club has been added to the rClubs database.";
    	$userandclubid = getUserAndClubId($username, $clubname);
    	$userid = $userandclubid[0];
    	$clubid = $userandclubid[1];
    	
    	addClub($userid, $clubid);
    	addUser($userid, $clubid);
    	makeAdmin($userid, $clubid);
    	
    	$message='The user' . $username . ' with id ' . $userid . ' has added ' . 
            $clubname . " to rClubs\n" . 'Location: ' . $location . "\n" . 
            'Meetings: ' . $meetingday . ' from ' . $starttime . ' to ' . $endtime;
    	mail("rclubsme@gmail.com","Rclubs: New Club Added to Database",$message);
    }
    echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>