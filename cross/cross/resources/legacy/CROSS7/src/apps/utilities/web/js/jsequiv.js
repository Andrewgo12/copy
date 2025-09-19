/*
* Copyright 2010 FullEngine
* 
* Carga el nombre del campo llave de la tabla selecionada
* @author freina<freina@parquesoft.com>
* @param string action
* @date 05-May-2010 14:21
* @location Cali-Colombia
*/
function jsLoadField(sbSignal){
	
	var params='';
	var objEquitablcros= new Object;
	
	var sbAction='FeGeCmdloadEquivField';
	
	if(sbSignal==1){
		objTable = document.getElementById('equitablcros');
	}else{
		if(sbSignal==2){
			objTable = document.getElementById('equitabldocs');
		}else{
			objTable = document.getElementById('eqvitablcros');
		}
	}
	
	var params = 'action='+sbAction+'&table='+objTable.value+'&signal='+sbSignal;
	
	
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: showResponseEquivField,
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
function showResponseEquivField(req){
	
	var rcRequest = eval(req.responseText);
	var sbValue = "";
	var objField = new Object;
	var objContenedor = new Object;
	if(rcRequest[0]==1){
		if(rcRequest[3]=="1"){
			objContenedor = document.getElementById("div_equicampcros");
			jsDrawdiv("div_equicampcros");
		}else{
			if(rcRequest[3]=="2"){
				objContenedor = document.getElementById("div_equicampdocs");
				jsDrawdiv("div_equicampdocs");
			}else{
				objContenedor = document.getElementById("div_eqvicampcros");
				jsDrawdiv("div_eqvicampcros");
			}
		}
		
		sbValue = decodeBase64(rcRequest[1]);
		objContenedor.innerHTML = sbValue;
	}else{
		if(rcRequest[3]=="1"){
			clearContainer('div_equicampcros');
		}else{
			if(rcRequest[3]=="2"){
				clearContainer('div_equicampdocs');
			}else{
				clearContainer('div_eqvicampcros');
			}
		}
		if(rcRequest[2]){
			alert(decodeBase64(rcRequest[1]));
		}
	}
	
	if(rcRequest[3]=="1"){
		objField = document.getElementById('equicampcros');
		objField.value = sbValue;
	}else{
		if(rcRequest[3]=="2"){
			objField = document.getElementById('equicampdocs');
			objField.value = sbValue;
		}else{
			objField = document.getElementById('eqvicampcros');
			objField.value = sbValue;
		}
	}
	
	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* Muestra o esconde un div 
* @author freina
* @date 05-May-2010 14:21
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
* @date 05-May-2010 14:21
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