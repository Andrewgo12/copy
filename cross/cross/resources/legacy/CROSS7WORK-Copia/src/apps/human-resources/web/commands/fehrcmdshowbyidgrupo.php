<?php  
/*
// you can define the commando extending the WebCommand

require_once "Web/WebCommand.php";
class DefaultCommand extends WebCommand {
}
// really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeHrCmdShowByIdGrupo {

	function execute() {
		extract($_REQUEST);
		//Carga el servicio de control de fechas
		$serviceDate = Application :: loadServices("DateController");

		if (($grupo__grupcodigon != NULL) && ($grupo__grupcodigon != "")) {

			//se limpia el detalle de personal
			WebSession :: unsetProperty("Grupodetalle");

			$grupo_manager = Application :: getDomainController('GrupoManager');
			$grupo_data = $grupo_manager->getByIdGrupo($grupo__grupcodigon);

			$_REQUEST["grupo__grupcodigon"] = $grupo_data[0]["grupcodigon"];
			$_REQUEST["grupo__grupcodigos"] = $grupo_data[0]["grupcodigos"];
			$_REQUEST["grupo__grupnombres"] = $grupo_data[0]["grupnombres"];
			$_REQUEST["grupo__esgrcodigos"] = $grupo_data[0]["esgrcodigos"];
			if ($grupo_data[0]["grupfchainin"] !== null || $grupo_data[0]["grupfchainin"] !== "")
				$_REQUEST["grupo__grupfchainin"] = $serviceDate->fncformatofechahora($grupo_data[0]["grupfchainin"]);
			if ($grupo_data[0]["grupfchafinn"] !== null || $grupo_data[0]["grupfchafinn"] !== "")
				$_REQUEST["grupo__grupfchafinn"] = $serviceDate->fncformatofechahora($grupo_data[0]["grupfchafinn"]);
			$_REQUEST["grupo__grupactivos"] = $grupo_data[0]["grupactivos"];

		} else {
			$_REQUEST["grupo__grupcodigon"] = WebSession :: getProperty("grupo__grupcodigon");
			$_REQUEST["grupo__grupcodigos"] = WebSession :: getProperty("grupo__grupcodigos");
			$_REQUEST["grupo__grupnombres"] = WebSession :: getProperty("grupo__grupnombres");
			$_REQUEST["grupo__esgrcodigos"] = WebSession :: getProperty("grupo__esgrcodigos");
			$_REQUEST["grupo__grupfchainin"] = WebSession :: getProperty("grupo__grupfchainin");
			$_REQUEST["grupo__grupfchafinn"] = WebSession :: getProperty("grupo__grupfchafinn");
			$_REQUEST["grupo__grupactivos"] = WebSession :: getProperty("grupo__grupactivos");
		}
		WebSession :: unsetProperty("grupo__grupcodigon");
		WebSession :: unsetProperty("grupo__grupcodigos");
		WebSession :: unsetProperty("grupo__grupnombres");
		WebSession :: unsetProperty("grupo__esgrcodigos");
		WebSession :: unsetProperty("grupo__grupfchainin");
		WebSession :: unsetProperty("grupo__grupfchafinn");
		WebSession :: unsetProperty("grupo__grupactivos");

		return "success";
	}
}
?>