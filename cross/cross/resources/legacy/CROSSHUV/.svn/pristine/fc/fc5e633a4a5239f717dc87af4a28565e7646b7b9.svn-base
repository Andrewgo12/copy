<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
Class FeEnCmdDeleteEjetematico {

	function execute(){
		echo $ejetematico__ejtecodigon;
		extract($_REQUEST);
		if(($ejetematico__ejtecodigon != NULL) && ($ejetematico__ejtecodigon != ""))
		{
			$ejetematico_manager = Application::getDomainController('EjetematicoManager');
			$message = $ejetematico_manager->deleteEjetematico($ejetematico__ejtecodigon);
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}
		else{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}
}
?>