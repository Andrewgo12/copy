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
	var nuCant=0;
	var nuContR=0;
	var nuCantR=0;
	
	
	// se limpia el objeto 
	jsCleanSelect();
	
	//acceso al objeto
	var objSelect = document.getElementById(objObjectSelect.value); 
	nuCant = objSelect.length;
	var rcRequest = eval(req.responseText);
	if(rcRequest){
		nuCantR = rcRequest.length;
		for(nuContR=0;nuContR<nuCantR;nuContR++){
		
			for(nuCont=0;nuCont<nuCant;nuCont++){
				if(objSelect.options[nuCont].value==rcRequest[nuContR]){
					objSelect.options[nuCont].selected=true;
				}
			}
		}
	}
}
function jsCleanSelect(){
	//acceso al objeto
	var nuCont=0;
	var nuCant=0;
	var objSelect = document.getElementById(objObjectSelect.value); 
	
	nuCant = objSelect.length;
	for(nuCont=0;nuCont<nuCant;nuCont++){
		objSelect.options[nuCont].selected=false;
	}
}


function extractselect(lstDestino,objDestino,objForm,objAction,action){
	var nuReg = lstDestino.options.length;
	var rcOpt = new Array();
	var cont = 0;
	for(nuCont=0;nuCont<nuReg;nuCont++){
		if (lstDestino.options[nuCont].selected){
			rcOpt[cont] = lstDestino.options[nuCont].value;
			cont++;
		}
	}
	objDestino.value = rcOpt.join(',');
	objAction.value = action;
	objForm.submit();
	return true;
}