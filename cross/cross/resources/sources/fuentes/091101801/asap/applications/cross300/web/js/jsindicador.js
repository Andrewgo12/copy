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

function clearContainer(sbId){
	contenedor = document.getElementById(sbId);
	contenedor.innerHTML = '';
	jsErasediv(sbId);
}
/**
* Copyright 2009 FullEngine
* 
* Presenta los calculos de los indicadores
* @author freina<freina@parquesoft.com>
* @param string action
* @date 31-Oct-2011 18:48
* @location Cali-Colombia
*/
function jsShowIndicador(){
	var params='';
	var sbAction='FeCrCmdShowIndicador';
	
	var objOrdefecingdini= new Object;
	objOrdefecingdini = document.getElementById('ordefecingdini');
	
	var objOrdefecingdfin= new Object;
	objOrdefecingdfin = document.getElementById('ordefecingdfin');
	
	var objOrdefecdiginin= new Object;
	objOrdefecdiginin = document.getElementById('ordefecdiginin');
	
	var objOrdefecdigfinn= new Object;
	objOrdefecdigfinn = document.getElementById('ordefecdigfinn');
	
	var objOrgacodigos= new Object;
	objOrgacodigos = document.getElementById('orgacodigos');
	
	var params = 'action='+sbAction+'&ordefecingdini='+objOrdefecingdini.value;
	params += '&ordefecingdfin='+objOrdefecingdfin.value;
	params += '&ordefecdiginin='+objOrdefecdiginin.value;
	params += '&ordefecdigfinn='+objOrdefecdigfinn.value;
	params += '&orgacodigos='+objOrgacodigos.value;
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseIndicador,
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
function showResponseIndicador(req){
	
	var rcRequest = eval(req.responseText);
	if(rcRequest[0]==1){
		contenedor = document.getElementById("div_indicador");
		jsDrawdiv("div_indicador");
		contenedor.innerHTML = decodeBase64(rcRequest[1]);
	}else{
		alert(decodeBase64(rcRequest[1]));
		jsAction();
	}
}
function jsAction(){
	clearContainer("div_indicador");
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