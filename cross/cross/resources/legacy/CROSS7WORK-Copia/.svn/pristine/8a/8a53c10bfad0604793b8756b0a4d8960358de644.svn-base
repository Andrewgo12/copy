<?php   
/**
	Copyright 2004 FullEngine
	
	Pinta un select con la data obtenida de un servicio.
	La data debe estar almacenada en un array
	@author freina <freina@parquesoft.com>
	@date 02-Sep-2004 10:13
	@location Cali-Colombia
*/
function smarty_function_select_estadostareaSinActa($params, & $smarty) {

	extract($params);
	extract($_REQUEST);
	
	settype($rctmp, "array");
	settype($rcdata, "array");
	settype($html_result, "string");
	settype($sbindex, "string");
    
	//Carga el servicio del general
	//$obj = Application :: loadServices("Workflow");
    $obj = Application::getDataGateway('SqlExtended');

	//obtiene la data
	$rcdata = $obj->getEstadostarea();

	if (!isset ($label)) {
		$label = $value;
	}
	if (!isset ($size)) {
		$size = 1;
	}

	$html_result .= "<select name='$name' size='$size' id='$id'>";
	if ($is_null == "true") {
		$html_result .= "<option value=''>---</optional>";
	}
	if ($rcdata && is_array($rcdata)) {
		
		foreach ($rcdata as $sbindex => $rctmp) {
			$html_result .= "<option value='";
			$html_result .= $rctmp[$value];
			if ($_REQUEST[$name] == $rctmp[$value]) {
				$html_result .= "' selected>";
			} else {
				$html_result .= "'>";
			}
			$html_result .= $rctmp[$label];
			$html_result .= "</option>";
		}
	}
	$html_result .= "</select>";
	print $html_result;
}
?>