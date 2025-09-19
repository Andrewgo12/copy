<?php     
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta unas listas para la asignación de las acciones (Comandos) a un perfil
*	@param array  
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/

function smarty_function_listas_cargadas($params, & $smarty) {
	
	settype($objService, "object");
	settype($sbResult,"string");
	
	extract($_REQUEST);
	extract($params);
	
	//set memory limit
	$objService = Application :: loadServices("General");
	$sbResult = $objService->setMemoryLimit();
	
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}

	if (!$applcodigos || !$profcodigos)
		return false;
	//Trae todos los comandos de una app	
	$rcComandos = loadCommands($applcodigos);
	//Trae todos los comandos asignados a un perfil
	$rcAssignCom = loadAssignCom($schecodigon,$profcodigos);
	if (!is_array($rcComandos))
		$rcComandos = array ();
	if (!is_array($rcAssignCom))
		$rcAssignCom = array ();
	//Calcula la diferencia entre los vectores	
	//$rcComandos = array_diff($rcComandos, $rcAssignCom);
	//Arma las opciones para todas las acciones
	foreach ($rcComandos as $key => $command) {
		$value = $key."|".$command["path"]."|".$command["parent"]."|".$command["type"];
		//Verifica cual opcion debe ser selecionada
		if($rcAssignCom[$key]){
			$selected = "selected";
			$rcSelected[] = $key;
		}else
			$selected = "";
//		$rcHtml[] = "<option value='$value' $selected onclick=\"selectParents(this.form.selTipoCampos,'$key','".$command["path"]."',this.form.selectedElements)\">".$command["tree"]."</option>";
		$rcHtml[] = "<option value='$value' $selected>".$command["tree"]."</option>\n";
	}
	if(is_array($rcSelected))
		$sbHidden = implode(",",$rcSelected);
	else
		$sbHidden = "";
	if ($rcHtml)
		$sbAll = implode("\n", $rcHtml);
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	$sbCadena = "<table border='0' align='center' width='100%''><tr>
					<td><div align=\"center\">".$rclabels["todas"]["label"]."</div></td>
				 </tr>
				 <tr>
				 	<td>
					  <div align=\"center\">       
						<select name=\"selTipoCampos\" size=\"17\" multiple onchange=\"var rcObjeto = findSelected(this.form.selTipoCampos);selectParents(this.form.selTipoCampos,rcObjeto[0],rcObjeto[1],this.form.selectedElements)\">
							$sbAll	
						</select>
					  </div>
					</td>
				</tr></table><input type='hidden' name='selectedElements' value='$sbHidden'>";

	unset($rcHtml);
	unset($rcComandos);
	unset($rcAssignCom);
	
	//Restore memory limit
	if($sbResult){
		ini_restore ( "memory_limit");	
	}
	
	return $sbCadena;
}
/**
*   Propiedad intelectual del FullEngine.
*	
*	Trae la lista de todas las acciones(comandos) de una aplicación
*	@param string $applcodigos  
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/
function loadCommands($applcodigos) {
	$rcCommands = xsltTransform("metaProfile.xml");
	if (!is_array($rcCommands))
		return null;
	return $rcCommands;
}
/**
*   Propiedad intelectual del FullEngine.
*	
*	Trae la lista de todas las acciones(comandos) Asignadas a un perfil
*	@param string  $applcodigos 
*	@param string  $perfcodigos 
*	@author creyes
*  @date 19-ago-2004 15:11:06
*	@location Cali-Colombia
*/
function loadAssignCom($schecodigon,$profcodigos) {
	$rcCommands = xsltTransform($schecodigon."_".$profcodigos.".xml");
	if (!is_array($rcCommands))
		return null;
	return $rcCommands;
}
/**
* @Copyright 2004 © FullEngine
*
* 
* @param typedata
* @return typedata 
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-dic-2004 15:11:36
* modified
* @author freina <freina@parquesoft.com>
* @date 24-Aug-2011 20:28:00
* @location Cali - Colombia
*/
function xsltTransform($xmlFile) {
	settype($objXslDoc,"object");
	settype($objXmlDoc,"object");
	settype($objxh,"object");
	settype($rcuser,"array");
	settype($sbpath,"string");
	settype($sbresult,"string");
	settype($sbpathXsl,"string");
	settype($sbpathXml,"string");

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser))
	{
		//Si no existe usuario en sesion
		$rcuser["lang"] = Application :: getSingleLang();
	}
	include($rcuser["lang"]."/".$rcuser["lang"].".metaprofiles.php");

	//Path del modulo
	$sbpath = Application :: getBaseDirectory();
	$sbpathXsl = $sbpath."/xslt/GenerateProfile.xsl";

	//Path del Xml
	$sbpathXml = $sbpath."/config/profiles/$xmlFile";
	if(!file_exists($sbpathXml))
	return array();

	$objXslDoc = new DOMDocument();
	$objXslDoc->load($sbpathXsl);

	$objXmlDoc = new DOMDocument();
	$objXmlDoc->load($sbpathXml);

	$objxh = new XSLTProcessor();
	$objxh->importStylesheet($objXslDoc);
	$sbresult = $objxh->transformToXML($objXmlDoc);
	eval ($sbresult);
	unset($sbresult);
	return $rcNode;
}
?>