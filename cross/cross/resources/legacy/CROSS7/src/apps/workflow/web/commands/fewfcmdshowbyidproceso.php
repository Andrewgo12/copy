<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdShowByIdProceso {

	function execute() {
		settype($serviceDate, "object");
		extract($_REQUEST);

		if($proccodigos)
			$proceso__proccodigos = $proccodigos;

		//Carga el servicio de control de fechas 
		$serviceDate = Application :: loadServices("DateController");

		if (($proceso__proccodigos != NULL) && ($proceso__proccodigos != "")) {
			$proceso_manager = Application :: getDomainController('ProcesoManager');
			$proceso_data = $proceso_manager->getByIdProceso($proceso__proccodigos);
			$rcDetaConf = $proceso_manager->getDetaconfprocByProceso($proceso__proccodigos) ;
			if(is_array($rcDetaConf)){
				foreach($rcDetaConf as $rcData){
					$_REQUEST[$rcData['caconombres']] = $rcData['decovalors'];
				}
			}

			$_REQUEST["proceso__proccodigos"] = $proceso_data[0]["proccodigos"];
			$_REQUEST["proceso__procnombres"] = $proceso_data[0]["procnombres"];
			$_REQUEST["proceso__procdescris"] = $proceso_data[0]["procdescris"];
			$_REQUEST["proceso__perscodigos"] = $proceso_data[0]["perscodigos"];
			$_REQUEST["proceso__procestinis"] = $proceso_data[0]["procestinis"];
			$_REQUEST["proceso__procestfins"] = $proceso_data[0]["procestfins"];
			if ($proceso_data[0]["procfeccren"]) {
				$_REQUEST["proceso__procfeccren"] = $serviceDate->fncformatofechahora($proceso_data[0]["procfeccren"]);
			}
			$_REQUEST["proceso__orgacodigos"] = $proceso_data[0]["orgacodigos"];
			//Calcula la cantidad de dias y horas
			$dias = floor($proceso_data[0]["proctiempon"] / 86400);
			$horas = (($proceso_data[0]["proctiempon"] % 86400) / 60) / 60;
			$_REQUEST["proceso__proctiempon"] = $dias;
			$_REQUEST["horas"] = $horas;
			$_REQUEST["proceso__procactivas"] = $proceso_data[0]["procactivas"];

		} else {

			$_REQUEST["proceso__proccodigos"] = WebSession :: getProperty("proceso__proccodigos");
			$_REQUEST["proceso__procnombres"] = WebSession :: getProperty("proceso__procnombres");
			$_REQUEST["proceso__procdescris"] = WebSession :: getProperty("proceso__procdescris");
			$_REQUEST["proceso__perscodigos"] = WebSession :: getProperty("proceso__perscodigos");
			$_REQUEST["proceso__procestinis"] = WebSession :: getProperty("proceso__procestinis");
			$_REQUEST["proceso__procestfins"] = WebSession :: getProperty("proceso__procestfins");
			if (WebSession :: getProperty("proceso__procfeccren")) {
				$_REQUEST["proceso__procfeccren"] = $serviceDate->fncformatofechahora(WebSession :: getProperty("proceso__procfeccren"));
			}
			$_REQUEST["proceso__orgacodigos"] = WebSession :: getProperty("proceso__orgacodigos");
			$_REQUEST["proceso__proctiempon"] = WebSession :: getProperty("proceso__proctiempon");
			$_REQUEST["horas"] = WebSession :: getProperty("horas");
			$_REQUEST["proceso__procactivas"] = WebSession :: getProperty("proceso__procactivas");
		}

		WebSession :: unsetProperty("proceso__proccodigos");
		WebSession :: unsetProperty("proceso__procnombres");
		WebSession :: unsetProperty("proceso__procdescris");
		WebSession :: unsetProperty("proceso__perscodigos");
		WebSession :: unsetProperty("proceso__procestinis");
		WebSession :: unsetProperty("proceso__procestfins");
		WebSession :: unsetProperty("proceso__procfeccren");
		WebSession :: unsetProperty("proceso__orgacodigos");
		WebSession :: unsetProperty("proceso__proctiempon");
		WebSession :: unsetProperty("horas");
		WebSession :: unsetProperty("proceso__procactivas");
		WebSession :: unsetProperty("tiorcodigos");
		WebSession :: unsetProperty("evencodigos");
		WebSession :: unsetProperty("causcodigos");

		return "success";
	}
}
?>	