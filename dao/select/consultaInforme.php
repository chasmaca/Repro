<?php

include ('query.php');
include ('departamentoAutorizador.php');
include ('subdepartamento.php');

function recuperaInformes($mysqlCon){

	global $generaInforme;

	$informeResult = mysqli_query($mysqlCon,$generaInforme);

	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInforme) en la BD: " . mysql_error();
		exit;
	}

	return $informeResult;
}

function recuperaInformesMesAdmin($mysqlCon, $anio, $dpto,$subdpto){

	global $generaInformeMes;

	$anioPartido = explode("/",$anio);

	$generaInformeMes = $generaInformeMes . $anioPartido[1] . " and month(s1.fecha_cierre) = " . $anioPartido[0];

	if ($dpto != 0 && $dpto != "aa")
		$generaInformeMes = $generaInformeMes . " and s1.departamento_id = " . $dpto;

		
	
	$resumentSub = "";
	if ($subdpto == "aa"){
		if ($dpto =="aa"){
			
		}else{

			$subdepartamentoList = recuperaSubXDpto($dpto);
			//	$subdpto4Usuario = cargarDptoSessionAsArray($usuario);
			for ($row = 0; $row < sizeof($subdepartamentoList); $row++){
				if ($resumentSub=="")
					$resumentSub = $subdepartamentoList[$row][1];
				else
					$resumentSub = $resumentSub . "," . $subdepartamentoList[$row][1];
			
			}
			$generaInformeMes = $generaInformeMes . " and s1.subdepartamento_id in (" . $resumentSub . ") ";
				
		}
		
	}else{

		$generaInformeMes = $generaInformeMes . " and s1.subdepartamento_id = " . $subdpto;

	}

	$generaInformeMes .= " UNION
	select
	'treintabarra' as codigo, 'ceco',
	i.departamento_id, 'Impresoras', i.periodo,
	ROUND(byn_total,2) as byn, ROUND(color_total,2) as color,
	0 as encuadernacion,
	0 as varios,
	'Impresoras' as subdepartamentos_desc
	from gastos_impresora i where i.departamento_id = " . $dpto ." and YEAR(i.periodo) = " . $anioPartido[1] . " and month(i.periodo) = " . $anioPartido[0];

	$generaInformeMes .= " UNION
	select
	'treintabarraMaq' as codigo, 'ceco',
	i.departamento_id, 'Maquinas', i.periodo,
	ROUND(byn_total,2) as byn, ROUND(color_total,2) as color,
	0 as encuadernacion,
	0 as varios,
	'Maquinas' as subdepartamentos_desc
	from gastos_maquina i where i.departamento_id = " . $dpto ." and YEAR(i.periodo) = " . $anioPartido[1] . " and month(i.periodo) = " . $anioPartido[0];

	$informeResult = mysqli_query($mysqlCon,$generaInformeMes);

	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeMes) en la BD: " . mysql_error();
		exit;
	}

	return $informeResult;
}

function recuperaInformesMes($mysqlCon, $anio, $dpto,$subdpto){

	global $generaInformeMes;
	
	$anioPartido = explode("/",$anio);
	
	$generaInformeMes = $generaInformeMes . $anioPartido[1] . " and month(s1.fecha_cierre) = " . $anioPartido[0];

	if ($dpto != 0 && $dpto != "aa")
		$generaInformeMes = $generaInformeMes . " and s1.departamento_id = " . $dpto;
	
	$resumentSub = "";
	if ($subdpto == "aa"){
	
		$subdepartamentoList = recuperaSubXDpto($dpto);

		for ($row = 0; $row < sizeof($subdepartamentoList); $row++){
			if ($resumentSub=="")
				$resumentSub = $subdepartamentoList[$row][1];
			else
				$resumentSub = $resumentSub . "," . $subdepartamentoList[$row][1];
				
		}
		
		
		$generaInformeMes = $generaInformeMes . " and s1.subdepartamento_id in (" . $resumentSub . ") ";
	
	}else{
	
		$generaInformeMes = $generaInformeMes . " and s1.subdepartamento_id = " . $subdpto;
	
	}

	$informeResult = mysqli_query($mysqlCon,$generaInformeMes);

	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeMes) en la BD: " . mysql_error();
		exit;
	}

	return $informeResult;
}

