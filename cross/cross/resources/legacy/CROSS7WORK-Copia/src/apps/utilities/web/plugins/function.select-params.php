<?php 
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * @copyright Copyright 2006 &copy; FullEngine
 * Type:     function
 * Name:     select_row_table
 * Version:  1.0
 * Date:     Mar 22, 2006
 * Author:	 Mario F. Restrepo <mrestrepo@parquesoft.com>
 * Purpose:  Draw a select input wich values comes into formal params
 			(Dibuja una lista de selección, cuyos valores vienen en los parametros)
 * Input:	name
 			id
 			value -> if exists
 			rcValues -> array like {id=>value} list
 * Output:	html string
 * --------------------------------------------------------------------
 */
function smarty_function_select_params($params, & $smarty)
{
	extract($params);
	extract($_REQUEST);
	
	settype($sbid, "string");
	settype($nuCont, "integer");
	
	$rcUser = Application::getUserParam();

	$html_result = '';
	$html_result .= "<select name=".$name." id=".$id.">";
	$html_result .= "<option value=''>---</optional>";

	$nuTam = sizeof($rcValues);
	while (list($sbKey,$sbValue) = each($rcValues))
	{
		$html_result .= "<option value='";
		$html_result .= $sbKey;
		if (strtoupper($value) == strtoupper($sbValue))
			$html_result .= "' selected>";
		else
			$html_result .= "'>";
		if(!is_array($sbValue))
			$html_result .= $sbValue;
		$html_result .= "</option>";
	}
	$html_result .= "</select>";
	return $html_result;
}
?>