<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeGeCmdDeleteLocalizacion {

	function execute() {
		extract($_REQUEST);

		if (($localizacion__locacodigos != NULL) && ($localizacion__locacodigos != "")) {
			$localizacion_manager = Application :: getDomainController('LocalizacionManager');
			$message = $localizacion_manager->deleteLocalizacion($localizacion__locacodigos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>