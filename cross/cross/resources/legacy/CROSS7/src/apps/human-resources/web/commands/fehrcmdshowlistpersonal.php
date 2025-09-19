<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowListPersonal {
	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		$objService = Application :: loadServices("Data_type");
		if($personal__persidentifs){
			$_REQUEST["personal__persidentifs"] = $objService->formatString($personal__persidentifs);
		}
		if($personal__persnombres){
			$_REQUEST["personal__persnombres"] = $objService->formatString($personal__persnombres);
		}
		if($personal__persapell1s){
			$_REQUEST["personal__persapell1s"] = $objService->formatString($personal__persapell1s);
		}
		if($personal__persapell2s){
			$_REQUEST["personal__persapell2s"] = $objService->formatString($personal__persapell2s);
		}if($personal__persprofecs){
			$_REQUEST["personal__persprofecs"] = $objService->formatString($personal__persprofecs);
		}
		if($personal__perstelefo1){
			$_REQUEST["personal__perstelefo1"] = $objService->formatString($personal__perstelefo1);
		}if($personal__perstelefo2){
			$_REQUEST["personal__perstelefo2"] = $objService->formatString($personal__perstelefo2);
		}
		if($personal__persdireccis){
			$_REQUEST["personal__persdireccis"] = $objService->formatString($personal__persdireccis);
		}if($personal__perscontacts){
			$_REQUEST["personal__perscontacts"] = $objService->formatString($personal__perscontacts);
		}
		if($personal__perstelcont){
			$_REQUEST["personal__perstelcont"] = $objService->formatString($personal__perstelcont);
		}
		if($personal__locacodigos){
			$_REQUEST["personal__locacodigos"] = $objService->formatString($personal__locacodigos);
		}
		
		if (!WebSession :: issetProperty("personal__perscodigos"))
			WebSession :: setProperty("personal__perscodigos", $personal__perscodigos);
		if (!WebSession :: issetProperty("personal__persidentifs"))
			WebSession :: setProperty("personal__persidentifs", $personal__persidentifs);
		if (!WebSession :: issetProperty("personal__persnombres"))
			WebSession :: setProperty("personal__persnombres", $personal__persnombres);
		if (!WebSession :: issetProperty("personal__persapell1s"))
			WebSession :: setProperty("personal__persapell1s", $personal__persapell1s);
		if (!WebSession :: issetProperty("personal__persapell2s"))
			WebSession :: setProperty("personal__persapell2s", $personal__persapell2s);
		if (!WebSession :: issetProperty("personal__persusrnams"))
			WebSession :: setProperty("personal__persusrnams", $personal__persusrnams);
		if (!WebSession :: issetProperty("personal__cargcodigos"))
			WebSession :: setProperty("personal__cargcodigos", $personal__cargcodigos);
		if (!WebSession :: issetProperty("personal__persprofecs"))
			WebSession :: setProperty("personal__persprofecs", $personal__persprofecs);
		if (!WebSession :: issetProperty("personal__perstelefo1"))
			WebSession :: setProperty("personal__perstelefo1", $personal__perstelefo1);
		if (!WebSession :: issetProperty("personal__perstelefo2"))
			WebSession :: setProperty("personal__perstelefo2", $personal__perstelefo2);
		if (!WebSession :: issetProperty("personal__locacodigos"))
			WebSession :: setProperty("personal__locacodigos", $personal__locacodigos);
		if (!WebSession :: issetProperty("personal_locacodigos_desc"))
			WebSession :: setProperty("personal_locacodigos_desc", $personal_locacodigos_desc);
		if (!WebSession :: issetProperty("personal__persdireccis"))
			WebSession :: setProperty("personal__persdireccis", $personal__persdireccis);
		if (!WebSession :: issetProperty("personal__persemails"))
			WebSession :: setProperty("personal__persemails", $personal__persemails);
		if (!WebSession :: issetProperty("personal__perscontacts"))
			WebSession :: setProperty("personal__perscontacts", $personal__perscontacts);
		if (!WebSession :: issetProperty("personal__perstelcont"))
			WebSession :: setProperty("personal__perstelcont", $personal__perstelcont);
		if (!WebSession :: issetProperty("personal__persestadoc"))
			WebSession :: setProperty("personal__persestadoc", $personal__persestadoc);
		return "success";
	}
}
?>