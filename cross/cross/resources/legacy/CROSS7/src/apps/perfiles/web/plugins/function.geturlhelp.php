<?php
/**
* Copyright 2005 FullEngine
* @author creyes
* @param type name desc
* @return type name desc
* @date 5-August-2005 15:29:56
* @location Cali-Colombia
*/
function smarty_function_geturlhelp($params, &$smarty){
    $url = Application::getConstant('URL_HELP');
    return "window.open('$url');";
}
?>