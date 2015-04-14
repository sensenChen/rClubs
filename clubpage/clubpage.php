 <?php 
    session_start();
    require_once('../php/club_functions.php');
?>
<?php 
  include ( "../header.php" ); 
?>
<?php
    connectToDatabase();	
    if(isset($_GET['c'])) {   //Get club name from link
        $myurl = mysql_real_escape_string($_GET['c']);   //Store club name in variable
    	
        	
        //Check if club is valid and in database, then get information about the club
        if(preg_match("/^[a-zA-Z0-9_\-]+$/", $myurl)){
            $check = mysql_query("SELECT urlname, name, location, day_time, public FROM Clubs WHERE urlname = '$myurl'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['name'];
                $location = $get['location'];
                $day_time = $get['day_time'];
                $hours = getDaytimeHours($day_time);
                $public = $get['public'];
                list($myuserid, $myclubid) = getUserAndClubId($_SESSION['myusername'], $myurl);
                $isMember = isUserAdded($myuserid, $myclubid);
                $isAdmin = isAdmin($myuserid, $myclubid);
                
            }else{
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
<?php
	if($isAdmin) {
		echo '<form method="post" action="change_club.php?club=';
			echo $get['urlname'];
			 echo '">';
	}
?>

	<div class="clubbanner"><p><?php if($isAdmin) {
		                        	echo '<input name="clubName" type="text" value="';
		                	}
		                	echo "$clubname"; 
		                	if($isAdmin) {
		                        	echo '" class="clubnameinput">';
		                	}
		                	?></p></div>
	
	<div class="container">
	    <div id="navcontainer" class="clubnav" style="background: #99ccff;"> 
	    <ul>
	        <li><a href="#">About</a></li>
	        <li><a href="#">Announcements</a></li>
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
			        	if ($public || $isMember) {
			        		$meetings = explode(',',$hours);
			        		$meetingsCount = count($meetings);
			        		if (!$isAdmin) {
				        		for ($i = 0;$i<$meetingsCount;$i++) {
				        			echo $meetings[$i];
				        			if ($i != $meetingsCount-1)
				        				echo "," . "<br>" ;
				        		}
			        		}
			        		else {
			        			for ($i = 0;$i<$meetingsCount;$i++) {
			        				$startTimeName = "starttime" . ($i+1);
			        				$endTimeName = "endtime" . ($i+1);
			        				$meetingDayName = "meetingday" . ($i+1);
			        				$temp = explode(";", $day_time);
			        				$temp2 = explode("_",$temp[$i]);
			        				$meetingDay = $temp2[0];
			        				$startTime = $temp2[1];
			        				$endTime = $temp2[2];
			        				if(strlen($startTime) == 4)
			        					$startTime = 0 . $startTime;
			        				if(strlen($endTime) == 4)
			        					$endTime = 0 . $endTime;
			        				echo"<p>";
			        				$selected0 = ''; if($meetingDay == 'Sunday')$selected0 = 'selected';
			        				$selected1 = ''; if($meetingDay == 'Monday')$selected1 = 'selected';
			        				$selected2 = ''; if($meetingDay == 'Tuesday')$selected2 = 'selected';
			        				$selected3 = ''; if($meetingDay == 'Wednesday')$selected3 = 'selected';
			        				$selected4 = ''; if($meetingDay == 'Thursday')$selected4 = 'selected';
			        				$selected5 = ''; if($meetingDay == 'Friday')$selected5 = 'selected';
			        				$selected6 = ''; if($meetingDay == 'Saturday')$selected6 = 'selected';
			        				echo"<select name='$meetingDayName'>
						                        <option value=''>Day of the Week...</option>
						                        <option value='Monday' $selected1>Monday</option>
						                        <option value='Tuesday' $selected2>Tuesday</option>
						                        <option value='Wednesday' $selected3>Wednesday</option>
						                        <option value='Thursday' $selected4>Thursday</option>
						                        <option value='Friday' $selected5>Friday</option>
						                        <option value='Saturday' $selected6>Saturday</option>
						                        <option value='Sunday' $selected0>Sunday</option>
						                </select>";
			        				echo "from";
				        			echo "<input name='$startTimeName' type='Time' value='$startTime'>";
				        			echo "to";
				        			echo "<input name='$endTimeName' type='Time' value='$endTime'>";
				        			echo"</p>";
				        		}
				        		echo "<span id='writeroot'></span>";
                					echo "<input type='button' onclick='moreFields()' value='Add more fields' />";
				        		
				        		echo"<p id = 'readroot' style='display: none'>";
				        			echo"<select id = 'meetingday'>
						                        <option value=''>Day of the Week...</option>
						                        <option value='Monday'>Monday</option>
						                        <option value='Tuesday'>Tuesday</option>
						                        <option value='Wednesday'>Wednesday</option>
						                        <option value='Thursday'>Thursday</option>
						                        <option value='Friday'>Friday</option>
						                        <option value='Saturday'>Saturday</option>
						                        <option value='Sunday'>Sunday</option>
						                </select>";
			        				echo "from";
				        			echo "<input type='Time' id = 'starttime'>";
				        			echo "to";
				        			echo "<input type='Time' id = 'endtime'>";
				        		echo"</p>";
			        		}
			        		echo "<div id='meetingsCount' style='display: none;'>";
        						echo htmlspecialchars($meetingsCount); 
						echo "</div>";
			        	}	
			        		
			        	else 
			        		echo "Please add the club to view this information.";
		            ?>
		            
			            <script>
			                    var counter = 0;
			
			                    function moreFields() {
			                        counter++;
			                        var node = document.getElementById('meetingsCount');
			                        var meetingsCount = parseInt(node.textContent);
			                        var newFields = document.getElementById('readroot').cloneNode(true);
			                        
			                        if(counter + meetingsCount>10)
			                            return;
			                        newFields.id = '';
			                        newFields.style.display = '';
			                        var newField = newFields.childNodes;
			                        for (var i=0;i<newField.length;i++) {
			                            var theName = newField[i].id;
			                            if (theName)
			                                newField[i].name = theName + (counter +  meetingsCount);
			                        }
			                        var insertHere = document.getElementById('writeroot');
			                        insertHere.parentNode.insertBefore(newFields,insertHere);
			                        
			                    }
	               		 </script>
		            
		        </td>
		    </tr>
		    <tr>
		        <td>Location</td>
		        <td><?php 
		        if ($public  || $isMember) {
		        	if($isAdmin) {
		                        echo '<input name="location" type="text" value="';
		                }
		        	echo "$location"; 
		        	if($isAdmin) {
		        		echo '">';
		                }
		        }
		        else 
		        	echo "Please add the club to view this information.";	
		        ?></td>
		    </tr>
	    </table>
	</div>
	
<?php
	if($isAdmin) {
	    echo '<center>';
	    echo '<input type="submit" value="Save Changes">';
	    echo '</center>';
	    echo '</form>';
	    
	}                            
?>                            
