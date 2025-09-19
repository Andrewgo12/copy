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
function drawDynamicColumns (params,rcObject,rtnIdObject,debug)
{
	var rcTriadas = new Array();
    rcTriadas = params.split("|");
    var nuCant = rcTriadas.length;
    var rcElements = new Array();
    sbIdObject = rtnIdObject;
    
    for(nuCont=0;nuCont<nuCant;nuCont++){
    
    	rcElements = rcTriadas[nuCont].split(",");

    	//Verifica si el elemento tiene valor, si no lo carga con el valor del objeto correspondiente
    	if(!rcElements[1])    	{
    		if(rcObject[nuCont].type=="text"){
    			rcElements[1] = rcObject[nuCont].value;
    		}else{
    			if(rcObject[nuCont].type=="select-one"){
    			    rcElements[1] = rcObject[nuCont].options[rcObject[nuCont].selectedIndex].value;
    			}
    		}
    	}
    	rcTriadas[nuCont] = rcElements.join(",");
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