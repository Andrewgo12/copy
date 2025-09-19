<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pone el estilo de las forma pubica de solicitante
*	@param array  
*	@author cazapata
*	@date 19-Ago-2021 12:40 
*	@location Cali-Colombia
*/

function smarty_function_putstylepub($params, &$smarty) 
{
	extract($params);
	
	if($style)
		return "<link href=\"web/css/$style\" rel=\"stylesheet\" type=\"text/css\">";
	$rcuser = Application::getUserParam();
	if($rcuser["style"])
		return "<link href=\"web/css/".$rcuser["style"]."\" rel=\"stylesheet\" type=\"text/css\">";
}
?>