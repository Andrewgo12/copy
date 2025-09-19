<?php

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     hidden
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of the hidden (optional)
 *           id = id of the hidden (optional)
 *           value = value of the hidden (optional)
 *
 *
 * Examples : {hidden name="hidden" value="LIDIS"}
 *
 * 
 * --------------------------------------------------------------------
 */
 
function smarty_function_hidden($params, &$smarty)
{
    extract($params);
    
    $html_result = '';
    $html_result .= "<input";
    if (isset($name)){
        $html_result .= " name=\"$name\"";
    }

    $html_result .= " type=\"hidden\"";

    if (isset($id)){
        $html_result .= " id=\"$id\"";
    }
    
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }else{
        $html_result .= " value='".$_REQUEST[$name]."'";
    }
    
    $html_result .= ">";
    
    print $html_result;
}

?>
