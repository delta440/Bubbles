<html><head><title>Add Customer</title></head></html>

<?php
if(isset($_POST['submit2']) || isset($_POST['submit3'])){
include('sqlconnect.php'); 
mysql_query("USE bubbles");
$PhoneNumber = $_POST['phonenumber'];
$Type = $_POST['type'];
$CustomerID = $_SESSION['customerid'];
$query ="INSERT INTO PhoneNumbers(PhoneNumber, Type, CustomerID) 
		VALUES('$PhoneNumber', '$Type', '$CustomerID')";
mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
}
?>

<?php
if(isset($_POST['submit1'])){ 
include('sqlconnect.php'); 
$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
mysql_query("USE bubbles");
$query ="INSERT INTO Customer(FirstName, LastName) 
		VALUES('$FirstName', '$LastName')";
mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
$result = mysql_query("SELECT LAST_INSERT_ID()");
$row = mysql_fetch_array($result);
$_SESSION['customerid'] = $row[0];
}
?>

<?php if(!isset($_POST['submit1']) && !isset($_POST['submit2'])) { ?>
<html><body>
<form  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
FirstName: <input name = "firstname" type = "text"/><br />
LastName: <input name = "lastname" type = "text"/><br />
<input name = "submit1" type = "submit" value = "Next"/><br />
</form>
</body></html>
<?php } ?>

<?php if(isset($_POST['submit1']) || isset($_POST['submit2'])){?>
<html><body>
<form  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
PhoneNumber: <input name ="phonenumber" type = "number"/><br />
<select name = "type">
<option>Home</option>
<option>Work</option>
<option>Cell</option>
</select>
<input Name = "submit2" type = "submit" value = "Add Another Number"/><br />
<input Name = "submit3" type = "submit" value = "Done"/><br />
</form>
</body></html>
<?php }?>

<html><body>
<form action="menu.php">
<input type = "submit" value = "Back to menu"/>
</form>
</body></html>