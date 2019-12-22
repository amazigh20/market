<?php 
session_start();
$ip = "localhost";
$dbname = "market";
$dbuser = "root";
$dbpassword = "root";

try {
    $con = new PDO("mysql:host={$ip};dbname={$dbname}", $dbuser, $dbpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
	echo $e->getMessage();
}
?>