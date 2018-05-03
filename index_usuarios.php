<?php
$pathCabecera = "utiles/cabecera_login.php";
$pathAnalitica = "utiles/analyticstracking.php";
?>
<html>
	<head>
		<title>Reprografia</title>
		<link rel="stylesheet" href="css/estilos.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="js/index_usuarios.js" type="text/javascript" ></script>
	</head>
	<body>
<?php
	include_once($pathAnalitica);

	$error = "";
	if( isset($_GET['error']) ){
		$error = htmlspecialchars($_GET["error"]);
		
	}
	include_once($pathCabecera);
?>
		<form name="login" action="formularios/homeRedireccion.php" method="post">
		  <h1>Acceso Reprograf&iacute;a</h1>
		  <div class="inset">
		  <div class="error" id="error">
<?php 
		  	if ($error != ""){
?>
		  		<label for="password" style="color:red;">Usuario y/o Contrase&ntilde;a incorrecta.</label>
<?php 
		  	}
?>
		  </div>
		  <p>
		    <label for="email">EMAIL ADDRESS</label>
		    <input type="text" name="usuario" id="usuario">
		  </p>
		  <p>
		    <label for="password">PASSWORD</label>
		    <input type="password" name="pwd" id="pwd">
		  </p>
	
		  </div>
		  <p class="p-container">
		    <span><a href="formularios/myAccount/myAccount.php" style="text-decoration: none;color:#0184ff;">Olvidaste la contrase&ntilde;a?</a></span>
		    <input type="button" name="goButton" id="goButton" value="Log in">
		  </p>
		</form>
	</body>
</html>