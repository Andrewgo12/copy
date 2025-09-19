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
* pinta el listado de comunicaciones
* @author freina<freina@parquesoft.com>
* @param string action
* @date 05-Aug-2009 02:07
* @location Cali-Colombia
*/
function jsDrawListado(){
	
	var params='';
	var objOrdenumeros= new Object;
	objOrdenumeros = document.getElementById('ordenumeros');
	var objOrdefecregdi= new Object;
	objOrdefecregdi = document.getElementById('ordefecregdi');
	var objOrdefecregdf= new Object;
	objOrdefecregdf = document.getElementById('ordefecregdf');
	var objFocacodigos= new Object;
	objFocacodigos = document.getElementById('focacodigos');
	var objComuestados= new Object;
	objComuestados = document.getElementById('comuestados');
	var sbAction='FeGeCmdCentroComunicacionConsult';
	var params = 'action='+sbAction+'&ordenumeros='+objOrdenumeros.value;
	params += '&ordefecregdi='+objOrdefecregdi.value;
	params += '&ordefecregdf='+objOrdefecregdf.value;
	params += '&focacodigos='+objFocacodigos.value;
	params += '&comuestados='+objComuestados.value;
	
	
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
* Propiedad intelectual de FullEngine
*
* crear una nueva comunicacion
* @author freina
* @date 27-Oct-2004 14:38
* @location Cali-Colombia
*/
function jsCreateCT(){
	
		var sbCommand = "FeGeCmdCentroComunicacionCreate";
		var objOrdenumeros= new Object;
		objOrdenumeros = document.getElementById('ordenumeros');
		var objFocacodigos= new Object;
		objFocacodigos = document.getElementById('focacodigos');
		
		
		if(objFocacodigos.value){
			var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,menubar=0,scrollbars=1,width=750,height=540";
			url ="index.php?action="+sbCommand+"&comunicacion__ordenumeros="+objOrdenumeros.value+"&comunicacion__focacodigos="+objFocacodigos.value+"&comunicacion__ordenumerosh="+objOrdenumeros.value;
			win = window.open(url,"new",opciones);
		}else{
			var sbMessage='';
			sbMessage = document.frmComunicacionConsult.message_66.value;
			alert(sbMessage);
		}
       	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* previsualiza las comunicaciones
* @author freina
* @date 23-Oct-2004 08:39
* @location Cali-Colombia
*/
function jsPreview(comucodigos){
	var sbCommand = "FeGeCmdCentroComunicacionPreview";
	if(comucodigos){
		var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,menubar=0,scrollbars=1,width=750,height=540";
		url ="index.php?action="+sbCommand+"&comunicacion__comucodigos="+comucodigos;
		win = window.open(url,"new",opciones);
	}
	return true;
}
function jsDelete(comucodigos){
	
	var params='';
	var sbAction='FeGeCmdCentroComunicacionDelete';
	var params = 'action='+sbAction+'&comucodigos='+comucodigos;
	
	
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
	
	var rcRequest = eval(req.responseText);
	enableButtons();
	alert(decodeBase64(rcRequest[1]));
	if(rcRequest[0]){
		jsDrawListado();
	}
}
/**
* Propiedad intelectual de FullEngine
*
* Genera las comunicaciones
* @author freina
* @date 25-Oct-2004 17:07
* @location Cali-Colombia
*/
function jsGenerate(comucodigos){
	var params='';
	var sbAction='FeGeCmdCentroComunicacionGenerate';
	var params = 'action='+sbAction+'&comucodigos='+comucodigos;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseGenerate,
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
function showResponseGenerate(req){
	
	var rcRequest = eval(req.responseText);
	enableButtons();
	alert(decodeBase64(rcRequest[1]));
	if(rcRequest[0]){
		jsDrawListado();
	}
}
/**
* Propiedad intelectual de FullEngine
*
* descarga las comunicaciones
* @author freina
* @date 21-Jun-2005 13:12
* @location Cali-Colombia
*/
function jsDownload(){
 	
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	url ="index.php?action=FeGeCmdCentroComunicacionDownload";
	win = window.open(url,"Pdf",opciones);
 	return true;
}