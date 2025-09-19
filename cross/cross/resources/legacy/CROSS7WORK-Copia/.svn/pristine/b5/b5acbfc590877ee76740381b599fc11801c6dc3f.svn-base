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
 * Comando de mostrar la interfaz de la tabla archivos
 * @author Ingravity 0.0.9
 * @location Cali - Colombia
 */

Class FeCrCmdDefaultSolucion {

	function execute() {

		extract($_REQUEST);
		settype($objManager, "object");
		
		$objManager = Application :: getDomainController("SolucionManager");
		$objManager->unsetAttachment();
		//SI limpia el $_REQUEST
		if (($clean_table)) {	
			$objManager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
	}
}
?>