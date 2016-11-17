function generaDetallado(){
	document.forms[0].action ="detalleAutorizador.php";
	document.forms[0].submit();
	
}

function generaGlobal(){
	document.forms[0].action = "globalAutorizador.php";
	document.forms[0].submit();
}

function volverHome(){
	document.forms[0].action = "../index.php";
	document.forms[0].submit();
}

function volverAtras(){
	document.forms[0].action = "homeValidador.php";
	document.forms[0].submit();
}

function pasaValores(){
	document.forms[0].action = "detalleAutorizador.php";
	document.forms[0].submit();
}


function actualizaTabla(obj){
	debugger;
		
	$('#listado .Operaciones').each(function()
	{
	  alert($(this).html());
	});
	
	$('#listado tr').each(function() {
	    var customerId = $(this).find(".Operaciones").html();    
	 });
	
	//enlaces
	//causa
}

function habilitaCapa(obj){
	var elemento = obj;
	
	document.getElementById("capa1").style.display = "block";
	document.getElementById("capa1").style.opacity = "0.5";
	document.getElementById("solicitudId").value=elemento;

}


function envioRechazo(){

//	alert(""../dao/update/solicitud.php?solicitudId=<?php echo $fila["solicitud_id"]; ?>&operacion=D' style="text-decoration:none;"><span style="color:black;");
	var id = document.getElementById("solicitudId").value;
	var comentarios = document.getElementById("razonRechazo").value;
	var accion = "../dao/update/solicitud.php?solicitudId=" + id + "&operacion=D&comentario="+comentarios;
	
	document.forms[0].method="get";
	document.forms[0].action=accion;
	document.forms[0].submit();
	
}
