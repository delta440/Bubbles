<html><head><title>Edit Customer</title></head></title>

<?php if(isset($_POST['submit']) || isset($_POST['addphone'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$FirstName = $_POST['firstname'];
	$LastName = $_POST['lastname'];
	$CustomerID = $_SESSION['customerid'];
	$query = "UPDATE Customer 
			SET FirstName='$FirstName', LastName = '$LastName'
			WHERE CustomerID = '$CustomerID'";
	mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	$query = "SELECT PhoneNumberID FROM PhoneNumbers WHERE CustomerID = '$CustomerID'";
	$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	while($row = mysql_fetch_array($result)){
		$PhoneNumber = $_POST['PhoneNumber'.$row['PhoneNumberID'].''];
		$Type = $_POST['Type'.$row['PhoneNumberID'].''];
		$query = "UPDATE PhoneNumbers 
				SET  PhoneNumber = '$PhoneNumber', Type = '$Type'
				WHERE PhoneNumberID = '".$row['PhoneNumberID']."'";
		mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	}
	if(isset($_POST['addphone'])){
		$PhoneNumber = $_POST['newphone'];
		$Type = $_POST['newtype'];
		$query ="INSERT INTO PhoneNumbers(PhoneNumber, Type, CustomerID) 
		VALUES('$PhoneNumber', '$Type', '$CustomerID')";
		mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
	}
}
?>

<?php if(isset($_POST['searchphone'])){
	include('sqlconnect.php');
	mysql_query("USE bubbles");
	$PhoneNumber = $_POST['phonenumber'];
	$query1 = "SELECT CustomerID FROM PhoneNumbers WHERE PhoneNumber = '$PhoneNumber'";
	$result1 = mysql_query($query1) or die('Query"' . $query1 . '" failed' . mysql_error());
	while($row1 = mysql_fetch_array($result1)){
		$CustomerID = $row1['CustomerID'];
		$_SESSION['customerid'] = $CustomerID;
		$query = "SELECT * FROM Customer WHERE CustomerID = '$CustomerID'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		$row = mysql_fetch_array($result);
		echo "<html><body><form action=".htmlentities($_SERVER['PHP_SELF']) . ' method="post">';
		echo 'FirstName: <input name = "firstname" type = "text" value = '.$row['FirstName'].' /><br />';
		echo 'LastName: <input name = "lastname" type = "text" value = '.$row['LastName'].' /><br />';
		$query = "SELECT * FROM PhoneNumbers WHERE CustomerID = '$CustomerID'";
		$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
		while($row = mysql_fetch_array($result)){
			echo 'PhoneNumber: <input name = "PhoneNumber'.$row['PhoneNumberID'].'" type = "text" value = '.$row['PhoneNumber'].' />';
			echo 'Type: <select name = "Type'.$row['PhoneNumberID'].'" >';
			if($row['Type'] == 'Home')
			echo '<option selected>Home</option>';
			else
			echo '<option>Home</option>';
			if($row['Type'] == 'Work')
			echo '<option selected>Work</option>';
			else
			echo '<option>Work</option>';
			if($row['Type'] == 'Cell')
			echo '<option selected>Cell</option>';
			else
			echo '<option>Cell</option>';
			echo '</select><br />';
		}
		echo 'New Phone Number: <input name = "newphone" type = "text"/>';
		echo '<select name = "newtype"><option>Home</option><option>Work</option><option>Cell</option></select><br />';
		echo '<input name = "submit" type = "submit" value = "Submit"/>';
		echo '<input name = "addphone" type = "submit" value = "Add Phone Number"/><br />';
		echo '</form>';
		echo '</body></html>';
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