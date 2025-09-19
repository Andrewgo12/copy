<?php  
/*
 * Smarty plugin
 * Type:     function
 * Name:     btn_commandCE
 * Version:  1.0
 * Date:     11-Oct-2004
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:
 * Input:
 *           name = name of btn_command (optional)
 *           id = id of btn_command (optional)
 *           type = define the type of the btn_command ('button'|'submit')(required)
 *           disabled = disable the btn_command (optional)
 *           onclick = To introduce code javascript (optional)
 *           value = define the label of the btn_command (optional)
 *           form_name = nombre de la forma que contiene el btn_command
 *                      (SI type = 'button' entonces form_name es requerido)
 *
 *
 * Examples : {btn_command type="button" form_name="frmPais" value="Modificar" name="CmdUpdatePais" onClick="alert('click al button');"}
 *            {btn_command type="submit" value="Adicionar" name="CmdAddPais" onClick="alert('click al submit');"}
 *
 */
function smarty_function_btn_commandCT($params, & $smarty) {
	extract($params);
	settype($hsbtml_result, "string");
	$sbhtml_result = '';
	$sbhtml_result .= "<input class=boton";

	if (isset ($name)) {
		$sbhtml_result .= " name='".$name."'";
	}
	if (isset ($type)) {
		$sbhtml_result .= " type='".$type."'";
	}
	if (isset ($id)) {
		$sbhtml_result .= " id='".$id."'";
	}
	if (isset ($value)) {
		$sbhtml_result .= " value='".$value."'";
	}
	if (isset ($disabled)) {
		$sbhtml_result .= " disabled='".$disabled."'";
	}

	if (($type == "Button") || ($type == "button")) {
		if (isset ($onclick)) {
			$sbhtml_result .= " onClick=\"".$onclick."\" ";
		}
	}

	if (($type == "Submit") || ($type == "submit")) {
		$sbhtml_result .= "action.value = '".$name."';";
	}

	//cierra la doble comilla del onClick
	$sbhtml_result .= "\"";
	$sbhtml_result .= ">";
	print $sbhtml_result;
}
?>