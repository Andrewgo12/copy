<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeHrCmdShowListGrupo {

	function execute() {
		
		settype($objService,"object");
		extract($_REQUEST);
		
		foreach ($_REQUEST as $index => $value) {
			if (stripos($index,'grupodetalle__')!==false) {
				$_REQUEST[$index] = '';
			}
		}
		if ($_REQUEST['grupo__grupcodigon'])
			$_REQUEST['grupo__grupcodigon'] = '';

		WebSession :: unsetProperty("Grupodetalle");
		
		$objService = Application :: loadServices("Data_type");
		if($grupo__grupnombres){
			$_REQUEST["grupo__grupnombres"] = $objService->formatString($grupo__grupnombres);
		}

		if (!WebSession :: issetProperty("grupo__grupcodigon"))
			WebSession :: setProperty("grupo__grupcodigon", $grupo__grupcodigon);

		if (!WebSession :: issetProperty("grupo__grupcodigos"))
			WebSession :: setProperty("grupo__grupcodigos", $grupo__grupcodigos);

		if (!WebSession :: issetProperty("grupo__grupnombres"))
			WebSession :: setProperty("grupo__grupnombres", $grupo__grupnombres);

		if (!WebSession :: issetProperty("grupo__esgrcodigos"))
			WebSession :: setProperty("grupo__esgrcodigos", $grupo__esgrcodigos);

		if (!WebSession :: issetProperty("grupo__grupfchainin"))
			WebSession :: setProperty("grupo__grupfchainin", $grupo__grupfchainin);

		if (!WebSession :: issetProperty("grupo__grupfchafinn"))
			WebSession :: setProperty("grupo__grupfchafinn", $grupo__grupfchafinn);

		return "success";
	}

}
?>