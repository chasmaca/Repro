<?php
session_start();

$pathMenu = "../utiles/menu.php";
$pathCabecera ="../utiles/cabecera_formulario.php";
$pathinforme = "../dao/select/consultaInforme.php";
$path  = "../utiles/connectDBUtiles.php";
$pathDepartamento = "../dao/select/departamentoAutorizador.php";
$pathPeriodo = "../dao/select/periodo.php";
$pathAnalitica = "../utiles/analyticstracking.php";
$pathSubdepartamento = "../dao/select/subdepartamento.php";

include_once($path);
include_once($pathinforme);
include_once($pathDepartamento);
include_once($pathPeriodo);
include_once($pathSubdepartamento);


$usuario = $_SESSION["userId_session"];

//$resultValida = recuperaDetalleValidador($usuario);
$resultDepartamento = cargarDptoSession($usuario);

	$anio = 0;
	$dpto = 0;
	$subdpto = 0;
	$tipoInforme = 0;
	$resultValida = null;
	$periodoCombo = "";
	$departamentoCombo = "";
	$recuperaInforme = null;

if( isset($_POST['anioParam']) && isset($_POST['depParametro']) && isset($_POST['informeParam']) && isset($_POST['subdptoParametro']) ){
	$anio = htmlspecialchars($_POST["anioParam"]);
	$dpto = htmlspecialchars($_POST["depParametro"]);
	$tipoInforme = htmlspecialchars($_POST["informeParam"]);
	$subdpto = htmlspecialchars($_POST["subdepartamento"]);
	
	if ($tipoInforme == 'global')
		$resultValida = recuperaGlobalMesValidador($usuario, $anio, $dpto, $subdpto);
	
	if ($tipoInforme == 'detalle')
		$resultValida = recuperaDetalleMesValidador($mysqlCon,$usuario,$anio,$dpto,$subdpto);
}else{
	$anio = 0;
	$dpto = 0;
	$subdpto = 0;
	$tipoInforme = "";
	$recuperaInforme = null;
}



if( isset($_POST['periodo']) ){
    $periodoCombo = $_POST["periodo"];
}
	
if( isset($_POST['departamento']) ){
    $departamentoCombo = $_POST["departamento"];
    if ($departamentoCombo != 0){
        $subdepartamentoList = recuperaSubXDpto($departamentoCombo);
    }
}


if (!empty($_POST["subdepartamento"])){
    $idSub = htmlspecialchars($_POST["subdepartamento"]);
}else{
    $idSub = "";
}

?>
<!doctype html>
<html lang=''>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/estilos.css">
		<script src="../js/consultaPorFecha.js" type="text/javascript" ></script>
		<script type="text/javascript" src="../js/homeValidador.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			$(function() {
				$( document ).tooltip();
			});
		</script>
		<style>
			#cuerpo {
				position: absolute;
				left:240px;
				top:50px;
				color: #FF0000;
				}
		</style>
		<title>Consulta Detallada Validadores</title>
	</head>

	<body> 
<?php
		include_once($pathAnalitica);
		include_once($pathCabecera);
?>
		<form name="detalleAutorizadorForm" method="post" action="" id="detalleAutorizadorForm">
			<h2>Informe Detalle del Autorizador</h2>
			<div class="inset">

				<input type="hidden" name="depParametro" id="depParametro" value="<?php echo $dpto;?>">
				<input type="hidden" name="anioParam" id="anioParam"  value="<?php echo $anio;?>">
				<input type="hidden" name="informeParam" id="informeParam"  value="<?php echo $tipoInforme;?>">
				<input type="hidden" name="subdptoParametro" id="subdptoParametro"  value="<?php echo $subdpto;?>">


				 <label for="email">Seleccione el Periodo*:</label>
				 <img src="../images/help.png" style="width:23px;" title="Campo obligatorio. Seleccione el periodo de la consulta." onclick="" onmouseover=""></img>
				 <select name="periodo" id="periodo">
				 <option value="0">Seleccione el periodo contable</option>
