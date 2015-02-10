<?php
	session_start();
	if (!isset($_SESSION['myusername'])) {
        	header("location: http://rclubs.me");
   	}
	require_once('../php/club_functions.php');
	$myusername = $_SESSION['myusername'];
	
   	connectToDatabase();
	
	// username and password sent from form
	$myfirstname=$_POST['myfirstname'];
	$mylastname=$_POST['mylastname'];
	$myemail=$_POST['myemail'];
	$myphonenumber=$_POST['myphonenumber'];
	$myemailnotification=isset($_POST['myemailnotification']);
	$mytextnotification=isset($_POST['mytextnotification']);
	
	//anti-injection
	$myfirstname = mysql_real_escape_string($myfirstname);
	$mylastname = mysql_real_escape_string($mylastname);
	$myemail = mysql_real_escape_string($myemail);
	$myphonenumber = mysql_real_escape_string($myphonenumber);

	if (isset($myphonenumber) && !ctype_digit($myphonenumber)) {
		echo("Make sure your phone number consists of all numerical digits.");
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/account'>";	
	}
	
	else {
		$query = "SELECT * FROM Users where username='$myusername'";
		$data = mysql_query($query)or die(mysql_error());
		
		if(mysql_num_rows($data) != 1)
		{
		    echo mysql_num_rows($result);
	    	    echo " instances of user in database.";
	    	    echo $myusername;
	    	    exit();
		}
		
		$query = "UPDATE Users SET firstname='$myfirstname',lastname='$mylastname',email='$myemail',phonenumber='$myphonenumber',
				emailnotification='$myemailnotification',textnotification='$mytextnotification' WHERE username='$myusername'";
		mysql_query($query)or die(mysql_error());
		echo("Changes successfully saved");
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/account'>";	
	}
?>