<?php   
/**
	Copyright 2004 FullEngine
	
	Pinta un select con la data obtenida de un servicio.
	La data debe estar almacenada en un array
	@author freina <freina@parquesoft.com>
	@date 02-Sep-2004 10:13
	@location Cali-Colombia
*/
function smarty_function_cambiarIdioma($params, & $smarty) {

	extract($params);
	settype($rctmp, "array");
	settype($rcdata, "array");
	settype($html_result, "string");
	settype($sbindex, "string");

	//Carga el servicio del general
	$obj = Application :: loadServices("Profiles");

	//obtiene la data
	$rcdata = $obj->getAllLanguage();

	if ($rcdata && is_array($rcdata)) {
		foreach ($rcdata as $sbindex => $rctmp) {
			$html_result .= "<img width=45 height=30 src='web/images/".$rctmp["langcodigos"].".jpg' title='".$rctmp["langnombres"]."' 
						onClick=\"cambiarIdioma('".$rctmp["langcodigos"]."');\">&nbsp;&nbsp;";
		}
	}
	return $html_result;
}
?>