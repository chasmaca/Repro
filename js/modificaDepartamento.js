function cargaValoresDpto(){
	if (document.getElementById('departamento').value != 0){
		document.forms[0].action="cargaDepartamentos.php";
		document.forms[0].submit();
	}
}

function validaFormulario(){
	
	var ok = 0;
	
	if (document.getElementById('nombreDepartamento').value == ""){
		alert ("Debe rellenar el departamento");
		ok = 1;
	}
	
	if (document.getElementById('CeCo').value == ""){
		alert ("Debe rellenar el CeCo");
		ok = 1;
	}
//	
//	if (document.getElementById('treintabarra').value == "30/"){
//		alert ("Debe rellenar el Código 30/");
//		ok = 1;
//	}

	if (ok == 0){
		document.forms[0].submit();
	}
		//
}

function cargaValoresSubDpto(){
	if (document.getElementById('departamento').value != 0){
		document.forms[0].action="modificaSubDepartamento.php";
		document.forms[0].submit();
	}
}

function cargaValoresSubDptoBorrado(){
	if (document.getElementById('departamento').value != 0){
		document.forms[0].action="borraSubDepartamento.php";
		document.forms[0].submit();
	}
}

function cargaValoresForm(){
	if (document.getElementById('departamento').value != 0 || document.getElementById('subdepartamento').value != 0){
		cadena = document.getElementById('arrayValores').value;
		if (cadena.indexOf("|") != -1){
			cadenaPartida = cadena.split("|");
			for(var x=0; x< cadenaPartida.length; x++){
				cadenaUnica = cadenaPartida[x].split(";");
				if (document.getElementById('subdepartamento').value == cadenaUnica[1]){
					document.getElementById("nombreSubDepartamento").value = cadenaUnica[2];
					document.getElementById("treintabarra").value = cadenaUnica[3];
				}
			}
		}else{
			cadenaUnica = cadena.split(";");
			document.getElementById("nombreSubDepartamento").value = cadenaUnica[2];
			document.getElementById("treintabarra").value = cadenaUnica[3];
		}
			
	}
}


function validaFormularioSub(){
	
	var ok = 0;
	

	if (document.getElementById('departamento').value == "0"){
		alert ("Debe seleccionar el Departamento");
		ok = 1;
	}

	
	if (document.getElementById('subdepartamento').value == "0"){
		alert ("Debe Seleccionar el Subdepartamento");
		ok = 1;
	}
	
	if (document.getElementById('nombreSubDepartamento').value == ""){
		alert ("Debe rellenar el Subdepartamento");
		ok = 1;
	}
	
	if (document.getElementById('treintabarra').value == ""){
		alert ("Debe rellenar el Código 30/");
		ok = 1;
	}
//	
//	if (document.getElementById('treintabarra').value == "30/"){
//		alert ("Debe rellenar el Código 30/");
//		ok = 1;
//	}

	if (ok == 0){
		document.forms[0].submit();
	}
		//
}

function validaFormularioBorrar(){
	var ok = 0;
	
	if (document.getElementById('departamento').value == "0"){
		alert ("Debe seleccionar el Departamento");
		ok = 1;
	}

	
	if (document.getElementById('subdepartamento').value == "0"){
		alert ("Debe Seleccionar el Subdepartamento");
		ok = 1;
	}
	
	if (ok == 0){
		document.forms[0].submit();
	}
}
