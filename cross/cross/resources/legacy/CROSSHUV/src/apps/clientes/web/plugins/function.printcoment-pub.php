<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta la etiqueta desde un arreglo en sesion
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_function_printcoment_pub($params, &$smarty) 
{
	//se organiza el arreglo
	if(isset($params) && is_string($params)){
		extract($params);
	}
	if(!$name){
		return;
	}
	$rclabels = WebSession::getProperty("labels");
	if(!is_array($rclabels)){
		$sbtmp .= $name;
	}
	else{
		$sbtmp .= $rclabels[$name][2];
	} 
	return  $sbtmp;
}
?>