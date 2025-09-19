/**
*
* @propiedad intekectual de FullEngine
* @author freina<freina@parquesoft.com>
* @date 05-Jul-2005
* @param string sqlId Identificador del sql en la compuerta
* @param string params nombres de las variables parametro, valores(opcional) y operadores(opcional) separadas por pipe("|"), 
*            Si el operador no es enunciado se asume que es un igual, si el valor no es pasado se buscara en ese mismo orden en el vector 
*			  con los objetos (rcObject)
*            Ej;  ciudcodigos|depacodigos|paiscodigos,3,=
* @param array rcObject Vector con los objetos parametro que pertenecen a la forma
			Ej; para el corresponder al ejemplo anterior
			array(this,this.form.depacodigos)
			Nota: Este ejemplo nos indica que se traiga el nombre de una ciudad digitada ("this") que pertenezca a un departamento 
			digitado("this.form.depacodigos") y que a su vez pertenezca a un pais con el codigo igual a tres, siempre se coloca como primer 
			elemento el objeto actual.
* @param object rtnObject (Objeto tipo select donde se pintara el resultado)
* @param boolean debug para pintar el debug, por defecto en false
*@param string CleanDescendants String with the name of the select descendants objects 
* 
*/
function LoadSelect(sqlId,params,rcObject,rtnObject,CleanDescendants,debug)
{
	homefield = rcObject[0];
	rtnfield = rtnObject;
    var rcTriadas = new Array();
    var rcCleanDescendants = new Array();
    rcTriadas = params.split("|");
    var nuCant = rcTriadas.length;
    var nuCantObjects = document.forms[0].length;
    var nuCantDescendantsObjects = 0;
    var nuContDescendantsObjects = 0;
    var rcElements = new Array();
    
    //limpiar los objetos descendientes 29-Sep-2005
    if(CleanDescendants){
    	rcCleanDescendants = CleanDescendants.split(",");
    	nuCantDescendantsObjects = rcCleanDescendants.length;
    	for(nuContDescendantsObjects=0;nuContDescendantsObjects<nuCantDescendantsObjects;nuContDescendantsObjects++){
    		for(nuCont=0;nuCont<nuCantObjects;nuCont++){
    			if(document.forms[0].elements[nuCont].name==rcCleanDescendants[nuContDescendantsObjects] 
    			&& document.forms[0].elements[nuCont].type=="select-one"){
    				//se limpia el combo
					document.forms[0].elements[nuCont].options.length = 0;
					document.forms[0].elements[nuCont].options[0] = new Option("---" ,"");
    			}
    		}
    	}
    }
    
    for(nuCont=0;nuCont<nuCant;nuCont++)
    {
    	rcElements = rcTriadas[nuCont].split(",");

    	//Verifica si el elemento tiene valor, si no lo carga con el valor del objeto correspondiente
    	if(!rcElements[1])
    	{
    		if(rcObject[nuCont].type=="text")
    		{
    			rcElements[1] = rcObject[nuCont].value;
    		}
    		else
    		{
    			if(rcObject[nuCont].type=="select-one")
    			{
    			    rcElements[1] = rcObject[nuCont].options[rcObject[nuCont].selectedIndex].value;
    			}
    		}
    	}
    	//Verifica el operador si no existe coloca un igual
    	if(!rcElements[2]){
    		rcElements[2] = '=';
    	}
    	rcTriadas[nuCont] = rcElements.join(",");
    }
    if(!debug){
    	debug=false;
    }
    params = rcTriadas.join("|");
    
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.RtnValue, "AutoCompletar::Select", Array(sqlId,params),debug);
 	return ;
 }
 
 /**
 @propiedad intekectual de FullEngine
* @author freina<freina@parquesoft.com>
* @date 05-Jul-2005
* @param string sbValue valor a cargar dupla valor,label (|)
* 
 */
function RtnValue(sbValue){

	var nuCont=0;
	var nuCant=0;
	var rcRows = new Array();
	var rcDuplas = new Array();
	
	//se limpia el combo
	rtnfield.options.length = 0;
	rtnfield.options[0] = new Option("---" ,"");
	
	if(sbValue == "null"){
	    homefield.focus();
	    return;
	}
	
	//se carga el combo
 	rcRows = sbValue.split("|");
 	nuCant = rcRows.length;
 	
 	for(nuCont=0;nuCont<nuCant;nuCont++)
 	{
 		rcDuplas = rcRows[nuCont].split("___SEPARADOR___");
 		rcDuplas[1] = unescape(rcDuplas[1].replace(/\+/g, " "));
 		rtnfield.options[nuCont + 1] = new Option(rcDuplas[1],rcDuplas[0]);
 	} 
	
	return;
}