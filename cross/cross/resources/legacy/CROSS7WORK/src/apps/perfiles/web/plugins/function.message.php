<?php
/*
 * Smarty plugin
 * Type:     function
 * Name:     message
 * Version:  1.0
 * Date:     Oct 28, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:
 * Input:
 *           id = codigo of message (required)
 *
 * Examples:  {message id="5"}
 *
 Se modifica para cargar los mensajes desde un archivo externo
 */
function smarty_function_message($params, & $smarty) {
	
	extract($params);
	
	settype($objService, "object");
	settype($rcParams,"array");
	settype($sbValue,"string");
	settype($sbTmp,"string");
	settype($sbMessage,"string");
	settype($nuCont,"integer");
	
	//Parametros del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
	if($error_field){
		include ($rcuser["lang"]."/".$rcuser["lang"].".".$label_file.".php");
	}
	
	$objService = Application :: loadServices("Data_type");
	
	if ($id !== null && $id !== "") {
		$msg = $objService->my_html_entity_decode($rcmessages[$id]);
		if($param){
			$rcParams = explode(",",$param);
			foreach($rcParams as $nuCont => $sbValue){
				if($error_field){
					$sbValue = $rclabels[$sbValue]["label"];
				}
				$sbTmp = "[VAR".$nuCont."]";
				$msg = str_replace($sbTmp,$sbValue,$msg);
			}
		}
		$sbMessage = "<script language='javascript'>"."alert('$msg')</script>";
	}
	return $sbMessage;
}
?>