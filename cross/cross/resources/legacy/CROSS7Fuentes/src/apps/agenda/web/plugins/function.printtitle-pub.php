<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta el titulo desde un arreglo en sesion
*	@param array  
*	@author freina
*	@date 22-Jul-2004 06:19 
*	@location Cali-Colombia
*/

function smarty_function_printtitle_pub($params, &$smarty) 
{
	extract($params);
	settype($rctmp,"array");
	settype($rctmpindice,"array");
	settype($nucont,"integer");
	settype($nucant,"integer");
	settype($sbtmp,"string");
	settype($sbtitle,"string");
	
	//se organiza el arreglo
	if(isset($params) && is_string($params)){
		parse_str($params);
	}

	$sbtitle = WebSession::getProperty("title");
	
	if(!($sbtitle)){
		$sbtmp .= $title;
	}
	else{
		$sbtmp .= $sbtitle;
	} 
	return  $sbtmp;
}
?>
