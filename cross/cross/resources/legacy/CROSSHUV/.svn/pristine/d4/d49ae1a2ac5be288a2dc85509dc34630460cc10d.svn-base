<?php

/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     block
 * Name:     form
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of the form (optional)
 *           action = value of the action (optional)
 *           method = value of the method (optional)
 *           enctype = value of the enctype (optional)
 *           target = value of the target (optional)
 *
 *
 * Examples : {form name="FActualizarUsuario" method="post" action="destino.php"}
 *             
 *            {/form}
 *
 *
 * --------------------------------------------------------------------
 */
 
function smarty_block_form($params, $content, &$smarty)
{
   extract($params);
   $html_result = '';
   if (isset($content)){
    $html_result .= "<form";
    if ($action != ''){
        $html_result .= " action=\"$action\"";
    }
    if ($method != ''){
        $html_result .= " method=\"$method\"";
    }
    if ($enctype != ''){
        $html_result .= " enctype=\"$enctype\"";
    }
    if ($name != ''){
        $html_result .= " name=\"$name\"";
    }
    if ($target != ''){
        $html_result .= " target=\"$target\"";
    }
    $html_result .= ">";
    $html_result .= $content;
    $html_result .= "</form>";
    print $html_result;
  }
}

?>
