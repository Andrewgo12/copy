<?php 

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdDefaultGrupo {

	function execute() {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if ($clean_table) {
			$cargo_manager = Application :: getDomainController("GrupoManager");
			$cargo_manager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
			//Limpia el detalle del personal de la sesion
			WebSession :: unsetProperty("Grupodetalle");
		}
		if(!$grupo__grupcodigos){
			//se limpia el detalle de personal
			WebSession :: unsetProperty("Grupodetalle");
		}
		return "success";
	}
}
?>