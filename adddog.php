<html><head><title>Add Dog</title></head></title>

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
		echo '<form action="'.htmlentities($_SERVER['PHP_SELF']) . ' method="post">';
		echo '<input name = "select" type = "submit" value = "Select"/><br />';
		echo '<input name = "customerid" type = "hidden" value ="'.$row['CustomerID'].'"/>';
		echo '</form>';
		echo "</td></tr>";  
	}
}
?>


<?php if(!isset($_POST['searchphone']) && !isset($_POST['searchname'])){ ?>
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