<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pone el estilo de las formas
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/
function smarty_function_putstyle($params, &$smarty) 
{
	extract($params);
	
	if($style)
		return "<link href=\"web/css/$style\" rel=\"stylesheet\" type=\"text/css\">";
	$rcuser = Application::getUserParam();
	if($rcuser["style"])
		return "<link href=\"web/css/".$rcuser["style"]."\" rel=\"stylesheet\" type=\"text/css\">";
}
?>