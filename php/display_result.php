<?php
    require_once('club_functions.php');

    connectToDatabase();

    $mysearch = $_POST['mysearch'];
    //if we got something through $_POST
    if (isset($mysearch))
    {
        $word = mysql_real_escape_string($mysearch);
        $word = htmlentities($word);
        
        $myurl = searchClubUrl($word);
        if ($myurl == "")
        {
            exit("Club does not exist! Perhaps, you can mention it in the feedback form.");
        }

        header("location: http://rclubs.me/clubpage/" . $myurl);
    }
?>
<html>
<style>
a {
text-decoration:none;
}
</style>
</html>