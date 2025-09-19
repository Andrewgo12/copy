<?php
/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Pone el foco en el objeto requerido
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 12-oct-2004 9:17:43
	* @location Cali-Colombia
*/
function smarty_function_putfocus($params,&$smarty) {

	extract($params);
	if($focusObject)
		$action = "\tdocument.$form_name.$focusObject.focus();";
	else
		$action = "\tputFocus();";
	$rcHtml[] =  "\n<script language='javascript'>";
	$rcHtml[] = $action;
	$rcHtml[] =  "</script>";
	echo implode("\n",$rcHtml);
}
?>