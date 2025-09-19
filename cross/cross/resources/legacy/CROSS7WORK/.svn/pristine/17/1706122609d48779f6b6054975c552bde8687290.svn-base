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

function smarty_function_loadPerscodigos($params, & $smarty)
{
	if(!$_REQUEST["perscodigos"]){
		$rcUser = Application::getUserParam();
		$objService = Application :: loadServices("Human_resources");
		$sbUserName = $rcUser["username"];
		$rcPersonal = $objService->getPersDatos($sbUserName);
		$perscodigos = $rcPersonal["perscodigos"];
		$_REQUEST["usuacodigos"] = $perscodigos;
		$_REQUEST["perscodigos"] = $perscodigos;
	}
}
?>