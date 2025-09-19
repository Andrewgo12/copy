<?php
/*
// you can define the commando extending the WebCommand

require_once "Web/WebCommand.php";
class DefaultCommand extends WebCommand {
}
// really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeHrCmdDeleteGrupo {
	
	function execute()
	{
		extract($_REQUEST);
		
		if(($grupo__grupcodigon != NULL) && ($grupo__grupcodigon != "")
			&& ($grupo__grupcodigos != NULL) && ($grupo__grupcodigos != "")){
			$grupo_manager = Application::getDomainController('GrupoManager');
			$message = $grupo_manager->deleteGrupo($grupo__grupcodigon,$grupo__grupcodigos);
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}else{
			WebRequest::setProperty('cod_message',$message = 5);
			return "fail";
		}
	}
}
?>