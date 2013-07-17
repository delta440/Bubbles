<html><head><title>Book Dog</title></head></title>

<?php if(isset($_POST['book'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$Date = $_SESSION['Date'];
	$Time = $_SESSION['Time'];
	$DogID = $_POST['dogid'];
	$SpecialComments = $_POST['specialcomments'];
	$query = "INSERT INTO Scheduled(DateofDay, TimeofDay, SpecialComments, DogID)
	 VALUES('$Date', '$Time', '$SpecialComments', '$DogID')";
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	}
	?>
<?php if(isset($_POST['selectdog']) || isset($_POST['book'])){
	if(!isset($_POST['book'])){
		include('sqlconnect.php');
		mysql_query("USE bubbles");
	}
	$Date = $_SESSION['Date'];
	$CustomerID = $_POST['customerid'];
	$query1 = "SELECT DogID FROM Owns WHERE CustomerID = '$CustomerID'";
	$result1 = mysql_query($query1) or die('Query"' . $query1 . '" failed' . mysql_error());
	echo "<html><body>";
	echo "<h2>List of Dogs matching the given owner: </h2>";  
	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
	echo "<tr style='font-weight: bold;'>";  
	echo "<td width='200' align='center'>Name</td><td width='200'align='center'>Breed</td><td width='200'align='center'>Price</td><td width='200'align='center'>Special Comments</td>";  
	echo "</tr>";  
	while($row1 = mysql_fetch_array($result1)){
		$DogID = $row1['DogID'];
		$query = "SELECT * FROM Dog WHERE DogID = '$DogID'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$row = mysql_fetch_array($result);
		echo "<tr>";  
		echo "<td align='center' width='100'>" . $row['Name'] . "</td>";  
		echo "<td align='center' width='100'>" . $row['Breed'] . "</td>";   
		echo "<td align='center' width='100'>" . $row['Price'] . "</td>"; 
		echo "<td>";
		echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
		echo '<input name = "specialcomments" type = "text"/>';
		$query2 ="SELECT DogID FROM Scheduled WHERE DogID = '$DogID' AND DateofDay = '$Date'";
		$result2 = mysql_query($query2) or die('Query"' . $query2 . '" failed' . mysql_error());
		if($row2 = mysql_fetch_array($result2)){
			echo 'Booked <br />';
		}
		else{
			echo '<input name = "book" type = "submit" value = "Book"/><br />';
		}
		echo '<input name = "dogid" type = "hidden" value ="'.$DogID.'"/>';
		echo '<input name = "customerid" type = "hidden" value ="'.$CustomerID.'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
	echo "</body></html>";
}
?>

<?php if(isset($_POST['searchphone'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$PhoneNumber = $_POST['phonenumber'];
	$query1 = "SELECT CustomerID FROM PhoneNumbers WHERE PhoneNumber = '$PhoneNumber'";
	$result1 = mysql_query($query1) or die('Query"' . $query1 . '" failed' . mysql_error());
	echo "<html><body>";
	echo "<h2>List of customers matching the given phone number: </h2>";  
	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
	echo "<tr style='font-weight: bold;'>";  
	echo "<td width='200' align='center'>First Name</td><td width='200'align='center'>Last Name</td>";  
	echo "</tr>";  
	while($row1 = mysql_fetch_array($result1)){
		$CustomerID = $row1['CustomerID'];
		$query = "SELECT * FROM Customer WHERE CustomerID = '$CustomerID'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$row = mysql_fetch_array($result);
		echo "<tr>";  
		echo "<td align='center' width='100'>" . $row['FirstName'] . "</td>";  
		echo "<td align='center' width='100'>" . $row['LastName'] . "</td>";   
		echo "<td>";
		echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
		echo '<input name = "selectdog" type = "submit" value = "Select"/><br />';
		echo '<input name = "customerid" type = "hidden" value ="'.$row['CustomerID'].'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
	echo "</body></html>";
}
?>

<?php if(isset($_POST['searchname'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$FirstName = $_POST['firstname'];
	$LastName = $_POST['lastname'];
	if(!empty($FirstName) && !empty($LastName))
		$query1 = "SELECT * FROM Customer WHERE FirstName LIKE '$FirstName' AND LastName LIKE '$LastName'";
	else if(!empty($FirstName))
		$query1 = "SELECT * FROM Customer WHERE FirstName LIKE '$FirstName'";
	else 
		$query1 = "SELECT * FROM Customer WHERE LastName LIKE '$LastName'";
	$result1 = mysql_query($query1) or die('Query"' . $query1 . '" failed' . mysql_error());
	echo "<html><body>";
	echo "<h2>List of customers matching the given phone number: </h2>";  
	echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
	echo "<tr style='font-weight: bold;'>";  
	echo "<td width='200' align='center'>First Name</td><td width='200'align='center'>Last Name</td>";  
	echo "</tr>";  
	while($row1 = mysql_fetch_array($result1)){
		$CustomerID = $row1['CustomerID'];
		$query = "SELECT * FROM Customer WHERE CustomerID = '$CustomerID'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$row = mysql_fetch_array($result);
		echo "<tr>";  
		echo "<td align='center' width='100'>" . $row['FirstName'] . "</td>";  
		echo "<td align='center' width='100'>" . $row['LastName'] . "</td>";   
		echo "<td>";
		echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
		echo '<input name = "selectdog" type = "submit" value = "Select"/><br />';
		echo '<input name = "customerid" type = "hidden" value ="'.$row['CustomerID'].'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
	echo "</body></html>";
}
?>


<?php if(!isset($_POST['searchphone']) && !isset($_POST['searchname']) && !isset($_POST['selectdog']) 
		&& !isset($_POST['editdog']) && !isset($_POST['setdate']) && !isset($_POST['book'])){ ?>
	<html>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<h3> Please enter the date and time you wish to book the dog for </h3> <br />
	Date (YY-MM-DD): <input name = "date" type = "text"/> <br />
	Time (24H) (HH-MM): <input name = "time" type = "text"/> <br />
	<input name = "setdate" type = "submit"/> <br />
	</form>
	</html>
<?php } ?>
		
<?php if(isset($_POST['setdate'])){ 
	include('sqlconnect.php');
	$_SESSION['Date'] = $_POST['date'];
	$_SESSION['Time'] = $_POST['time'];
	?>
	<html>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<h3> Please enter either the phone number, or the first and last name of the customer </h3> <br />
	Phone Number: <input name = "phonenumber" type = "number"/>
	<input name = "searchphone" type = "submit" value = "Search by Number"/><br />
	<br />
	</form>

	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	FirstName: <input name = "firstname" type = "text"/><br />
	LastName: <input name = "lastname" type = "text"/>
	<input name = "searchname" type = "submit" value = "Search by Name"/><br />
	</form>
	</body></html>

	<?php } ?>

<html><body>
<form action="menu.php">
<input type = "submit" value = "Back to menu"/>
</form>
</body></html>