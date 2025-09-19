<?php   
/**
	Copyright 2004 FullEngine
	
	Pinta un select con la data obtenida de un servicio.
	La data debe estar almacenada en un array
	@author freina <freina@parquesoft.com>
	@date 02-Sep-2004 10:13
	@location Cali-Colombia
*/
function smarty_function_select_authpersonal($params, & $smarty) {

	extract($params);
	settype($rctmp, "array");
	settype($rcdata, "array");
	settype($html_result, "string");
	settype($sbindex, "string");

	//Carga el servicio del general
	$obj = Application :: loadServices($service);

	//obtiene la data
	$rcdata = $obj->$method();

	if (!isset ($label)) {
		$label = $value;
	}
	if (!isset ($size)) {
		$size = 1;
	}
	
	if($onchange){
		$onchange = " onChange=\"".$onchange."\" ";
	}

	$html_result .= "<select name='$name' size='$size' id='$id' $onchange>";
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
			$html_result .= $rctmp["persnombres"]." ".$rctmp["persapell1s"];
			$html_result .= "</option>";
		}
	}
	$html_result .= "</select>";
	print $html_result;
}
?>