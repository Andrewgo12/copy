/**
*
* @propiedad intekectual de FullEngine
* @author freina<freina@parquesoft.com>
* @date 01-Mar-2005
* @param string params nombres de las variables parametro, valores(opcional) separadas por pipe("|"), 
*            Si el valor no es pasado se buscara en ese mismo orden en el vector 
*			  con los objetos (rcObject)
*            Ej;  ciudcodigos|depacodigos|paiscodigos,3
* @param array rcObject Vector con los objetos parametro que pertenecen a la forma
			Ej; para el corresponder al ejemplo anterior
			array(this,this.form.depacodigos)
* @param object rtnIdObject (Id del div donde se dibujara el html)
* @param boolean debug para pintar el debug, por defecto en false
*@param string CleanDescendants String with the name of the select descendants objects 
* 
*/
function drawDynamicColumns (rtnIdObject,debug)
{
	//var params = getParams();
	var rcObject = getObjects();
	var rcTriadas = new Array();
	
    //rcTriadas = params.split("|");
    var nuCant = rcObject.length;
    var rcElements = new Array();
    sbIdObject = rtnIdObject;
    var nuRow = 0;
    
    for(nuCont=0;nuCont<nuCant;nuCont++){
    
    	if(rcObject[nuCont].type=="text" || rcObject[nuCont].type=="hidden"){
    		rcElements[0] = rcObject[nuCont].value;
    	}else{
    		if(rcObject[nuCont].type=="select-one"){
    			rcElements[0] = rcObject[nuCont].options[rcObject[nuCont].selectedIndex].value;
    		}
    	}
    		
    	if(rcElements[0]) {
    		rcElements[1] = rcObject[nuCont].id;
    		rcTriadas[nuRow] = rcElements.join(",");
    		nuRow ++;
    	}
    }
    if(!debug){
    	debug=false;
    }
    params = rcTriadas.join("|");
    
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.RtnHtml, "AutoCompletar::obtainHtmlDynamicColumns", Array(params),debug);
 	return ;
}
 /**
 @propiedad intekectual de FullEngine
* @author freina<freina@parquesoft.com>
* @date 05-Jul-2005
* @param string sbValue valor a cargar dupla valor,label (|)
* 
 */
function RtnHtml(sbValue)
{
	var newObject = document.getElementById(sbIdObject);
	if(sbValue)
	{
		newObject.innerHTML = decodeBase64(sbValue);
		jsDrawdiv(sbIdObject);
	}
	else
		jsErasediv(sbIdObject);
	return;
}


function getParams()
{
	var nuTam = document.forms[0].length;
	var sbReturn = '';
	for(nuCont=0;nuCont<(nuTam-1);nuCont++)
	{
		if(document.forms[0].elements[nuCont])
			if(document.forms[0].elements[nuCont].type)
				if(document.forms[0].elements[nuCont].type!="button" && document.forms[0].elements[nuCont].type!="password")
				{
					if(document.forms[0].elements[nuCont].id)
						sbReturn += document.forms[0].elements[nuCont].id+'|';
					else if(document.forms[0].elements[nuCont].name.indexOf('_')==-1)
						sbReturn += document.forms[0].elements[nuCont].name+'|';
				}
	}
	return sbReturn;
}


function getObjects()
{
	var nuTam = document.forms[0].length;
	var rcReturn = new Array();
	for(nuCont=0,nuAux=0;nuCont<(nuTam-1);nuCont++)
	{
		if(document.forms[0].elements[nuCont])
			if(document.forms[0].elements[nuCont].type)
				if(document.forms[0].elements[nuCont].type!="button" && document.forms[0].elements[nuCont].type!="password" && document.forms[0].elements[nuCont].name)
					rcReturn[nuAux++] = document.forms[0].elements[nuCont];
				
	}
	return rcReturn;
}