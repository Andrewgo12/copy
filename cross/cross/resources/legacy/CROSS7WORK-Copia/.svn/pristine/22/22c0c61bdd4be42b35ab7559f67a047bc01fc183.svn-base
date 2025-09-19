<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdDeleteTipolocaliza {

	function execute() {
		extract($_REQUEST);

		if (($tipolocaliza__tilocodigos != NULL) && ($tipolocaliza__tilocodigos != "")) {
			$tipolocaliza_manager = Application :: getDomainController('TipolocalizaManager');
			$message = $tipolocaliza_manager->deleteTipolocaliza($tipolocaliza__tilocodigos);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>