<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeWFCmdCancelShowListProceso {

	function execute() {
		
		settype($serviceDate,"object");
        //Carga el servicio de control de fechas 
		$serviceDate = Application :: loadServices("DateController");

		$_REQUEST["proceso__proccodigos"] = WebSession :: getProperty("proceso__proccodigos");
		$_REQUEST["proceso__procnombres"] = WebSession :: getProperty("proceso__procnombres");
		$_REQUEST["proceso__procdescris"] = WebSession :: getProperty("proceso__procdescris");
		$_REQUEST["proceso__perscodigos"] = WebSession :: getProperty("proceso__perscodigos");
		$_REQUEST["proceso__procestinis"] = WebSession :: getProperty("proceso__procestinis");
		$_REQUEST["proceso__procestfins"] = WebSession :: getProperty("proceso__procestfins");
		if(WebSession :: getProperty("proceso__procfeccren")){
			$_REQUEST["proceso__procfeccren"] = $serviceDate->fncformatofechahora(WebSession :: getProperty("proceso__procfeccren"));
		}
		$_REQUEST["proceso__orgacodigos"] = WebSession :: getProperty("proceso__orgacodigos");
		$proceso__proctiempon = WebSession :: getProperty("proceso__proctiempon");
		//Calcula la cantidad de dias y horas
		$dias = floor($proceso__proctiempon / 86400);
		$horas = (($proceso__proctiempon % 86400) / 60) / 60;
		$_REQUEST["proceso__proctiempon"] = $dias;
		$_REQUEST["horas"] = $horas;

		$_REQUEST["tiorcodigos"] = WebSession :: getProperty("tiorcodigos");
		$_REQUEST["evencodigos"] = WebSession :: getProperty("evencodigos");
		$_REQUEST["causcodigos"] = WebSession :: getProperty("causcodigos");

		$_REQUEST["proceso__procactivas"] = WebSession :: getProperty("proceso__procactivas");


		WebSession :: unsetProperty("proceso__proccodigos");
		WebSession :: unsetProperty("proceso__procnombres");
		WebSession :: unsetProperty("proceso__procdescris");
		WebSession :: unsetProperty("proceso__perscodigos");
		WebSession :: unsetProperty("proceso__procestinis");
		WebSession :: unsetProperty("proceso__procestfins");
		WebSession :: unsetProperty("proceso__procfeccren");
		WebSession :: unsetProperty("proceso__orgacodigos");
		WebSession :: unsetProperty("proceso__proctiempon");

		WebSession :: unsetProperty("tiorcodigos");
		WebSession :: unsetProperty("evencodigos");
		WebSession :: unsetProperty("causcodigos");

		WebSession :: unsetProperty("proceso__procactivas");

		return "success";
	}
}
?>	