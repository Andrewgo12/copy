<?php
/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Limpia de la sesion el vector con los recusros 
	* @param datatype Name desc
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 11-oct-2004 14:38:51
	* @location Cali-Colombia
*/
function smarty_function_cleansession($params, & $smarty){
	extract($params);
	if(!isset($signal))
		unset($_SESSION["genericData"]);
	return;
}	
?>