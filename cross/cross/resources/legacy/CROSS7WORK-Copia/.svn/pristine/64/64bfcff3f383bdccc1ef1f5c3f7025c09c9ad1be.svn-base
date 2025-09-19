rtnSelect = new Object;
rtnfield = new Object;
homefield = new Object;

function AutoCompletar(tbl_field,rtn_field,home_field)
{
	if(!home_field && !rtn_field && !tbl_field){
			return;
	}
	if(!home_field.value){
		rtn_field.value = '';
		return;
	}
	//Atributos
	rtnfield = rtn_field;
	homefield = home_field;
	this.namefield = tbl_field;
	
	//Metodos
	this.fncloaddato = fncloaddato;
	this.fncrtnvalue = fncrtnvalue;
	
	//Llamado a la funcion
	this.fncloaddato();
}

function fncloaddato(value)
{
		jsrsExecute("rs/jsrs.php", this.fncrtnvalue, "AutoCompletar::fncAutoCompletar", Array(homefield.value,this.namefield),true);
}

function fncrtnvalue(valor)
{
	if(valor == "null")
	{
	    rtnfield.value = '';
	    homefield.value = '';
	    homefield.focus();
	    return;
	}
	rtnfield.value =  unescape(valor.replace(/\+/g, " "));
	return;
}

function fncrtnValidateImei(valor)
{
	if(valor == "1")
	    return;
	else
	{
		homefield.value = '';
		homefield.focus();
		var sbMess = decodeBase64(valor);
		printAlert(sbMess);
	}
	return;
}

/**
* @propiedad intekectual de FullEngine
* 
* Hace una autoreferencia para un campo
* @author Cesar Reyes
* @date 02-Jul-2004 10:16
* @param string sqlId Identificador del sql en la compuerta
* @param string params nombres de las variables par?metro, valores(opcional) y operadores(opcional) separadas por pipe("|"), 
*            Si el operador no es enunciado se asume que es un igual, si el valor no es pasado se buscara en ese mismo orden en el vector 
*			  con los objetos (rcObject)
*            Ej;  ciudcodigos|depacodigos|paiscodigos,3,=
* @param array rcObject Vector con los objetos parametro que pertenecen a la forma
			Ej; para el corresponder al ejemplo anterior
			array(this,this.form.depacodigos)
			Nota: Este ejemplo nos indica que se traiga el nombre de una ciudad digitada ("this") que pertenezca a un departamento 
			digitado("this.form.depacodigos") y que a su vez pertenezca a un pais con el codigo igual a tres, siempre se coloca como primer 
			elemento el objeto actual.
* @param object rtnObject (Objeto tipo text, textarea donde se pintara el resultado)
* @param boolean debug para pintar el debug, por defecto en false
*/
function autoReference(sqlId,params,rcObject,rtnObject,debug){
	homefield = rcObject[0];
	rtnfield = rtnObject;
    var triadas = new Array();
    triadas = params.split("|");
    var cantTradas = triadas.length;
    var elements = new Array();
    for(cont=0;cont<cantTradas;cont++){
    				elements = triadas[cont].split(",");
    				//Verifica si el elemento tiene valor, si no lo carga con el valor del objeto correspondiente
    				if(!elements[1]){
    								elements[1] = rcObject[cont].value;
    				}
    				//Verifica el operador si no existe coloca un igual
    				if(!elements[2]){
    							elements[2] = '=';
    			}
    			 triadas[cont] = elements.join(",");
    }
    if(!debug)
    	debug=false;
    params = triadas.join("|");
    
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.fncrtnvalue, "AutoCompletar::autoReference", Array(sqlId,params),debug);
 			return ;
 }
function loadModelosByMarca(url,action,objCombo,marccodigos){

	rtnSelect = objCombo;
	var params = 'action='+action+'&marccodigos='+marccodigos;
	//alert(params);
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    postBody: params,
	    // Handle successful response
	    onSuccess: loadSelect,
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

function loadSelect(req){

	var result = eval(req.responseText);
	
	if(result == false){
		//se limpia el combo
		rtnSelect.options.length = 0;
		rtnSelect.options[0] = new Option("---" ,"");
		return false;
	}
	
	//se limpia el combo
	rtnSelect.options.length = 0;
	rtnSelect.options[0] = new Option("---" ,"");
	
	//se carga el combo
 	nuCant = result.length;
 	
 	for(nuCont=0;nuCont<nuCant;nuCont++)
 	{
 		rtnSelect.options[nuCont + 1] = new Option(result[nuCont][1],result[nuCont][0]);
 	} 
	return true;
}

function fcnDebug(req)
{
	contenedor = document.getElementById('debug');
	contenedor.innerHTML = req.responseText;
}