/**
 * Propiedad intelectual de FullEngine
 * 
 * Muestra o esconde un div
 * 
 * @author freina
 * @date
 * @date 17-Dec-2015 11:07
 * @location Cali-Colombia
 */
function jsDrawdiv(sbId) {
	var sbBrowser = '';
	sbBrowser = jsBrowser();
	contenedor = document.getElementById(sbId);
	if (sbBrowser == 'IE') {
		contenedor.style.visibility = 'visible';
		contenedor.style.display = 'inline';
	} else {
		contenedor.style.visibility = 'visible';
		contenedor.style.display = 'inline';
	}
	return true;
}

/**
 * Propiedad intelectual de FullEngine
 * 
 * Esconde un div
 * 
 * @author freina
 * @date
 * @date 17-Dec-2015 11:07
 * @location Cali-Colombia
 */
function jsErasediv(sbId) {
	var sbBrowser = '';
	sbBrowser = jsBrowser();
	contenedor = document.getElementById(sbId);
	if (sbBrowser == 'IE') {
		contenedor.style.visibility = 'hidden';
		contenedor.style.display = 'none';
	} else {
		contenedor.style.visibility = 'hidden';
		contenedor.style.display = 'none';
	}
	return true;
}
function clearContainer(sbId) {
	contenedor = document.getElementById(sbId);
	contenedor.innerHTML = '';
	jsErasediv(sbId);
}

/*
 * Copyright 2015 FullEngine
 * 
 * Carga los registros de los pacientes
 * @author freina<freina@fullengine.com>
 * @param string action
 * @date 17-Dec-2015 11:07
 * @location Cali-Colombia
 */
function jsLoadPaciente() {

	var params ='';
	var sbString='';
	disableButtons();

	var sbAction = 'FeCuCmdLoadPaciente';
	var objValue = new Object;
	
	objValue = document.getElementById('paciindentis');

	var params = 'action=' + sbAction + '&paciindentis=' + objValue.value;

	var opt = {
		// Use POST
		method : 'post',
		// Send this lovely data
		postBody : params,
		// Handle successful response
		onSuccess : showResponseLoadPaciente,
		// Handle 404
		on404 : function(t) {
			alert('Error 404: location "' + t.statusText + '" was not found.');
		},
		// Handle other errors
		onFailure : function(t) {
			alert('Error ' + t.status + ' -- ' + t.statusText);
		}
	}

	new Ajax.Request('index.php', opt);
}
function showResponseLoadPaciente(req) {

	enableButtons();
	var rcRequest = eval(req.responseText);
	var objValue = new Object; 

	if (rcRequest[0] == 1) {
		
	  var paciindentis = document.getElementById("paciindentis");
	  paciindentis.value = decodeBase64(rcRequest[1]); 
	  var tiidcodigos = document.getElementById("tiidcodigos");
	  tiidcodigos.value = decodeBase64(rcRequest[2]);
	  var paciprinoms = document.getElementById("paciprinoms");
	  paciprinoms.value = decodeBase64(rcRequest[3]);
	  var pacisegnoms = document.getElementById("pacisegnoms");
	  pacisegnoms.value = decodeBase64(rcRequest[4]);
	  var pacipriapes = document.getElementById("pacipriapes");
	  pacipriapes.value = decodeBase64(rcRequest[5]);
	  var pacisegapes = document.getElementById("pacisegapes");
	  pacisegapes.value = decodeBase64(rcRequest[6]);
	  var pacifecnacis = document.getElementById("pacifecnacis");
	  pacifecnacis.value = decodeBase64(rcRequest[7]);
	  var sexocodigos = document.getElementById("sexocodigos");
	  sexocodigos.value = decodeBase64(rcRequest[8]);
	  var paciemail = document.getElementById("paciemail");
	  paciemail.value = decodeBase64(rcRequest[9]);
	  var locacodigos = document.getElementById("locacodigos");
	  locacodigos.value = decodeBase64(rcRequest[10]);
	  var pacidirecios = document.getElementById("pacidirecios");
	  pacidirecios.value = decodeBase64(rcRequest[11]);
	  var pacitelefons = document.getElementById("pacitelefons");
	  pacitelefons.value = decodeBase64(rcRequest[12]);
	  var pacinumcels = document.getElementById("pacinumcels");
	  pacinumcels.value = decodeBase64(rcRequest[13]);
	  var pacihisclis = document.getElementById("pacihisclis");
	  pacihisclis.value = decodeBase64(rcRequest[14]);
	  var paciobservs = document.getElementById("paciobservs");
	  paciobservs.value = decodeBase64(rcRequest[15]);
	  var paciactivos = document.getElementById("paciactivos");
	  paciactivos.value = decodeBase64(rcRequest[16]);	  
	  var paciente_locacodigos_desc = document.getElementById("paciente_locacodigos_desc");
	  paciente_locacodigos_desc.value = decodeBase64(rcRequest[17]);
	  

	} else {
		alert(decodeBase64(rcRequest[1]));
	}
}