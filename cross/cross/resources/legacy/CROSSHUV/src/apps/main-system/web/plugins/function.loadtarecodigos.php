<?php  
/**
* @Copyright 2004 � FullEngine
*
* Smarty plugin
* Pinta el listado de ordenes
* @author creyes <cesar.reyes@parquesoft.com>
* @date 09-dic-2004 10:26:01
* @location Cali - Colombia
*/
function smarty_function_loadTarecodigos($params, & $smarty)
{
	$objGeneral = Application::loadServices("General");
	$seguimiento = $objGeneral->getParam("cross300","TAREA_SEGUIMIENTO");
	$_REQUEST["tarecodigos"] = $seguimiento;
}
?>