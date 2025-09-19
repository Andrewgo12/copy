<?php

/*
 * Smarty plugin
 * Type:     function
 * Name:     max_length
 * Version:  1.0
 * Date:    31-May-2007
 * Author:	 freina<freina@parquesoft.com.com>
 * Purpose: it stores the maximum length 
 * Input:
 *           name = name of the hidden (optional)
 *           id = id of the hidden (optional)
 *           value = value of the hidden (optional)
 *
 *
 * Examples : {hidden name="max_length"}
 *
 */
function smarty_function_max_length($params, & $smarty) {
	extract($params);

	settype($objService, "object");
	settype($sbString, "string");
	settype($nuMax, "integer");
	
	$objService = Application::loadServices("General");
	$nuMax = $objService->getParam("general","MAXLENGTH_TEXTAREA");

	$sbString .= "<input";
	$sbString .= " name=\"max_length\"";

	$sbString .= " type=\"hidden\"";

	$sbString .= " id=\"max_length\"";
	
	$sbString .= " value='".$nuMax."'";

	$sbString .= ">";

	return $sbString;
}
?>


