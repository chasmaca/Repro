<?php
session_start();

include ('query.php');


$autorizadorId = $_SESSION["userId_session"]; 
$solicitudPorValidador = $solicitudPorValidadorQuery . $autorizadorId;
$solicitudResult = mysqli_query($mysqlCon,$solicitudPorValidador);

if (!$solicitudResult) {
	echo "No se pudo ejecutar con exito la consulta ($solicitudPorValidadorQuery) en la BD: " . mysql_error();
	exit;
}

if (mysqli_num_rows($solicitudResult) == 0) {
	echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
	//exit;
}


/**
 * Controlamos los trabajos que deben realizar en la imprenta.
 * Status_id = 2
 * @var unknown
 */
$plantillaResult = mysqli_query($mysqlCon,$solicitudPorRealizarQuery);

if (!$plantillaResult) {
	echo "No se pudo ejecutar con exito la consulta ($solicitudPorRealizarQuery) en la BD: " . mysql_error();
	//exit;
}

?>
