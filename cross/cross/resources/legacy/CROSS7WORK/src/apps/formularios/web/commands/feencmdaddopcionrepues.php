<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdAddOpcionrepues {

	function execute(){
		
		extract($_REQUEST);
		settype($objService,"object");
		settype($objManager,"object");
		settype($rcResult,"array");
		settype($nuMessage,"integer");

		if(($opcionrepues__opredescrisp != NULL) && ($opcionrepues__opredescrisp != "")){
			
			$objService = Application::loadServices("Data_type");
			$opcionrepues__opredescrisp = $objService->formatString($opcionrepues__opredescrisp);

			$objManager = Application::getDomainController('OpcionrepuesManager');
			$objManager->setData(array("opredescrisp"=>$opcionrepues__opredescrisp,
									   "morecodigon"=>$opcionrepues__morecodigon,
									   "opreactivas"=>$opcionrepues__opreactivas));
			$objManager->addOpcionrepues();
			$rcResult = $objManager->getResult();
			$nuMessage = $rcResult["message"];  
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>