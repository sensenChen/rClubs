                                                                                                <?php
session_start();

require_once('../php/club_functions.php');

connectToDatabase();

mysql_select_db("rclubsme_users")or die("cannot select DB");
$tbl_name = "Clubs";

echo "RPI has many wonderful clubs that you can join. Here is a list of all of them!". "<br/>";

$check = mysql_query("SELECT clubid FROM $tbl_name");


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
}

?>
                            
                            
                            