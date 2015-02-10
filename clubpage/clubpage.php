                                                                                                <?php 
    include ( "../clubpage/header.php" ); 
    require_once('../php/club_functions.php');
?>

<?php
    connectToDatabase();

    if(isset($_GET['c'])) {   //Get club name from link
        $myurl = mysql_real_escape_string($_GET['c']);   //Store club name in variable

        //Check if club is valid and in database, then get information about the club
        if(preg_match("/^[a-zA-Z0-9_\-]+$/", $myurl)){
            $check = mysql_query("SELECT urlname, name, location, day_time FROM Clubs WHERE urlname = '$myurl'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['name'];
                $location = $get['location'];
                $day_time = $get['day_time'];

                $hours = getDaytimeHours($day_time);
            }
            else{
                echo "<strong>Club does not exist!</strong>";
                exit();
            }
        }
    }
?>

<div class="clubbar">
<?php
session_start();

if (!isset($_SESSION['myusername'])) {
    echo "Want to bookmark this club? Login or signup for a new account.<br/>";
}
else
{
    echo "<br/>";

    //Display either an "add" or "delete" button, but not both

    //Get data
    $myusername = $_SESSION['myusername'];

   //Get the user and club id
   list($myuserid, $myclubid) = getUserAndClubId($myusername, $myurl);

    //Checks to see if the user already added the club to the MyClubs list
    if (!isClubAdded($myuserid, $myclubid)) {
       echo "<a href=http://rclubs.me/myclubs/add_club.php?club=".$get['urlname']." class=add_club>";
       echo "Add Club";
       echo "</a>";

       //echo "<br/>";
    }
    else
    {
        echo "<a href=http://rclubs.me/myclubs/delete_club.php?club=".$get['urlname']." class=delete_club>";
        echo "Delete Club";
        echo "</a>";       
    }
    mysql_select_db("rclubsme_users")or die("cannot select DB");

}                     
?>
</div>

<div class="clubbanner"><p><?php echo "$clubname"; ?></p></div>

<div class="container">
    <div id="navcontainer" class="clubnav" style="background: #99ccff;"> 
    <ul>
        <li><a href="#">About</a></li>
        <li><a href="#">Posts</a></li>
        <li><a href="#">Members</a></li>
        <li><a href="#">Photos</a></li>
    </ul>
    <br style="clear:right"/>
    </div>
</div>

<!--Print club information from database-->  
<div class="clubabout">
    <table id="clubtable" border="1" width="25%" cellpadding="4" cellspacing="3">
    <th colspan="2">
        <h3><br><?php echo "Club Info"; ?></h3>
    </th>
    <tr>
        <td>Meeting Day(s)</td>
        <td><?php 	
        	echo $hours;
            ?>
        </td>
    </tr>
    <tr>
        <td>Location</td>
        <td><?php echo "$location"; ?></td>
    </tr>
    </table>
</div>
                            
                            
                            
                            
                            
                            
                            
                            
                            