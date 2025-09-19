<?php

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     block
 * Name:     option
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           value = value of the option (optional)
 *           id = id of the option (optional)
 *
 *
 * Examples : {select name="nombres" id="nom"}
 *              {option id="cod1"}Hemerson{/option}
 *              {option id="cod2"}Leider{/option}
 *            {/select}
 *
 *
 * --------------------------------------------------------------------
 */
 
function smarty_block_option($params, $content, &$smarty)
{
extract($params);
$html_result = '';
 if(isset($content)){
    $html_result .= "<option";
    if (isset($value)){
        $html_result .= " value=\"$value\"";
    }
    if (isset($id)){
        $html_result .= " id=\"$id\"";
    }
    $html_result .= ">";
    $html_result .= $content;
    $html_result .= "</option>";
    return $html_result;
 }
}
?>
