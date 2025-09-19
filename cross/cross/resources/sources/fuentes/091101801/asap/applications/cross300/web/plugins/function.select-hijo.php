<?php 

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_hijo
 * Version:  1.0
 * Date:     Oct 30, 2003
 * Author:	 Leider Roldan Vivas M.<leiderv@parquesoft.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      table_hijo = is the name of the table child (required)
 *      id_hijo = is the primary of the table child (required)
 *      label_hijo = is the value of the field in the table child (optional)
 *      select_papa = name of the select father(required)
 *
 * Examples: 
 *
 *    {select_father name="operacion__id_tipo_pieza"
 *    table_papa="tipo_pieza" id_papa="id" label_papa="nombre" command_default="CmdDefaultOperacion"}
 *
 *    {select_hijo name="operacion__id_modelo_pieza"
 *    table_hijo="modelo_pieza" id_hijo="id" label_hijo="nombre"
 *    select_papa="operacion__id_tipo_pieza"
 *    command_default="CmdDefaultOperacion"}
 *
 *    {select_hijo name="operacion__id_parte_pieza"
 *    table_hijo="Parte_pieza" id_hijo="id" label_hijo="nombre"
 *    select_papa="operacion__id_modelo_pieza,operacion__id_tipo_pieza"
 *    command_default="CmdDefaultOperacion"}
 *
 * --------------------------------------------------------------------
 */

function smarty_function_select_hijo($params, & $smarty) {
	extract($params);

	$html_result = '';
	if (isset($command_default))
		$html_result .= "<select name='".$name."' id='".$id_hijo."' onchange=\"action.value = '".$command_default."';submit();\">";
	else
		$html_result .= "<select name='".$name."' id='".$id_hijo."' >";
	

	$v = explode(",", $select_papa);

	for ($i = 0; $i < count($v); $i ++) {
		$parametros .= $_REQUEST[$v[$i]].',';
	}
	$parametros = substr($parametros, 0, -1);
	$vector = explode(",", $parametros);

	if (($_REQUEST[$v[0]] != '')) {

		$gateway_hijo = Application :: getDataGateway("$table_hijo");

		$hijo = call_user_func_array(array ($gateway_hijo, "getBy".$table_hijo."_A"), $vector);

		$html_result .= "<option value=''>---</option>";

		for ($i = 0; $i < count($hijo); $i ++) {
			$html_result .= "<option value='";
			$html_result .= $hijo[$i][$id_hijo];
			if ($_REQUEST[$name] == $hijo[$i][$id_hijo]) {
				$html_result .= "' selected>";
			} else {
				$html_result .= "'>";
			}

			$html_result .= $hijo[$i][$label_hijo];
			$html_result .= "</option>";
		}
	} else {
		$html_result .= "<option value=''>---</option>";
	}

	$html_result .= "</select>";

	print $html_result;

}

?>
