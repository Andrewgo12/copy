<?php 
/**Copyright 2004 � FullEngine
	
	 Pinta el boton de limpiar
	@param datatype paramname description
	@return datatype description
	@author freina <freina@parquesoft.com>
	@date 19-Oct-2004 10:37
	@location Cali - Colombia
	Input:
            command = name of command (required)
            form_name = nombre de la forma que contiene el btn_command
           (SI type = 'button' entonces form_name es requerido)
 
*/
function smarty_function_btn_cleanCE($params, & $smarty) {
	extract($params);
	
	$html_result = "<input class=boton type='button' value='' name='CmdClean' id='CmdClean' onClick=\"disableButtons();action.value='".$command."';clean_table.value='$table_name'; $form_name.submit();\">";
	$html_result .= "<input type='hidden' name='clean_table'>";
	print $html_result;
}
?>