<?php
#connect
include('sqlconnect.php');
#create database
$result = mysql_query("CREATE DATABASE jonesauto");
if(!$result)
echo "Database not created " . mysql_error();
else
echo "Database created";
#select Database
mysql_query("USE jonesauto");
#create tables
mysql_query("
	CREATE TABLE IF NOT EXISTS Customer(
	PhoneNumber int(11),
	Gender varchar(6),
	FirstName varchar(50),
	LastName varchar(50),
	City varchar(50),
	State varchar(50),
	Zip varchar(50),
	TaxPayerID int(9) NOT NULL,
	PRIMARY KEY (TaxPayerID))");
echo mysql_error();

mysql_query("
	CREATE TABLE IF NOT EXISTS EmploymentHistory(
	Employer varchar(50),
	Title varchar(50),
	SupervisorFirstName varchar(50),
	SupervisorLastName varchar(50),
	PhoneNumber int(11),
	City varchar(50),
	State varchar(50),
	Zip varchar(50),
	EmploymentHistoryID int NOT NULL AUTO_INCREMENT,
	TaxPayerID int(9) NOT NULL,
	PRIMARY KEY(EmploymentHistoryID),
	FOREIGN KEY(TaxPayerID) REFERENCES Customer(TaxPayerID))");
echo mysql_error();


mysql_query("
	CREATE TABLE IF NOT EXISTS Vehicle(
	VIN int(10) NOT NULL,
	Make varchar(50),
	Model varchar(50),
	Color varchar(20),
	OnLot bit,
	Miles int(7),
	InteriorColor varchar(20),
	BookPrice int(9),
	CarCondition text,
	PRIMARY KEY (VIN))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS Employee(
	EmployeeID int NOT NULL AUTO_INCREMENT,
	PhoneNumber int(11),
	FirstName varchar(50),
	LastName varchar(50),
	PRIMARY KEY(EmployeeID))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS Repaired(
	EstimatedCost int(7),
	ActualCost int(7),
	Problem text,
	RepairID int NOT NULL AUTO_INCREMENT,
	VIN int(10) NOT NULL,
	PRIMARY KEY(RepairID),
	FOREIGN KEY(VIN) REFERENCES Vehicle(VIN))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS Sold(
	DateOfSale date,
	TotalDue int(7),
	DownPayment int(7),
	FinancedAmount int(7),
	Commission int(7),
	Cosigner varchar(50),
	SaleID int NOT NULL AUTO_INCREMENT,
	VIN int(10) NOT NULL,
	TaxPayerID int(9) NOT NULL,
	EmployeeID int NOT NULL,
	PRIMARY KEY(SaleID),
	FOREIGN KEY(VIN) REFERENCES Vehicle(VIN),
	FOREIGN KEY(TaxPayerID) REFERENCES Customer(TaxpayerID),
	FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID))");
echo mysql_error();	

mysql_query("
	CREATE TABLE IF NOT EXISTS PurchasedForDealership(
	DateOfPurchase date,
	CityOfPurchase varchar(50),
	StateOfPurchase varchar(50),
	ZipOfPurchase varchar(50),
	Auction varchar(3),
	TaxID int(9),
	Seller varchar(50),
	PurchaseID int NOT NULL AUTO_INCREMENT,
	VIN int(10) NOT NULL,
	PRIMARY KEY(PurchaseID),
	FOREIGN KEY(VIN) REFERENCES Vehicle(VIN))");
echo mysql_error();

mysql_query("
	CREATE TABLE IF NOT EXISTS Payments(
	Due date,
	PaymentDate date,
	PaidDate date,
	Amount int(7),
	BankAccount int(15),
	PaymentID int NOT NULL AUTO_INCREMENT,
	VIN int(10) NOT NULL,
	TaxPayerID int(9) NOT NULL,
	PRIMARY KEY(PaymentID),
	FOREIGN KEY(VIN) REFERENCES Vehicle(VIN),
	FOREIGN KEY(TaxPayerID) REFERENCES Customer(TaxPayerID))");	
echo mysql_error();

?>
<html><body>
<form action="menu.php">
<input type = "submit" value = "Back to menu"/>
</form>
</body></html>












