<?php 
/*** @Copyright 2004 © FullEngine
*
* Smarty plugin: Pinta el listado de consulta
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
*/

function smarty_function_loadDatosAppoint($params, & $smarty) {
	
	//extraemos datos de entorno
	extract($params);
	extract($_REQUEST);
	
	//algunos datos necesitan cambiar de formato
	if($date)
	{
		$objDate = Application::loadServices("DateController");
		$hora = $objDate->hour2secs($hour);
		$nuTimeStamp = $date+$hora;	
	}
	
	//Cargamos los datos que necesita la forma
	if(!$entrada__catecodigon)
		$_REQUEST["entrada__catecodigon"] = $catecodigon;
	if(!$entrada__entrfechorun && $date)
		$_REQUEST["entrada__entrfechorun"] = $objDate->fncformatofechahora($nuTimeStamp);
	if(!$entrada__entrduracion && $date)
		$_REQUEST["entrada__entrduracion"] = $objDate->fncformatofechahora($nuTimeStamp+($objDate->nuSecsDay/$objDate->nuhorasdia));
	if(!$focusposition)
		$_REQUEST["focusposition"] = "entrada__entrduracion";
	if($entrada__entractivas == Application::getConstant("REG_INACT"))
		$_REQUEST["disabledButton"] = true;
	$_REQUEST["date"] = $date;
}

?>
