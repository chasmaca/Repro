<?php
    $path  = "../utiles/connectDBUtiles.php";
    include($path);
    $pathMenu = "../utiles/menuhor.php";
    $pathCabecera = "../utiles/cabecera_formulario.php";
    $pathAnalitica = "../utiles/analyticstracking.php";


    
?>

<!doctype html>
<html lang=''>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/estilos.css">
<link rel="stylesheet" href="../css/styles.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../js/modificaSubDepartamento.js" type="text/javascript" ></script>
<title>Borrar SubDepartamentos</title>
</head>
<body>
<?php
include_once($pathAnalitica);
include_once($pathCabecera);
include_once($pathMenu);

?>
<div id='cssformulario' class='cssformulario'>

	<form name="borraSubDepartamento" id="borraSubDepartamento" method="post" action="../dao/insert/borrarSubDepartamento.php">
			<h2>Borrar SubDepartamento</h2>
			<div class="inset">	
			
			Seleccione el departamento a modificar:
			<select name="departamento" id="departamento">
			</select>
    		<br/><br/>
			Seleccione el subdepartamento a Borrar:
			<select name="subdepartamento" id="subdepartamento" onchange="javascript:cargaValoresForm();">
				<option value="0">Seleccione el SubDepartamento</option>
    		</select>
    		<br/><br/>
    		<span>Nombre del SubDepartamento:</span>
    		<input type="text" id="nombreSubDepartamento" name="nombreSubDepartamento" value=""/> 
    		<br/><br/>
    		<span>CeCo:</span>
    		<input type="text" id="treintabarra" name="treintabarra" value=""/> 
    		<br/><br/>
    		<input type="button" name="borraSubDpto" id="borraSubDpto" value="Borrar SubDepartamento"/>
			</div>
			</form>
		</div>
	</body>
</html>