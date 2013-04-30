<?php
session_start();
$host = "localhost";
if(isset($_SESSION['UserName']) && isset($_SESSION['Password'])){
	$sqlconnection = mysql_pconnect("$host", $_SESSION['UserName'], $_SESSION['Password']) or die("cannot connect to sql server");
}
else
	echo "error no session username/password"
?>
