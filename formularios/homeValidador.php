<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$pathDB = "../utiles/connectDBUtiles.php";
$pathClase = "../dao/select/solicitud.php";
$pathCabecera = "../utiles/cabecera_formulario.php";
$pathAnalitica = "../utiles/analyticstracking.php";

include_once($pathDB);

?>
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
		<script type="text/javascript" src="../js/homeValidador.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/estilos.css"/>
	</head>
	<body> 
	<?php 
	include_once($pathAnalitica);
	include_once($pathCabecera);
	?>
		<form name="validaSoliditudForm" method="post" action="../index.php" id="validaSoliditudForm">
			<h2>Validacion de Solicitudes</h2>
			<div class="inset">
			<table style="width: 95%" id="listado">
				<thead>
					<tr>
						<th>Id</th>
						<th>Departamento</th>
						<th>SubDepartamento</th>
						<th>Solicitante</th>
						<th>Fecha</th>
						<th>Observaciones</th>
						<th>Operaciones</th>
					</tr>
				</thead>
  				
<?php
				include ('../dao/select/solicitud.php');
				
				$contador=1;
				while ($fila = mysqli_fetch_assoc($solicitudResult)) {
				    
?>				
				<tbody>
					<tr>
						<td><?php echo $fila["solicitud_id"]; ?></td>
						<td><?php echo $fila["departamentos_desc"]; ?></td>
						<td><?php echo $fila["subdepartamentos_desc"]; ?></td>
						<td><?php echo $fila["nombre_solicitante"]; ?>&nbsp;<?php echo $fila["apellidos_solicitante"]; ?></td>
						<td nowrap><?php echo $fila["fecha_alta"]; ?></td>
						<td><?php echo $fila["descripcion_solicitante"]; ?></td>
						<td>
							<div id="enlaces<?php echo $contador;?>">
								<a href='../dao/update/solicitud.php?solicitudId=<?php echo $fila["solicitud_id"]; ?>&operacion=A' style="text-decoration:none;"><span style="color:black;">Aprobar</span></a>
								&nbsp;&nbsp;/&nbsp;&nbsp;
								<a class="request-consultation" style="cursor: pointer;cursor: hand;" rel="leanModal" name="test" onclick="javascript:habilitaCapa(<?php echo $fila["solicitud_id"]; ?>);" id="rechazo_solicitudId=<?php echo $fila["solicitud_id"]; ?>"><span style="color:black;">Rechazar</span></a>
								
							</div>
						</td>
					</tr>
<?php
                    $contador++;
				}
				mysqli_free_result($solicitudResult);
				
?>
			</tbody>
			</table>
		
			
			<div style="position: relative; top:0px; width:100%; height:100%; display:none;" id="capa1">
				<input type="hidden" id="solicitudId" name="solicitudId"/>
				<input type="hidden" id="operacion" name="operacion" value="D"/>
 				<p>Introduzca el motivo del rechazo.</p>
				<textarea rows="5" cols="15" id="razonRechazo" name="razonRechazo"></textarea>
				<a onclick="javascript:envioRechazo();" style="cursor: pointer;cursor: hand;" id="botonRechazo" class="enlaceboton"> <span>Rechazar</span></a>
			</div>
			
		
			<br/><br/>
			<input type="button" name="volver" id="volver" value="Volver" onclick="javascript:volverHome();"/> 
			<input type="button" name="informeDetallado" id="informeDetallado" value="Informes" onclick="javascript:generaDetallado();"/> 
			<br/><br/>
			</div>
		</form>
	
	</body>
</html>