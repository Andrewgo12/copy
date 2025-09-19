<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdDeleteOpcionrepues {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($rcResult,"array");
		settype($nuMessage,"integer");

		if(($opcionrepues__oprecodigon != NULL) && ($opcionrepues__oprecodigon != "")){

			$objManager = Application::getDomainController('OpcionrepuesManager');
			$objManager->setData(array("oprecodigon"=>$opcionrepues__oprecodigon));
			$objManager->deleteOpcionrepues();
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