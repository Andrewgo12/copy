/*
* Copyright 2010 FullEngine
* 
* Carga los registros del log de auditoria que estan en estado de fallo
* @author freina<freina@parquesoft.com>
* @param string action
* @date 13-Abr-2010 11:27
* @location Cali-Colombia
*/
function jsLoadIntegraLog(){
	
	var params='';
	var objInlofchaejin1= new Object;
	var objInlofchaejin2= new Object;
	var objInloapps= new Object;
	var objInloestados= new Object;
	var objInloidcrosss= new Object;
	var objInlousuarios= new Object;
	
	var sbAction='FeGeCmdloadIntegraLog';
	objInlofchaejin1 = document.getElementById('inlofchaejin1');
	objInlofchaejin2 = document.getElementById('inlofchaejin2');
	objInloapps = document.getElementById('inloapps');
	objInloestados = document.getElementById('inloestados');
	objInloidcrosss = document.getElementById('inloidcrosss');
	objInlousuarios = document.getElementById('inlousuarios');
	
	var params = 'action='+sbAction+'&inlofchaejin1='+objInlofchaejin1.value+'&inlofchaejin2='+objInlofchaejin2.value
	+'&inloapps='+objInloapps.value+'&inloestados='+objInloestados.value+'&inloidcrosss='+objInloidcrosss.value
	+'&inlousuarios='+objInlousuarios.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseLoadIntegraLog,
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
function showResponseLoadIntegraLog(req){
	
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_integralog");
		jsDrawdiv("div_integralog");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		clearContainer('div_integralog');
		alert(decodeBase64(rcRequest[1]));
	}
}
//---------------------
/*
* Copyright 2010 FullEngine
* 
* Envia a ejecutar la integracion
* @author freina<freina@parquesoft.com>
* @param string action
* @date 13-Abr-2010 11:27
* @location Cali-Colombia
*/
function jsSendIntegration(nuInlocodigon){
	var params='';
	var sbAction='FeGeCmdSendIntegraLog';
	
	var params = 'action='+sbAction+'&inlocodigon='+nuInlocodigon;
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseSend,
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
function showResponseSend(req){
	enableButtons();
	var rcRequest = eval(req.responseText);
	var sbDiv ='';
	if(rcRequest[0]==1){
		sbDiv = 'div_inloerrors_'+rcRequest[2];
		contenedor = document.getElementById(sbDiv);
		contenedor.innerHTML = decodeBase64(rcRequest[3]);
		sbDiv = 'div_inlofchaejfn_'+rcRequest[2];
		contenedor = document.getElementById(sbDiv);
		contenedor.innerHTML = decodeBase64(rcRequest[4]);
		sbDiv = 'div_inloestados_'+rcRequest[2];
		contenedor = document.getElementById(sbDiv);
		contenedor.innerHTML = "";
		alert(decodeBase64(rcRequest[1]));
	}else{
		if(rcRequest[0]==2){
			sbDiv = 'div_inloerrors_'+rcRequest[2];
			contenedor = document.getElementById(sbDiv);
			contenedor.innerHTML = decodeBase64(rcRequest[3]);
			alert(decodeBase64(rcRequest[1]));
		}else{
			if(rcRequest[0]==3){
				alert(decodeBase64(rcRequest[1]));
			}
		}
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
function clearContainer(sbId){
	contenedor = document.getElementById(sbId);
	contenedor.innerHTML = '';
	jsErasediv(sbId);
}
/**
* Propiedad intelectual de FullEngine
*
* abre la forma para editar la informacion propia de la integracion
* @author freina
* @date @date 20-Apr-2010 17:40
* @location Cali-Colombia
*/
function jsUpdateDetailIntegration(nuInlocodigon,sbInloapps){
	
	var sbOptions="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=800,height=500";
	var sbCommand='';
	var sbData='';
	var sbUrl='';
	
	switch(sbInloapps){

		case "1":
			sbCommand ='FeGeCmdDefaultIntelogdoc';
		break;
		case "2":
			sbCommand ='FeGeCmdDefaultIntelogsip';
		break;
	}
	
	if(sbCommand != '' && nuInlocodigon !=''){
		sbData ='inlocodigon='+nuInlocodigon;
		sbUrl ="index.php?action="+sbCommand+"&"+sbData;
		win = window.open(sbUrl,"",sbOptions);
	}
	
	return;
}

/**
* Propiedad intelectual de FullEngine
*
* actualiza la informacion del detalle del log para Docunet
* @author freina
* @date @date 21-Apr-2010 15:17
* @location Cali-Colombia
*/
function jsUpdateIntelogdoc(){
	
	var params='';
	var objInlocodigon= new Object;
	var objD_id_cross= new Object;
	var objNmbre_srie= new Object;
	var objNmbre_tpo_crpta= new Object;
	var objNmbre_crpta= new Object;
	var objNmbre_tpo_dcto= new Object;
	var objNmbre_dcto= new Object;
	var objExt= new Object;
	var objFncnrio= new Object;
	
	var sbAction='FeGeCmdUpdateIntelogdoc';
	objInlocodigon = document.getElementById('inlocodigon');
	objD_id_cross = document.getElementById('d_id_cross');
	objNmbre_srie = document.getElementById('nmbre_srie');
	objNmbre_tpo_crpta = document.getElementById('nmbre_tpo_crpta');
	objNmbre_crpta = document.getElementById('nmbre_crpta');
	objNmbre_tpo_dcto = document.getElementById('nmbre_tpo_dcto');
	objNmbre_dcto = document.getElementById('nmbre_dcto');
	objExt = document.getElementById('extt');
	objFncnrio = document.getElementById('fncnrio');
	
	var params = 'action='+sbAction+
	'&inlocodigon='+objInlocodigon.value+
	'&d_id_cross='+objD_id_cross.value+
	'&nmbre_srie='+objNmbre_srie.value+
	'&nmbre_tpo_crpta='+objNmbre_tpo_crpta.value+
	'&nmbre_crpta='+objNmbre_crpta.value+
	'&nmbre_tpo_dcto='+objNmbre_tpo_dcto.value+
	'&nmbre_dcto='+objNmbre_dcto.value+
	'&ext='+objExt.value+
	'&fncnrio='+objFncnrio.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseUpdateIntelogdoc,
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
function showResponseUpdateIntelogdoc(req){
	var rcRequest = eval(req.responseText);
	enableButtons();
	if(rcRequest[0]==1){
		alert(decodeBase64(rcRequest[1]));
		this.close();
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}
//--------------------------------
/**
* Propiedad intelectual de FullEngine
*
* actualiza la informacion del detalle del log para el sistema SIPA
* @author freina
* @date @date 29-Apr-2010 16:58
* @location Cali-Colombia
*/
function jsUpdateIntelogsip(){
	
	var params='';
	var objInlocodigon= new Object;
	var objCaso= new Object;
	var objArea= new Object;
	var objSerie= new Object;
	var objTipo_carpeta= new Object;
	var objNmbre_tpo_dcto= new Object;
	
	var sbAction='FeGeCmdUpdateIntelogsip';
	objInlocodigon = document.getElementById('inlocodigon');
	objCaso = document.getElementById('caso');
	objArea = document.getElementById('area');
	objSerie = document.getElementById('serie');
	objTipo_carpeta = document.getElementById('tipo_carpeta');
	objLocalizacion = document.getElementById('localizacion');
	
	var params = 'action='+sbAction+
	'&inlocodigon='+objInlocodigon.value+
	'&caso='+objCaso.value+
	'&area='+objArea.value+
	'&serie='+objSerie.value+
	'&tipo_carpeta='+objTipo_carpeta.value+
	'&localizacion='+objLocalizacion.value;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseUpdateIntelogsip,
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
function showResponseUpdateIntelogsip(req){
	var rcRequest = eval(req.responseText);
	enableButtons();
	if(rcRequest[0]==1){
		alert(decodeBase64(rcRequest[1]));
		this.close();
	}else{
		alert(decodeBase64(rcRequest[1]));
	}
}