<?php
include '../utiles/connectDBUtiles.php';
include '../utiles/phpmailer/class.phpmailer.php';
include '../dao/select/autorizador.php';
include 'generaInformeDetalladoCierre.php';

$email = new PHPMailer();
$email->From      = 'apps@eneasp.com';
$email->FromName  = 'Departamento de Reprografia';
$email->Subject   = 'Informe de cierre de Mes';

//$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

//$email->AddAttachment( $file_to_attach , 'NameOfFile.pdf' );


	$todosValidadores = recuperaTodosValidadores($mysqlCon);
	
	while ($fila = mysqli_fetch_assoc($todosValidadores)) {
		
		$fila["AUTORIZADOR_ID"]; 
		$nombre = strtolower(utf8_encode($fila["AUTORIZADOR_NOMBRE"]));
		$apellido = strtolower(utf8_encode($fila["AUTORIZADOR_APELLIDOS"]));
		
		$bodytext = "<p>Hola ". ucfirst(utf8_encode($nombre)) . " " . ucfirst(utf8_encode($apellido)). "</p>";
		$bodytext .= "<p>Desde el departamento de reprografia se adjunta el informe de cierre de mes de sus departamentos, con el coste de todas las copias hechas en el departamento de reprografia, como en las impresoras y maquinas asignadas a su departamento</p>";
		$bodytext .= "<p>Saludos</p>";
		

		// we can use file_get_contents to fetch binary data from a remote location
		//$url = 'http://mywebsite/webservices/report/sales_invoice.php?company=development&sale_id=2';
		$binary_content = file_get_contents(generaDetalladoCierreValidador());
		
		// You should perform a check to see if the content
		// was actually fetched. Use the === (strict) operator to
		// check $binary_content for false.
		if ($binary_content) {
			throw new Exception("Could not fetch remote content from: '$binary_content'");
		}
		
		// $mail must have been created
		$email->AddStringAttachment($binary_content, "Cierre del mes.pdf", $encoding = 'base64', $type = 'application/vnd.ms-excel');
		
		// continue building your mail object...
		
		
		$email->Body      = $bodytext;
		$email->AddAddress( 'chasmaca@gmail.com' );

		$email->Send();

	}
	mysqli_free_result($todosValidadores);


exit;

?>