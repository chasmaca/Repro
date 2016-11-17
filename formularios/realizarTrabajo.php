<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
session_start();


$path  = "../utiles/connectDBUtiles.php";
$pathClase = "../dao/select/trabajo.php";
$pathInsert = "../dao/insert/inserciones.php";
$pathUpdate = "../dao/update/updates.php";
$pathCabecera = "../utiles/cabecera_formulario.php";
$pathClaseModal = "../dao/select/trabajoModal.php";

include_once($path);
include_once($pathClase);
include_once($pathClaseModal);
include_once($pathInsert);
include_once($pathUpdate);

$usuarioPlantilla = $_SESSION["nombre_session"];

?>

<html>
	<head>
		<script type="text/javascript" src="../js/detalleTrabajo.js"></script>
		<link rel="stylesheet" type="text/css" href="/Repro/css/estilosTrabajo.css"> </link>
	</head>
	<body onload="javascript:calculaTotal();"> 
<?php 
include_once($pathCabecera);
//actualizaEstado($_GET['solicitudId'], $mysqlCon, 4);
actualizaEstadoUsuario($_GET['solicitudId'], $mysqlCon, 4, $usuarioPlantilla);
$departamentoSol = recuperaDepartamento($_GET['solicitudId'],$mysqlCon);
$solicitanteSol = recuperaSolicitante($_GET['solicitudId'],$mysqlCon);
$recuperaDetalleEspiral = recuperaDetalleEspiral($mysqlCon);
$recuperaDetalleEncolado = recuperaDetalleEncolado($mysqlCon);
$recuperaDetalleVarios1 = recuperaDetalleVarios1($mysqlCon);
$recuperaDetalleColor = recuperaDetalleColor($mysqlCon);
$recuperaDetalleVarios2 = recuperaDetalleVarios2($mysqlCon);
$recuperaDetalleByN = recuperaDetalleByN($mysqlCon);
$departamentoNombre = "";
$departamentoTreinta ="";
$departamentoCeco = "";
$departamentoId = "";
$subdepartamentoNombre = "";
while ($fila0 = mysqli_fetch_assoc($departamentoSol)) {
	$departamentoNombre = $fila0['DEPARTAMENTOS_DESC'];
	$subdepartamentoNombre = $fila0['SUBDEPARTAMENTO_DESC'];
	$departamentoTreinta = $fila0['TREINTABARRA'];
	$departamentoCeco = $fila0['CECO'];
	$departamentoId = $fila0['DEPARTAMENTO_ID'];
}
mysqli_free_result($departamentoSol);


$subtotalEspiral = recuperaSubtotalEspiral($mysqlCon);
$subtotalEncolado = recuperaSubtotalEncolado($mysqlCon);
$subtotalVarios1 = recuperaSubtotalVarios1($mysqlCon);
$subtotalVarios2 = recuperaSubtotalVarios2($mysqlCon);
$subtotalColor = recuperaSubtotalColor($mysqlCon);
$subtotalByN = recuperaSubtotalByN($mysqlCon);
//actualizaEstado($_GET['solicitudId'],$mysqlCon,4);

$error = "";
if( isset($_GET['error']) ){
	$error = "Debe Guardar el Trabajo antes de Cerrarlo.";
}
?>
		<form name="detalleTrabajo" id="detalleTrabajo" method="post" action="../dao/insert/guardarTrabajo.php">
			<h1>Realizar Trabajo</h1>
			<div style="display: inline; padding:10px;">
				<label for="email">Departamento:</label>
				<?php echo $departamentoNombre; ?>
			</div>
			<div style="display: inline; padding:10px;">
				<label for="email">Subdepartamento:</label>
				<?php echo $subdepartamentoNombre; ?>
			</div>
			<div style="display: inline; padding:10px;">
				<label for="email">Fecha:</label>
				<?php date_default_timezone_set("Europe/Madrid");
				echo iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y', time())); ?>
			</div>
			<div style="display: inline; padding:10px;">
				<label for="email">Proyecto/Orden:</label>
				<?php echo  $_GET['solicitudId'] . " - " . $departamentoTreinta ?>

				<input type="hidden" name="orden" id="orden" value="<?php echo  $_GET['solicitudId'] ?>"/>
				<input type="hidden" name="codigo" id="codigo" value="<?php echo $departamentoTreinta ?>"/>
			</div>
			<div style="display: inline; padding:10px;">
				<label for="email">CeCo:</label>
				<?php echo $departamentoCeco ?>
			</div>
			<div style="display: block; padding:10px;">
				<label for="email">Solicitante:</label>
				<?php echo $solicitanteSol; ?>
				<input type="hidden" name="esb" id="esb" value="<?php echo $departamentoTreinta ?>"/>
			</div>
