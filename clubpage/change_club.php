<?php 
    session_start();
    require_once('../php/club_functions.php');
?>
<?php
    connectToDatabase();
	$myusername = $_SESSION['myusername'];
	if(!isset($_GET['club'])) {
		echo "Club not selected.";
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/myclubs/'>";
	}
	$club = $_GET['club'];

	
	list($myuserid, $myclubid) = getUserAndClubId($_SESSION['myusername'], $club);
	$isAdmin = isAdmin($myuserid, $myclubid);
	
	if(!$isAdmin) {
		echo "Not admin.";
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/clubpage/". $club. "'>";
	}
	
	if (isset($_POST['location'])) {
		mysql_select_db("rclubsme_users")or die("cannot select DB");
		$location = $_POST['location'];
		$sql = "UPDATE Clubs SET location='$location' WHERE urlname='$club'";
		mysql_query($sql);
	}
	
	echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/clubpage/". $club. "'>";
?>