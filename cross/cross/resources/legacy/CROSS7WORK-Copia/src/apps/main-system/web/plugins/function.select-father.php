<?php 
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_father
 * Version:  1.0
 * Date:     Oct 31, 2003
 * Author:	 Leider Roldan Vivas <leiderv@hotmail.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      table_papa = is the name of the table father (required)
 *      id_papa = is the primary of the table father (required)
 *      label_papa = is the value of the field in the table father (optional)
 *      command_default = name of the command
 *
 * Examples: 
 *
 *    {select_father name="operacion__id_tipo_pieza"
 *    table_papa="tipo_pieza" id_papa="id" label_papa="nombre"
 *    command_default="CmdDefaultOperacion"}
 *
 *
 *
 *  Necesita estar dentro de una forma para que funcione.
 * --------------------------------------------------------------------
 */

function smarty_function_select_father($params, & $smarty) {
	extract($params);

	//llama a la compuerta del select father
	$gateway_papa = Application :: getDataGateway("$table_papa");
	$v_papa = call_user_func(array ($gateway_papa, "getAll$table_papa"));

	$html_result = '';
	generar_select($v_papa, $html_result, $name, $id_papa, $label_papa, $command_default);

	return $html_result;

}

function generar_select($vect, & $html_result, $name, $id_papa, $label_papa, $command_default) {

	//llena el select father
	$html_result .= "<select name='".$name."' id='".$id_papa."' onchange=\"action.value = '".$command_default."';submit();\">";

	$html_result .= "<option value=''>---</option>";

	for ($i = 0; $i < count($vect); $i ++) {
		$html_result .= "<option value='";
		$html_result .= $vect[$i][$id_papa];
		if ($_REQUEST[$name] == $vect[$i][$id_papa]) {
			$html_result .= "' selected>";
		} else {

			$html_result .= "'>";
		}
		$html_result .= $vect[$i][$label_papa];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";

}

?>
