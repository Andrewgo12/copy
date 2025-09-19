<?php  
/*
 * Smarty plugin
 * Type:     function
 * Name:     text_comunicacion
 * Version:  1.0
 * Date:     23-Oct-2004
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  it draws the text of the communication
 * Input:
 *
 * Examples:  
 *
 *
 */
function smarty_function_text_comunicacion($params, & $smarty) {
	
	settype($objService,"object");
	settype($sbcontext_head, "string");
	extract($params);
	extract($_REQUEST);
	
	$objService = Application :: loadServices("Data_type");

	if ($comutextos) {
		$sbcontext_head = $objService->decode($comutextos);
	}

	if (!$sbcontext_head) {
		return "&nbsp;";
	}
	
	return $sbcontext_head;
}
?>