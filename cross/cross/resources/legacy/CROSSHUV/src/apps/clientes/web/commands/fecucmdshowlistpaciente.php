<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeCuCmdShowListPaciente {

	function execute() {
		extract($_REQUEST);
		settype($objService,"object");
		settype($objDate, "object");
		
		$objService = Application :: loadServices("Data_type");
		$objDate = Application :: loadServices("DateController");
		
		if ($paciente__paciindentis)
			$_REQUEST["paciente__paciindentis"] = $objService->formatString($paciente__paciindentis);
			
		if ($paciente__tiidcodigos)
			$_REQUEST["paciente__tiidcodigos"] = $objService->formatString($paciente__tiidcodigos);
			
		if ($paciente__paciprinoms)
			$_REQUEST["paciente__paciprinoms"] = $objService->formatString($paciente__paciprinoms);
			
		if ($paciente__pacisegnoms)
			$_REQUEST["paciente__pacisegnoms"] = $objService->formatString($paciente__pacisegnoms);
			
		if ($paciente__pacipriapes)
			$_REQUEST["paciente__pacipriapes"] = $objService->formatString($paciente__pacipriapes);
			
		if ($paciente__pacisegapes)
			$_REQUEST["paciente__pacisegapes"] = $objService->formatString($paciente__pacisegapes);
			
		if ($paciente__paciemail)
			$_REQUEST["paciente__paciemail"] = $objService->formatString($paciente__paciemail);
			
		if ($paciente__locacodigos)
			$_REQUEST["paciente__locacodigos"] = $objService->formatString($paciente__locacodigos);
			
		if ($paciente__pacidirecios)
			$_REQUEST["paciente__pacidirecios"] = $objService->formatString($paciente__pacidirecios);
			
		if ($paciente__pacitelefons)
			$_REQUEST["paciente__pacitelefons"] = $objService->formatString($paciente__pacitelefons);
			
		if ($paciente__paciobservs)
			$_REQUEST["paciente__paciobservs"] = $objService->formatString($paciente__paciobservs);
			
		if ($paciente__pacihisclis)
			$_REQUEST["paciente__pacihisclis"] = $objService->formatString($paciente__pacihisclis);
			
		if ($paciente__pacifecnacis)
			$_REQUEST["paciente__pacifecnacis"] = $objDate->fncdatetoint($paciente__pacifecnacis);

		if (!WebSession :: issetProperty("paciente__paciindentis"))
			WebSession :: setProperty("paciente__paciindentis", $paciente__paciindentis);
			
		if (!WebSession :: issetProperty("paciente__tiidcodigos"))
			WebSession :: setProperty("paciente__tiidcodigos", $paciente__tiidcodigos);

		if (!WebSession :: issetProperty("paciente__paciprinoms"))
			WebSession :: setProperty("paciente__paciprinoms", $paciente__paciprinoms);
			
		if (!WebSession :: issetProperty("paciente__pacisegnoms"))
			WebSession :: setProperty("paciente__pacisegnoms", $paciente__pacisegnoms);
			
		if (!WebSession :: issetProperty("paciente__pacipriapes"))
			WebSession :: setProperty("paciente__pacipriapes", $paciente__pacipriapes);
			
		if (!WebSession :: issetProperty("paciente__pacisegapes"))
			WebSession :: setProperty("paciente__pacisegapes", $paciente__pacisegapes);

		if (!WebSession :: issetProperty("paciente__pacifecnacis"))
			WebSession :: setProperty("paciente__pacifecnacis", $paciente__pacifecnacis);

		if (!WebSession :: issetProperty("paciente__sexocodigos"))
			WebSession :: setProperty("paciente__sexocodigos", $paciente__sexocodigos);

		if (!WebSession :: issetProperty("paciente__paciemail"))
			WebSession :: setProperty("paciente__paciemail", $paciente__paciemail);

		if (!WebSession :: issetProperty("paciente__locacodigos"))
			WebSession :: setProperty("paciente__locacodigos", $paciente__locacodigos);

		if (!WebSession :: issetProperty("paciente_locacodigos_desc"))
			WebSession :: setProperty("paciente_locacodigos_desc", $paciente_locacodigos_desc);

		if (!WebSession :: issetProperty("paciente__pacidirecios"))
			WebSession :: setProperty("paciente__pacidirecios", $paciente__pacidirecios);

		if (!WebSession :: issetProperty("paciente__pacitelefons"))
			WebSession :: setProperty("paciente__pacitelefons", $paciente__pacitelefons);

		if (!WebSession :: issetProperty("paciente__paciobservs"))
			WebSession :: setProperty("paciente__paciobservs", $paciente__paciobservs);
			
		if (!WebSession :: issetProperty("paciente__pacihisclis"))
			WebSession :: setProperty("paciente__pacihisclis", $paciente__pacihisclis);
			
		if (!WebSession :: issetProperty("paciente__pacinumcels"))
			WebSession :: setProperty("paciente__pacinumcels", $paciente__pacinumcels);

		return "success";
	}
}
?>