<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdAddEstadogrupo {

	function execute() {
		extract($_REQUEST);

		if (($estadogrupo__esgrcodigos != NULL) && ($estadogrupo__esgrcodigos != "")
		 && ($estadogrupo__esgrnombres != NULL) && ($estadogrupo__esgrnombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($estadogrupo__esgrcodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena

			$estadogrupo__esgrnombres = $objServ->formatString($estadogrupo__esgrnombres);
			$estadogrupo__esgrdescrips = $objServ->formatString($estadogrupo__esgrdescrips);

			$estadogrupo_manager = Application :: getDomainController('EstadogrupoManager');
			$message = $estadogrupo_manager->addEstadogrupo($estadogrupo__esgrcodigos, 
			$estadogrupo__esgrnombres, $estadogrupo__esgrdescrips, $estadogrupo__esgractivas);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}
?>