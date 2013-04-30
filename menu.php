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
	case "Add New Customer":
		include('createcustomer.php');
		break;
	case "Purchase Form":
		header('Location:purchaseform.php');
		break;
	default:
		echo "has not been implemented";
		break;
		}
}
?>
<html><body>
<h4>Please select an operation</h4>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post">
<select name = "selection">
<option>Setup Database</option>
<option>Add New Customer</option>
<option>Purchase Form</option>
<option>Logout</option>
</select>
<input type="submit" value="Submit"/>
</form>
</body></html>