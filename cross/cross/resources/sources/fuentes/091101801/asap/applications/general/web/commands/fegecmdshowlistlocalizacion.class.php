<?php 
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
Class FeGeCmdShowListLocalizacion {

	function execute() {
		extract($_REQUEST);
		$objServ = Application :: loadServices("Data_type");
		if($localizacion__locanombres)
		$_REQUEST["localizacion__locanombres"] = $objServ->formatString($localizacion__locanombres);
		if($localizacion__locadescrips)
		$_REQUEST["localizacion__locadescrips"] = $objServ->formatString($localizacion__locadescrips);
		if($localizacion__locazonas)
		$_REQUEST["localizacion__locazonas"] = $objServ->formatString($localizacion__locazonas);

		if (!WebSession :: issetProperty("localizacion__locacodigos"))
			WebSession :: setProperty("localizacion__locacodigos", $localizacion__locacodigos);

		if (!WebSession :: issetProperty("localizacion__locanombres"))
			WebSession :: setProperty("localizacion__locanombres", $localizacion__locanombres);

		if (!WebSession :: issetProperty("localizacion__locadescrips"))
			WebSession :: setProperty("localizacion__locadescrips", $localizacion__locadescrips);

		if (!WebSession :: issetProperty("localizacion__tilocodigos"))
			WebSession :: setProperty("localizacion__tilocodigos", $localizacion__tilocodigos);

		if (!WebSession :: issetProperty("localizacion__locacodpadrs"))
			WebSession :: setProperty("localizacion__locacodpadrs", $localizacion__locacodpadrs);

		if (!WebSession :: issetProperty("localizacion__locaordenn"))
			WebSession :: setProperty("localizacion__locaordenn", $localizacion__locaordenn);

		if (!WebSession :: issetProperty("localizacion__locazonas"))
			WebSession :: setProperty("localizacion__locazonas", $localizacion__locazonas);

		if (!WebSession :: issetProperty("localizacion__locaestados"))
			WebSession :: setProperty("localizacion__locaestados", $localizacion__locaestados);

		return "success";
	}
}
?>	