<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeCuCmdShowListContacto {

	function execute() {
		extract($_REQUEST);
		settype($objService,"object");
		settype($objDate, "object");
		
		$objService = Application :: loadServices("Data_type");
		$objDate = Application :: loadServices("DateController");
		
		if ($contacto__contindentis)
			$_REQUEST["contacto__contindentis"] = $objService->formatString($contacto__contindentis);
			
		if ($contacto__tiidcodigos)
			$_REQUEST["contacto__tiidcodigos"] = $objService->formatString($contacto__tiidcodigos);
			
		if ($contacto__contprinoms)
			$_REQUEST["contacto__contprinoms"] = $objService->formatString($contacto__contprinoms);
			
		if ($contacto__contsegnoms)
			$_REQUEST["contacto__contsegnoms"] = $objService->formatString($contacto__contsegnoms);
			
		if ($contacto__contpriapes)
			$_REQUEST["contacto__contpriapes"] = $objService->formatString($contacto__contpriapes);
			
		if ($contacto__contsegapes)
			$_REQUEST["contacto__contsegapes"] = $objService->formatString($contacto__contsegapes);
			
		if ($contacto__contemail)
			$_REQUEST["contacto__contemail"] = $objService->formatString($contacto__contemail);
			
		if ($contacto__locacodigos)
			$_REQUEST["contacto__locacodigos"] = $objService->formatString($contacto__locacodigos);
			
		if ($contacto__contdirecios)
			$_REQUEST["contacto__contdirecios"] = $objService->formatString($contacto__contdirecios);
			
		if ($contacto__conttelefons)
			$_REQUEST["contacto__conttelefons"] = $objService->formatString($contacto__conttelefons);
			
		if ($contacto__contobservs)
			$_REQUEST["contacto__contobservs"] = $objService->formatString($contacto__contobservs);
			
		if ($contacto__contfecnacis)
			$_REQUEST["contacto__contfecnacis"] = $objDate->fncdatetoint($contacto__contfecnacis);

		if (!WebSession :: issetProperty("contacto__contcodigon"))
			WebSession :: setProperty("contacto__contcodigon", $contacto__contcodigon);

		if (!WebSession :: issetProperty("contacto__contindentis"))
			WebSession :: setProperty("contacto__contindentis", $contacto__contindentis);
			
		if (!WebSession :: issetProperty("contacto__tiidcodigos"))
			WebSession :: setProperty("contacto__tiidcodigos", $contacto__tiidcodigos);

		if (!WebSession :: issetProperty("contacto__cliecodigon"))
			WebSession :: setProperty("contacto__cliecodigon", $contacto__cliecodigon);

		if (!WebSession :: issetProperty("contacto__contprinoms"))
			WebSession :: setProperty("contacto__contprinoms", $contacto__contprinoms);
			
		if (!WebSession :: issetProperty("contacto__contsegnoms"))
			WebSession :: setProperty("contacto__contsegnoms", $contacto__contsegnoms);
			
		if (!WebSession :: issetProperty("contacto__contpriapes"))
			WebSession :: setProperty("contacto__contpriapes", $contacto__contpriapes);
			
		if (!WebSession :: issetProperty("contacto__contsegapes"))
			WebSession :: setProperty("contacto__contsegapes", $contacto__contsegapes);

		if (!WebSession :: issetProperty("contacto__contfecnacis"))
			WebSession :: setProperty("contacto__contfecnacis", $contacto__contfecnacis);

		if (!WebSession :: issetProperty("contacto__contsexos"))
			WebSession :: setProperty("contacto__contsexos", $contacto__contsexos);

		if (!WebSession :: issetProperty("contacto__contemail"))
			WebSession :: setProperty("contacto__contemail", $contacto__contemail);

		if (!WebSession :: issetProperty("contacto__locacodigos"))
			WebSession :: setProperty("contacto__locacodigos", $contacto__locacodigos);

		if (!WebSession :: issetProperty("contacto_locacodigos_desc"))
			WebSession :: setProperty("contacto_locacodigos_desc", $contacto_locacodigos_desc);

		if (!WebSession :: issetProperty("contacto__contdirecios"))
			WebSession :: setProperty("contacto__contdirecios", $contacto__contdirecios);

		if (!WebSession :: issetProperty("contacto__conttelefons"))
			WebSession :: setProperty("contacto__conttelefons", $contacto__conttelefons);

		if (!WebSession :: issetProperty("contacto__contobservs"))
			WebSession :: setProperty("contacto__contobservs", $contacto__contobservs);
			
		if (!WebSession :: issetProperty("contacto__contedadn"))
			WebSession :: setProperty("contacto__contedadn", $contacto__contedadn);
			
		if (!WebSession :: issetProperty("contacto__contnumcels"))
			WebSession :: setProperty("contacto__contnumcels", $contacto__contnumcels);

		return "success";
	}

}
?>