<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdDeleteModeloresp {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($nuMessage,"integer");

		if(($modeloresp__morecodigon != NULL) && ($modeloresp__morecodigon != "")){
			$objManager = Application::getDomainController('ModelorespManager');
			$nuMessage = $objManager->deleteModeloresp($modeloresp__morecodigon);
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>