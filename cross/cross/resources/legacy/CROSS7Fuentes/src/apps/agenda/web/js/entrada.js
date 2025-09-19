function loadActas(orden,actas)
{
	var rcPartesExp = actas.split("___");
	var nuSize = rcPartesExp.length;
	var rcExped = new Array();
	var rcOrdenes = new Array();
	var rcActa = new Array();
	
	//Limpio el combobox
	document.forms[0].actacodigos.value = '';
	document.forms[0].tarenombres.value = '';
	
	if(orden=='')
		return false;
	
	for (nuCont=0;nuCont<nuSize;nuCont++)
	{
		rcActa = rcPartesExp[nuCont].split("=>");
		document.forms[0].actacodigos.value = rcActa[1];
		document.forms[0].tarenombres.value = rcActa[3];
	}
	return true;
}

function disableEntePartic(sbvalue,sbDestino)
{
	if(document.forms[0].elements[sbDestino].options[document.forms[0].elements[sbDestino].options.selectedIndex].value == sbvalue)
	{
		document.forms[0].orgacodigospart.value = '';
		document.forms[0].orgacodigospart.focus();
	}
}

function Availability(nuTimestamp,sbName,sbField)
{
	if(document.forms[0].elements[sbName])
	{
		var sbcomando = "FeScCmdDefaultDayviewAvail"
		var sbdata = sbField+"=";
		var nuSize = document.forms[0].elements[sbName].options.length;
		var rcData = new Array();
		
		for(nuCont=0,nuAux=0;nuCont<nuSize;nuCont++)
			if(document.forms[0].elements[sbName].options[nuCont].selected == true)
				rcData[nuAux++] = document.forms[0].elements[sbName].options[nuCont].value
		sbdata += rcData.join("___");
		
		if(document.forms[0].entrada__entrfechorun)
			if(document.forms[0].entrada__entrfechorun.value!='')
				nuTimestamp = document.forms[0].entrada__entrfechorun.value;
		if(nuTimestamp>0)
			sbdata = sbdata+"&date="+nuTimestamp;
		sbdata += "&close=yes";
		sbdata += "&field="+sbField;
		fncopenwindow(sbcomando,sbdata);
	}
}

function js_in_array(the_needle, the_haystack)
{
    var the_hay = the_haystack.toString();
    if(the_hay == ''){
        return false;
    }
    var the_pattern = new RegExp(the_needle, 'g');
    var matched = the_pattern.test(the_haystack);
    return matched;
}

function arrayKey(the_needle,the_haystack)
{
	var nuSize = the_haystack.length;
	for(nuCont=0;nuCont<nuSize;nuCont++)
	{
		if(the_needle==the_haystack[nuCont])
			return nuCont;
	}
}

function loadPerscodigos(sbValue,nuComm)
{
	if(nuComm==1)
		var sbCommand='FeScCmdDefaultJudgeSchedule';
	else if(nuComm==2)
		var sbCommand='FeScCmdDefaultDayview';
	
	document.frmEntrada.perscodigos.value = sbValue;
	document.frmEntrada.action.value=sbCommand;
	document.frmEntrada.submit();
}

function loadFichaEvento(sbValue)
{
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	var url = "index.php?action=FeScCmdDefaultFichaEvento&entrcodigon="+sbValue;
	window.open(url,"fichaevento",opciones);
}
function loadFichaEventoSP(sbValue)
{
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	var url = "index.php?action=FeScCmdDefaultFichaEventoSP&preecodigon="+sbValue;
	window.open(url,"fichaevento",opciones);
}

/**
* Propiedad intelectual de FullEngine
*
* Dibuja las dependencias seleccionadas para agendar las citas
* @author freina
* @date 06-Mar-2011 16:39
* @location Cali-Colombia
*/
function drawOrg(){
	var params='';
	var objOrgacodigos= new Object;
	var sbAction='FeScCmddrawOrg';
	
	objOrgacodigos = document.getElementById('orgacodigos');
	
	var params = 'action='+sbAction+'&orgacodigos='+objOrgacodigos.value;
	
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showOrg,
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

function showOrg(req){
	
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_org");
		jsDrawdiv("div_org");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
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
* Copyright 2011 FullEngine
* 
* Elimina las dependencias seleccionadas
* @author freina<freina@parquesoft.com>
* @param string action
* @date 08-Mar-2011 09:48
* @location Cali-Colombia
*/
function jsDelete(sbOrgacodigos){
	var params='';
	var sbAction='FeScCmdDeleteOrg';
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
		contenedor = document.getElementById("div_org");
		jsDrawdiv("div_org");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
/**
* Copyright 2011 FullEngine
* 
* Carga la entrada seleccionada
* @author freina<freina@parquesoft.com>
* @param string action
* @date 13-Mar-2011 16:54
* @location Cali-Colombia
*/
function jsLoadEntrada(){
	
	var params='';
	var objEntrcodigon= new Object;
	var sbAction='FeScCmdloadEntrada';
	objEntrcodigon = document.getElementById('entrcodigon');
	var params = 'action='+sbAction+'&entrcodigon='+objEntrcodigon.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseLoad,
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
function showResponseLoad(req){
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_org");
		jsDrawdiv("div_org");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}