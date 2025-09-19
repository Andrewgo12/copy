<?php 

/*
 * Smarty plugin
 * -------------------------------------------------------------
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
 * -------------------------------------------------------------
 * Se modifica para cargar los mensajes desde un archivo externo
 */

function smarty_function_message($params, & $smarty) {
	
	settype($objService, "object");
	
	//Parametros del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
    
	extract($params);
    extract($_REQUEST);
    if($cod_message !== "" && $cod_message !== null)
        $id = $cod_message;

	include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
	
	$objService = Application :: loadServices("Data_type");
	
	if ($id !== null && $id !== "") {
		$msg = $objService->my_html_entity_decode($rcmessages[$id]);
		$message = "<script language='javascript'>"."alert('$msg')</script>";
	}
	return $message;
}
?>

