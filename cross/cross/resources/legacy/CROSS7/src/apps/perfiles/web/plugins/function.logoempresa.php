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
 
function smarty_function_logoEmpresa($params, &$smarty)
{
    extract($params);
    
    $general = Application::loadServices("General");
    $datosEmpresa = $general->getParam("general","empresa");
    $image = $datosEmpresa["emprlogos"];
    $html_result = '<tr><td><img src="web/images/'.$image.'"></td></tr>';   
    return $html_result;
}
?>