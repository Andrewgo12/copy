<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowListOrganizacion {
	function execute() {
		
		settype($serviceDate,"object");
		settype($objService,"object");
		extract($_REQUEST);
		$serviceDate = Application :: loadServices("DateController");
		$objService = Application :: loadServices("Data_type");
		if($organizacion__organombres){
			$_REQUEST["organizacion__organombres"] = $objService->formatString($organizacion__organombres);
		}
		if($organizacion__orgatelefo1s){
			$_REQUEST["organizacion__orgatelefo1s"] = $objService->formatString($organizacion__orgatelefo1s);
		}
		if($organizacion__orgatelefo2s){
			$_REQUEST["organizacion__orgatelefo2s"] = $objService->formatString($organizacion__orgatelefo2s);
		}
		if (!WebSession :: issetProperty("organizacion__orgacodigos"))
			WebSession :: setProperty("organizacion__orgacodigos", $organizacion__orgacodigos);
		if (!WebSession :: issetProperty("organizacion__organombres"))
			WebSession :: setProperty("organizacion__organombres", $organizacion__organombres);
		if (!WebSession :: issetProperty("organizacion__tiorcodigos"))
			WebSession :: setProperty("organizacion__tiorcodigos", $organizacion__tiorcodigos);
		if (!WebSession :: issetProperty("organizacion__orgacgpads"))
			WebSession :: setProperty("organizacion__orgacgpads", $organizacion__orgacgpads);
		if (!WebSession :: issetProperty("organizacion__orgaordenn"))
			WebSession :: setProperty("organizacion__orgaordenn", $organizacion__orgaordenn);
		if (!WebSession :: issetProperty("organizacion__orgafechcred")){
			WebSession :: setProperty("organizacion__orgafechcred", $organizacion__orgafechcred);
			if($organizacion__orgafechcred){
				$_REQUEST["organizacion__orgafechcred"] =$serviceDate->fncdatehourtoint($organizacion__orgafechcred);
			}
		}else{
			$_REQUEST["organizacion__orgafechcred"] =$serviceDate->fncdatehourtoint($organizacion__orgafechcred);
		}	
		if (!WebSession :: issetProperty("organizacion__esorcodigos"))
			WebSession :: setProperty("organizacion__esorcodigos", $organizacion__esorcodigos);
		if (!WebSession :: issetProperty("organizacion__grupcodigos"))
			WebSession :: setProperty("organizacion__grupcodigos", $organizacion__grupcodigos);
		if (!WebSession :: issetProperty("organizacion__orgatelefo1s"))
			WebSession :: setProperty("organizacion__orgatelefo1s", $organizacion__orgatelefo1s);
		if (!WebSession :: issetProperty("organizacion__orgatelefo2s"))
			WebSession :: setProperty("organizacion__orgatelefo2s", $organizacion__orgatelefo2s);
		if (!WebSession :: issetProperty("organizacion__locacodigos"))
			WebSession :: setProperty("organizacion__locacodigos", $organizacion__locacodigos);
		if (!WebSession :: issetProperty("organizacion_locacodigos_desc"))
			WebSession :: setProperty("organizacion_locacodigos_desc", $organizacion_locacodigos_desc);
		return "success";
	}
}
?>