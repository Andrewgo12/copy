<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdCancelShowListTipolocaliza {

	function execute() {

		$_REQUEST["tipolocaliza__tilocodigos"] = WebSession :: getProperty("tipolocaliza__tilocodigos");
		$_REQUEST["tipolocaliza__tilonombres"] = WebSession :: getProperty("tipolocaliza__tilonombres");
		$_REQUEST["tipolocaliza__tilodesc"] = WebSession :: getProperty("tipolocaliza__tilodesc");
		$_REQUEST["tipolocaliza__tilocodpadrs"] = WebSession :: getProperty("tipolocaliza__tilocodpadrs");
		$_REQUEST["tipolocaliza__tiloimagens"] = WebSession :: getProperty("tipolocaliza__tiloimagens");
		$_REQUEST["tipolocaliza__tiloestados"] = WebSession :: getProperty("tipolocaliza__tiloestados");

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