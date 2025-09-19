<?php 
/**Copyright 2004 © FullEngine
	
	 Pinta el boton de limpiar el password
	@param datatype paramname description
	@return datatype description
	@author freina <freina@parquesoft.com>
	@date 17-Mar-2006 11:03:00
	@location Cali - Colombia
*/
function smarty_function_btn_clean_pass($params, & $smarty) {
	extract($params);
	
	$sbprefijo = Application :: getAppId();
	$html_result = "<input class=boton type='button' value='' name='CmdCleanpass' id='CmdCleanpass' onClick=\"disableButtons();action.value='".$sbprefijo."CmdDefault$table_name';clean_pass.value='$table_name'; $form_name.submit();\">";
	$html_result .= "<input type='hidden' name='clean_pass'>";
	print $html_result;
}
?>