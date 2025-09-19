idContainer = new Object;
StateElement = new Object;
objForm = new Object;
objObject = new Object;
objObjectSelect = new Object;
objParameters = new Object;
objUrl = new Object;
objAction = new Object;
objOri = new Object;
/**
* Copyright 2006 FullEngine
* 
* pesenta las formas
* @author freina<freina@parquesoft.com>
* @param string url 
* @param string id_contenedor
* @param string action
* @param string dimension
* @param string report
* @param string state
* @return type name desc
* @date 12-Jul-2006 15:36
* @location Cali-Colombia
*/
function jsShowHtml(url,id_contenedor,action,dimension,report,objState){
	
	var params;
	var sbState='';
	idContainer.value = id_contenedor;
	StateElement.value = objState;
	var params = 'action='+action+'&dimension='+dimension+'&report='+report;

	sbState = getState();
 	if(sbState=='1'){
 		clearContainer();
 		return;
 	}
	
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

	new Ajax.Request(url, opt);
}
/**
* Copyright 2006 FullEngine
* 
* Envia los parametros dela forma
* @author freina<freina@parquesoft.com>
* @param string url 
* @param string action
* @param string report
* @param string fields
* @param string message
* @param string reportname
* @return type name desc
* @date 13-Jul-2006 12:06
* @location Cali-Colombia
*/
function jsSend(url,action,form,report,fields,message,reportname){
	
	var params='';
	var nuCont=0;
	var nuCant=0;
	var nuForm=0;
	var sbName='';
	var rcfields = new Array();
	var rcmessage = new Array();
	var rcspecialdata = new Array();
	rcspecialdata[0]='';
	
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	url +='?action='+action+'&report='+report;
	
	//Campos que e deben validar
	if(fields){
		rcfields = fields.split(',');
	}
	
	//mensajes
	if(message){
		rcmessage = message.split('-');
	}
	
	//primero se determin el FORM
	nuCant = document.forms.length;
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[nuCont].name==form){
			nuForm=nuCont;
			break;
		}
	}
	//se obtienen los valores de la interfaz
	nuCant= document.forms[nuForm].elements.length;
	
	// se validan la nulidad de campos y se arman parametros
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[nuForm].elements[nuCont].type == "text" ||
			document.forms[nuForm].elements[nuCont].type == "select-one"){
			
			sbName = document.forms[nuForm].elements[nuCont].name;
			if(sbName.indexOf('orden__')!=-1){
				sbName = sbName.substr(7);
			}
			
			if(in_array(sbName,rcfields)){
				if(document.forms[nuForm].elements[nuCont].value==''){
					alert(rcmessage[0]);
					return ;
				}
			}
			
			//se toman los datos para la validacion especial
			if(sbName=='period'){
				rcspecialdata[0]=document.forms[nuForm].elements[nuCont].value;
			}
			if(sbName=='month'){
				rcspecialdata[1]=document.forms[nuForm].elements[nuCont].value;
			}
			params +='&'+sbName+'='+document.forms[nuForm].elements[nuCont].value;
		}
	}

	if(rcspecialdata[0]!=''){
		//se valida que sea mensual
		if(rcspecialdata[0].indexOf(',')==-1){
			if(rcspecialdata[1]==''){
				alert(rcmessage[1]);
				return ;
			}
		}
	}
	
	url +=params;
	win = window.open(url,reportname,opciones);
}

/**
* Copyright 2006 FullEngine
* 
* Obtiene los valores del textfield
* @author freina<freina@parquesoft.com>
* @param string url 
* @param string id_contenedor
* @param string action
* @param string form
* @param string objoriname
* @param string params
* @param string objnameselect
* @param string paramsselect
* @return type name desc
* @date 17-Jul-2006 15:32
* @location Cali-Colombia
*/
function jsGetDescription(url,action,form,objoriname,objname,params,objnameselect,paramsselect){
	
	var sbParams;
	objForm.value = form;
	objObject.value = objname;
	objObjectSelect.value = objnameselect;
	objParameters.value = paramsselect;
	objUrl.value = url;
	objAction.value = action;
	objOri.value = objoriname;
	
	var sbParams = 'action='+action+params;

	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: sbParams,
	    // Handle successful response
	    onSuccess: setTextfield,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request(url, opt);
}
function setTextfield(req){
	
	var nuCont=0;
	var nuCant=0;
	var nuForm=0;
	var sbValue='';

	var rcRequest = eval(req.responseText);
	if(rcRequest[0][0]){
		sbValue = rcRequest[0][0];
	}
	//primero se determin el FORM
	nuCant = document.forms.length;
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[nuCont].name==objForm.value){
			nuForm=nuCont;
			break;
		}
	}
	//ahora se modifica el valor
	nuCant= document.forms[nuForm].elements.length;
	
	// se carga el valor
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[nuForm].elements[nuCont].name == objObject.value){
			document.forms[nuForm].elements[nuCont].value=sbValue;
		}
	}
	
	//se carga el combo
	if(sbValue){
		jsGetSelect(objUrl.value,objAction.value,objParameters.value);
	}else{
		// se limpia el origen
		for(nuCont=0;nuCont<nuCant;nuCont++){
			if(document.forms[nuForm].elements[nuCont].name == objOri.value){
				document.forms[nuForm].elements[nuCont].value='';
				document.forms[nuForm].elements[nuCont].focus();
			}
		}
		jsCleanSelect();
	}
}

