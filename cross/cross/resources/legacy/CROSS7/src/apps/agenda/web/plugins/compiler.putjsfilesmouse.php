<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Incluye los archivos js genericos
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_compiler_putjsfilesMouse($params, &$smarty) 
{
	settype($rctmp,"array");
	settype($rctmpindice,"array");
	settype($rcuserfiles,"array");
	settype($sbtmp,"string");
	settype($nucont,"integer");
	settype($nucant,"integer");
	
	//se organiza el arreglo
	if(isset($params)){
		parse_str($params);
	}

	//Adicione aca los archivos
	$nucont = 0;
	$rcfiles = array("jsrsClient.js","jsAccessKey.js","putFocus.js","optionKey.js","disableButtons.js");

	if(is_array($files)){
		$rcfiles = array_merge($rcfiles,$files);
	}
	
	if(!sizeof($rcfiles)){
		return;	
	}
		
	foreach($rcfiles as $file){
		
		$rctmp[$nucont] = "<script language=\"javascript\" src=\"web/js/$file\" type=\"text/javascript\"></script>";
		$nucont ++;
	}
	
	$sbtmp = "echo '";
	$sbtmp .=  implode("\n",$rctmp);
	return $sbtmp."'";
}
?>
