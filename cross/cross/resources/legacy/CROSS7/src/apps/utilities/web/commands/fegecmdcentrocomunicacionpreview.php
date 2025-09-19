<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeGeCmdCentroComunicacionPreview {
	function execute() {
		settype($rctmp, "array");
		settype($sbtexto, "string");
		settype($comunicacion_manager, "object");

		unset ($_REQUEST["comutextos"]);

		if ($_REQUEST["comunicacion__comucodigos"]) {
			$comunicacion_manager = Application :: getDomainController('ComunicacionManager');
			$rctmp = $comunicacion_manager->getByIdComunicacion($_REQUEST["comunicacion__comucodigos"]);
			$sbtexto = $rctmp[0]["comutextos"];
			if($sbtexto){
				$sbtexto = htmlentities($sbtexto);
				$_REQUEST["comutextos"] = $sbtexto;
			}
			unset ($_REQUEST["comunicacion__comucodigos"]);
		}
		return "success";
	}
}
?>	