/**
* Copyright 2006 FullEngine
* 
* Obtiene los valores del combo
* @author freina<freina@parquesoft.com>
* @param string url 
* @param string id_contenedor
* @param string params
* @param string state
* @return type name desc
* @date 18-Jul-2006 15:31
* @location Cali-Colombia
*/
function jsGetSelect(url,action,params){

	var sbParams;
	var sbParams = 'action='+action+params;

	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: sbParams,
	    // Handle successful response
	    onSuccess: setSelect,
	    // Handle 404
	    on404: function(t) {
	        alert('Error 404: location "' + t.statusText + '" was not found.');
	    },
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}

	new Ajax.Request(url, opt);
}
function setSelect(req){
	
	var nuCont=0;
	var nuContR=0;
	var nuCant=0;
	
	//acceso al objeto
	var objSelect = document.getElementById(objObjectSelect.value); 
	objSelect.options.length = 0;
	objSelect.options[0] = new Option("---" ,"");
	var rcRequest = eval(req.responseText);
	if(rcRequest){
		nuCant = rcRequest.length;
		for(nuContR=0;nuContR<nuCant;nuContR++){
			objSelect.options[nuContR + 1] = new Option(rcRequest[nuContR][1],rcRequest[nuContR][0]);
		}
	}
}
function jsCleanSelect(){
	//acceso al objeto
	var objSelect = document.getElementById(objObjectSelect.value); 
	objSelect.options.length = 0;
	objSelect.options[0] = new Option("---" ,"");
}

function in_array($sbvalue,rcArray){
	var nuCont=0;
	var nuCant=0;
	nuCant = rcArray.length;
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(rcArray[nuCont]==$sbvalue){
			return true; 
		}
	}
	return false;
}
function fcnDebug(req){
	contenedor = document.getElementById('debug');
	contenedor.innerHTML = req.responseText;
}
function showResponse(req){
	contenedor = document.getElementById(idContainer.value);
	jsDrawdiv();
	contenedor.innerHTML = req.responseText;
}
function clearContainer(){
	contenedor = document.getElementById(idContainer.value);
	contenedor.innerHTML = '';
	jsErasediv();
}
/**
* Propiedad intelectual de FullEngine
*
* Muestra o esconde un div 
* @author freina
* @date @date 12-Jul-2006 15:46
* @location Cali-Colombia
*/
function jsDrawdiv()
{
	var sbBrowser='';
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(idContainer.value);
 	if(sbBrowser =='IE'){
 		 contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}else{
 		contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}
 	setState();
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* Esconde un div
* @author freina
* @date 12-Jul-2006 15:46
* @location Cali-Colombia
*/
function jsErasediv(){
	var sbBrowser=''; 
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(idContainer.value);
 	if(sbBrowser =='IE'){
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	else{
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	setState();
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* determina el navegador
* @author freina
* @date 12-Jul-2006 15:46
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
/**
* Propiedad intelectual de FullEngine
*
* Obtiene el estado del div
* @author freina
* @date 12-Jul-2006 19:16
* @location Cali-Colombia
*/
function getState(){
	
	var nuCant= document.forms[0].elements.length;
	var nuCont= 0;
	
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[0].elements[nuCont].type == "hidden" 
		&& document.forms[0].elements[nuCont].name == StateElement.value){
			return document.forms[0].elements[nuCont].value;
		}
	}
}
/**
* Propiedad intelectual de FullEngine
*
* Modifica el estado del div
* @author freina
* @date 12-Jul-2006 19:16
* @location Cali-Colombia
*/
function setState(){
	
	var nuCant= document.forms[0].elements.length;
	var nuCont= 0;
	for(nuCont=0;nuCont<nuCant;nuCont++){
		if(document.forms[0].elements[nuCont].type == "hidden" 
		&& document.forms[0].elements[nuCont].name == StateElement.value){
			if(document.forms[0].elements[nuCont].value=='1'){
				document.forms[0].elements[nuCont].value='';
			}else{
				document.forms[0].elements[nuCont].value='1';
			}
			break;
		}
	}
	return true;
}