<html><head><title>View/Edit Day</title></head></html>

<?php if(isset($_POST['delete'])){
include('sqlconnect.php');
	mysql_query("USE bubbles");
	$ScheduleID = $_POST['scheduleid'];
	$query ="DELETE FROM Scheduled WHERE ScheduleID = '$ScheduleID'";
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
}
?>

<?php if(isset($_POST['update'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$Date = $_POST['date'];
	$Time = $_POST['time'];
	$AMPM = $_POST['AMPM'];
	$SpecialComments = $_POST['specialcomments'];
	$ScheduleID = $_POST['scheduleid'];
	if($AMPM == "AM"){
		$query ="UPDATE Scheduled
				SET TimeOfDay = '$Time', SpecialComments = '$SpecialComments', PM = FALSE
				WHERE ScheduleID = '$ScheduleID'";
	}
	else{
		$query ="UPDATE Scheduled
				SET TimeOfDay = '$Time', SpecialComments = '$SpecialComments', PM = TRUE
				WHERE ScheduleID = '$ScheduleID'";
	}
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
}
?>

<?php if(isset($_POST['editbooking'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$DogID = $_POST['dogid'];
	$Date = $_POST['date'];
	$query = "SELECT * FROM Scheduled WHERE DogID = '$DogID' AND DateOfDay = '$Date'";
	$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	$BookingInfo = mysql_fetch_array($result);
	echo "<html><body";
	echo '<h2>Booked for ' . $BookingInfo['DateOfDay'] . ':</h2>';
	echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
	echo 'Time (HH:MM): <input name = "time" type = "text" value = "'.$BookingInfo['TimeOfDay'].'"/>';
	if($BookingInfo['PM'] == TRUE){
		echo '<select name = "AMPM">';
		echo '<option>AM</option>';
		echo '<option selected="selected">PM</option>';
		echo '</select><br />';
	}
	else{
		echo '<select name = "AMPM">';
		echo '<option selected="selected">AM</option>';
		echo '<option>PM</option>';
		echo '</select><br />';
	}
	echo 'Special Comments: <input name = "specialcomments" type = "text" value = "'.$BookingInfo['SpecialComments'].'"/><br />';
	echo '<input name = "update" type = "submit" value = "Update">';
	echo '<input name = "delete" type = "submit" value = "Delete"><br />';
	echo '<input name = "date" type = "hidden" value = "'.$BookingInfo['DateOfDay'].'">';
	echo '<input name = "scheduleid" type = "hidden" value = "'.$BookingInfo['ScheduleID'].'">';
	echo '</form></body></html>';
}
?>

<?php if(isset($_POST['setdate'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	echo "<html><body>";
	$_SESSION['Date'] = $_POST['date'];
	echo '<h2>Dogs Scheduled for ' . $_SESSION['Date'] . ':</h2>';
	$query = "SELECT DogID FROM Scheduled WHERE DateOfDay = '{$_SESSION['Date']}'";
	$DogIDs = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
	echo "<tr style='font-weight: bold;'>";  
	echo "<td width='200' align='center'>Time</td><td width='200' align='center'>Dog Name</td><td width='200'align='center'>Breed</td><td width='200'align='center'>Price</td><td width='300'align='center'>Special Comments</td><td width='400'align='center'>Instructions</td>";  
	echo "</tr>";  
	while($DogID = mysql_fetch_array($DogIDs)){
		$query = "SELECT * FROM Dog WHERE DogID = '{$DogID['DogID']}'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$DogInfo = mysql_fetch_array($result);
		$query = "SELECT * FROM Scheduled WHERE DogID = '{$DogID['DogID']}' AND DateOfDay = '{$_SESSION['Date']}'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$BookingInfo = mysql_fetch_array($result);
		echo "<tr>";  
		if($BookingInfo['PM'] == TRUE)
			echo "<td align='center' width='100'>" . $BookingInfo['TimeOfDay'] . "PM" . "</td>"; 
		if($BookingInfo['PM'] == FALSE)
			echo "<td align='center' width='100'>" . $BookingInfo['TimeOfDay'] . "AM" . "</td>"; 
		echo "<td align='center' width='100'>" . $DogInfo['Name'] . "</td>";  
		echo "<td align='center' width='100'>" . $DogInfo['Breed'] . "</td>";   
		echo "<td align='center' width='100'>" . $DogInfo['Price'] . "</td>"; 
		echo "<td align='center' width='100'>" . $BookingInfo['SpecialComments'] . "</td>"; 
		echo "<td align='center' width='100'>" . $DogInfo['Instructions'] . "</td>"; 
		echo "<td>";
		echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
		echo '<input name = "editbooking" type = "submit" value = "Edit Booking"/><br />';
		echo '<input name = "dogid" type = "hidden" value ="'.$DogInfo['DogID'].'"/>';
		echo '<input name = "date" type = "hidden" value ="'.$_SESSION['Date'].'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
	
} ?>

<?php if(!isset($_POST['setdate']) && !isset($_POST['editbooking'])){ ?>
	<html>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<h3> Please enter the date and time you wish to view/edit </h3> 
	Date (YY-MM-DD): <input name = "date" type = "text"/> <br />
	<input name = "setdate" type = "submit" value = "Search"/> <br />
	</form>
	</html>
<?php } ?>

<html><body>
<form action="menu.php">
<input type = "submit" value = "Back to menu"/>
</form>
</body></html>