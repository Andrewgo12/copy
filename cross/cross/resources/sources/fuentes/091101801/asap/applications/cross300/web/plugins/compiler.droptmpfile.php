<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Elimina el archivo temporal
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_compiler_droptmpfile($params, &$smarty) 
{
	WebSession::unsetProperty("labels");
	WebSession::unsetProperty("labelscommands");
	WebSession::unsetProperty("title");
	return;
}
?>