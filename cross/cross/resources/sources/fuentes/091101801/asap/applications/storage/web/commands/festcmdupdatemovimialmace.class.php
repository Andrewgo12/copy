<?php   
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdUpdateMovimialmace {
	function execute() {
		extract($_REQUEST);
		if (($movimialmace__bodecodigos_in != NULL) && ($movimialmace__bodecodigos_in != "") && ($movimialmace__bodecodigos_out != NULL) && ($movimialmace__bodecodigos_out != "") && ($movimialmace__comocodigos_in != NULL) && ($movimialmace__comocodigos_in != "") && ($movimialmace__comocodigos_out != NULL) && ($movimialmace__comocodigos_out != "") && ($movimialmace__tidocodigos != NULL) && ($movimialmace__tidocodigos != "") && ($movimialmace__moalnumedocs != NULL) && ($movimialmace__moalnumedocs != "")) {
			//Verifica que las bodegas no sean iguales
			if($movimialmace__bodecodigos_in == $movimialmace__bodecodigos_out){
				WebRequest :: setProperty('cod_message', $message = 10);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				return "fail";
			}
			//Verifica que el movimiento no sea entre dos bodegas externas
			//Verifica que los conceptos de movimiento no sean iguales
			if($movimialmace__comocodigos_in == $movimialmace__comocodigos_out){
				WebRequest :: setProperty('cod_message', $message = 11);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				return "fail";
			}
			//Extrae de la sesion los recursos ingresados 
			$rcResources = WebSession :: getProperty("genericData");
			if (!is_array($rcResources)) {
				WebRequest :: setProperty('cod_message', $message = 12);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				return "fail";
			}
			//Arma una matriz con los datos genericos del movimiento
			$rcGeneric["bodecodigos_in"] = $movimialmace__bodecodigos_in;
			$rcGeneric["bodecodigos_out"] = $movimialmace__bodecodigos_out;
			$rcGeneric["comocodigos_in"] = $movimialmace__comocodigos_in;
			$rcGeneric["comocodigos_out"] = $movimialmace__comocodigos_out;
			$rcGeneric["tidocodigos"] = $movimialmace__tidocodigos;
			$rcGeneric["moalnumedocs"] = $movimialmace__moalnumedocs;
			//Hace el grabado de los movimientos
			$movimialmace_manager = Application :: getDomainController('MovimialmaceManager');
			$result = $movimialmace_manager->addMovimialmace($rcGeneric,$rcResources) ;
			if(is_array($result)){
				$message = $result["fallo"];
				$rcParams = array($result["msg"]);
				WebSession :: setProperty("params", $rcParams);
				WebRequest :: setProperty('cod_message', $message);
				WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
				return "fail";
			}
			$message = $result;
			$rcResources = null;
			WebSession :: setProperty("genericData", $rcResources);
			WebSession :: setProperty("params", $rcParamas = null);
			WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
			WebRequest :: setProperty('cod_message', $message);
			unset ($_REQUEST["movimialmace__recucodigos"]);
			unset ($_REQUEST["movimialmace__recucodigos_desc"]);
			unset ($_REQUEST["movimialmace__moalcantrecf"]);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
			return "fail";
		}
	}
}
?>	
