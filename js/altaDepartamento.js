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
	
	if (ok == 0){
		document.forms[0].submit();
	}
		//
}


function validaFormularioSub(){
	
	var ok = 0;
	
	if (document.getElementById('departamento').value == "0"){
		alert ("Debe seleccionar el departamento");
		ok = 1;
	}
	
	if (document.getElementById('nombreSubDepartamento').value == ""){
		alert ("Debe rellenar el departamento");
		ok = 1;
	}
	
	if (document.getElementById('treintabarra').value == "30/"){
		alert ("Debe rellenar el Código 30/");
		ok = 1;
	}

	if (ok == 0){
		document.forms[0].submit();
	}
		//
}