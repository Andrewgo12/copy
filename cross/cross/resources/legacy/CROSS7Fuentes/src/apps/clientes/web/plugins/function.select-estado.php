<?php

/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Smarty plugin que pinta un combox con las opciones de activa e inactiva
	* @param datatype Name desc
	* @return datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 22-oct-2004 12:12:39
	* @location Cali-Colombia
*/
function smarty_function_select_estado($params,&$smarty) {
	extract($params);

	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}
	$table_name = strtolower($table);
	include($rcuser["lang"]."/".$rcuser["lang"].".$table.php");
	if(isset($id))
		$id  = " id= '$id' ";
		
	$html_result = "<select name='$name' size='$size' $id>\n";
	$html_result .= "\t<option value='A'";
	if ($_REQUEST[$name] == "A")
		$html_result .= " selected ";
	$html_result .= ">{$rcMsg["active"]}</option>\n";
		
	$html_result .= "\t<option value='I'";
	if ($_REQUEST[$name] == "I")
		$html_result .= " selected ";
	$html_result .= ">{$rcMsg["inactive"]}</option>\n";
	$html_result .= "</select>\n";
	echo $html_result;
}
?>