<?php
				if ($periodoResult != null){
					while ($fila = mysqli_fetch_assoc($periodoResult)) {
?>
						<option value='<?php echo $fila["mes_alta"] . "/" . $fila["anio_alta"]; ?>'
<?php 
						if ($fila["mes_alta"] . "/" . $fila["anio_alta"] == $periodoCombo){
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
				 <img src="../images/help.png" style="width:23px;" title="Campo obligatorio.&#10;
																		  Seleccione el Departamento de la consulta.
																		  Si desea consultar todos sus departamentos asociados, marque Todos los Departamentos." onclick="" onmouseover=""></img>				 
				<select name="departamento" id="departamento" onchange="javascript:pasaValores();">
					<option value="0">--Seleccione el Departamento--</option>
					<option value="aa"
	<?php 				
					if ($departamentoCombo == "aa"){
?>						

								selected
<?php 
							}
?>		
					
					
					
					>--Todos los Departamentos--</option>
<?php
		
				if ($resultDepartamento != null){
					
					while ($fila = mysqli_fetch_assoc($resultDepartamento)) {
?>
						<option value='<?php echo $fila["DEPARTAMENTO_ID"]; ?>'
<?php 
							if ($fila["DEPARTAMENTO_ID"] == $departamentoCombo){
?>						

								selected
<?php 
							}
?>						
						><?php echo $fila["DEPARTAMENTOS_DESC"]; ?></option>
<?php 				
					}
					mysqli_free_result($resultDepartamento);
				}
?>
				 </select>
				 <br><br>
				 <label for="email">Seleccione el SubDepartamento*:</label>
				 <img src="../images/help.png" style="width:23px;" 
				 		title="Campo obligatorio.&#10;Seleccione el SubDepartamento de la consulta.
						Si desea consultar todos sus Subdepartamentos asociados, marque Todos los SubDepartamentos." onmouseover=""/>
																		  				 
				<select name="subdepartamento" id="subdepartamento">
				 <option value="0">--Seleccione el SubDepartamento--</option>
				 <option value="aa">--Todos los SubDepartamentos--</option>
<?php 
                    if ($subdepartamentoList != null){
                    for ($row = 0; $row < sizeof($subdepartamentoList); $row++){
                        if ($subdepartamentoList[$row][1] != ""){
?>
							<option value="<?php echo $subdepartamentoList[$row][1]; ?>"
<?php 
					           if ($idSub == $subdepartamentoList[$row][1]){
?>
								   selected 
<?php 
                                }
?>
							> <?php echo $subdepartamentoList[$row][2];?></option>
<?php
                        }
                    }
                    }
?>
				 </select>
				 <br><br>
				 <label for="tipoInforme" style="color:white;">Seleccione el Tipo de Informe*:</label>
				 <img src="../images/help.png" style="width:23px;" title="Campo obligatorio. Seleccione el tipo de informe que desee." onclick="" onmouseover=""></img>
				  <input type="radio" name="tipoInforme" id="tipoInforme" value="global"
				  <?php 
				  	if ($tipoInforme=='global'){
				  ?> 
				  	checked
				  <?php 
					}
				  ?>
				  > Global 
				  <input type="radio" name="tipoInforme" id="tipoInforme" value="detalle" 
				  <?php 
				  	if ($tipoInforme=='detalle'){
				  ?> 
				  	checked
				  <?php 
					}
				  ?>
				  > Detallado 
				  <br><br>
				 <input type="button" name="filtrar" id="filtrar" value="Filtrar" onclick="javascript:filtrarInforme();" style="float: left;"/>
				 <br><br>
				 <table style="width:99%;">
				 	<thead>
				 		<tr>
							<th>ESB</th>
							<th>CODIGO</th>
							<th>DEPARTAMENTO</th>
							
<?php 
							if ($tipoInforme != 'global'){
?>
								<th>FECHA DE CIERRE</th>
								<th>NOMBRE SOLICITANTE</th>
								<th>DESCRIPCION</th>
<?php 
							}
?>
								
							<th>BLANCO Y NEGRO</th>
							<th>COLOR</th>
							<th>ENCUADERNACIONES</th>
							<th>VARIOS</th>
							<th>TOTAL</th>
						</tr>
					</thead>
					<tbody>
<?php
					if ($resultValida!= null){
						$totalFinal = 0;
						while ($fila = mysqli_fetch_assoc($resultValida)) {
							$total = $fila['byn'] + $fila['color'] + $fila['encuadernacion'] + $fila['varios'];
							$totalFinal = $totalFinal + $total;
?>
							<tr>
								<td><?php echo $fila["esb"];?> </td>
								<td><?php echo $fila["codigo"];?> </td>
								<td><?php echo $fila["departamento"];?> </td>
								
<?php 
							if ($tipoInforme != 'global'){
?>
								<td><?php echo $fila["fecha"];?> </td>
								<td><?php echo $fila["nombre"] . " " . $fila["apellidos"];?> </td>
								<td><?php echo $fila["descripcion"];?> </td>
<?php 
							}
?>

								<td><?php echo round($fila["byn"],2);?> </td>
								<td><?php echo round($fila["color"],2);?> </td>
								<td><?php echo round($fila["encuadernacion"],2);?> </td>
								<td><?php echo round($fila["varios"],2);?> </td>
								<td><?php echo round($total,2); ?> </td>
							</tr>
<?php
						}
						mysqli_free_result($resultValida);
?>
						<tr>
<?php 
							if ($tipoInforme != 'global'){
?>
							<td colspan="10" style="text-align:right;"><b>Total:</b></td>
<?php 
							}else{
?>
							<td colspan="7" style="text-align:right;"><b>Total:</b></td>
<?php 
							}
?>
							<td><?php echo $totalFinal; ?> </td>
						</tr>
<?php
					}
?>
					</tbody>
				</table>
			</div>
			<input type="button" name="volver" id="volver" value="Volver Atras" onClick="javascript:volverAtras();"/>
			<input type="button" name="excel" id="excel" value="Generar Excel" onClick="javascript:mostramosExcel();"/>
		</form>
	</body>
</html>