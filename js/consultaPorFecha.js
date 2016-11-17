function actualizaLista(obj){
	var objeto = document.getElementById('fecha').value;
	
	var respuesta = objeto.split(" ");

	switch(respuesta[0]) {
    case 'Enero':
    	document.getElementById('mesParametro').value=1;
        break;
    case 'Febrero':
    	document.getElementById('mesParametro').value=2;
        break;
    case 'Marzo':
    	document.getElementById('mesParametro').value=3;
        break;
    case 'Abril':
    	document.getElementById('mesParametro').value=4;
        break;
    case 'Mayo':
    	document.getElementById('mesParametro').value=5;
        break;
    case 'Junio':
    	document.getElementById('mesParametro').value=6;
        break;
    case 'Julio':
    	document.getElementById('mesParametro').value=7;
        break;
    case 'Agosto':
    	document.getElementById('mesParametro').value=8;
        break;
    case 'Septiembre':
    	document.getElementById('mesParametro').value=9;
        break;
    case 'Octubre':
    	document.getElementById('mesParametro').value=10;
        break;
    case 'Noviembre':
    	document.getElementById('mesParametro').value=11;
        break;
    case 'Diciembre':
    	document.getElementById('mesParametro').value=12;
        break;
	}
	
	//document.getElementById('mesParametro').value=respuesta[0];
	document.getElementById('anioParametro').value=respuesta[1];
	document.forms[0].submit();
}


function actualizaListaInforme(obj){
	document.getElementById('mesParametro').value=obj.value;
	document.forms[0].action ="consultaInformes.php";
	document.forms[0].submit();
}

function generaExcel(){
	document.forms[0].action ="generaExcel.php";
	document.forms[0].submit();

}

function generaExcelGestor(){
	var periodo = document.getElementById('anioParam').value;
	var departamento = document.getElementById('depParametro').value;
	var informe = document.getElementById('informeParam').value;

	if (periodo != 0 && departamento != 0 && informe != ""){
		document.forms[0].action ="generaExcelGestor.php";
		document.forms[0].submit();
	}
}

function generaInforme(){
	document.getElementById('mesParametro').value=document.getElementById('mes').value;
	document.forms[0].action ="homeGestor.php";
	document.forms[0].submit();
}

function enviarConsulta(){
	document.forms[0].action = "generaExcelGlobal.php";
	document.forms[0].submit();
	
}

function mostramosExcel(){
	document.forms[0].action = "generaExcelDetalleAuto.php";
	document.forms[0].submit();

}

function mostramosExcelGlobal(){
	document.forms[0].action = "generaExcelGlobalAuto.php";
	document.forms[0].submit();

}

function consultaAnio(obj){
	if (obj.value != 0){
		document.getElementById('anioParam').value = obj.value;
		document.forms[0].submit();
	}
	
}

function filtrarInforme(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	var informe = "";
   	for (var i=0;i<document.forms[0].tipoInforme.length;i++){ 
      	if (document.forms[0].tipoInforme[i].checked) 
         	informe = document.forms[0].tipoInforme[i].value;
   	} 
	
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;
	document.getElementById('informeParam').value = informe;
	
	document.forms[0].action = "detalleAutorizador.php";
	document.forms[0].submit();
}

function filtrarInformeAdmin(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	var informe = "";
   	for (var i=0;i<document.forms[0].tipoInforme.length;i++){ 
      	if (document.forms[0].tipoInforme[i].checked) 
         	informe = document.forms[0].tipoInforme[i].value;
   	} 
	
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;
	document.getElementById('informeParam').value = informe;
	

	document.forms[0].action = "consultaInformes.php";
	document.forms[0].submit();
}


function filtrarConsultaAdmin(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;
	

	document.forms[0].action = "consultaTrabajos.php";
	document.forms[0].submit();
}


function filtrarInformeAdminGlobal(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;

	document.forms[0].action = "consultaInformesGlobal.php";
	document.forms[0].submit();
}

function filtrarInformeGlobal(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;

	document.forms[0].action = "globalAutorizador.php";
	document.forms[0].submit();
}

function filtrarInformeGestor(){
	
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	var informe = "";
   	for (var i=0;i<document.forms[0].tipoInforme.length;i++){ 
      	if (document.forms[0].tipoInforme[i].checked) 
         	informe = document.forms[0].tipoInforme[i].value;
   	} 
	
	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;
	document.getElementById('informeParam').value = informe;

	if (periodo != 0 && departamento != 0 && informe != ""){
		document.forms[0].action = "homeGestor.php";
		document.forms[0].submit();
	}
	
}

function pasaValores(){
	document.forms[0].action = "homeGestor.php";
	document.forms[0].submit();
}

function pasaValoresAdmin(){
	/**
	 * <input type="hidden" name="depParametro" id="depParametro" value="<?php echo $dpto;?>">
					<input type="hidden" name="subdptoParametro" id="subdptoParametro"  value="<?php echo $subdpto;?>">
					<input type="hidden" name="anioParam" id="anioParam"  value="<?php echo $anio;?>">
					<input type="hidden" name="informeParam" id="informeParam"  value="<?php echo $tipoInforme;?>">
	 */
	var periodo = document.getElementById("periodo").value;
	var departamento = document.getElementById('departamento').value;
	var informe = "";
   	for (var i=0;i<document.forms[0].tipoInforme.length;i++){ 
      	if (document.forms[0].tipoInforme[i].checked) 
         	informe = document.forms[0].tipoInforme[i].value;
   	} 
   	
   	document.getElementById('anioParam').value = periodo;
	document.getElementById('depParametro').value = departamento;
	document.getElementById('informeParam').value = informe;

	document.forms[0].action = "consultaInformes.php";
	document.forms[0].submit();
}
