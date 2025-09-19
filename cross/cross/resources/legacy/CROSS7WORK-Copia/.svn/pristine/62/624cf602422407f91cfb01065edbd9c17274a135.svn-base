<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdUpdateEquivalencias {
	function execute() {
	
		settype($objManager,"object");
		settype($objService,"object");
		settype($rcTmp,"array");
		settype($rcResult,"array");
		settype($sbIndex,"string");
		settype($sbValue,"string");
		settype($sbPos,"string");
		settype($sbTmp,"string");
		settype($nuMessage,"integer");

		foreach ($_REQUEST as $sbIndex => $sbValue) {
			$sbPos = strpos($sbIndex, "__");
			if (!($sbPos === false)) {
				$sbTmp = substr($sbIndex, ($sbPos +2));
				$rcTmp[$sbTmp] = $sbValue;
			}
		}
		
		if(is_array($rcTmp) && $rcTmp){
			extract($rcTmp);
		}

		if (($equicodigon != NULL) && ($equicodigon != "") && ($equitablcros != NULL) && ($equitablcros != "") 
		&& ($equicampcros != NULL) && ($equicampcros != "") && ($equivalcros != NULL) && ($equivalcros != "") 
		&& ($equinomcros != NULL) && ($equinomcros != "") && ($equiareacros !=NULL) && ($equiareacros !="") 
		&& ($equitabldocs != NULL) && ($equitabldocs != "") && ($equicampdocs != NULL) && ($equicampdocs != "") 
		&& ($equivaldocs != NULL) && ($equivaldocs != "") && ($equinomdocs != NULL) && ($equinomdocs != "") 
		&& ($equiareadocs != NULL) && ($equiareadocs != "") && ($equiseridocs !=NULL) && ($equiseridocs !="") 
		&& ($equiestados != NULL) && ($equiestados != "")) {
			
			$objService = Application :: loadServices("Data_type");
			$rcTmp["equitablcros"] = $objService->formatString($rcTmp["equitablcros"]);
			$rcTmp["equicampcros"] = $objService->formatString($rcTmp["equicampcros"]);
			$rcTmp["equivalcros"] = $objService->formatString($rcTmp["equivalcros"]);
			$rcTmp["equinomcros"] = $objService->formatString($rcTmp["equinomcros"]);
			$rcTmp["equitabldocs"] = $objService->formatString($rcTmp["equitabldocs"]);
			$rcTmp["equicampdocs"] = $objService->formatString($rcTmp["equicampdocs"]);
			$rcTmp["equivaldocs"] = $objService->formatString($rcTmp["equivaldocs"]);
			$rcTmp["equinomdocs"] = $objService->formatString($rcTmp["equinomdocs"]);
			$rcTmp["equiareadocs"] = $objService->formatString($rcTmp["equiareadocs"]);
			$rcTmp["equiseridocs"] = $objService->formatString($rcTmp["equiseridocs"]);
			
			$objManager = Application::getDomainController("EquivalenciasManager");
			$objManager->setData($rcTmp);
			$objManager->updateEquivalencias();
			$rcResult = $objManager->getResult();
			WebRequest :: setProperty('cod_message', $rcResult["message"]);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}
	}
}
?>