<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de Inicial de la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdDefaultAuth {

	function execute() {
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if ($clean_table) {
			$profilesServices = Application :: loadServices("Profiles");
			$Manager = $profilesServices->loadManager("AuthManager");
			$Manager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
			$profilesServices->close();
		}
		return "success";
	}

}

?>	
