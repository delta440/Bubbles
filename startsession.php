<html><body>
<?php
session_start();
$_SESSION['UserName'] = $_POST['username'];
$_SESSION['Password'] = $_POST['password'];
header("Location:Menu.php");
?>
</body></html>