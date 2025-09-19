<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     btn_command
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of btn_command (optional)
 *           id = id of btn_command (optional)
 *           type = define the type of the btn_command ('button'|'submit')(required)
 *           disabled = disable the btn_command (optional)
 *           onClick = To introduce code javascript (optional)
 *           value = define the label of the btn_command (optional)
 *           form_name = nombre de la forma que contiene el btn_command
 *                      (SI type = 'button' entonces form_name es requerido)
 *
 *
 * Examples : {btn_command type="button" form_name="frmPais" value="Modificar" name="CmdUpdatePais" onClick="alert('click al button');"}
 *            {btn_command type="submit" value="Adicionar" name="CmdAddPais" onClick="alert('click al submit');"}
 *
 *
 * --------------------------------------------------------------------
 */

function smarty_function_btn_delete($params, &$smarty)
{
    extract($params);
    $html_result = '';
    $html_result .= "<input class=boton";

	//Hace la validacion de permisos
	if(Application :: validateProfiles($name) == false)
		$disabled = "true";
    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    if (isset($type)){
        $html_result .= " type='".$type."'";
    }
    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }
    if (isset($disabled)){
        $html_result .= " disabled='".$disabled."'";
    }

    $html_result .= " onClick=\"javascript:";
    
    if (isset($onClick)){
        $html_result .= $onClick;
    }
    
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}

	$table_name = strtolower($table);
	include($rcuser["lang"]."/".$rcuser["lang"].".".$table.".php");
    $html_result .= "var result = confirm('{$rcMsg["delete"]}'); if(result == true){action.value='$name';$form_name.submit();disableButtons()}";

    //cierra la doble comilla del onClick
    $html_result .= "\"";

    $html_result .= ">";
    
    return $html_result;

}
?>
