<?php
/*
 * Smarty plugin
 * Type:     function
 * Name:     hiddenactiveregistry
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 freina<freina@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of the hidden (optional)
 *           id = id of the hidden (optional)
 *           value = value of the hidden (optional)
 *
 *
 * Examples : {hiddenactiveregistry name="hidden" value="LIDIS"}
 *
 */
function smarty_function_hiddenactiveregistry($params, & $smarty) {
	
	settype($sbhtml_result,"string");
	settype($sbvalue,"string");
	extract($params);
	
	$sbvalue = Application :: getConstant("REG_ACT");
	$sbhtml_result .= "<input";
	if (isset ($name)) {
		$sbhtml_result .= " name=\"$name\"";
	}
	$sbhtml_result .= " type=\"hidden\"";
	if (isset ($id)) {
		$sbhtml_result .= " id=\"$id\"";
	}
	$sbhtml_result .= " value='".$sbvalue."'";
	$sbhtml_result .= ">";
	print $sbhtml_result;
}
?>