<?php

$pathDB = "../../utiles/connectDBUtiles.php";
$pathInsert = "borrado.php";

include_once($pathDB);
include_once($pathInsert);

$departamento = $_GET["departamentoId"];

global $mysqlCon,$borradoDepartamento;

$jsondata = array();
$jsondata["data"] = array();

if ($stmt = $mysqlCon->prepare($borradoDepartamento)) {
	$stmt->bind_param('i',$departamento);
	$stmt->execute();
	$jsondata["success"] = true;
} else {
	/*Llegamos aqui con error, asociamos false para identificarlo en el js*/
	$jsondata["success"] = false;
	die("Errormessage: ". $mysqlCon->error);
}

$stmt->close();

/*Devolvemos el JSON con los datos de la consulta*/
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata, JSON_FORCE_OBJECT);

?>