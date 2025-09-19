<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeCrCmdAddAnexosWeb {

	function execute() {

		settype($objService, "object");
		settype($rcFile, "array");
		settype($rcTmp, "array");
		settype($rcFileName, "array");
		settype($sbMaxtamfile, "string");
		settype($sbFlag, "string");
		settype($sbContent, "string");
		settype($sbIndex, "string");
		settype($nuMaxtamfile, "double");
		settype($nuCont, "integer");
		settype($nuMax, "integer");
		settype($nuCant, "integer");
		settype($nuRow, "integer");
		
		$sbFlag= false;
		
		//se valida que se hayan ingresado el nombre y tipo del archivo
		if(!$_REQUEST["anexos__archnombres"] || !$_REQUEST["anexos__archextensis"]){
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}

		//se almacena el $_REQUEST para el control de campos dinamicos
		WebSession :: setProperty("rcRequest", $_REQUEST);

		//Se obtiene la data del archivo
		$rcFile = WebRequest :: getPostFiles("anexos___anexnombarch");

		//se obtienen los archivos ya guardados
		$rcFileName = WebSession :: getProperty("_rcCasosFileList");
		
		if($rcFileName &&  is_array($rcFileName)){
			//se valida que el archivo no este ya
			foreach($rcFileName as $nuCont => $rcTmp){
				if($rcTmp["name"] == $rcFile["name"]){
					WebRequest :: setProperty('cod_message', $message = 61);
					return "fail";
				}
			}
			$sbFlag = true;
		}

		if (!$rcFile["name"]) {
			if ($rcFile["size"] === 0) {
				WebRequest :: setProperty('cod_message', $message = 17);
				return "fail";
			}
		} else {
			if ($rcFile["error"]) {
				WebRequest :: setProperty('cod_message', $message = 60);
				return "fail";
			}
		}

		//Se valida que el tamanho del archivo no sea mayor a el limite configurado e el php.ini
		$objService = Application :: loadServices("Data_type");
		$sbMaxtamfile = ini_get("upload_max_filesize");
		$nuMaxtamfile = $objService->string_to_bytes($sbMaxtamfile);
		if ($nuMaxtamfile < $rcFile["size"]) {
			WebRequest :: setProperty('cod_message', $message = 13);
			return "fail";
		}
		
		// se cargan los valores
		$sbContent = $objService->file2encode($rcFile["tmp_name"]);
		if($sbFlag){
			$nuMax = 0;
			 $nuCant = sizeof($rcFileName);
			for($nuCont = 0; $nuCont<$nuCant;$nuCont++){
				$rcTmp = $rcFileName[$nuCont];
				//se genera el registro
				$nuRow = $rcTmp["row"];
				if($nuRow > $nuMax){
					$nuMax = $nuRow;
				}
			}
			$nuRow = $nuMax + 1;
			$rcFileName[$nuCant]["name"]=$_REQUEST["anexos__archnombres"].".".$_REQUEST["anexos__archextensis"];
			$rcFileName[$nuCant]["type"]=$rcFile["type"];
			$rcFileName[$nuCant]["ext"]=$_REQUEST["anexos__archextensis"];
			$rcFileName[$nuCant]["size"]=$rcFile["size"];
			$rcFileName[$nuCant]["row"]=$nuRow;
			$sbIndex = "_file_".$nuRow;
			$rcFileName[$nuCant]["index"]=$sbIndex;
		}else{
			$nuRow = 1;
			$rcFileName[0]["name"]=$_REQUEST["anexos__archnombres"].".".$_REQUEST["anexos__archextensis"];
			$rcFileName[0]["type"]=$rcFile["type"];
			$rcFileName[0]["ext"]=$_REQUEST["anexos__archextensis"];
			$rcFileName[0]["size"]=$rcFile["size"];
			$rcFileName[0]["row"]=$nuRow;
			$sbIndex = "_file_".$nuRow;
			$rcFileName[0]["index"]=$sbIndex;
		}
		
		WebSession :: setProperty("_rcCasosFileList", $rcFileName);
		WebSession :: setProperty($sbIndex, $sbContent);

		$_REQUEST["focusposition"] = "anexos___anexnombarch";

		return "success";
	}
}
?>