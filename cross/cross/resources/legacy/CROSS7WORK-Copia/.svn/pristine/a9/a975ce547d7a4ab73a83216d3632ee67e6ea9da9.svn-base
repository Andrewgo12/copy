<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdTransferTareas {
	function execute() {

		settype($objService,"object");
		settype($objDate,"object");
		settype($objManager,"object");
		settype($rcData, "array");
		settype($nuMessage,"integer");

		extract($_REQUEST);

		if(($orgacodigost == null || $orgacodigost == '')
		||  ($trtafechan == null || $trtafechan == '')){
			WebRequest :: setProperty('cod_message', $nuMessage = 0);
			return "fail";
		}

		$objDate = Application :: loadServices("DateController");
		if($trtafechan){
			$trtafechan = $objDate->fncdatehourtoint($trtafechan);
		}

		$objService = Application :: loadServices("Data_type");
		$trtaobservas = $objService->formatString($trtaobservas);

		//parametros extra
		$rcData["trtafechan"] = $trtafechan;
		$rcData["trtaobservas"] = $trtaobservas;

		$objManager = Application :: getDomainController('ActaempresaManager');
		$nuMessage = $objManager->updateActa($orgacodigost, $acta, $rcData);
		WebRequest :: setProperty('cod_message', $nuMessage);

		if($nuMessage != 3){
			return "fail";
		}

		return "success";
	}
}
?>