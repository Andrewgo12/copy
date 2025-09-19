<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
Class FeGeCmdAddComunicacion {

	function execute() {
		
		settype($objManager,"object");
		settype($objService,"object");
		settype($objJson,"object");
		settype($rcUser,"array");
		settype($rcResposnse,"array");
		settype($sbOutput,"string");
		settype($sbCharset, "string");
		settype($nuMessage,"integer");
		extract($_REQUEST);
		
		$objJson = new Services_JSON();
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion 
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include_once ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		
		$objService = Application :: loadServices("Data_type");
		$sbCharset = strtoupper(ini_get("default_charset")) ;
		
		if($formatocarta__focaplantils=="Error_max_length"){
			$rcResposnse[] = 62;
			$rcmessages[62] = $objService->my_html_entity_decode($rcmessages[62]);
			if($sbCharset=='UTF-8'){
				$rcmessages[62] = utf8_decode($rcmessages[62]);
			}
			$rcResposnse[] = $objService->encode($rcmessages[62]);
			
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		}

		if (($comunicacion__focacodigos != NULL) && ($comunicacion__focacodigos != "") 
		&& ($comunicacion__comuasuntos != NULL) && ($comunicacion__comuasuntos != "") 
		&& ($comunicacion__comutextos != NULL) && ($comunicacion__comutextos != "")) {

			//Hace la validacion de campos numericos y formateo de campos cadena
			$comunicacion__comuasuntos = $objService->formatString($comunicacion__comuasuntos);

			$objManager = Application :: getDomainController('ComunicacionManager');
			$nuMessage = $objManager->addComunicacion($comunicacion__ordenumeros, 
			$comunicacion__focacodigos, $comunicacion__comuasuntos, $comunicacion__comutextos);
			$rcResposnse[] = $nuMessage;
			$rcmessages[$nuMessage] = $objService->my_html_entity_decode($rcmessages[$nuMessage]);
			if($sbCharset=='UTF-8'){
				$rcmessages[$nuMessage] = utf8_decode($rcmessages[$nuMessage]);
			}
			$rcResposnse[] = $objService->encode($rcmessages[$nuMessage]);
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		} else {
			$rcResposnse[] = 0;
			$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
			if($sbCharset=='UTF-8'){
				$rcmessages[0] = utf8_decode($rcmessages[0]);
			}
			$rcResposnse[] = $objService->encode($rcmessages[0]);
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		}
	}
}
?>