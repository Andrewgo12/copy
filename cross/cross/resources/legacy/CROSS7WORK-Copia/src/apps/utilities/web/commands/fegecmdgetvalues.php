<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdGetValues {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($rcResult, "array");
		settype($objManager, "object");
		settype($sbOutput, "string");

		$objJson = new Services_JSON();

		if ($sbFunction && $rcParams) {

			$objManager = Application :: getDomainController('GetValuesManager');
			$rcResult = $objManager->$sbFunction($sbSqlId, $rcParams);
			$sbOutput = $objJson->encode($rcResult);
			die($sbOutput);
		}
	
	}
}
?>