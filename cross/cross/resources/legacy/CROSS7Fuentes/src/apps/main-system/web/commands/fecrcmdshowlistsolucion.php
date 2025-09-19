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
* Comando de mostrar el listado de la tabla archivos
* @author Ingravity 0.0.9
* @location Cali - Colombia
*/

Class FeCrCmdShowListSolucion {

	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		unset ($_REQUEST['solucion__ordenumeros']);
		
		$objService = Application :: loadServices("Data_type");
		if ($solucion__resumen)
			$_REQUEST["solucion__resumen"] = $objService->formatString($solucion__resumen);
		
		if (!WebSession :: issetProperty("ordenempresa__ordenumeros"))
			WebSession :: setProperty("ordenempresa__ordenumeros", $ordenempresa__ordenumeros);

		if (!WebSession :: issetProperty("solucion__resumen"))
			WebSession :: setProperty("solucion__resumen", $solucion__resumen);

		return "success";
	}

}
?>