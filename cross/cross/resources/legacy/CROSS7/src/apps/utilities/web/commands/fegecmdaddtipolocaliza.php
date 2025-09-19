<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeGeCmdAddTipolocaliza {

	function execute() {
		extract($_REQUEST);
		settype($sbDbNull,"string");

		if (($tipolocaliza__tilocodigos != NULL) && ($tipolocaliza__tilocodigos != "") 
		&& ($tipolocaliza__tilonombres != NULL) && ($tipolocaliza__tilonombres != "")) {
			
			//constantes
			$sbDbNull = Application :: getConstant("DB_NULL");
			
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($tipolocaliza__tilocodigos) == false) {
				WebRequest :: setProperty('cod_message', $message = 4);
				return "fail";
			}

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
			$message = $tipolocaliza_manager->addTipolocaliza($tipolocaliza__tilocodigos, $tipolocaliza__tilonombres, $tipolocaliza__tilodesc, $tipolocaliza__tilocodpadrs, $tipolocaliza__tiloimagens, $tipolocaliza__tiloestados);
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}
}
?>	