function recuperaInformesMesGestores($mysqlCon, $anio, $dpto, $subdpto){

	global $generaInformeMes;

	$anioPartido = explode("/",$anio);

	$generaInformeMes = $generaInformeMes . $anioPartido[1] . " and month(s1.fecha_cierre) = " . $anioPartido[0];

	if ($dpto != 0 && $dpto != "aa")
		$generaInformeMes = $generaInformeMes . " and s1.departamento_id = " . $dpto;

		$resumentSub = "";
		if ($subdpto == "aa"){

			

		}else{

			$generaInformeMes = $generaInformeMes . " and s1.subdepartamento_id = " . $subdpto;

		}
		
		$informeResult = mysqli_query($mysqlCon,$generaInformeMes);

		if (!$informeResult) {
			echo "No se pudo ejecutar con exito la consulta ($generaInformeMes) del metodo recuperaInformesMesGestores en la BD: " . mysql_error();
			exit;
		}

		return $informeResult;
}

function recuperaInformesGlobal($mysqlCon){

	global $generaInformeGlobal;

	$informeGlobalResult = mysqli_query($mysqlCon,$generaInformeGlobal);

	if (!$informeGlobalResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeGlobal) en la BD: " . mysql_error();
		exit;
	}

	return $informeGlobalResult;
}

function recuperaInformesGlobalMesAdmin($mysqlCon,$anio, $dpto, $subdpto){

	global $generaInformeGlobalMes, $generaInformeGlobal;

	$anioPartido = explode("/",$anio);

	$generaInformeGlobalMes = $generaInformeGlobalMes . " inner join subdepartamento sd1 on sd1.departamento_id = s1.departamento_id and sd1.subdepartamento_id = s1.subdepartamento_id where YEAR(s1.fecha_cierre) = " . $anioPartido[1] . " and month(s1.fecha_cierre) = " . $anioPartido[0];

	if ($dpto != 0 && $dpto != "aa"){
		$generaInformeGlobalMes = $generaInformeGlobalMes . " and s1.departamento_id = " . $dpto;
	}
	
	
	if ($subdpto == "aa"){

	}else{
		if ($subdpto!= 0)
			$generaInformeGlobalMes = $generaInformeGlobalMes . " and s1.subdepartamento_id = " . $subdpto;

	}

	$generaInformeGlobalMes = $generaInformeGlobalMes . " group by t1.codigo";

	$generaInformeGlobalMes .= " UNION
	select 
	'treintabarra' as codigo, 'ceco', 
	i.departamento_id, 'Impresoras', 
	ROUND(byn_total,2) as byn, ROUND(color_total,2) as color, 
	0 as encuadernacion, 
	0 as varios, 
	'Impresoras' as subdepartamentos_desc
	from gastos_impresora i where i.departamento_id = " . $dpto ." and YEAR(i.periodo) = " . $anioPartido[1] . " and month(i.periodo) = " . $anioPartido[0];
	
	$generaInformeGlobalMes .= " UNION
	select
	'treintabarraMaq' as codigo, 'ceco',
	i.departamento_id, 'Maquinas',
	ROUND(byn_total,2) as byn, ROUND(color_total,2) as color,
	0 as encuadernacion,
	0 as varios,
	'Maquinas' as subdepartamentos_desc
	from gastos_maquina i where i.departamento_id = " . $dpto ." and YEAR(i.periodo) = " . $anioPartido[1] . " and month(i.periodo) = " . $anioPartido[0];

	
	$informeGlobalResult = mysqli_query($mysqlCon,$generaInformeGlobalMes);

	if (!$informeGlobalResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeGlobalMes) en la BD: " . mysql_error();
		exit;
	}

	return $informeGlobalResult;
}

function recuperaInformesGlobalMes($mysqlCon,$anio, $dpto, $subdpto){

	global $generaInformeGlobalMes, $generaInformeGlobal;
	
	$anioPartido = explode("/",$anio);

	$generaInformeGlobalMes = $generaInformeGlobalMes . " inner join subdepartamento sd1 on d1.departamento_id = sd1.departamento_id and sd1.subdepartamento_id = s1.subdepartamento_id where YEAR(s1.fecha_cierre) = " . $anioPartido[1] . " and month(s1.fecha_cierre) = " . $anioPartido[0];
	
	if ($dpto != 0 && $dpto != "aa")
		$generaInformeGlobalMes = $generaInformeGlobalMes . " and s1.departamento_id = " . $dpto;
	
	if ($subdpto == "aa"){
		
// 			$subdpto4Usuario = cargarDptoSessionAsArray($usuario);
		
// 			$generaInformeGlobalMes = $generaInformeGlobalMes . " and s1.subdepartamento_id in (" . $dpto4Usuario . ") ";
		
	}else{
	
		$generaInformeGlobalMes = $generaInformeGlobalMes . " and s1.subdepartamento_id = " . $subdpto;
	
	}
		
	$generaInformeGlobalMes = $generaInformeGlobalMes . " group by t1.codigo";
		

	$informeGlobalResult = mysqli_query($mysqlCon,$generaInformeGlobalMes);

	if (!$informeGlobalResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeGlobalMes) en la BD: " . mysql_error();
		exit;
	}
	
	return $informeGlobalResult;
}

