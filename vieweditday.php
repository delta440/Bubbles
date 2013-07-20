<html><head><title>View/Edit Day</title></head></html>

<?php if(isset($_POST['setdate'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	echo "<html><body>";
	echo '<h2>Dogs Scheduled for ' . $_SESSION['Date'] . ':</h2>';
	$_SESSION['Date'] = $_POST['date'];
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
		$query = "SELECT * FROM Scheduled WHERE DogID = '{$DogID['DogID']}'";
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
	
		echo "</td></tr>";  
	}
	
} ?>

<?php if(!isset($_POST['setdate'])){ ?>
	<html>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<h3> Please enter the date and time you wish to view/edit </h3> 
	Date (YY-MM-DD): <input name = "date" type = "text"/> <br />
	<input name = "setdate" type = "submit" value = "Search"/> <br />
	</form>
	</html>
<?php } ?>