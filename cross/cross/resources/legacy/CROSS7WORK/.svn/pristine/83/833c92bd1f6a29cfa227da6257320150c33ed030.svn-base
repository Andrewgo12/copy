<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListIpsservicio {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($ipsservicio__ipsenombres){
			$_REQUEST["ipsservicio__ipsenombres"] = $objService->formatString($ipsservicio__ipsenombres);
		}
		if($ipsservicio__ipsedescrips){
			$_REQUEST["ipsservicio__ipsedescrips"] = $objService->formatString($ipsservicio__ipsedescrips);
		}
		
		if (!WebSession :: issetProperty("ipsservicio__ipsecodigos"))
			WebSession :: setProperty("ipsservicio__ipsecodigos", $ipsservicio__ipsecodigos);
		if (!WebSession :: issetProperty("ipsservicio__ipsenombres"))
			WebSession :: setProperty("ipsservicio__ipsenombres", $ipsservicio__ipsenombres);
		if (!WebSession :: issetProperty("ipsservicio__ipsedescrips"))
			WebSession :: setProperty("ipsservicio__ipsedescrips", $ipsservicio__ipsedescrips);
		if (!WebSession :: issetProperty("ipsservicio__ipseactivos"))
			WebSession :: setProperty("ipsservicio__ipseactivos", $ipsservicio__ipseactivos);
		return "success";
	}
}
?>