<?php

if(isset($_POST['selection'])){
	session_start();
	switch($_POST['selection']){
	case "Setup Database":
		header("Location:installdatabase.php");
		break;
	case "Logout":
		session_destroy();
		echo "Successfully Logged Out";
		break;
	case "Add Customer":
		header('Location:addcustomer.php');
		break;
	case "Edit Customer":
		header('Location:editcustomer.php');
		break;
	case "Add Dog":
		header('Location:adddog.php');
		break;
	case "Edit Dog":
		header('Location:editdog.php');
		break;
	case "Book Dog":
		header('Location:bookdog.php');
		break;
	case "View/Edit Day":
		header('Location:vieweditday.php');
		break;
	default:
		echo "has not been implemented";
		break;
	}
}
?>
<html><body>
<h3>Edit Customers:</h3>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post">
<select name = "selection">
<option>Add Customer</option>
<option>Edit Customer</option>
</select>
<input type="submit" value="Submit"/>
</form>

<h3>Edit Dogs:</h3>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post">
<select name = "selection">
<option>Add Dog</option>
<option>Edit Dog</option>
</select>
<input type="submit" value="Submit"/>
</form>

<h3>Edit Schedule:</h3>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post">
<select name = "selection">
<option>Book Dog</option>
<option>View/Edit Day</option>
</select>
<input type="submit" value="Submit"/>
</form>

<h3>Administration:</h3>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post">
<select name = "selection">
<option>Setup Database</option>
<option>Logout</option>
</select>
<input type="submit" value="Submit"/>
</form>
</body></html>