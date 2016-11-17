<?php
$path  = "../utiles/connectDBUtiles.php";
include($path);
$pathMenu = "../utiles/menuhor.php";
$pathCabecera = "../utiles/cabecera_formulario.php";
$pathAnalitica = "../utiles/analyticstracking.php";
include ('../dao/select/departamento.php');
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
<script src="../js/modificaDepartamento.js" type="text/javascript" ></script>
<title>Borrar Departamentos</title>
</head>
<body>
<?php
include_once($pathAnalitica);
include_once($pathCabecera);
include_once($pathMenu);
?>
<div id='cssformulario' class='cssformulario'>

	<form name="borraDepartamento" id="borraDepartamento" method="post" action="../dao/insert/borrarDepartamento.php">
		<h2>Borrar Departamento</h2>
			<div class="inset">
			Seleccione el departamento a borrar:
			<select name="departamento" id="departamento">
				<option value="0">Seleccione el Departamento</option>
				<?php 
				$departamentoResult = recuperaTodosDepartamentos();
				
				while ($fila = mysqli_fetch_assoc($departamentoResult)) {
				?>
				<option value='<?php echo $fila["DEPARTAMENTO_ID"]; ?>'><?php echo $fila["DEPARTAMENTOS_DESC"]; ?></option>
				<?php 
				}
				mysqli_free_result($departamentoResult);
				?>
			</select>
			
			<br/><br/>
			<input type="submit" name="borraDpto" id="borraDpto" value="Borrar Departamento"/>
			</div>
			</form>
			
			
</div>
</body>
</html>