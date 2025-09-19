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
function jsDrawdiv(sbId){
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
		sbString +='i:'+nuCont+';a:2:{i:0;s:'+rcArray[nuCont][0].length+':"'+rcArray[nuCont][0]+'";i:1;s:'+rcArray[nuCont][1].length+':"'+rcArray[nuCont][1]+'";}';
	}
	sbString += '}';
	
	return sbString;
}
function jsAction(){
	clearContainer("div_respuesta");
}
/**
* Copyright 2009 FullEngine
* 
* Carga las tablas a crear los nuevos labels
* @author freina<freina@parquesoft.com>
* @param string action
* @date 08-Aug-2009 19:57
* @location Cali-Colombia
*/
function jsLoadTabla(){
	
	var params='';
	var sbAction='FeGeCmdloadTabla';
	var params = 'action='+sbAction;
	
	
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
	var nuCant=0;
	var rcTmp= new Array();
	
	//acceso al objeto
	var objSelect = document.getElementById("entidad"); 
	jsCleanSelect("entidad");
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]){
		rcTmp = rcRequest[1];
		nuCant = rcTmp.length;
		for(nuCont=0;nuCont<nuCant;nuCont++){
			objSelect.options[nuCont + 1] = new Option(decodeBase64(rcTmp[nuCont][1]),rcTmp[nuCont][0]);
		}
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
	clearContainer("div_listado");
}
/**
* Copyright 2009 FullEngine
* 
* pinta el listado de labels a crear o modificar
* @author freina<freina@parquesoft.com>
* @param string action
* @date 08-Aug-2009 20:51
* @location Cali-Colombia
*/

function jsDrawListado(){
	
	var params='';
	var objEntidad= new Object;
	objEntidad = document.getElementById('entidad');
	var objLangcodigos= new Object;
	objLangcodigos = document.getElementById('langcodigos');
	var sbAction='FeGeCmdDrawListTablastipole';
	var params = 'action='+sbAction+'&entidad='+objEntidad.value;
	params += '&langcodigos='+objLangcodigos.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseDraw,
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
function showResponseDraw(req){
	//se limpia el container
	clearContainer("div_listado");
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_listado");
		jsDrawdiv("div_listado");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
/**
* Copyright 2009 FullEngine
* 
* actualiza el descriptor en el idioma seleccionado
* @author freina<freina@parquesoft.com>
* @param string action
* @date 09-Aug-2009 14:36
* @location Cali-Colombia
*/

function jsUpdate(tatlnomtabls,tatlnomcacos,tatlnocadess,tatlvalcods,tatlvaldescs,langcodigos){
	
	var params='';
	var $sbId='';
	var objTatlvaldesls= new Object;
	objTatlvaldesls = document.getElementById(tatlvalcods);
	var objTatlcodigos= new Object;
	$sbId = "tatlcodigos_"+tatlvalcods;
	objTatlcodigos = document.getElementById($sbId);
	var sbAction='FeGeCmdSaveListTablastipole';
	var params = 'action='+sbAction+'&tatlcodigos='+objTatlcodigos.value;
	params += '&tatlnomtabls='+tatlnomtabls;
	params += '&tatlnomcacos='+tatlnomcacos;
	params += '&tatlnocadess='+tatlnocadess;
	params += '&tatlvalcods='+encodeBase64(tatlvalcods);
	params += '&tatlvaldescs='+encodeBase64(tatlvaldescs);
	params += '&langcodigos='+langcodigos;
	params += '&tatlvaldesls='+encodeBase64(objTatlvaldesls.value);
	
	
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
	var $sbId='';
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		
		if(rcRequest[2]){
			//se actualiza el hidden
			var objTatlcodigos= new Object;
			$sbId = "tatlcodigos_"+decodeBase64(rcRequest[3]);
			objTatlcodigos = document.getElementById($sbId);
			objTatlcodigos.value=rcRequest[2];
			jsDrawListado();
		}
		
	}
	enableButtons();
	alert(decodeBase64(rcRequest[1]));
}
//==========================
/**
* Copyright 2009 FullEngine
* 
* elimina el descriptor en el idioma seleccionado
* @author freina<freina@parquesoft.com>
* @param string action
* @date 09-Aug-2009 14:36
* @location Cali-Colombia
*/

function jsDelete(tatlvalcods){
	
	var params='';
	var $sbId='';
	var objTatlcodigos= new Object;
	$sbId = "tatlcodigos_"+tatlvalcods;
	objTatlcodigos = document.getElementById($sbId);
	var sbAction='FeGeCmdDeleteListTablastipole';
	var params = 'action='+sbAction+'&tatlcodigos='+objTatlcodigos.value;
	
	//alert(params);
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
	var $sbId='';
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		jsDrawListado();
	}
	enableButtons();
	alert(decodeBase64(rcRequest[1]));
}