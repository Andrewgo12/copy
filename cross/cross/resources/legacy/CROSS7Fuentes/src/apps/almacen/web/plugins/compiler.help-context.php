<?php 
/**Copyright 2004 © FullEngine
	
	 Pinta un objeto field set con la ayuda contextual de cada forma
	@param string $params 
	@return object $smarty
	@author creyes <cesar.reyes@parquesoft.com>
	@date 06-sep-2004 13:01:38
	@location Cali - Colombia
*/
function smarty_compiler_help_context($params, & $smarty) {
	settype($rctmp, "array");
	settype($rctmpindice, "array");
	settype($nucont, "integer");
	settype($nucant, "integer");
	settype($sbtmp, "string");
	settype($sbtitle, "string");

	//se organiza el arreglo
	if (isset ($params)) {
		parse_str($params);
	}

	$context_help = WebSession :: getProperty("context_help");
	if(!$context_help)
		return "echo \"&nbsp;\"";
	//Escapa las comillas dobles y las sencillas
	$context_help = str_replace('"','\\"',$context_help);
	$context_help = str_replace("'","\\'",$context_help);
	$result = "echo \"<fieldset class=context_help>";
	$result .= "&nbsp;&nbsp;";
	$result .= $context_help;
	$result .= "</fieldset>\"";
	
	//$result = "echo \"<script language='javascript' src='web/js/overlib_mini.js'></script>
	//				<div id='overDiv' style='position:absolute; visibility:hidden; z-index:1000;'></div>
	//				<div align='right'><a href='#' onMouseOver=\\\"overlib('$context_help');return true;\\\" onMouseOut=\\\"nd(); return true;\\\" onFocus=\\\"overlib('$context_help');return true;\\\" onBlur=\\\"nd(); return true;\\\" accesskey=\\\"H\\\"><img src='web/images/ayuda.gif' border='0' /><div></a>\"";
	return $result;
}
?>