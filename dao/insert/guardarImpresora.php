<?php
$pathDB = "../../utiles/connectDBUtiles.php";
$pathQuery = "../select/query.php";
$pathInsert = "inserciones.php";

include_once($pathDB);
include_once($pathQuery);
include_once($pathInsert);

$modelo = htmlspecialchars($_POST["modelo"]);
$edificio = htmlspecialchars($_POST["edificio"]);
$ubicacion = htmlspecialchars($_POST["ubicacion"]);
$fecha = htmlspecialchars($_POST["fecha"]);
$serie = htmlspecialchars($_POST["serie"]);
$maquina = htmlspecialchars($_POST["maquina"]);

global $sentenciaInsertImpresoras;

if ($stmt = $mysqlCon->prepare($sentenciaInsertImpresoras)) {
	$stmt->bind_param('sssssi',$modelo,$edificio,$ubicacion,$fecha,$serie,$maquina);
	
	if (!$stmt->execute()) {
		echo "Falló la ejecución: (" . $sentenciaInsertImpresoras->errno . ") " . $sentenciaInsertImpresoras->error;
		header("Location: ../../formularios/confirmacion.php?mensaje=20");
	}
	$stmt->close();

	header("Location: ../../formularios/confirmacion.php?mensaje=19");
	exit;
	
} else {
	header("Location: ../../formularios/confirmacion.php?mensaje=20");
	die("Errormessage: ". $mysqlCon->error);
}


?>