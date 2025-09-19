var timeoutHnd;
function gw(searchId, selectId, sqlId, valueField, labelField,adicParam){
	
	var obj = document.getElementById(searchId);	
	if(timeoutHnd)
		clearTimeout(timeoutHnd);
	timeoutHnd=setTimeout(function (){
		if(obj.value.length >= 1){
			getLista(searchId, selectId, sqlId, valueField, labelField,adicParam);
		}
	},800);
	
}

function getLista(searchId, selectId, sqlId, valueField, labelField, adicParam){
		
	var params='';
	var objValue = new Object;
	var adicObj = new Object;
	var sbAction='FeEnCmdDefaultAutoreference';
	objValue = document.getElementById(searchId);
	var params = 'action='+sbAction+'&sqlid='+sqlId+'&valueField='+valueField+'&labelField='+labelField+'&value='+objValue.value;
	if(adicParam){
		adicObj = document.getElementById(adicParam);
		params += '&'+adicParam+'='+adicObj.value;
	}
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: function(data, e){
	    					data = eval(data.responseText);	    					
							if(data.length > 0){
								data = data.split(">>>");
								populateList(selectId, data, valueField, labelField);
							}else{
								dropList(selectId);
								document.getElementById(searchId).value='';
							}
							//console.debug(data);
						},
	    // Handle 404
	    on404: function(type, error){ 
							alert(String(type) + "\n" + String(error));
							console.debug(error);
						},
	    // Handle other errors
	    onFailure: function(t) {
	        alert('Error ' + t.status + ' -- ' + t.statusText);
	    }
	}
	new Ajax.Request('index.php', opt);
}

function populateList(listId, data, valueField, labelField){
	dropList(listId);
	var combo = document.getElementById(listId);
	var fila = '';
	var tam = data.length;
	for(var x=0;x<tam;x++){
		fila = data[x].split("___");
		combo.options[x + 1] = new Option(fila[1],fila[0]);
	}
	return;
}

function dropList(listId){
	//se limpia el combo
	document.getElementById(listId).options.length = 0;
	document.getElementById(listId).options[0] = new Option("" ,"");
}