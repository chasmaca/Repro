<?php
$pathInsert = "../insert/inserciones.php";
$pathDB = "../../utiles/connectDBUtiles.php";
$pathUpdate = "updates.php";

include_once($pathDB);
include_once($pathInsert);
include_once($pathUpdate);

$modelo = htmlspecialchars($_POST["modelo"]);
$edificio = htmlspecialchars($_POST["edificio"]);
$ubicacion = htmlspecialchars($_POST["ubicacion"]);
$fecha = htmlspecialchars($_POST["fecha"]);
$serie = htmlspecialchars($_POST["serie"]);
$maquina = htmlspecialchars($_POST["maquina"]);
$id= htmlspecialchars($_POST["imprParam"]);

global $sentenciaUpdateImpresoras,$mysqlCon;

if ($stmt = $mysqlCon->prepare($sentenciaUpdateImpresoras)) {
	
	$stmt->bind_param('sssssii',$modelo,$edificio,$ubicacion,$fecha,$serie,$maquina,$id);

	if (!$stmt->execute()) {
		echo "Falló la ejecución: (" . $sentenciaUpdateImpresoras->errno . ") " . $sentenciaUpdateImpresoras->error;
		header("Location: ../../formularios/confirmacion.php?mensaje=22");
	}
	$stmt->close();

	header("Location: ../../formularios/confirmacion.php?mensaje=21");
	exit;

} else {
	header("Location: ../../formularios/confirmacion.php?mensaje=22");
	die("Errormessage: ". $mysqlCon->error);
}


?>