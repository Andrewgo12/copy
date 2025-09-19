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
 *           cmd = nombre del comando (required)
 *           label = etiqueta del link (required)
 *			 href= enlace
 * Examples: {href_command cmd="default" form_name="frmContrato_alquiler" label="Volvel al Menu Princial"}
 *            
 *
 * -------------------------------------------------------------
 */

function smarty_function_href($params, & $smarty) {

	extract($params);
	
	if(isset($title)){
		$title = "title=\"$title\"";
	}
	
	if(isset($onclick)){
		$onclick = "onClick=\"$onclick\"";
	}
	if(!isset($href)){
		$href = "#";
	}
	$html_result = "";
	$html_result .= "<a href=\"$href\" $title $onclick>".$label."</a>";
	return $html_result;

}
?>