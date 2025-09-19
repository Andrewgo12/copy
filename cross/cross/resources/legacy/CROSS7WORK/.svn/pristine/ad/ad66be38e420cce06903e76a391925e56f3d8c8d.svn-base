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
function smarty_function_select_personal($params, & $smarty)
{
	settype($objService,"object");
	settype($rcPermissions,"array");
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($rcPersonal,"array");
	settype($rcList,"array");
	settype($sbHtml,"string");
	settype($sbSelected,"string");
	
	extract($params);
	$rcUser = Application::getUserParam();

	$objService = Application::loadServices("General");
	$rcPermissions = $objService->getParam("human_resources","permisos_personal");

	if(is_array($rcPermissions) && $rcPermissions){
		if(array_key_exists($rcUser["username"],$rcPermissions)){
			$rcTmp = $rcPermissions;
			unset($rcPermissions);
			$rcPermissions = $rcTmp[$rcUser["username"]];
		}
	}
	
	//Carga el servicio del modulo de human resources
	$objService = Application :: loadServices("Human_resources");
	$rcPersonal = $objService->getPersDatos($rcUser["username"],true);
	if(is_array($rcPersonal) && $rcPersonal){
		$rcPermissions[] = $rcPersonal["perscodigos"];
		unset($rcPersonal);
	}
	$rcPersonal = $objService->getPersonalbyUsername($rcPermissions);

	$sbHtml = "<select name='$name' id='$id' $onChange>";
	
	if($is_null){
		$sbHtml .= "<option value=''>---</option>";	
	}

	if (!is_array($rcPersonal)) {
		$sbHtml = "</select>";
		return $sbHtml;
	}

	foreach ($rcPersonal as $rcTmp){
		
		if(in_array($rcTmp["perscodigos"],$rcPermissions)){
			
			if ($_REQUEST[$name] == $rcTmp["perscodigos"]){
				$sbSelected = "selected";
			}
			
			$rcList[] = "\t<option value='".$rcTmp["perscodigos"]."' $sbSelected>".
			$rcTmp["persnombres"]." ".$rcTmp["persapell1s"]." ".$rcTmp["persapell2s"]." - ".$rcTmp["persusrnams"]."</option>";
			$sbSelected = "";
		}
	}
	if(is_array($rcList)){
		$sbHtml .= implode("\n", $rcList)."</select>";	
	}
	
	return $sbHtml;
}
?>