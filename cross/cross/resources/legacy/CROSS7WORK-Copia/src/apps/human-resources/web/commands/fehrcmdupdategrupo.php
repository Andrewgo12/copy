<?php
/*
// you can define the commando extending the WebCommand

require_once "Web/WebCommand.php";
class DefaultCommand extends WebCommand {
}
// really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeHrCmdUpdateGrupo {

	function execute() {
		extract($_REQUEST);

		if (($grupo__grupcodigos != NULL) && ($grupo__grupcodigos != "") 
		&& ($grupo__esgrcodigos != NULL) && ($grupo__esgrcodigos != "")) {
			//Verifico que se haya consultado primero el grupo
			if (($grupo__grupcodigon != NULL) && ($grupo__grupcodigon != "")) {
				$objServ = Application :: loadServices("Data_type");
				//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria
				if($objServ->formatPrimaryKey($grupo__grupcodigos) == false){
						WebRequest::setProperty('cod_message',$message = 4);
						return "fail";
				}

				//Hace la validacion de campos numericos y formateo de campos cadena
				$grupo__grupnombres = $objServ->formatString($grupo__grupnombres);

				//Servicio  de manipulacion de fechas
				/*$serviceDate = Application :: loadServices("DateController");
				
				if ($serviceDate->fncvalidatedate($grupo__grupfchainin)){$grupo__grupfchainin = $serviceDate->fncdatetoint($grupo__grupfchainin);}
				else{WebRequest :: setProperty('cod_message', $message = 7);return "fail";}
				if($grupo__grupfchafinn == ""){$grupo__grupfchafinn = null;}else {
					if ($serviceDate->fncvalidatedate($grupo__grupfchafinn)){$grupo__grupfchafinn = $serviceDate->fncdatehourtoint($grupo__grupfchafinn);
					}else {WebRequest :: setProperty('cod_message', $message = 7);return "fail";}}*/

				$grupo_manager = Application :: getDomainController('GrupoManager');
				$message = $grupo_manager->updateGrupo($grupo__grupcodigon, 
				$grupo__grupcodigos, $grupo__grupnombres, $grupo__esgrcodigos, $grupo__grupactivos);
				WebRequest :: setProperty('cod_message', $message);
				return "success";
			} else {
				WebRequest :: setProperty('cod_message', $message = 8);
				return "fail";
			}
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>