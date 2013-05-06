<?php
#connect
include('sqlconnect.php');
#create database
$result = mysql_query("CREATE DATABASE bubbles");
if(!$result)
echo "Database not created " . mysql_error();
else
echo "Database created";
#select Database
mysql_query("USE bubbles");
#create tables
mysql_query("
	CREATE TABLE IF NOT EXISTS Customer(
	FirstName varchar(50),
	LastName varchar(50),
	CustomerID int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (CustomerID))");
echo mysql_error();

mysql_query("
	CREATE TABLE IF NOT EXISTS PhoneNumbers(
	PhoneNumber varchar(11),
	Type varchar(10),
	CustomerID int NOT NULL,
	PRIMARY KEY(PhoneNumber),
	FOREIGN KEY(CustomerID) REFERENCES Customer(CustomerID))");
echo mysql_error();

mysql_query("
	CREATE TABLE IF NOT EXISTS Dog(
	Price decimal(5,2),
	Name varchar(50),
	Breed varchar(50),
	Instructions text,
	Saturday bool,
	DogID int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (DogID))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS Owns(
	CustomerID int NOT NULL,
	DogID int Not NULL,
	OwnID int NOT NULL AUTO_INCREMENT,
	FOREIGN KEY(CustomerID) REFERENCES Customer(CustomerID),
	FOREIGN KEY(DogID) REFERENCES Dog(DogID),
	PRIMARY KEY(OwnID))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS Scheduled(
	DateOfDay date NOT NULL,
	TimeOfDay time,
	SpecialComments text,
	Holiday bool,
	DogID int NOT NULL,
	FOREIGN KEY(DogID) REFERENCES Dog(DogID),
	PRIMARY KEY(DateOfDay))");
echo mysql_error();	

?>
<html><body>
<form action="menu.php">
<input type = "submit" value = "Back to menu"/>
</form>
</body></html>












