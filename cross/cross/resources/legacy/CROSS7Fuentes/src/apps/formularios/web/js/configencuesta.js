/**
* Copyright 2009 FullEngine
* 
* Carga las repuestas teniendo encuenta el modelo de respuesta de la pregunta seleccionada
* @author freina<freina@parquesoft.com>
* @param string action
* @date 08-Jul-2009 16:12
* @location Cali-Colombia
*/
function jsLoadRespuesta(){
	
	var params='';
	var objPregcodigon= new Object;
	var sbAction='FeEnCmdloadRespuestas';
	objPregcodigon = document.getElementById('pregcodigon');
	var params = 'action='+sbAction+'&pregcodigon='+objPregcodigon.value;
	
	
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
	var objSelect = document.getElementById("oprecodigon"); 
	jsCleanSelect("oprecodigon");
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]){
		rcTmp = rcRequest[0];
		nuCant = rcTmp.length;
		for(nuContR=0;nuContR<nuCant;nuContR++){
			objSelect.options[nuContR + 1] = new Option(decodeBase64(rcTmp[nuContR][1]),rcTmp[nuContR][0]);
		}
	}
	if(rcRequest[1]){
		jsCleanSelect("objecodigon");
		objSelect = document.getElementById("objecodigon");
		rcTmp = rcRequest[1];
		nuCant = rcTmp.length;
		for(nuContR=0;nuContR<nuCant;nuContR++){
			objSelect.options[nuContR + 1] = new Option(decodeBase64(rcTmp[nuContR][1]),rcTmp[nuContR][0]);
		}
	}
	clearContainer("div_respuesta");
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
* Dibuja las respuestas selecionadas de una pregunta
* @author freina
* @date 10-Jul-2009 14:08
* @location Cali-Colombia
*/
function drawRespuesta(){
	var params='';
	var objOprecodigon= new Object;
	var objPregpadren= new Object;
	var sbAction='FeEnCmddrawRespuestas';
	var rcSelected = new Array();
	var nuCant=0;
	var nuRow=0;
	var sbOprecodigon='';
	
	objOprecodigon = document.getElementById('oprecodigon');
	objPregpadren = document.getElementById('pregpadren');
	
	//se obtiene los indices seleccionados
	nuCant = objOprecodigon.options.length;
	for (var nuCont = 0; nuCont < nuCant; nuCont++){
		if (objOprecodigon.options[ nuCont ].selected && objOprecodigon.options[ nuCont ].value!=''){
			rcSelected[nuRow]=objOprecodigon.options[ nuCont ].value;
			nuRow ++;
		}
	}
	
	sbOprecodigon = rcSelected.join(",");
	var params = 'action='+sbAction+'&oprecodigon='+sbOprecodigon+'&pregpadren='+objPregpadren.value;
	
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showRespuesta,
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

function showRespuesta(req){
	
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_respuesta");
		jsDrawdiv("div_respuesta");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}

function clearContainer(sbId){
	contenedor = document.getElementById(sbId);
	contenedor.innerHTML = '';
	jsErasediv(sbId);
}
/**
* Copyright 2009 FullEngine
* 
* Almacena las preguntas de un formulario
* @author freina<freina@parquesoft.com>
* @param string action
* @date 15-Jul-2009 16:44
* @location Cali-Colombia
*/
function jsAddPregunta(){
	var params='';
	var sbAction='FeEnCmdAddAnswers';
	
	var objPregcodigon= new Object;
	objPregcodigon = document.getElementById('pregcodigon');
	
	var objFormcodigon= new Object;
	objFormcodigon = document.getElementById('formcodigon');
	
	var objPregpadren= new Object;
	objPregpadren = document.getElementById('pregpadren');
	
	var objObjecodigon= new Object;
	objObjecodigon = document.getElementById('objecodigon');
	
	//se almacena las opciones de respuesta padre seleccionadas
	var sbString='';
	sbString = jsgetSelect();
	
	//se almacena el orden de las respuestas
	var sbString_o='';
	sbString_o = jsgetText('o');
	//se alamcena el peso de las respuestas
	var sbString_p='';
	sbString_p = jsgetText('p');
	
	var params = 'action='+sbAction+'&pregcodigon='+objPregcodigon.value;
	params += '&formcodigon='+objFormcodigon.value;
	params += '&pregpadren='+objPregpadren.value;
	params += '&sel_pregpadren='+sbString;
	params += '&sel_reprordenn='+sbString_o;
	params += '&sel_reprpeson='+sbString_p;
	params += '&objecodigon='+objObjecodigon.value;
	
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
	
	var objSelect = document.getElementById("pregcodigon");
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
		//se debe ademas actualizar los combos de preguntas y pregunta padre.
		jsUpdateSelect("pregcodigon","pregpadren",objSelect.options[objSelect.selectedIndex].value);
		//se limpia las respuestas
		jsCleanSelect("oprecodigon");
		//se limpian los objetos
		jsCleanSelect("objecodigon");
		//se limpia el contenedor
		clearContainer("div_respuesta");
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
function jsUpdateSelect(sbIdIni,sbIdFin,sbValue){
	
	var nuCont=0;
	var nuCant=0;
	var sbLabel='';
	
	//acceso al objeto
	var objSelectIni = document.getElementById(sbIdIni);
	nuCant = objSelectIni.length;
	if(nuCant && sbValue){
		for(nuCont=0;nuCont<nuCant;nuCont++){
			if(objSelectIni.options[nuCont].value==sbValue){
				sbLabel=objSelectIni.options[nuCont].text;
				objSelectIni.remove(nuCont);
				break;
			}
		}
		var OptNew = document.createElement('option');
		OptNew.text = sbLabel;
		OptNew.value = sbValue;
		var objSelectFin = document.getElementById(sbIdFin);
		try {
			objSelectFin.add(OptNew,null); // standards compliant; doesn't work in IE
		}
		catch(ex) {
			objSelectFin.add(OptNew); // IE only
		}
	}
	return;
}
function jsgetSelect(){
	
	var nuElements = 0;
	var nuCont = 0;
	var nuRow = 0;
	var sbName = '';
	var sbResult = '';
	var objObject = new Object;
	var rcTmp = new Array();
	var rcSplit = new Array();
		
	//Recorre el formulario
	nuElements = document.forms[0].length;
	for(nuCont;nuCont<nuElements;nuCont++){
		objObject =document.forms[0].elements[nuCont]; 
		if(objObject.type == "select-one"){
			sbName = objObject.name;
			if(sbName.indexOf("select_")!=-1){
				rcSplit = sbName.split("_"); 
				rcTmp[nuRow]=new Array(rcSplit[1],objObject.value);
				nuRow ++;
			}
		}
	}
	if(nuRow){
		sbResult = serialize(rcTmp);
	}
	return sbResult;
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
function jsAction(){
	clearContainer("div_respuesta");
}
/**
* Copyright 2009 FullEngine
* 
* Elimina las preguntas de un formulario
* @author freina<freina@parquesoft.com>
* @param string action
* @date 15-Jul-2009 16:44
* @location Cali-Colombia
*/
function jsDelete(nuPregcodigon){
	var params='';
	var sbAction='FeEnCmdDeleteAnswers';
	var params = 'action='+sbAction+'&pregcodigon='+nuPregcodigon;
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
	var nuCont=0;
	var nuCant=0;
	var rcArray=new Array();
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
		//se debe ademas actualizar los combos de preguntas y pregunta padre.
		if(rcRequest[2]){
			rcArray=rcRequest[2];
			nuCant = rcArray.length;
			for(nuCont=0;nuCont<nuCant;nuCont++){
				jsUpdateSelect("pregpadren","pregcodigon",rcArray[nuCont]);
			}
		}
		//se limpia las respuestas
		jsCleanSelect("oprecodigon");
		//se limpian los objetos
		jsCleanSelect("objecodigon");
		//se limpia el contenedor
		clearContainer("div_respuesta");
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
/**
* Copyright 2009 FullEngine
* 
* Carga la informacion de un formulario si este esta almacenado
* @author freina<freina@parquesoft.com>
* @param string action
* @date 30-Jul-2009 18:12
* @location Cali-Colombia
*/
function jsLoadFormulario(){
	
	var params='';
	var objFormcodigon= new Object;
	var sbAction='FeEnCmdloadFormulario';
	objFormcodigon = document.getElementById('formcodigon');
	var params = 'action='+sbAction+'&formcodigon='+objFormcodigon.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseLoadFormulario,
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
function showResponseLoadFormulario(req){
	
	var nuCont=0;
	var nuCant=0;
	var objSelect = document.getElementById("pregcodigon");
	var rcRequest = eval(req.responseText);
	var rcArray=new Array();
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
		//se debe ademas actualizar los combos de preguntas y pregunta padre.
		if(rcRequest[2]){
			if(rcRequest[2]){
				rcArray=rcRequest[2];
				nuCant = rcArray.length;
				for(nuCont=0;nuCont<nuCant;nuCont++){
					jsUpdateSelect("pregcodigon","pregpadren",rcArray[nuCont]);
				}
			}
		}
		
		//se limpia las respuestas
		jsCleanSelect("oprecodigon");
		//se limpian los objetos
		jsCleanSelect("objecodigon");
		//se limpia el contenedor
		clearContainer("div_respuesta");
	}else{
		document.frmConfigEncuesta.action.value="FeEnCmdDefaultConfigEncuesta";
		document.frmConfigEncuesta.submit();
	}
	
}
function jsSaveConfig(){
	var params='';
	var sbAction='FeEnCmdSaveConfig';
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
		var objTmp = document.getElementById("formcodigon");
		objTmp.value="";
		document.frmConfigEncuesta.action.value="FeEnCmdDefaultConfigEncuesta";
		document.frmConfigEncuesta.submit();
	}	
}

function isInteger(event){
	var sbBrouser='';
	sbBrowser = jsBrowser();
	
	if(sbBrowser=='NS'){
		if (!((event.charCode>=48) && (event.charCode<=57) 
			|| (event.charCode == 0) || (event.charCode == 8))){
				AnnulEventNE(event);
		}
	}else{
		if(sbBrowser=='IE'){
			if (!((event.keyCode>=48) && (event.keyCode<=57))){
				AnnulEventIE(event);
			}
		}else{
			if(sbBrowser=='MOZ'){
				if (!((event.charCode>=48) && (event.charCode<=57) 
					|| (event.charCode == 0) || (event.charCode == 8))){
						AnnulEventMOZ(event);				
				}
			}
		}
	}
}

function jsgetText(sbText){
	
	var nuElements = 0;
	var nuCont = 0;
	var nuRow = 0;
	var sbName = '';
	var sbResult = '';
	var sbIndexOf='';
	var objObject = new Object;
	var rcTmp = new Array();
	var rcSplit = new Array();
	
	sbIndexOf = "text_"+sbText+"_";
	
	//Recorre el formulario
	nuElements = document.forms[0].length;
	for(nuCont;nuCont<nuElements;nuCont++){
		objObject =document.forms[0].elements[nuCont]; 
		if(objObject.type == "text"){
			sbName = objObject.name;
			if(sbName.indexOf(sbIndexOf)!=-1){
				rcSplit = sbName.split("_"); 
				rcTmp[nuRow]=new Array(rcSplit[2],objObject.value);
				nuRow ++;
			}
		}
	}
	if(nuRow){
		sbResult = serialize(rcTmp);
	}
	return sbResult;
}
//==========================================
/**
* Copyright 2009 FullEngine
* 
* Modifica los pesos y orden de las respuestas
* @author freina<freina@parquesoft.com>
* @param string action
* @date 23-Sep-2009 13:01
* @location Cali-Colombia
*/
function jsUpdate(nuPregcodigon){
	var params='';
	var sbAction='FeEnCmdUpdateAnswers';
	//se almacena el orden de las respuestas
	var sbString_o='';
	sbString_o = jsgetText_P(nuPregcodigon,'o');
	//se alamcena el peso de las respuestas
	var sbString_p='';
	sbString_p = jsgetText_P(nuPregcodigon,'p');
	
	var params = 'action='+sbAction+'&pregcodigon='+nuPregcodigon;
	params += '&sel_reprordenn='+sbString_o;
	params += '&sel_reprpeson='+sbString_p;
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseUpdate,
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
function showResponseUpdate(req){
	enableButtons();
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_configuracion");
		jsDrawdiv("div_configuracion");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
		clearContainer("div_respuesta");
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
function jsgetText_P(nuPregcodigon,sbText){
	
	var nuElements = 0;
	var nuCont = 0;
	var nuRow = 0;
	var sbName = '';
	var sbResult = '';
	var sbIndexOf='';
	var objObject = new Object;
	var rcTmp = new Array();
	var rcSplit = new Array();
	
	sbIndexOf = "preg_"+sbText+"_";
	
	//Recorre el formulario
	nuElements = document.forms[0].length;
	for(nuCont;nuCont<nuElements;nuCont++){
		objObject =document.forms[0].elements[nuCont]; 
		if(objObject.type == "text"){
			sbName = objObject.name;
			if(sbName.indexOf(sbIndexOf)!=-1){
				rcSplit = sbName.split("_");
				if(rcSplit[2]==nuPregcodigon){
					rcTmp[nuRow]=new Array(rcSplit[3],objObject.value);
					nuRow ++;
				}
			}
		}
	}
	if(nuRow){
		sbResult = serialize(rcTmp);
	}
	return sbResult;
}