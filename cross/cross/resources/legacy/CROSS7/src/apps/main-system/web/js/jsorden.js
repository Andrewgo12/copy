/**
* Copyright 2009 FullEngine
* 
* Analiza la fecha de ingreso de un caso para determinar si se hace necesario una llave
* @author freina<freina@parquesoft.com>
* @param string action
* @date 24-Mar-2009 10:55
* @location Cali-Colombia
*/
function jsAddOrden(){
	
	var params='';
	var objDate= new Object;;
	var sbAction='FeCrCmdValidateDate';
	objDate = document.getElementById('ordefecregd');
	var params = 'action='+sbAction+'&fecha='+objDate.value;
	
	disableButtons();
	
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
	var objLlave= new Object;
	var objAction= new Object;
	var nuResult=0;
	var sbValue='';
	var sbLlave='';
	var rcRequest = eval(req.responseText);
	nuResult = parseInt(rcRequest[0]);
	sbValue = rcRequest[1];
	if(!nuResult){
		sbLlave = prompt(sbValue,"");
		objLlave = document.getElementById('llave');
		if(sbLlave){
			objLlave.value=sbLlave;
		}else{
			enableButtons();
			return;
		}
	}
	objAction = document.getElementById('action');
	objAction.value='FeCrCmdAddOrden';
	document.frmOrden.submit();
}