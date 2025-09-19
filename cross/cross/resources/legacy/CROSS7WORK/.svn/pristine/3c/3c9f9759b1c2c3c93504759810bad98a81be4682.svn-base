<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     href_command
 * Version:  1.0
 * Date:     Feb 12, 2004
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:  crea una href que llama a un comando.
 * Input:
 *           form_name = name of the form that content calendar (required)
 *           cmd = nombre del comando (required)
 *           label = etiqueta del link (required)
 *
 * Examples: {href_command cmd="default" form_name="frmContrato_alquiler" label="Volvel al Menu Princial"}
 *            
 *
 * -------------------------------------------------------------
 */

function smarty_function_href_command($params, &$smarty)
{

extract($params);

$html_result = "";

$html_result .= "<a href='#' onClick=\"".$form_name.".action.value='".$cmd."';".$form_name.".submit();\">".$label."</a>";

return $html_result;

}
?>




