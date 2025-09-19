<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de adicionar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdAddProfiles {

	function execute() {
		extract($_REQUEST);

		if (($profiles__profcodigos != NULL) && ($profiles__profcodigos != "") && ($profiles__applcodigos != NULL) && ($profiles__applcodigos != "") && ($profiles__profnombres != NULL) && ($profiles__profnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if ($objServ->formatPrimaryKey($profiles__profcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$profiles__profdescrips = $objServ->formatString($profiles__profdescrips);
              $profiles_manager = Application::getDomainController('ProfilesManager'); 

			$message = $profiles_manager->addProfiles($profiles__profcodigos, $profiles__applcodigos, $profiles__profnombres, $profiles__profdescrips);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>