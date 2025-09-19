<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     hidden
 * Version:  1.0
 * Date:     15-Aug-2007 11:53
 * Author:	 feina<freina@parquesoft.com>
 * Purpose:
 * Input:
 *           value = value of the id message
 *
 *
 * Examples : {hidden_message  value="45,46"}
 *
 */

function smarty_function_hidden_message($params, & $smarty) {
	extract($params);

	// se determina cuantos hidden se deben crear
	settype($rcMessage, "array");
	settype($rcUser, "array");
	settype($sbHtml, "string");
	settype($sbId, "string");

	if ($value) {
		$rcMessage = explode(",", $value);
	}
	
	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();

	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

	foreach ($rcMessage as $sbId) {

		$sbHtml .= "<input";
		$sbHtml .= " name='message_".$sbId."' ";
		$sbHtml .= " id='message_".$sbId."' ";
		$sbHtml .= " type='hidden' ";
		$sbHtml .= " value='".$rcmessages[$sbId]."'";
		$sbHtml .= "> \n";
	}

	return $sbHtml;
}
?>