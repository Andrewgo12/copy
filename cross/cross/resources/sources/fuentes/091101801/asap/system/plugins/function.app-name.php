<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     app_name
 * Purpose:  get the application name
 * -------------------------------------------------------------
 */
function smarty_function_app_name($params, &$smarty)
{
    return Application::getName();
}

/* vim: set expandtab: */

?>
