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
	settype($rcParams,"array");
	settype($rcUser,"array");
	settype($sbValue,"string");
	settype($sbTmp,"string");
	settype($sbMessage,"string");
	settype($nuCont,"integer");
	
	//Parametros del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application :: getSingleLang();
	}
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

	$objService = Application :: loadServices("Data_type");
	
	extract($params);
    extract($_REQUEST);
    
    if($cod_message !== "" && $cod_message !== null){
    	 $id = $cod_message;
    }

	if ($id !== null && $id !== "") {
		$msg = $objService->my_html_entity_decode($rcmessages[$id]);
		if($param){
			$rcParams = explode(",",$param);
			foreach($rcParams as $nuCont => $sbValue){
				$sbTmp = "[VAR".$nuCont."]";
				$msg = str_replace($sbTmp,$sbValue,$msg);
			}
		}
		$sbMessage = "<script language='javascript'>"."alert('$msg') \n";
		if($close){
			$sbMessage .= " if(parent.opener!=null){\n";
        	$sbMessage .=" parent.close();\n";
        	$sbMessage .="}\n";
		}
		$sbMessage .= "</script>";
	}
	return $sbMessage;
}
?>