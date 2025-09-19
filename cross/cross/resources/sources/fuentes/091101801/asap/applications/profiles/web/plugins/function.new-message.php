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

function smarty_function_new_message($params, & $smarty) {
	//Parametros del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser) || !$rcuser["lang"]) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
    
	extract($params);
    extract($_REQUEST);
    if($cod_message !== "" && $cod_message !== null)
        $id = $cod_message;

	include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
	if ($id !== null && $id !== "") {
        if($param)
            $msg = str_replace("[VAR1]",$param,$rcmessages[$id]);
        else
            $msg = $rcmessages[$id];
            
		$msg = html_entity_decode($msg);
		$message = "<script language='javascript'>"."alert('$msg')</script>";
	}
	return $message;
}
?>

