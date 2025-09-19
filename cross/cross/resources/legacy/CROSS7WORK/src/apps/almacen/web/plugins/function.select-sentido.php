<?php 
/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Pinta una lista despleglable con los sentidos de movimiento, solo esta en la forma de concepmovimi
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 30-sep-2004 13:52:03
	* @location Cali-Colombia
*/
function smarty_function_select_sentido() {
	//Obtiene los datos del usuario
	$rcUser = Application::getUserParam();
	if(!is_array($rcUser)){
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application::getSingleLang();
	}
	include($rcUser["lang"]."/".$rcUser["lang"].".concepmovimi.php");

	$rcDatos = array(
									array($rclabels["inside"]["label"],"+"),
									array($rclabels["outside"]["label"],"-"),
								);
	$html_result = "<select name='concepmovimi__comosentidos'  id='comosentidos'>";
	$html_result .= "<option value=''>---</optional>";
	foreach($rcDatos as $rcOption){
		$html_result .= "<option value='";
		$html_result .= $rcOption[1];
		if ($_REQUEST["concepmovimi__comosentidos"] == $rcOption[1]) {
			$html_result .= "' selected>";
		} else {
			$html_result .= "'>";
		}
		$html_result .= $rcOption[0];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";
	print $html_result;
}
?>