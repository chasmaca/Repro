<?php
session_start();

$pathDB  = "../../utiles/connectDBUtiles.php";

$pathQuery = "../select/query.php";
$pathCorreo = "../select/autorizador.php";


include_once($pathDB);
include_once($pathQuery);
include_once($pathCorreo);

$accion = 0;

$comentario = "";


if ($_GET['operacion'] == "A"){
	$queryActualizaQuery = $updateSolicitudQuery . " status_id = 2, fecha_validacion = now() where solicitud_id = " . $_GET['solicitudId'];
	$accion = 1;
}
	
if ($_GET['operacion'] == "D"){
	$comentario = $_GET['razonRechazo'];
	$queryActualizaQuery = $updateSolicitudQuery . " status_id = 3, fecha_validacion = now(), comentario = '" . $comentario ."' where solicitud_id = " . $_GET['solicitudId'];
	$accion = 2;	
}


mysqli_query($mysqlCon,$queryActualizaQuery);

$my_error = mysqli_error($mysqlCon);

if(!empty($my_error)) {
	$error = "Ha habido un error al insertar los valores. $my_error ";
} else {
	$error = "Los datos han sido introducidos satisfactoriamente. ";
	
	/***
	 * Envio de correo
	 */
	
	$idSolicitud = $_GET['solicitudId'];
	$emailAuth = recuperaCorreo($idSolicitud);
	envioMail($emailAuth,$idSolicitud,$comentario);
	
}


function envioMail($email,$idSolicitud,$comentario){
	// destinatario
	$para  = $email;
	global $nombre, $accion;

	ini_set("sendmail_from", "apps@eneasp.com");

	// t�tulo
	$titulo = 'Su petici�n de Reprograf�a ha sido Validada.';

	
	$mensaje = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
	
	$mensaje .= "<html>";
	$mensaje .= '<body>';
	$mensaje .= '<div style="width:100%;height:85%;background-color:lightgray;">';
	$mensaje .= '<header style="display:block;">';
	$mensaje .= '<div id="logo" style="display:inline-block;">';
	$mensaje .= '<div id="logo_text">';
	$mensaje .= '<div id="logo-enea" style="display:inline;">';
	$mensaje .= '<a href="http://www.eneasp.com/Repro"><img src="http://www.eneasp.com/Repro/images/logo_enea.gif" alt="Eneasp Reprograf�a" width="87" height="87"></a>';
	$mensaje .= '</div>';
	$mensaje .= '<div id="logo-slogan" style="display: inline;font-size: 18px;font-weight: bold;">Soluciones a Empresarios</div>';
	$mensaje .= '</div>';
	$mensaje .= '</div>';
	$mensaje .= '</header>';
	$mensaje .= '<br><br>';
	$mensaje .= '<p>Buenos d�as:</p>';
	if ($accion == 1){
		$mensaje .= "<p>Su solicitud ha sido autorizada, con el siguiente n�mero de parte le podr�n realizar sus encargos en Reprograf�a.<p>";
		$mensaje .= "<p><h3><b>". $idSolicitud ."</b></h3></p>";
		$mensaje .= "<p>Muchas Gracias.</p>";
	}
	if ($accion == 2){
		$mensaje .= "<p>Su solicitud ha sido rechazada por su autorizador con la siguiente raz�n.</p>";
		$mensaje .= "<p>" . $comentario . "</p>";
		$mensaje .= "<p>P�ngase en contacto con su autorizador para conocer mas detalles.</p>";
		$mensaje .= "<p>Muchas Gracias.</p>";
	}
	$mensaje .= '<br/>';
	$mensaje .= '<p>Si desea acceder a la aplicaci�n pulse <a href="http://www.eneasp.com/Repro">aqui</a>.';
	$mensaje .= '</div>';
	$mensaje .= '</body>';
	$mensaje .= '</html>';
	
	
	$headers = "From: apps@eneasp.com" . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Enviarlo
	$mensajeValida = "";
	if (mail($para, $titulo, $mensaje, $headers))
		$mensajeValida = "Mail ok";
	else
		echo "Fallo el envio de correo";
}


header("Location: ../../formularios/homeValidador.php");
exit;

?>