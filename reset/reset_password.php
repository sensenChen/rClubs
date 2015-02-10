<?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Reset"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$mykey=$_POST['mykey'];

//anti-injection
$mykey = mysql_real_escape_string($mykey);

//Checks to see if the key exists in the confirm table
$sql = "SELECT * FROM $tbl_name WHERE resetkey='$mykey'";  
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count != 1) {
	echo("Make sure you have a valid reset link.");
}
else {

    //Stores the userid and email from the confirm table
    $db_field = mysql_fetch_assoc($result);
    $myemail = $db_field['email'];

    //Access users table now
    $tbl_name = "Users";
    $sql = "SELECT * FROM $tbl_name WHERE email='$myemail'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) != 1) {
        exit("User exists " . mysql_num_rows($result) . " times in database.");
    }

    $db_field = mysql_fetch_assoc($result);
    $myusername = $db_field['username'];

    echo "Username: " . $myusername. "<br/>";

    $newpassword = $_POST['mypassword'];

    //hash the password
    $newpassword = md5($newpassword);

    $sql = "UPDATE $tbl_name SET password='$newpassword' WHERE email='$myemail'";
    mysql_query($sql);
    echo("Your password has been successfully changed.");

    //Delete element
    $sql = "DELETE FROM Reset WHERE email='$myemail'";
    mysql_query($sql);
}

?>                                
                            