<?php 
			if ($error != ""){
?>
			
			<div style="display: inline; padding:10px;color:red;align:center;text-align:center;">
				<h2><span><?php echo $error;?></span></h2>
			</div>
<?php 
			}
?>
		<div style="width:100%; margin: 0 auto;vertical-align:top;">
			<div class="encuadernacion" >
				<table border="1" width="100%">
					<thead>	
						<tr>
							<th colspan="4" width="100%" id="tipoId3">
								<center>Varios 1</center>
							</th>
						</tr>
						<tr>
							<th width="25%"><center>Descripcion</center></th>
							<th width="25%"><center>Cantidad</center></th>
							<th width="25%"><center>Pr. Unidad</center></th>
							<th width="25%"><center>Total</center></th>
						</tr>
					</thead>
					<tbody id="tbVarios1">
<?php 
						while ($fila3 = mysqli_fetch_assoc($recuperaDetalleVarios1)) { 
?>
						<tr>
							<td width="25%">
								<center>
									<?php echo $fila3['DESCRIPCION']; ?>
								</center>
							</td>
							<td width="25%">
								<center>
									<input type="text" name="cantidad_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>" 
										id="cantidad_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>"
										value="<?php echo $fila3['UNIDADES']; ?>" onblur="javascript:actualizaValores(this);"  
										onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
								</center>
							</td>
							<td width="25%">
								<center>
									<?php echo $fila3['PRECIO']; ?>
									<input type="hidden" name="precio_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>" 
										id="precio_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>" 
										value="<?php echo $fila3['PRECIO']; ?>" />
								</center>
							</td>
							<td width="25%">
								<center>
									<input type="text"  readonly  name="total_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>" 
										id="total_<?php echo $fila3['TIPO_ID']; ?>-<?php echo $fila3['DETALLE_ID']; ?>"
										value="<?php echo $fila3['PRECIOTOTAL']; ?>"/>
								</center>
							</td>
						</tr>
<?php 
						} 
						mysqli_free_result($recuperaDetalleVarios1);
