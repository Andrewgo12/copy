/**
* Copyright 2009 FullEngine
* 
* Carga las tareas teniendo encuenta el proceso
* @author freina<freina@parquesoft.com>
* @param string action
* @date 07-Sep-2009 15:36
* @location Cali-Colombia
*/
function jsLoadTarea(){
	
	var params='';
	var objPregcodigon= new Object;
	//var sbAction='FeEnCmdloadRespuestas';
	var sbAction='FeGeCmdloadTareas';
	objProccodigos = document.getElementById('proccodigos');
	var params = 'action='+sbAction+'&proccodigos='+objProccodigos.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponse,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}

function showResponse(req){
	
	var nuCont=0;
	var nuContR=0;
	var nuCant=0;
	var rcTmp= new Array();
	
	//acceso al objeto
	var objSelect = document.getElementById("tarecodigos"); 
	jsCleanSelect("tarecodigos");
	var rcRequest = eval(req.responseText);
	if(rcRequest){
		rcTmp = rcRequest;
		nuCant = rcTmp.length;
		for(nuContR=0;nuContR<nuCant;nuContR++){
			objSelect.options[nuContR + 1] = new Option(decodeBase64(rcTmp[nuContR][1]),rcTmp[nuContR][0]);
		}
	}
	//clearContainer("div_respuesta");
}
function jsCleanSelect(sbId){
	//acceso al objeto
	var objSelect = document.getElementById(sbId); 
	objSelect.options.length = 0;
	objSelect.options[0] = new Option("---" ,"");
}


/**
* Propiedad intelectual de FullEngine
*
* Muestra o esconde un div 
* @author freina
* @date @date 10-Jul-2009 13:59
* @location Cali-Colombia
*/
function jsDrawdiv(sbId)
{
	var sbBrowser='';
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(sbId);
 	if(sbBrowser =='IE'){
 		 contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}else{
 		contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* Esconde un div
* @author freina
* @date @date 10-Jul-2009 13:59
* @location Cali-Colombia
*/
function jsErasediv(sbId){
	var sbBrowser=''; 
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(sbId);
 	if(sbBrowser =='IE'){
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	else{
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* determina el navegador
* @author freina
* @date 10-Jul-2009 13:59
* @location Cali-Colombia
*/
function jsBrowser(){
  if (document.layers) return "NS";
  if (document.all) {
		// But is it really IE?
		// convert all characters to lowercase to simplify testing
		var agt=navigator.userAgent.toLowerCase();
		var is_opera = (agt.indexOf("opera") != -1);
		var is_konq = (agt.indexOf("konqueror") != -1);
		if(is_opera) {
			return "OPR";
		} else {
			if(is_konq) {
				return "KONQ";
			} else {
				// Really is IE
				return "IE";
			}
		}
  }
  if (document.getElementById) return "MOZ";
  return "OTHER";
}
function clearContainer(sbId){
	contenedor = document.getElementById(sbId);
	contenedor.innerHTML = '';
	jsErasediv(sbId);
}
function serialize(rcArray){
	var nuCont = 0;
	var nuCant = 0;
	nuCant = rcArray.length;
	var sbString = 'a:'+nuCant+':{';
	for(nuCont=0; nuCont<nuCant; nuCont++){
		sbString += 'i:'+rcArray[nuCont][0]+';s:'+rcArray[nuCont][1].length+':"'+rcArray[nuCont][1]+'";';
	}
	sbString += '}';
	
	return sbString;
}
/**
* Copyright 2009 FullEngine
* 
* Almacena las dependencias relacionadas a una tarea
* @author freina<freina@parquesoft.com>
* @param string action
* @date 09-Sept-2009 11:07
* @location Cali-Colombia
*/

function jsAddEnte(){
	var params='';
	var sbAction='FeGeCmdAddEnte';
	
	var objOrgacodigos= new Object;
	objOrgacodigos = document.getElementById('orgacodigos');
	
	var objProccodigos= new Object;
	objProccodigos = document.getElementById('proccodigos');
	
	var objTarecodigos= new Object;
	objTarecodigos = document.getElementById('tarecodigos');
	
	var params = 'action='+sbAction+'&orgacodigos='+objOrgacodigos.value;
	params += '&proccodigos='+objProccodigos.value;
	params += '&tarecodigos='+objTarecodigos.value;
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseAdd,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}
function showResponseAdd(req){
	
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
/**
* Copyright 2009 FullEngine
* 
* Elimina las personas relacionadas
* @author freina<freina@parquesoft.com>
* @param string action
* @date 09-Sep-2009 15:50
* @location Cali-Colombia
*/
function jsDelete(sbOrgacodigos){
	var params='';
	var sbAction='FeGeCmdDeleteEnte';
	var params = 'action='+sbAction+'&orgacodigos='+sbOrgacodigos;
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseDelete,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}
function showResponseDelete(req){
	enableButtons();
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = rcRequest[1];
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
/**
* Copyright 2009 FullEngine
* 
* Almacena la relacion
* @author freina<freina@parquesoft.com>
* @param string action
* @date 12-Sep-2009 15:50
* @location Cali-Colombia
*/
function jsSaveRelacion(){
	var params='';
	var sbAction='FeGeCmdSaveRelacion';
	var params = 'action='+sbAction;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseSave,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}
function showResponseSave(req){
	var rcRequest = eval(req.responseText);
	alert(decodeBase64(rcRequest[1]));
	if(rcRequest[0]){
		document.frmTareaPersona.action.value="FeGeCmdDefaultRelacionTarea_Persona";
		document.frmTareaPersona.submit();
	}	
}
/**
* Propiedad intelectual de FullEngine
*
* Dibuja las relacion de personas a la tarea de un proceso
* @author freina
* @date 12-Sep-2009 16:37
* @location Cali-Colombia
*/
function jsDrawRelacion(){
	
	var params='';
	var sbAction='FeGeCmdDrawRelacion';
	
	var objProccodigos= new Object;
	objProccodigos = document.getElementById('proccodigos');
	
	var objTarecodigos= new Object;
	objTarecodigos = document.getElementById('tarecodigos');
	
	var params = 'action='+sbAction+'&proccodigos='+objProccodigos.value;
	params += '&tarecodigos='+objTarecodigos.value;
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showRelacion,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}

function showRelacion(req){
	
	var rcRequest = eval(req.responseText);
	jsErasediv("div_configuracion");
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}
}
/**
* Copyright 2009 FullEngine
* 
* Desactiva la relacion
* @author freina<freina@parquesoft.com>
* @param string action
* @date 13-Sep-2009 11:07
* @location Cali-Colombia
*/
function jsDeleteRelacion(){
	var params='';
	var sbAction='FeGeCmdDeleteRelacion';
	
	var objProccodigos= new Object;
	objProccodigos = document.getElementById('proccodigos');
	
	var objTarecodigos= new Object;
	objTarecodigos = document.getElementById('tarecodigos');
	
	var params = 'action='+sbAction+'&proccodigos='+objProccodigos.value;
	params += '&tarecodigos='+objTarecodigos.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseDelRel,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request('index.php', opt);
}
function showResponseDelRel(req){
	var rcRequest = eval(req.responseText);
	alert(decodeBase64(rcRequest[1]));
	if(rcRequest[0]){
		document.frmTareaPersona.action.value="FeGeCmdDefaultRelacionTarea_Persona";
		document.frmTareaPersona.submit();
	}	
}