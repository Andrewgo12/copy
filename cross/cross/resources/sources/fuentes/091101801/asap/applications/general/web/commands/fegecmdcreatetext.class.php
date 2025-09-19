<?php


/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCreatetext {
	function execute() {

		settype($objManager, "object");
		settype($rcTmp, "array");
		settype($sbOutput, "string");

		extract($_REQUEST);

		if ($focacodigos) {

			$objManager = Application :: getDomainController('CentroComunicacionManager');
			$rcTmp = $objManager->fncCreateComunicacion($ordenumeros, $focacodigos);
			if ($rcTmp["result"] == 3) {
				$sbOutput = $rcTmp["text"];
			}
		}
		die($sbOutput);
	}
}
?>