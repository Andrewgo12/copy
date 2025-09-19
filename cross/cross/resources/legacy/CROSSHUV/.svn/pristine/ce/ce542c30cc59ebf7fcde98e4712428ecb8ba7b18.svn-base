<?php  
/*
 * Smarty plugin
 * Type:     function
 * Name:     text_email
 * Version:  1.0
 * Date:     11-Oct-2004
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  it draws the text of the email
 * Input:
 *
 * Examples:  
 *
 *
 */
function smarty_function_text_email($params, & $smarty) {
	settype($rcuser, "array");
	settype($sbhtml_result, "string");
	settype($sbcontext_head, "string");
	extract($params);
	extract($_REQUEST);

	if ($emaitextos) {
		$sbcontext_head = $emaitextos;
	}

	if (!$sbcontext_head) {
		return "&nbsp;";
	}

	//Escapa las comillas dobles y las sencillas
	$sbcontext_head = str_replace('"', '\\"', $sbcontext_head);
	$sbcontext_head = str_replace("'", "\\'", $sbcontext_head);
	$sbhtml_result .= "&nbsp;&nbsp;";
	$sbhtml_result .= $sbcontext_head;
	return $sbhtml_result;
}
?>