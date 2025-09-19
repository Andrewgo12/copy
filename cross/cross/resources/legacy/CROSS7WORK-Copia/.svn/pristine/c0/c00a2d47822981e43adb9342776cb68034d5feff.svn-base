<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCrCmdShowIndicador {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objDate, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp,"array");
		settype($rcSession,"array");
		settype($rcUser,"array");
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
		if($ordefecingdini && $ordefecingdfin){
			
			$objDate = Application :: loadServices("DateController");
			
			$ordefecingdini = $objDate->fncdatetoint($ordefecingdini);
			
			$ordefecingdfin = $objDate->fncdatetoint($ordefecingdfin) + ($objDate->nuSecsDay - 1);
			
			if($ordefecdiginin){
				$ordefecdiginin = $objDate->fncdatetoint($ordefecdiginin);
			}
			
			if($ordefecdigfinn){
				$ordefecdigfinn = $objDate->fncdatetoint($ordefecdigfinn) + ($objDate->nuSecsDay - 1);
			}
			
			//se envian los parametros de busqueda para generar los indicadores
			$objManager = Application::getDomainController('IndicadorManager');
			$objManager->setData(array("ordefecingdini"=>$ordefecingdini,"ordefecingdfin"=>$ordefecingdfin,"ordefecdiginin"=>$ordefecdiginin,
									   "ordefecdigfinn"=>$ordefecdigfinn,"orgacodigos"=>$orgacodigos));
			$objManager->getIndicador();
			$rcTmp = $objManager->getResult();
			
			if($rcTmp["result"] && $rcTmp["data"]){
				$rcSession["data"] = $rcTmp["data"];
				WebSession :: setProperty("_rcIndicador",$rcSession);
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
			
		$sbPath = Application::getPluginsDirectory()."/function.drawIndicator.php";
		include($sbPath);
		$sbHtml = smarty_function_drawIndicator(array(),$this,false);
		return $sbHtml;
	}
}
?>