<?php 
/**Copyright 2004 © FullEngine
	 Pinta el boton de limpiar
	@param datatype paramname description
	@return datatype description
	@author creyes <cesar.reyes@parquesoft.com>
	@date 06-sep-2004 15:40:53
	@location Cali - Colombia
*/
function smarty_function_closebutton($params, & $smarty) {
	extract($params);
	extract($_REQUEST);
	
	$html_result = "<input class='boton' type='button' value='' name='CmdClose' id='CmdClose' onClick=\"window.close();\">";
	return $html_result;
}
?>