<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeGeCmdDeleteEquivalencias {
	function execute(){
		
		settype($objManager,"object");
		settype($rcResult,"array");
		settype($nuMessage,"integer");
		
		extract($_REQUEST);
		if(($equivalencias__equicodigon != NULL) && ($equivalencias__equicodigon != "")){
			$objManager = Application::getDomainController('EquivalenciasManager');
			$objManager->setData(array("equicodigon"=>$equivalencias__equicodigon));
			$objManager->deleteEquivalencias();
			$rcResult = $objManager->getResult();
			WebRequest::setProperty('cod_message', $rcResult["message"]);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0);
			return "fail";
		}
	}
}
?>