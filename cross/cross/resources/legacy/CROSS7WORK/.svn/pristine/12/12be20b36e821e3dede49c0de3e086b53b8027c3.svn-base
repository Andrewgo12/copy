<?php 
/**Copyright 2004 © FullEngine
	
	 Pinta un objeto field set con la ayuda contextual de cada forma
	@param string $params 
	@return object $smarty
	@author creyes <cesar.reyes@parquesoft.com>
	@date 06-sep-2004 13:01:38
	@location Cali - Colombia
*/
function smarty_function_help_context_pub($params, & $smarty) {
	settype($rctmp, "array");
	settype($rctmpindice, "array");
	settype($nucont, "integer");
	settype($nucant, "integer");
	settype($sbtmp, "string");
	settype($sbtitle, "string");

	//se organiza el arreglo
	if (isset ($params) && is_string($params)) {
		parse_str($params);
	}

	$context_help = WebSession :: getProperty("context_help");
	
	//Escapa las comillas dobles y las sencillas
	$context_help = str_replace('"','\\"',$context_help);
	$context_help = str_replace("'","\\'",$context_help);
	$result = "<fieldset class=context_help>";
	$result .= "&nbsp;&nbsp;";
	$result .= $context_help;
	$result .= "</fieldset>";
	return $result;
}
?>