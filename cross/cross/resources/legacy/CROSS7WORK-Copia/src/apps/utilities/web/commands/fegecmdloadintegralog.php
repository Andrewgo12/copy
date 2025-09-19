<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdloadIntegraLog {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objManager, "object");
		settype($objDate,"object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($sbOutput, "string");
		settype($sbHtml,"string");
		
		//labels
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		//se limpia la sesion 
		if(WebSession :: issetProperty("_rcIntegraLog")){
			WebSession :: unsetProperty("_rcIntegraLog");
		}
		
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
		
		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type"); 
		
		if($inlofchaejin1 && $inlofchaejin2){
			$objDate = Application :: loadServices("DateController");
			$inlofchaejin1 = $objDate->fncdatehourtoint($inlofchaejin1);
			$inlofchaejin2 = $objDate->fncdatehourtoint($inlofchaejin2);
			$objManager = Application :: getDomainController('IntegraLogManager');
			$objManager->setData(array("inlofchaejin1"=>$inlofchaejin1,'inlofchaejin2'=>$inlofchaejin2,
								       "inloapps"=>$inloapps,"inloestados"=>$inloestados,
									   "inloidcrosss"=>$inloidcrosss,"inlousuarios"=>$inlousuarios));
			$objManager->getIntegration();
			$rcTmp = $objManager->getResult();

			if($rcTmp && is_array($rcTmp) && $rcTmp["result"]){
				
				WebSession :: setProperty("_rcIntegraLog",$rcTmp["data"]);
				if($rcTmp["query"]){
					WebSession :: setProperty("_sbQueryIntegraLog",$rcTmp["query"]);
				}
				$sbHtml = $this->drawList();
				
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode($sbHtml);
			}else{
				$rcResult[0] = 0;
				$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[$rcTmp["message"]]));
			}	
		}else{
			$rcResult[0] = 0;
			$rcResult[1]= $objService->encode(html_entity_decode($rcmessages[0]));
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
	
	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawIntegraLog.php";
		include($sbPath);
		$sbHtml = smarty_function_drawIntegraLog(array(),$this,false);
		return $sbHtml;
	}
}
?>