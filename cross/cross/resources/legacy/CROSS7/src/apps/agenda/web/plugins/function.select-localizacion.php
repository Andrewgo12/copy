<?php 
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* command_default = nombre del comando ejecutar en el submit (opcional)
* padre = Nombre del objeto HTML padre (opcional)
* cod_padre = Codigo del ente padre (opcional)
* nivel = Nivel jerarquico de la localizaci�n Ej; 1 o 2 ... etc (opcional)
* tipo = Nombre tipo de localizacion Ej: geografia o almacenamianto ... etc
* Smarty plugin Pinta el lista de las localizacions
* @author creyes <cesar.reyes@parquesoft.com>
* @date 10-nov-2004 16:36:32
* @location Cali-Colombia
*/
function smarty_function_select_localizacion($params, & $smarty) {
	extract($params);
	
	settype($sbCommand,"string"); 
	
	if ($command_default) {
		$sbCommand = " onchange=\"action.value = '".$command_default."';submit();\" ";
	}else{
		if($onchange){
			$sbCommand = " onchange=\"".$onchange."\" ";
		}
	}
	
	//busca el valor del ente padre
	if(strlen($cod_padre)){
		$locacodpadrs = $cod_padre;
	}else{
		if(isset($padre)){
			if(strlen($_REQUEST[$padre]))
				$locacodpadrs = $_REQUEST[$padre];
			else{
				$sbhtml_result = "<select name='$name' id='$id' ".$sbCommand."><option value=''>---</option></select>";
				return $sbhtml_result;		
			}
		}
	}
	//Carga el servicio del modulo general y consulta las localizaciones
	$localizacionService = Application :: loadServices("General");
	$rcLocalizaciones = $localizacionService->getLocalizaciones($tipo, $nivel ,$locacodpadrs);
	if(!is_array($rcLocalizaciones)){
		$sbhtml_result = "<select name='$name' id='$id' ".$sbCommand."><option value=''>---</option></select>";
		return $sbhtml_result;		
	}
	
	$sbhtml_result = "<select name='".$name."' id='".$id."' ".$sbCommand.">\n";
	foreach($rcLocalizaciones as $rcTmpLocal){
		if($_REQUEST[$name] == $rcTmpLocal["locacodigos"])
			$selected = "selected";
		$rcList[] = "\t<option value='{$rcTmpLocal["locacodigos"]}' $selected>{$rcTmpLocal["locanombres"]}</option>";
		$selected = "";
	}
	$sbhtml_result .= "<option value=''>---</option>".implode("\n",$rcList)."\n</select>\n";
	return $sbhtml_result;
}
?>