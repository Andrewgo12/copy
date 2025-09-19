<?php
function smarty_function_viewPestanas($params, &$smarty)
{
	settype($sbCadena,"string");
	settype($rcSchemas,"array");
	
    extract($params);
    extract($_REQUEST);
    
	$objProfiles = Application::loadServices("Profiles");
	$rcSchemas = $objProfiles->getSessionSchema();
	
	if($rcSchemas){
		$sbCadena .= $rcSchemas[0]["schenombres"];
		$_REQUEST["schema"] = $rcSchemas[0]["schecodigon"];
		$_REQUEST["schecodigon"] = $rcSchemas[0]["schecodigon"];
	}
	return $sbCadena;
}
?>