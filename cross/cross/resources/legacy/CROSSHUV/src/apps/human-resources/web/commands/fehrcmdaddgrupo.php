<?php 
/*
// you can define the commando extending the WebCommand

require_once "Web/WebCommand.php";
class DefaultCommand extends WebCommand {
}
// really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeHrCmdAddGrupo {

	function execute() {
		extract($_REQUEST);

		if (($grupo__grupcodigos != NULL) && ($grupo__grupcodigos != "") 
		&& ($grupo__esgrcodigos != NULL) && ($grupo__esgrcodigos != "")) {
			$objServ = Application :: loadServices("Data_type");

			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
			if($objServ->formatPrimaryKey($grupo__grupcodigos) == false){
					WebRequest::setProperty('cod_message',$message = 4);
					return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$grupo__grupnombres = $objServ->formatString($grupo__grupnombres);

			$grupo_manager = Application :: getDomainController('GrupoManager');
			$message = $grupo_manager->addGrupo($grupo__grupcodigos, 
			$grupo__grupnombres, $grupo__esgrcodigos);
			WebRequest :: setProperty('cod_message', $message);
			//Limpia el detalle del personal de la sesion
			//WebSession :: unsetProperty("Grupodetalle");
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>