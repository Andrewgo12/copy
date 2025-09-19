<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdUpdateTipolocaliza {

	function execute() {
		extract($_REQUEST);
		settype($rcMessage,"array");
		settype($sbDbNull,"string");

		if (($tipolocaliza__tilocodigos != NULL) && ($tipolocaliza__tilocodigos != "") 
		&& ($tipolocaliza__tilonombres != NULL) && ($tipolocaliza__tilonombres != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($tipolocaliza__tilocodigos) == false) {
				WebRequest :: setProperty('cod_message', $rcMessage = 4);
				return "fail";
			}
			
			//constantes
			$sbDbNull = Application :: getConstant("DB_NULL");

			//Hace la validacion de campos numericos y formateo de campos cadena

			$tipolocaliza__tilonombres = $objServ->formatString($tipolocaliza__tilonombres);

			$tipolocaliza__tilodesc = $objServ->formatString($tipolocaliza__tilodesc);

			if ($tipolocaliza__tilocodpadrs == "" || $tipolocaliza__tilocodpadrs == NULL) {
				$tipolocaliza__tilocodpadrs = $sbDbNull;
			}
	
			if ($tipolocaliza__tilocodpadrs) {
				if ($objServ->formatPrimaryKey($tipolocaliza__tilocodpadrs) == false) {
					WebRequest :: setProperty('cod_message', $sbmessage = 4);
					return "fail";
				}
			}

			$tipolocaliza__tiloimagens = $objServ->formatString($tipolocaliza__tiloimagens);
			if($tipolocaliza__tiloimagens == "" || $tipolocaliza__tiloimagens == NULL){
				$tipolocaliza__tiloimagens = $sbDbNull;
			}

			$tipolocaliza_manager = Application :: getDomainController('TipolocalizaManager');
			$rcMessage = $tipolocaliza_manager->updateTipolocaliza($tipolocaliza__tilocodigos, $tipolocaliza__tilonombres, $tipolocaliza__tilodesc, $tipolocaliza__tilocodpadrs, $tipolocaliza__tiloimagens, $tipolocaliza__tiloestados);
			WebRequest :: setProperty('cod_message', $rcMessage["result"]);
			if($rcMessage["result"] == 48){
				WebRequest :: setProperty('param', $rcMessage["tilocodigos"]);
			}
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $rcMessage["result"] = 0);
			return "fail";
		}
	}
}
?>