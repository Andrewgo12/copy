<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultIndicador {

    function execute() {
		extract($_REQUEST);
		settype($objManager,"object");
		//SI limpia el $_REQUEST
		if (($clean_table)) {
			$objManager = Application :: getDomainController("IndicadorManager");
			$objManager->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		return "success";
    }
}
?>