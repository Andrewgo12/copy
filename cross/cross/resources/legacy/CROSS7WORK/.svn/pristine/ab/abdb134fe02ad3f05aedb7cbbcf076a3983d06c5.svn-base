<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Pinta el enlace para crear una nueva solución
* según los permisos
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-sep-2004 9:05:31
* @location Cali-Colombia
*/
function smarty_function_newsolucion($params, &$smarty){

    //Valida los permisos de usuario
    if(Application :: validateProfiles('FeCrCmdDefaultSolucion') == false)
		return null;
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
    include ($rcUser["lang"]."/".$rcUser["lang"].".consultsolucion.php");
    return "<a href='index.php?action=FeCrCmdDefaultSolucion' title='{$rclabels['new']['commentary']}'>{$rclabels['new']['label']}</a> | ";
}