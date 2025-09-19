<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta un texto que saca del $_REQUEST
*	@param array  
*	@author freina<freina@parquesoft.com>
*	@date 17-Mar-2006 10:49 
*	@location Cali-Colombia
*/

function smarty_function_printtext($params, & $smarty){
	
	settype($sbHtml,"string");

	extract($params);
	
	if(!$name){
		return null;
	}
	
	if($_REQUEST[$name]){
		$sbHtml = $_REQUEST[$name];
	}
	else{
		return null;
	}
	
	if($blBold) {
		$sbHtml = "<B>".$sbHtml."</B>";
	}
	return  $sbHtml;
}
?>