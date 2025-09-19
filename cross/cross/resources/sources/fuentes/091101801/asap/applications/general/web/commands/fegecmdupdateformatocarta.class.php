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
Class FeGeCmdUpdateFormatocarta {

	function execute() {
		extract($_REQUEST);
		
		settype($objJson,"object");
		settype($objService,"object");
		settype($objManager,"object");
		settype($rcUser,"array");
		settype($rcResposnse,"array");
		settype($sbOutput,"string");
		settype($sbCharset, "string");
		
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
			$rcResposnse[]= $objService->encode($rcmessages[62]);
			
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		}

		if (($formatocarta__focacodigos != NULL) && ($formatocarta__focacodigos != "") 
		&& ($formatocarta__focanombres != NULL) && ($formatocarta__focanombres != "") 
		&& ($formatocarta__focaplantils != NULL) && ($formatocarta__focaplantils != "")) {
			
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objService->formatPrimaryKey($formatocarta__focacodigos) == false) {
				$rcResposnse[] = 4;
				$rcmessages[4] = $objService->my_html_entity_decode($rcmessages[4]);
				if($sbCharset=='UTF-8'){
					$rcmessages[4] = utf8_decode($rcmessages[4]);
				}
				$rcResposnse[]= $objService->encode($rcmessages[4]);				
				$sbOutput = $objJson->encode($rcResposnse);
				die($sbOutput);
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$formatocarta__focanombres = $objService->formatString($formatocarta__focanombres);

			$objManager = Application :: getDomainController('FormatocartaManager');
			$message = $objManager->updateFormatocarta($formatocarta__focacodigos, 
			$formatocarta__focanombres, $formatocarta__focaplantils, $formatocarta__focaestados);
			$rcResposnse[] = $message;
			$rcmessages[$message] = $objService->my_html_entity_decode($rcmessages[$message]);
			if($sbCharset=='UTF-8'){
				$rcmessages[$message] = utf8_decode($rcmessages[$message]);
			}
			$rcResposnse[]= $objService->encode($rcmessages[$message]);			
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		} else {
			$rcResposnse[] = 0;
			$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
			if($sbCharset=='UTF-8'){
				$rcmessages[0] = utf8_decode($rcmessages[0]);
			}
			$rcResposnse[]= $objService->encode($rcmessages[0]);			
			$sbOutput = $objJson->encode($rcResposnse);
			die($sbOutput);
		}
	}
}
?>