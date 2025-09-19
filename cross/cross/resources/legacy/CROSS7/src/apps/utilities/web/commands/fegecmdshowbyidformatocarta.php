<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowByIdFormatocarta {

	function execute() {
		extract($_REQUEST);

		if (($formatocarta__focacodigos != NULL) && ($formatocarta__focacodigos != "")) {
			$formatocarta_manager = Application :: getDomainController('FormatocartaManager');
			$formatocarta_data = $formatocarta_manager->getByIdFormatocarta($formatocarta__focacodigos);

			$_REQUEST["formatocarta__focacodigos"] = $formatocarta_data[0]["focacodigos"];
			$_REQUEST["formatocarta__focanombres"] = $formatocarta_data[0]["focanombres"];
			$_REQUEST["formatocarta__focaplantils"] = $formatocarta_data[0]["focaplantils"];
			$_REQUEST["formatocarta__focaestados"] = $formatocarta_data[0]["focaestados"];

		} else {

			$_REQUEST["formatocarta__focacodigos"] = WebSession :: getProperty("formatocarta__focacodigos");
			$_REQUEST["formatocarta__focanombres"] = WebSession :: getProperty("formatocarta__focanombres");
			$_REQUEST["formatocarta__focaplantils"] = WebSession :: getProperty("formatocarta__focaplantils");
			$_REQUEST["formatocarta__focaestados"] = WebSession :: getProperty("formatocarta__focaestados");
		}

		WebSession :: unsetProperty("formatocarta__focacodigos");
		WebSession :: unsetProperty("formatocarta__focanombres");
		WebSession :: unsetProperty("formatocarta__focaplantils");
		WebSession :: unsetProperty("formatocarta__focaestados");

		return "success";
	}
}
?>