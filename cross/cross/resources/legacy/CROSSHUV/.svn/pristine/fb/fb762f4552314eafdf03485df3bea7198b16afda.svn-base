<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultSeguimiento {
	function execute() {
		
		extract($_REQUEST);
		settype($rcFileName, "array");
		settype($rcTmp, "array");
		settype($nuCont, "integer");
		
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			$ordenempresa_manager = Application :: getDomainController("OrdenempresaManager");
			$ordenempresa_manager->UnsetRequestCompromisos();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
	}
}
?>	