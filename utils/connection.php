<?php

include './../config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
	$pdo = new PDO($dsn, $user, $password);
$GLOBALS['conn'] = mysqli_connect($host, $user, $password, $db);
	if (!$pdo) {
		echo "Error in connection to the $db database!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
