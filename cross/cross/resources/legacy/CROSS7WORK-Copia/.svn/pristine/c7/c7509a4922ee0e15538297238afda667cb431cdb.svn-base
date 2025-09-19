<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";
/**
* @Copyright 2005 Parquesoft
*
* Comando de consultar los datos de la tabla archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCrCmdShowByIdSolucion {

	function execute() {
		extract($_REQUEST);
		if (($solucion__ordenumeros != NULL) && ($solucion__ordenumeros != "")) {
			$gatewayOrdenempresa = Application :: getDataGateway("Ordenempresa");
			$rcReq = $gatewayOrdenempresa->getByIdOrdenempresa($solucion__ordenumeros);
			$_REQUEST["ordenempresa__ordenumeros"] = $rcReq[0]["ordenumeros"];
			$_REQUEST["solucion__resumen"] = $rcReq[0]["oremsolucios"];
			$_REQUEST["consult"] = 1;
		} else {
			$_REQUEST["ordenempresa__ordenumeros"] = WebSession :: getProperty("ordenempresa__ordenumeros");
			$_REQUEST["solucion__resumen"] = WebSession :: getProperty("solucion__resumen");
		}

		unset ($_REQUEST['solucion__ordenumeros']);
		WebSession :: unsetProperty("solucion__ordenumeros");
		WebSession :: unsetProperty("ordenempresa__ordenumeros");
		WebSession :: unsetProperty("solucion__resumen");

		return "success";
	}

}
?>