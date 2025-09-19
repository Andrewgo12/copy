<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowByIdModeloresp {

	function execute(){
		
		extract($_REQUEST);
		settype($objManager,"object");
		settype($rcData,"array");

		if(($modeloresp__morecodigon != NULL) && ($modeloresp__morecodigon != "")){
			$objManager = Application::getDomainController('ModelorespManager');
			$rcData = $objManager->getByIdModeloresp($modeloresp__morecodigon);
			 
			$_REQUEST["moreloresp__morecodigon"] = $rcData[0]["morecodigon"];
			$_REQUEST["modeloresp__morenombres"] = $rcData[0]["morenombres"];
			$_REQUEST["modeloresp__moredescrips"] = $rcData[0]["moredescrips"];

		}else{

			$_REQUEST["modeloresp__morecodigon"] = WebSession::getProperty("modeloresp__morecodigon");
			$_REQUEST["modeloresp__morenombres"] = WebSession::getProperty("modeloresp__morenombres");
			$_REQUEST["modeloresp__moredescrips"] = WebSession::getProperty("modeloresp__moredescrips");
		}

		WebSession::unsetProperty("modeloresp__morecodigon");
		WebSession::unsetProperty("modeloresp__morenombres");
		WebSession::unsetProperty("modeloresp__moredescrips");

		return "success";
	}
}
?>