?>
						<tr>
							<td colspan="2" width="60%"></td>
							<td width="20%">SUBTOTAL</td>
							<td width="20%">
								<center>
									<input type="text"  readonly  name="subtotalVarios1" id="subtotalVarios1" value="<?php echo $subtotalVarios1 ?>"/>
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
		<div class="encuadernacion" >
			<table border="1" width="100%">
				<thead>
				<tr>
					<th colspan="4" width="100%" id="tipoId4">
						<center>Color</center>
					</th>
				</tr>
				<tr>
					<th width="25%"><center>Descripcion</center></th>
					<th width="25%"><center>Cantidad</center></th>
					<th width="25%"><center>Pr Unidad</center></th>
					<th width="25%"><center>Total</center></th>
				</tr>
				</thead>
				<tbody id="tbColor">
				<?php while ($fila4 = mysqli_fetch_assoc($recuperaDetalleColor)) { ?>
					<tr>
						<td width="25%">
							<center>
								<?php echo $fila4['DESCRIPCION']; ?>
							</center>
						</td>
						<td width="25%">
							<center>
								<input type="text" name="cantidad_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>" 
									id="cantidad_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>"
									value="<?php echo $fila4['UNIDADES']; ?>"
									onblur="javascript:actualizaValores(this);"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
							</center>
						</td>
						<td width="25%">
							<center>
								<?php echo $fila4['PRECIO']; ?>
								<input type="hidden" name="precio_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>" 
									id="precio_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>" 
									value="<?php echo $fila4['PRECIO']; ?>" />
							</center>
						</td>
						<td width="25%">
							<center>
								<input type="text"  readonly  name="total_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>" 
									id="total_<?php echo $fila4['TIPO_ID']; ?>-<?php echo $fila4['DETALLE_ID']; ?>"
									value="<?php echo $fila4['PRECIOTOTAL']; ?>" />
							</center>
						</td>
					</tr>
				<?php 
				}
				mysqli_free_result($recuperaDetalleColor);
				?>
				<tr>
					<td colspan="2" width="60%"></td>
					<td width="20%">SUBTOTAL</td>
					<td width="20%"><center><input type="text"  readonly  name="subtotalColor" id="subtotalColor" value="<?php echo $subtotalColor ?>" /></center></td>
				</tr>
				</tbody>
			</table>
			
			<div>
					<table border="1" width="100%">
						<thead>
							<tr>
								<th colspan="4" width="100%" nowrap>
									<div id="txt1" >
										<center>Encuadernaciones</center>
									</div>
								</th>
							</tr>
							<tr id="tipoId1">
									<th><center>Espiral</center></th>
									<th><center>Cantidad</center></th>
									<th><center>Pr Unidad</center></th>
									<th><center>Total</center></th>
							</tr>
						</thead>
						<tbody id="tbEspiral">
							<?php while ($fila = mysqli_fetch_assoc($recuperaDetalleEspiral)) { ?>
								<tr>
									<td width="40%">
										<center>
											<?php echo $fila['DESCRIPCION']; ?>
										</center>
									</td>
									<td width="20%">
										<center>
											<input type="text" name="cantidad_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>" 
												id="cantidad_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>"
												value="<?php echo $fila['UNIDADES']; ?>"
												onblur="javascript:actualizaValores(this);" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
										</center>
									</td>
									<td width="20%">
										<center>
											<?php echo $fila['PRECIO']; ?>
											<input type="hidden" name="precio_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>" 
												id="precio_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>" 
												value="<?php echo $fila['PRECIO']; ?>" />
										</center>
									</td>
									<td width="20%">
										<center>
											<input type="text" readonly name="total_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>" 
												id="total_<?php echo $fila['TIPO_ID']; ?>-<?php echo $fila['DETALLE_ID']; ?>"
												value="<?php echo $fila['PRECIOTOTAL']; ?>"/>
										</center>
									</td>
								</tr>
							<?php 
							} 
							mysqli_free_result($recuperaDetalleEspiral);
							?>
							<tr>
								<td colspan="2" width="60%"></td>
								<td width="20%">SUBTOTAL</td>
								<td width="20%">
									<center>
										<input type="text" readonly name="subtotalEspiral"  id="subtotalEspiral" value="<?php echo $subtotalEspiral ?>" />
									</center>
								</td>
							</tr>
						</tbody>
					</table>
					
					<table border="1" width="100%">
						<thead>
							<tr>
								<th colspan="5" width="100%">
								<div id="txt1" >
										<center>Encolado</center>
									</div>
								</th>
							</tr>
							<tr id="tipoId2">
								<th width="40%" colspan="2"><center>Encolado</center></th>
								<th width="20%"><center>Cantidad</center></th>
								<th width="20%"><center>Pr Unidad</center></th>
								<th width="20%"><center>Total</center></th>
							</tr>
						</thead>
				<tbody id="tbEncolado">
				<?php while ($fila2 = mysqli_fetch_assoc($recuperaDetalleEncolado)) { ?>
					<tr>
						<td width="40%" colspan="2">
							<center>
								<?php echo $fila2['DESCRIPCION']; ?>
							</center>
						</td>
						<td width="20%">
							<center>
								<input type="text" name="cantidad_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>" 
									id="cantidad_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>"
									value="<?php echo $fila2['UNIDADES']; ?>" onblur="javascript:actualizaValores(this);"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
							</center>
						</td>
						<td width="20%">
							<center>
								<?php echo $fila2['PRECIO']; ?>
								<input type="hidden" name="precio_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>" 
									id="precio_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>" 
									value="<?php echo $fila2['PRECIO']; ?>" />
							</center>
						</td>
						<td width="20%">
							<center>
								<input type="text" readonly  name="total_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>" 
									id="total_<?php echo $fila2['TIPO_ID']; ?>-<?php echo $fila2['DETALLE_ID']; ?>" 
									value="<?php echo $fila2['PRECIOTOTAL']; ?>" />
							</center>
						</td>
					</tr>
				<?php 
					}
					mysqli_free_result($recuperaDetalleEncolado);
				?>
				<tr>
					<td colspan="3" width="60%"></td>
					<td width="20%">SUBTOTAL</td>
					<td width="20%">
						<center>
							<input type="text"  readonly name="subtotalEncolado" id="subtotalEncolado" value="<?php echo $subtotalEncolado ?>" />
						</center>
					</td>
				</tr>
				</tbody>
			</table>
			
			<table border="1" width="100%">
				<thead>
				
				<tr>
					<th width="100%" colspan="4">
						<center>Blanco y Negro</center>
					</th>
				</tr>
				<tr>
					<th width="25%">Descripcion</th>
					<th width="25%">Cantidad</th>
					<th width="25%">Pr. Unidad</th>
					<th width="25%">Total</th>
				</tr>
				</thead>
				<tbody id="tbByN">
				<?php while ($fila6 = mysqli_fetch_assoc($recuperaDetalleByN)) { ?>
					<tr>
						<td width="25%">
							<center>
								<?php echo $fila6['DESCRIPCION']; ?>
							</center>
						</td>
						<td width="25%">
							<center>
								<input type="text" name="cantidad_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>" 
									id="cantidad_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>"
									value="<?php echo $fila6['UNIDADES']; ?>"
									onblur="javascript:actualizaValores(this);"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
							</center>
						</td>
						<td width="25%">
							<center>
								<?php echo $fila6['PRECIO']; ?>
								<input type="hidden" name="precio_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>" 
									id="precio_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>" 
									value="<?php echo $fila6['PRECIO']; ?>" />
							</center>
						</td>
						<td width="25%">
							<center>
								<input type="text"  readonly name="total_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>" 
									id="total_<?php echo $fila6['TIPO_ID']; ?>-<?php echo $fila6['DETALLE_ID']; ?>"
									value="<?php echo $fila6['PRECIOTOTAL']; ?>" />
							</center>
						</td>
					</tr>
					<?php 
				}
				mysqli_free_result($recuperaDetalleByN);
				?>
				<tr>
					<td width="50%" colspan="2"></td>
					<td width="25%">SUBTOTAL</td>
					<td width="25%"><center><input type="text" name="subtotalByN" id="subtotalByN"  readonly value="<?php echo $subtotalByN ?>"/></center></td>
				</tr>
				</tbody>
			</table>
				</div>
			<table border="1" width="100%" id="tablaVarios2">
				<tr>
					<td width="100%" colspan="4">
						<div style="display:inline;width:90%;float:left;">
							<center>
								Varios 2
							</center>
						</div>
						<div style="display:inline;float:right;">
							<a onclick="javascript:sumaLinea();">
								<img src="../images/sumar.png" style="width:15px;height:15px;"/>
							</a>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="4" width="100%" style="background:linear-gradient(#777, #444);border-left: 1px solid #555;border-right: 1px solid #777;border-top: 1px solid #555;border-bottom: 1px solid #333;color: #fff;font-weight: bold;padding: 10px 15px; text-shadow: 0 1px 0 #000;">
						<center>
							<p>Seleccione el trabajo Varios2
							<select name="varios2" id="varios2" onchange="javascript:rellenaTabla(this);">
								<option value="0">Seleccione el Trabajo</option>
								<?php 
								$recuperaVarios2Modal = recuperaVarios2Modal($mysqlCon);
								while ($fila5 = mysqli_fetch_assoc($recuperaVarios2Modal)) {
								?>
									<option value="<?php  echo $fila5['TIPO_ID']; ?>-<?php  echo $fila5['DETALLE_ID']; ?>_<?php  echo $fila5['PRECIO']; ?>">
										<?php  echo $fila5['DESCRIPCION']; ?>
									</option>
								<?php 
								}
								mysqli_free_result($recuperaVarios2Modal);
								?>
							</select>
							</p>
						</center>
					</td>
				</tr>
				<tr>
					<th width="25%"><center>Descripcion</center></th>
					<th width="10%"><center>Cantidad</center></th>
					<th width="10%"><center>Pr. Unidad</center></th>
					<th width="20%"><center>Total</center></th>
				</tr>

				<?php 
				while ($fila7 = mysqli_fetch_assoc($recuperaDetalleVarios2)) {
					if ($fila7['UNIDADES']!=0){
				?>
						<tr>
							<td><center><?php echo $fila7['DESCRIPCION']; ?></center></td>
							<td>
								<center>
								<input type="text" name="cantidad_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>" 
									id="cantidad_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>"
									value="<?php echo $fila7['UNIDADES']; ?>"
									onblur="javascript:actualizaValores(this);"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
								</center>
							</td>
							<td>
								<center>
									<?php echo $fila7['PRECIO']; ?>
									<input type="hidden" name="precio_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>" 
										id="precio_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>" 
										value="<?php echo $fila7['PRECIO']; ?>" />
								</center>
							</td>
							<td>
								<center>
									<input type="text"  readonly name="total_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>" 
										id="total_<?php echo $fila7['TIPO_ID']; ?>-<?php echo $fila7['DETALLE_ID']; ?>"
										value="<?php echo $fila7['PRECIOTOTAL']; ?>" />
								</center>
							</td>
						</tr>
				<?php 
					}
				}
				mysqli_free_result($recuperaDetalleVarios2);
				?>
				<tr>
					<td colspan="2" width="60%"></td>
					<td width="20%">SUBTOTAL</td>
					<td width="20%">
						<center>
							<input type="text"  readonly  name="subtotalVarios2" id="subtotalVarios2" value="<?php echo $subtotalVarios2 ?>"/>
						</center>
					</td>
				</tr>
			</table>
			</div>
			</div>
			<label for="email" style="padding-left:30%"> TOTAL:</label>
			<input type="text" readonly name="total" id="total" />

			<input type="hidden" name="tablaValores1" id="tablaValores1" value="" />
			<input type="hidden" name="tablaValores2" id="tablaValores2" value="" />
			<input type="hidden" name="tablaValores3" id="tablaValores3" value="" />
			<input type="hidden" name="tablaValores4" id="tablaValores4" value="" />
			<input type="hidden" name="tablaValores5" id="tablaValores5" value="" />
			<input type="hidden" name="tablaValores6" id="tablaValores6" value="" />
			<input type="hidden" name="trabajo" id="trabajo" value='' />
			<input type="hidden" name="tablaValores7" id="tablaValores7" value="" />
			<input type="hidden" name="solicitud" id="solicitud" value='<?php echo ($_GET["solicitudId"]); ?>'/>
			<input type="hidden" name="cerrar" id="cerrar" value="0"/> 
			<input type="hidden" name="departamento" id="departamento" value='<?php echo $departamentoId; ?>' />
			<input type="hidden" name="cerramosTrabajo" id="cerramosTrabajo" value="0"/> 
			<input type="button" name="guardar" value="Guardar" onclick="javascript:guardarTrabajo();"/>
			<input type="button" name="Cerrar" value="Cerrar" onclick="javascript:closeWork();"/>
			<input type="button" name="Volver" value="Volver"  onclick="javascript:volverHome();"/>

		</form>
	</body>
</html>
<?php 
	function actualizaEstado($solicitud,$conexion,$status){
		global $sentenciaEstadoSolicitud;
		
		if ($stmt = $conexion->prepare($sentenciaEstadoSolicitud)) {
			$stmt->bind_param('ii',$status,$solicitud);
			$stmt->execute();
		} else {
			die("Errormessage: ". $conexion->error);
		}
		$stmt->close();
	}
	
	function actualizaEstadoUsuario($solicitud,$conexion,$status,$plantilla){
		global $sentenciaEstadoSolicitudPlantilla;
		
		if ($stmt = $conexion->prepare($sentenciaEstadoSolicitudPlantilla)) {
			$stmt->bind_param('isi',$status,$plantilla,$solicitud);
			$stmt->execute();
		} else {
			die("Errormessage: ". $conexion->error);
		}
		$stmt->close();
	}
?>