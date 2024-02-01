<?php
$servername='localhost';
$username="root";
$password="";

try
{
	$con=new PDO("mysql:host=$servername;dbname=employee_test_db",$username,$password); // employee_test_db
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//echo 'connected';
}
catch(PDOException $e)
{
	echo '<br>'.$e->getMessage();
}
	
?>