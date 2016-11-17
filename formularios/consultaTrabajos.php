<?php
$path  = "../utiles/connectDBUtiles.php";
$pathMenu = "../utiles/menuhor.php";
$pathQuery = "../dao/select/solicitudAdmin.php";
$pathPeriodo = "../dao/select/periodo.php";
$pathDepartamento = "../dao/select/departamentoAutorizador.php";
$pathCabecera = "../utiles/cabecera_formulario.php";
$pathAnalitica = "../utiles/analyticstracking.php";

include_once($path);
include_once($pathQuery);
include_once($pathPeriodo);
include_once($pathDepartamento);

$resultDepartamento = cargarTodosDepartamentos();

?>

<!doctype html>
<html lang=''>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/estilosListados.css">
	<script src="../js/consultaPorFecha.js" type="text/javascript" ></script>
	<link rel="stylesheet" type="text/css" href="../js/filtergrid.css" media="screen" />
	<script type="text/javascript" src="../js/tablefilter.js"></script>
	<link rel="stylesheet" href="../css/styles.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
      if ($.browser.msie && $.browser.version.substr(0,1)<7)
      {
		$('li').has('ul').mouseover(function(){
			$(this).children('ul').show();
			}).mouseout(function(){
			$(this).children('ul').hide();
			})
      }
    });       
</script>

	<style>
		#cuerpo {
			position: absolute;
		    left: 10px;
		    top: 25%;
		    color: white;
		        width: 90%;
			}

		.ui-datepicker-calendar {
		    display: none;
		 }
	</style>
	<title>Consulta de Trabajos</title>
</head>
<body>
<?php
	include_once($pathAnalitica);
	include_once($pathCabecera);
?>
<br>
<?php 
	include_once($pathMenu);
	

	if( isset($_POST['anioParam']) && isset($_POST['depParametro']) ){
		$anio = htmlspecialchars($_POST["periodo"]);
		$dpto = htmlspecialchars($_POST["depParametro"]);
		$recuperaSolicitud = recuperaTrabajosMes($mysqlCon,$anio,$dpto);
	}else{
		$anio = 0;
		$dpto = 0;
		$recuperaSolicitud = recuperaTrabajos($mysqlCon);
	}

?>
	<!-- div id='cssformulario' class='cssformulario'-->
	<div id="cuerpo" style="width: 98%;">
		<form id="consultaSolicitud" name="consultaSolicitud" method="POST" action="" style="width: 100%;">
			<h2>Consulta Trabajos</h2>
			<input type="hidden" value="" name="anioParam" id="anioParam"  value="<?php echo $anio;?>">
			<input type="hidden" name="depParametro" id="depParametro" value="<?php echo $dpto;?>">
			<div id="filtro">
			Seleccione el A&ntilde;o:
			<select name="periodo" id="periodo">
				<option value="0">Seleccione el periodo contable</option>
<?php
					if ($periodoResult != null){
					while ($fila = mysqli_fetch_assoc($periodoResult)) {
?>
						<option value='<?php echo $fila["mes_alta"] . "/" . $fila["anio_alta"]; ?>'
<?php 
						if ($fila["mes_alta"] . "/" . $fila["anio_alta"] == $anio){
?>							
							selected
<?php 
						}
?>
						><?php echo $fila["mes_alta"] . "/" . $fila["anio_alta"]; ?></option>
<?php 				
					}
					mysqli_free_result($periodoResult);
				}
?>
			</select>
				 <br/> <br/>
				 <label for="email">Seleccione el Departamento*:</label>
				 <select name="departamento" id="departamento">
				 <option value="0">Seleccione el Departamento</option>
<?php
		
				if ($resultDepartamento != null){
					while ($fila = mysqli_fetch_assoc($resultDepartamento)) {
?>
						<option value='<?php echo $fila["DEPARTAMENTO_ID"]; ?>'
<?php 
							if ($fila["DEPARTAMENTO_ID"] == $dpto){
?>						

								selected
<?php 
							}
?>						
						><?php echo $fila["DEPARTAMENTOS_DESC"]; ?></option>
<?php 				
					}
					mysqli_free_result($departamentoResult);
				}
?>
				 </select>
				 <br><br>
				 <input type="button" name="filtrar" id="filtrar" value="Filtrar" onclick="javascript:filtrarConsultaAdmin()" style="float: left;"/>
				 <br><br>
				 
			</div>
	
			<div id="resultado">

				<table border="1" id="tablaInforme" style="table-layout: fixed;">
					<thead>
						<tr>
							<td>Id de Solicitud</td>
							<td>Departamento</td>
							<td>Subdepartamento</td>
							<td>Nombre solicitante</td>
							
							<td>Email solicitante</td>
							<td>Autorizador</td>
							<td>Descripcion</td>
							<td>Estado</td>
							<td>Fecha de Alta</td>
							<td>Fecha de Cierre</td>
							<td>Operaciones</td>
						</tr>
					</thead>
<?php 
					while ($fila = mysqli_fetch_assoc($recuperaSolicitud)) {
?>
					<tbody>
						<tr>
							<td id="solId"><?php echo $fila['solicitud_id'];?></td>
							<td ><?php echo $fila['departamentos_desc'];?></td>
							<td ><?php echo $fila['subdepartamento_desc'];?></td>
							<td ><?php echo $fila['nombre_solicitante'] . " " .$fila['apellidos_solicitante'];?></td>
							<td ><?php echo $fila['email_solicitante'];?></td>
							<td ><?php echo $fila['nombre'];?> <?php echo $fila['apellido'];?></td>
							<td ><?php echo $fila['descripcion_solicitante'];?></td>
							<td ><?php echo $fila['status_desc'];?></td>
							<td ><?php echo $fila['fecha_alta'];?></td>
							<td ><?php echo $fila['fecha_cierre'];?></td>
							<td >
<?php 
							if ($fila['status_id'] == 6){
?>
								<a href='reabrirSolicitud.php?solicitudId=<?php echo $fila["solicitud_id"]; ?>' style="color:white;">Reabrir</a>
<?php 
							}
?>
							</td>
						</tr>
						</tbody>
<?php 
					}
					mysqli_free_result($recuperaSolicitud);
?>
				</table>
<script type="text/javascript"> 
//<![CDATA[ 
    var tf1 = setFilterGrid("tablaInforme"); 
//]]> 
</script> 
			</div>
		</form>
	</div>
</body>