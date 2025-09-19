<?php

/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeWFCmdShowListTarea {
	function execute() {
		settype($objService, "object");
		extract($_REQUEST);
		$objService = Application :: loadServices("Data_type");
		if ($tarea__tarenombres) {
			$_REQUEST["tarea__tarenombres"] = $objService->formatString($tarea__tarenombres);
		}
		if ($tarea__taredescris) {
			$_REQUEST["tarea__taredescris"] = $objService->formatString($tarea__taredescris);
		}
		if (!WebSession :: issetProperty("tarea__tarecodigos"))
			WebSession :: setProperty("tarea__tarecodigos", $tarea__tarecodigos);
		if (!WebSession :: issetProperty("tarea__tarenombres"))
			WebSession :: setProperty("tarea__tarenombres", $tarea__tarenombres);
		if (!WebSession :: issetProperty("tarea__orgacodigos"))
			WebSession :: setProperty("tarea__orgacodigos", $tarea__orgacodigos);
		if (!WebSession :: issetProperty("tarea__taredescris"))
			WebSession :: setProperty("tarea__taredescris", $tarea__taredescris);
		if (!WebSession :: issetProperty("tarea__tareactivas"))
			WebSession :: setProperty("tarea__tareactivas", $tarea__tareactivas);
		return "success";
	}
}
?>