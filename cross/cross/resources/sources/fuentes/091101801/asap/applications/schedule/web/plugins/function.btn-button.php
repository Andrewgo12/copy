<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     btn_command
 * Version:  1.0
 * Date:     2004/10/28
 * Author:	 Cesar Reyes
 * Purpose:
 * Input:
 *           name = name of btn_command (optional)
 *           id = id of btn_command (optional)
 *           disabled = disable the btn_command (optional)
 *           onClick = To introduce code javascript (optional)
 *           value = define the label of the btn_command (optional)
*			 disableButtons = define si efectua el deshabilitar de los botones
 *
 *
 * Examples : {btn_command value="Modificar" name="CmdUpdatePais" onClick="alert('click al button');"}
 *
 *
 * --------------------------------------------------------------------
 */

function smarty_function_btn_button($params, &$smarty)
{
    extract($params);
    $html_result = '';
    $html_result .= "<input class=boton";

    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    $html_result .= " type='button'";
    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }
    if (isset($disabled)){
        $html_result .= " disabled='".$disabled."'";
    }

    if(isset($disableButtons))
    	$html_result .= " onClick=\"disableButtons();";
    else
    	$html_result .= " onClick=\"";
    if (isset($onClick)){
        $html_result .= $onClick;
    }
    //cierra la doble comilla del onClick
    $html_result .= "\"";
    $html_result .= ">";
    echo $html_result;
}

?>
