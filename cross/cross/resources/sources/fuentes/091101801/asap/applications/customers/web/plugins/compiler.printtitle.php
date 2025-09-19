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

function smarty_compiler_printtitle($params, &$smarty) 
{
	settype($rctmp,"array");
	settype($rctmpindice,"array");
	settype($nucont,"integer");
	settype($nucant,"integer");
	settype($sbtmp,"string");
	settype($sbtitle,"string");
	
	//se organiza el arreglo
	if(isset($params)){
		parse_str($params);
	}

	$sbtitle = WebSession::getProperty("title");
	
	$sbtmp = "echo \"";
	if(!($sbtitle)){
		$sbtmp .= $title;
	}
	else{
		$sbtmp .= $sbtitle;
	} 
	return  $sbtmp."\";";
}
?>
