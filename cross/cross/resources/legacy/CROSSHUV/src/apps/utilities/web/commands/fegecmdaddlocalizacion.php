<?php  
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdAddLocalizacion {

	function execute() {
		settype($sbmessage,"string");
		settype($sbDbNull,"string");
		extract($_REQUEST);

		if (($localizacion__locacodigos != NULL) && ($localizacion__locacodigos != "") 
		&& ($localizacion__locanombres != NULL) && ($localizacion__locanombres != "")
		&& ($localizacion__tilocodigos != NULL) && ($localizacion__tilocodigos != "")) {
			$objServ = Application :: loadServices("Data_type");
			//Hace la validacion de formato (Caracteres no permitidos) de la llave primaria

			if ($objServ->formatPrimaryKey($localizacion__locacodigos) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}
			
			//constantes
			$sbDbNull = Application :: getConstant("DB_NULL");

			//Hace la validacion de campos numericos y formateo de campos cadena

			$localizacion__locanombres = $objServ->formatString($localizacion__locanombres);
			$localizacion__locadescrips = $objServ->formatString($localizacion__locadescrips);
			$localizacion__tilocodigos = $objServ->formatString($localizacion__tilocodigos);
			$localizacion__locazonas = $objServ->formatString($localizacion__locazonas);

			if ($localizacion__locacodpadrs) {
				if ($objServ->formatPrimaryKey($localizacion__locacodpadrs) == false) {
					WebRequest :: setProperty('cod_message', $sbmessage = 4);
					return "fail";
				}
			}
			
			if ($localizacion__locacodpadrs == "" || $localizacion__locacodpadrs == NULL) {
				$localizacion__locacodpadrs = $sbDbNull;
			}

			if ($localizacion__locaordenn == "" || $localizacion__locaordenn == NULL) {
				$localizacion__locaordenn = $sbDbNull;
			}elseif ($objServ->isInteger($localizacion__locaordenn) == false) {
				WebRequest :: setProperty('cod_message', $sbmessage = 4);
				return "fail";
			}

			$localizacion_manager = Application :: getDomainController('LocalizacionManager');
			$sbmessage = $localizacion_manager->addLocalizacion($localizacion__locacodigos, $localizacion__locanombres, $localizacion__locadescrips, $localizacion__tilocodigos, $localizacion__locacodpadrs, $localizacion__locaordenn, $localizacion__locazonas, $localizacion__locaestados);
			WebRequest :: setProperty('cod_message', $sbmessage);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $sbmessage = 0);
			return "fail";
		}
	}
}
?>