<?php 
/**Copyright 2004 © FullEngine
	 Pinta el boton de limpiar
	@param datatype paramname description
	@return datatype description
	@author creyes <cesar.reyes@parquesoft.com>
	@date 06-sep-2004 15:40:53
	@location Cali - Colombia
*/
function smarty_function_btn_clean($params, & $smarty) {
	extract($params);
	
	$sbprefijo = Application :: getAppId();
	$html_result = "<input class=boton type='button' value='Limpiar' name='CmdClean' id='CmdClean' onClick=\"disableButtons();action.value='".$sbprefijo."CmdDefault$table_name';clean_table.value='$table_name'; $onClick $form_name.submit();\">";
	$html_result .= "<input type='hidden' name='clean_table'>";
	return $html_result;
}
?>