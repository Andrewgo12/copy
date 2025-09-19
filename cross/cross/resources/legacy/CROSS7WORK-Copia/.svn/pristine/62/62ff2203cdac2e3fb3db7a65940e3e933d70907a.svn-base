<?php   
/**
	Copyright 2004 FullEngine
	
	Pinta un select con la data obtenida de un servicio.
	La data debe estar almacenada en un array
	@author freina <freina@parquesoft.com>
	@date 02-Sep-2004 10:13
	@location Cali-Colombia
*/
function smarty_function_showCustomer($params, & $smarty) {

	settype($rcdata, "array");
	settype($html_result, "string");

	extract($_REQUEST);
	
	//Carga el servicio del general
	$obj = Application :: loadServices("Customers");

	//obtiene la data
	$rcdata = $obj->getByIdCliente($cliecodigos);
	
	if(is_array($rcdata))
		return $html_result .= "<h2>".$rcdata[0]["clienombres"]."</h2>";
	else
		return null;
}
?>