<?php

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     checkbox
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 creyes <creyes@oarquesoft.com>
 * Purpose:
 * Input:
 *           name = string : name of the checkbox (optional)
 *           id = string : id of the checkbox (optional)
 *           value = string : puts value to the checkbox (optional)
 *           disabled = boolean : disabled the checkbox (optional)
 *           checked = boolean : checked the checkbox (optional)
 *           onClick =  string : javascript code (optional)
 *
 *
 *
 * Examples : {checkbox name="textfield" value="FULLENGINE"}
 *
 *
 *
 * --------------------------------------------------------------------
 */
function smarty_function_checkbox($params, &$smarty)
{
    extract($params);
    
    $html_result .= "<input type='checkbox'";
    if (isset($name)){
        $html_result .= " name='".$name."'";
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
    if($_REQUEST[$name]){
        $html_result .= " checked='true'";
    }else if (isset($checked)){
        $html_result .= " checked='".$checked."'";
    }
    
    if (isset($onClick)){
        $html_result .= " onClick='".$onClick."'";
    }
    if(isset($onChange)){
    	$html_result .= " onChange=\"".$onChange."\"";
    }
    if(isset($onBlur)){
    	$html_result .= " onBlur=\"".$onBlur."\"";
    }
    $html_result .= ">";
    return $html_result;

}
?>