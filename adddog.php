<html><head><title>Add Dog</title></head></title>

<?php if(isset($_POST['finishadddog']) || isset($_POST['addanotherdog'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$CustomerID = $_POST['customerid'];
	$Price = $_POST['price'];
	$Name = $_POST['name'];
	$Breed = $_POST['breed'];	
	$Instructions = $_POST['instructions'];	
	if(isset($_POST['saturday']))
		$Saturday = 1;
	else
		$Saturday = 0;
	$query ="INSERT INTO Dog(Price, Name, Breed, Instructions, Saturday) 
		VALUES('$Price', '$Name', '$Breed', '$Instructions', '$Saturday')";
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	$query ="INSERT INTO Owns(CustomerID, DogID) 
		VALUES('$CustomerID', LAST_INSERT_ID())";
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
}
?>

<?php if(isset($_POST['adddog']) || isset($_POST['addanotherdog'])){
	if(!isset($_POST['addanotherdog']))
		include('sqlconnect.php');
	mysql_query("USE bubbles");
	$CustomerID = $_POST['customerid'];
	echo "<html><body>";
	echo "<h2>Please enter dog info: </h2>";  
	echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . '" method="post">';
	echo 'Name: <input name = "name" type = "text" /><br />';
	echo 'Breed: <input name = "breed" type = "text" /><br />';
	echo 'Price: <input name = "price" type = "number" /><br />';
	echo 'Can be booked on Saturday: <input name = "saturday" type = "checkbox" /><br />';
	echo '<textarea rows="5" cols="60" name="instructions" wrap="physical">';
	echo 'Instructions</textarea><br />';
	echo '<input name = "customerid" type = "hidden" value = "'.$CustomerID.'"/><br />';
	echo '<input name = "finishadddog" type = "submit" value = "Submit"/>';
	echo '<input name = "addanotherdog" type = "submit" value = "Add Another"/><br />';
	echo '</form></body></html>';
	

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
		echo '<input name = "adddog" type = "submit" value = "Select"/><br />';
		echo '<input name = "customerid" type = "hidden" value ="'.$row['CustomerID'].'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
	echo "</body></html>";
}
?>


<?php if(!isset($_POST['searchphone']) && !isset($_POST['searchname']) && !isset($_POST['adddog']) && !isset($_POST['addanotherdog'])){ ?>
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