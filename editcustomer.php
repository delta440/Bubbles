<html><head><title>Edit Customer</title></head></title>

<?php if(isset($_POST['searchphone'])){
include('sqlconnect.php');
mysql_query("USE bubbles");
$PhoneNumber = $_POST['phonenumber'];
$query = "SELECT CustomerID FROM PhoneNumbers WHERE PhoneNumber = '$PhoneNumber'";
$result = mysql_query($query) or die('Query"' . $query . '" failed' . mysql_error());
$row = mysql_fetch_array($result);
$CustomerID = $row['CustomerID'];

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