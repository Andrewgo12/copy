<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCrCmdShowIndoprequre {
	function execute() {
		extract($_REQUEST);
		
		//error_reporting(30719);

		settype($objJson, "object");
		settype($objDate, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcSession,"array");
		settype($rcUser,"array");
		settype($rcParam, "array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");

		//labels
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");

		//se validan los datos necesariospara calcular los indicadores
		if($ordefecregdb && $ordefecregde){
			
			$objDate = Application :: loadServices("DateController");
			
			$ordefecregdb = $objDate->fncdatetoint($ordefecregdb);
			
			$ordefecregde = $objDate->fncdatetoint($ordefecregde) + ($objDate->nuSecsDay - 1);
			
			if($ordefecingdb){
				$ordefecingdb = $objDate->fncdatetoint($ordefecingdb);
			}
			
			if($ordefecingde){
				$ordefecingde = $objDate->fncdatetoint($ordefecingde) + ($objDate->nuSecsDay - 1);
			}
			
			//se envian los parametros de busqueda para generar los indicadores
			$objManager = Application::getDomainController('IndoprequreManager');
			$rcParam = array("ordefecregdb"=>$ordefecregdb,"ordefecregde"=>$ordefecregde,"ordefecingdb"=>$ordefecingdb,
						     "ordefecingde"=>$ordefecingde,"tiorcodigos"=>$tiorcodigos,"evencodigos"=>$evencodigos,"causcodigos"=>$causcodigos);
			$objManager->setData($rcParam);
			$objManager->getIndoprequre();
			$rcTmp = $objManager->getResult();
			
			if($rcTmp["result"] && $rcTmp["data"]){
				$rcSession["data"] = $rcTmp["data"];
				$rcSession["params"] = $rcParam;
				WebSession :: setProperty("_rcIndoprequre",$rcSession);
				$sbHtml = $this->drawList();

				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);
			}else{
				$rcResult[0]=0;
				$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[$rcTmp["message"]]));
			}
		}else{
			//resultado de los * son obligatorios
			$rcResult[0]=0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}

	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawIndoprequre.php";
		include($sbPath);
		$sbHtml = smarty_function_drawIndoprequre(array(),$this,false);
		return $sbHtml;
	}
}
?>