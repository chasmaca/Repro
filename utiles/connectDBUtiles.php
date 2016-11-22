<?php

$mysqlCon = new mysqli("localhost:3306", "root", "", "229564reproenea");

//$mysqlCon = new mysqli("229564reproenea.mysql.eneasp.com", "229564-jmadrazo", "Chasmaca2015!" , "229564reproenea");

// Check connection
if (!$mysqlCon) {
	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

?>