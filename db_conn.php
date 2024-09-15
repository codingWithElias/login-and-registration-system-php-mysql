<?php 
 $sName = "localhost";
 $uName = "root";
 $pass = "";
 $dbName = "user_system";


/**
creating database connection 
useing The PHP Data Objects (PDO)
**/

try{
	$conn = new PDO("mysql:host=$sName;dbname=$dbName", 
		             $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, 
		                PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection Failed: ". $e->getMessage();
}
