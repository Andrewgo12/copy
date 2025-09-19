<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCrCmdAddPrioridad {
	function execute() {
		extract($_REQUEST);

		if (($prioridad__priocodigos != NULL) && ($prioridad__priocodigos != "")
		&& ($prioridad__prionombres != NULL) && ($prioridad__prionombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($prioridad__priocodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}
			//Hace la validacion de campos numericos y formateo de campos cadena
			$prioridad__prionombres = $objServ->formatString($prioridad__prionombres);
			$prioridad__priodescrips = $objServ->formatString($prioridad__priodescrips);
			$prioridad_manager = Application :: getDomainController('PrioridadManager');
			$message = $prioridad_manager->addPrioridad($prioridad__priocodigos,
			$prioridad__prionombres, $prioridad__priodescrips, $prioridad__prioactivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>