function recuperaInformesMesGestor($mysqlCon, $mes, $usuario){

	global $generaInformeMesGestor;

	$generaInformeMesGestor = $generaInformeMesGestor . $mes;

	$informeResult = mysqli_query($mysqlCon,$generaInformeMesGestor);

	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($generaInformeMesGestor) en la BD: " . mysql_error();
		exit;
	}

	return $informeResult;
}

function recuperaDetalleValidador($usuario){
	
	global $mysqlCon, $recuperaInformeDetalleValida;
	
	$recuperaInformeDetalleValida = $recuperaInformeDetalleValida . $usuario . ")";	
	
	$informeResult = mysqli_query($mysqlCon,$recuperaInformeDetalleValida);
	
	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($recuperaInformeDetalleValida) en la BD: " . mysql_error();
		exit;
	}
	
	return $informeResult;

}

function recuperaDetalleMesValidador($mysqlCon,$usuario,$anio,$dpto,$subdpto){

	global $mysqlCon, $recuperaInformeDetalleValida;

	$anioPartido = explode("/",$anio);

	$recuperaInformeDetalleValida .= $usuario . ")";

	if ($dpto == "aa"){

		$dpto4Usuario = cargarDptoSessionAsArray($usuario);

		$recuperaInformeDetalleValida .= " and s1.departamento_id in (" . $dpto4Usuario . ") ";

	}else{

		if ($dpto != 0){

			$recuperaInformeDetalleValida .= " and s1.departamento_id = " . $dpto;

			if ($subdpto == "aa"){

				$subdpto4Usuario = cargarSubDptoXDptoAsArray($usuario, $dpto);

				$recuperaInformeDetalleValida = $recuperaInformeDetalleValida . " and s1.subdepartamento_id in (" . $subdpto4Usuario . ") ";

			}else{

				if ($subdpto != 0){

					$recuperaInformeDetalleValida = $recuperaInformeDetalleValida . " and s1.subdepartamento_id = " . $subdpto;

				}

			}

		}

	}

	$recuperaInformeDetalleValida .= " and month(s1.fecha_validacion) = " . $anioPartido[0] . 
		" and year(s1.fecha_validacion) = " . $anioPartido[1];

	$informeResult = mysqli_query($mysqlCon,$recuperaInformeDetalleValida);

	if (!$informeResult) {

		echo "No se pudo ejecutar con exito la consulta ($recuperaInformeDetalleValida) en la BD: " . mysql_error();

		exit;

	}

	return $informeResult;

}


function recuperaGlobalValidador($usuario){

	global $mysqlCon, $recuperaInformeGlobalValida;

	$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . $usuario . ") group by de1.ceco";

	$informeResult = mysqli_query($mysqlCon,$recuperaInformeGlobalValida);

	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($recuperaInformeGlobalValida) en la BD: " . mysql_error();
		exit;
	}

	return $informeResult;

}


function recuperaGlobalMesValidador($usuario,$anio,$dpto,$subdpto){

	global $mysqlCon, $recuperaInformeGlobalValida;
	
	$anioPartido = explode("/",$anio);
	
	$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . $usuario . ")";
	
	
	if ($dpto == "aa"){
	
		$dpto4Usuario = cargarDptoSessionAsArray($usuario);
		
		$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . " and s1.departamento_id in (" . $dpto4Usuario . ") ";
	
	}else{
	
		if ($dpto!=0){
			
			$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . " and s1.departamento_id = " . $dpto;
		
			if ($subdpto == "aa"){
			
				$subdpto4Usuario = cargarSubDptoXDptoAsArray($usuario, $dpto);
				
				$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . " and s1.subdepartamento_id in (" . $subdpto4Usuario . ") ";
			
			}else{
				if ($subdpto != 0){
						
					$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . " and s1.subdepartamento_id = " . $subdpto;
			
				}
			}
			
		}
		
	}

	

	$recuperaInformeGlobalValida = $recuperaInformeGlobalValida . " and month(s1.fecha_validacion) = " . $anioPartido[0] .
	" and year(s1.fecha_validacion) = " . $anioPartido[1] . " group by de1.ceco";

	
	$informeResult = mysqli_query($mysqlCon,$recuperaInformeGlobalValida);
	
	if (!$informeResult) {
		echo "No se pudo ejecutar con exito la consulta ($recuperaInformeGlobalValida) en la BD: " . mysql_error();
		exit;
	}
	
	return $informeResult;
}
?>