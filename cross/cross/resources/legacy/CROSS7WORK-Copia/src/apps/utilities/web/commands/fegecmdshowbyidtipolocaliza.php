<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowByIdTipolocaliza {

	function execute() {
		extract($_REQUEST);

		if (($tipolocaliza__tilocodigos != NULL) && ($tipolocaliza__tilocodigos != "")) {
			$tipolocaliza_manager = Application :: getDomainController('TipolocalizaManager');
			$tipolocaliza_data = $tipolocaliza_manager->getByIdTipolocaliza($tipolocaliza__tilocodigos);

			$_REQUEST["tipolocaliza__tilocodigos"] = $tipolocaliza_data[0]["tilocodigos"];
			$_REQUEST["tipolocaliza__tilonombres"] = $tipolocaliza_data[0]["tilonombres"];
			$_REQUEST["tipolocaliza__tilodesc"] = $tipolocaliza_data[0]["tilodesc"];
			$_REQUEST["tipolocaliza__tilocodpadrs"] = $tipolocaliza_data[0]["tilocodpadrs"];
			$_REQUEST["tipolocaliza__tiloimagens"] = $tipolocaliza_data[0]["tiloimagens"];
			$_REQUEST["tipolocaliza__tiloestados"] = $tipolocaliza_data[0]["tiloestados"];

		} else {

			$_REQUEST["tipolocaliza__tilocodigos"] = WebSession :: getProperty("tipolocaliza__tilocodigos");
			$_REQUEST["tipolocaliza__tilonombres"] = WebSession :: getProperty("tipolocaliza__tilonombres");
			$_REQUEST["tipolocaliza__tilodesc"] = WebSession :: getProperty("tipolocaliza__tilodesc");
			$_REQUEST["tipolocaliza__tilocodpadrs"] = WebSession :: getProperty("tipolocaliza__tilocodpadrs");
			$_REQUEST["tipolocaliza__tiloimagens"] = WebSession :: getProperty("tipolocaliza__tiloimagens");
			$_REQUEST["tipolocaliza__tiloestados"] = WebSession :: getProperty("tipolocaliza__tiloestados");
		}

		WebSession :: unsetProperty("tipolocaliza__tilocodigos");
		WebSession :: unsetProperty("tipolocaliza__tilonombres");
		WebSession :: unsetProperty("tipolocaliza__tilodesc");
		WebSession :: unsetProperty("tipolocaliza__tilocodpadrs");
		WebSession :: unsetProperty("tipolocaliza__tiloimagens");
		WebSession :: unsetProperty("tipolocaliza__tiloestados");

		return "success";
	}
}
?>