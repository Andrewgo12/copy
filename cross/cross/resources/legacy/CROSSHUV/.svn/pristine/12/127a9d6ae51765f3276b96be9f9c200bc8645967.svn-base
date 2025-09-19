<?php  
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* 
* padre = Nombre del objeto HTML padre
* Smarty plugin Pinta el lista de las localizacions
* @author creyes <cesar.reyes@parquesoft.com>
* @date 29-nov-2004 13:10:32
* @location Cali-Colombia
*/
function smarty_function_select_personal($params, & $smarty) {
	extract($params);
	//busca el valor del ente padre
	if(!$_REQUEST[$padre]){
		$sbhtml_result = "<select name='$name' id='$id'><option value=''>---</option></select>";
		return $sbhtml_result;
	}
	//Carga el servicio del modulo de human resources
	$humanService = Application :: loadServices("Human_resources");
	$rcPersonal = $humanService->getpersonalByOrganizacion($_REQUEST[$padre]);
	//echo "<pre>";
	//print_r($rcPersonal);
	//echo "</pre>";
	if (!is_array($rcPersonal)) {
		$sbhtml_result = "<select name='$name' id='$id'><option value=''>---</option></select>";
		return $sbhtml_result;
	}
	if ($command_default) {
		$sbcommand = " onchange=\"action.value = '".$command_default."';submit();\" ";
	}
	$sbhtml_result = "<select name='".$name."' id='".$id."' $sbcommand>\n";
	foreach ($rcPersonal as $rcTmpLocal) {
		if ($_REQUEST[$name] == $rcTmpLocal["perscodigos"])
			$selected = "selected";
		$rcList[] = "\t<option value='".$rcTmpLocal["perscodigos"]."' $selected>".$rcTmpLocal["persnombres"]."</option>";
		$selected = "";
	}
	$sbhtml_result .= "<option value=''>---</option>".implode("\n", $rcList)."\n</select>\n";
	return $sbhtml_result;
}
?>