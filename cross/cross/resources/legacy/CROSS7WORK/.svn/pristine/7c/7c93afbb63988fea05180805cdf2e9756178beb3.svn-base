<?php
/**
* @Copyright 2004 © FullEngine
*
* Smarty plugin 
* Pinta un input tipo hidden con el id de la aplicacion sacandolo de los datos
* de sesion del usuario
* @author creyes <cesar.reyes@parquesoft.com>
* @date 17-dic-2004 10:47:16
* @location Cali - Colombia
*/
function smarty_function_set_application($params, & $smarty) {
	extract($params);
	//Obtiene los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser))
		return null;
	$_REQUEST["$name"] = $rcuser["app_code"];
	$sbCadena = "<input type='hidden' name='$name' value='".$rcuser["app_code"]."'>";
	return $sbCadena; 
}
?>
