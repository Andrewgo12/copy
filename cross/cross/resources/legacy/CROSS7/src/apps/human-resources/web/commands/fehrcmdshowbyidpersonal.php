<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowByIdPersonal {
	function execute() {
		settype($objService, "object");
		settype($rcTmp, "array");

		extract($_REQUEST);
		if (($personal__perscodigos != NULL) && ($personal__perscodigos != "")) {
			$personal_manager = Application :: getDomainController('PersonalManager');
			$personal_data = $personal_manager->getByIdPersonal($personal__perscodigos);
			$_REQUEST["personal__perscodigos"] = $personal_data[0]["perscodigos"];
			$_REQUEST["personal__persidentifs"] = $personal_data[0]["persidentifs"];
			$_REQUEST["personal__persnombres"] = $personal_data[0]["persnombres"];
			$_REQUEST["personal__persapell1s"] = $personal_data[0]["persapell1s"];
			$_REQUEST["personal__persapell2s"] = $personal_data[0]["persapell2s"];
			$_REQUEST["personal__persusrnams"] = $personal_data[0]["persusrnams"];
			$_REQUEST["personal__cargcodigos"] = $personal_data[0]["cargcodigos"];
			$_REQUEST["personal__persprofecs"] = $personal_data[0]["persprofecs"];
			$_REQUEST["personal__perstelefo1"] = $personal_data[0]["perstelefo1"];
			$_REQUEST["personal__perstelefo2"] = $personal_data[0]["perstelefo2"];

			if ($personal_data[0]["locacodigos"]) {
				$objService = Application :: loadServices("General");
				$_REQUEST["personal__locacodigos"] = $personal_data[0]["locacodigos"];
				$rcTmp = $objService->getByIdLocalizacion($_REQUEST["personal__locacodigos"]);
				$_REQUEST["personal_locacodigos_desc"] = $rcTmp[0]["locanombres"];
			}

			$_REQUEST["personal__persdireccis"] = $personal_data[0]["persdireccis"];
			$_REQUEST["personal__persemails"] = $personal_data[0]["persemails"];
			$_REQUEST["personal__perscontacts"] = $personal_data[0]["perscontacts"];
			$_REQUEST["personal__perstelcont"] = $personal_data[0]["perstelcont"];
			$_REQUEST["personal__persestadoc"] = $personal_data[0]["persestadoc"];
		} else {
			$_REQUEST["personal__perscodigos"] = WebSession :: getProperty("personal__perscodigos");
			$_REQUEST["personal__persidentifs"] = WebSession :: getProperty("personal__persidentifs");
			$_REQUEST["personal__persnombres"] = WebSession :: getProperty("personal__persnombres");
			$_REQUEST["personal__persapell1s"] = WebSession :: getProperty("personal__persapell1s");
			$_REQUEST["personal__persapell2s"] = WebSession :: getProperty("personal__persapell2s");
			$_REQUEST["personal__persusrnams"] = WebSession :: getProperty("personal__persusrnams");
			$_REQUEST["personal__cargcodigos"] = WebSession :: getProperty("personal__cargcodigos");
			$_REQUEST["personal__persprofecs"] = WebSession :: getProperty("personal__persprofecs");
			$_REQUEST["personal__perstelefo1"] = WebSession :: getProperty("personal__perstelefo1");
			$_REQUEST["personal__perstelefo2"] = WebSession :: getProperty("personal__perstelefo2");
			$_REQUEST["personal__locacodigos"] = WebSession :: getProperty("personal__locacodigos");
			$_REQUEST["personal_locacodigos_desc"] = WebSession :: getProperty("personal_locacodigos_desc");
			$_REQUEST["personal__persdireccis"] = WebSession :: getProperty("personal__persdireccis");
			$_REQUEST["personal__persemails"] = WebSession :: getProperty("personal__persemails");
			$_REQUEST["personal__perscontacts"] = WebSession :: getProperty("personal__perscontacts");
			$_REQUEST["personal__perstelcont"] = WebSession :: getProperty("personal__perstelcont");
			$_REQUEST["personal__persestadoc"] = WebSession :: getProperty("personal__persestadoc");
		}
		WebSession :: unsetProperty("personal__perscodigos");
		WebSession :: unsetProperty("personal__persidentifs");
		WebSession :: unsetProperty("personal__persnombres");
		WebSession :: unsetProperty("personal__persapell1s");
		WebSession :: unsetProperty("personal__persapell2s");
		WebSession :: unsetProperty("personal__persusrnams");
		WebSession :: unsetProperty("personal__cargcodigos");
		WebSession :: unsetProperty("personal__persprofecs");
		WebSession :: unsetProperty("personal__perstelefo1");
		WebSession :: unsetProperty("personal__perstelefo2");
		WebSession :: unsetProperty("personal__locacodigos");
		WebSession :: unsetProperty("personal_locacodigos_desc");
		WebSession :: unsetProperty("personal__persdireccis");
		WebSession :: unsetProperty("personal__persemails");
		WebSession :: unsetProperty("personal__perscontacts");
		WebSession :: unsetProperty("personal__perstelcont");
		WebSession :: unsetProperty("personal__persestadoc");
		return "success";
	}
}
?>