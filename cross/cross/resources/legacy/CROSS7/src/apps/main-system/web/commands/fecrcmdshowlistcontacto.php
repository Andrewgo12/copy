<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeCrCmdShowListContacto {

	function execute() {
		extract($_REQUEST);
		settype($objService,"object");
		
		$objService = Application :: loadServices("Data_type");
		
		if ($contacto__contindentis)
			$_REQUEST["contacto__contindentis"] = $objService->formatString($contacto__contindentis);
		if ($contacto__tiidcodigos)
			$_REQUEST["contacto__tiidcodigos"] = $objService->formatString($contacto__tiidcodigos);
		if ($contacto__contnombre)
			$_REQUEST["contacto__contnombre"] = $objService->formatString($contacto__contnombre);
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

		if (!WebSession :: issetProperty("contacto__contcodigon"))
			WebSession :: setProperty("contacto__contcodigon", $contacto__contcodigon);

		if (!WebSession :: issetProperty("contacto__contindentis"))
			WebSession :: setProperty("contacto__contindentis", $contacto__contindentis);
		
		if (!WebSession :: issetProperty("contacto__tiidcodigos"))
			WebSession :: setProperty("contacto__tiidcodigos", $contacto__tiidcodigos);

		if (!WebSession :: issetProperty("contacto__cliecodigon"))
			WebSession :: setProperty("contacto__cliecodigon", $contacto__cliecodigon);

		if (!WebSession :: issetProperty("contacto__contnombre"))
			WebSession :: setProperty("contacto__contnombre", $contacto__contnombre);

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

		return "success";
	}
}
?>