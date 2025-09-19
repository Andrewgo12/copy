<?php
class FeCuPacienteManager {
	var $gateway;

	function FeCuPacienteManager() {
		$this->gateway = Application :: getDataGateway("paciente");
	}

	function addPaciente($paciindentis, $tiidcodigos, $paciprinoms,
	$pacisegnoms, $pacipriapes, $pacisegapes, $pacifecnacis, $sexocodigos, $paciemail,
	$locacodigos, $pacidirecios, $pacitelefons, $pacihisclis, $paciobservs, $pacinumcels) {
		
		settype($rcData, "string");
		$dbnull= Application::getConstant("DB_NULL");
		if(!empty($pacihisclis) && ($pacihisclis != $dbnull)){
			$rcData = $this->gateway->getPacienteByPacihisclis($pacihisclis);
			if(is_array($rcData) & $rcData){
				return 37;
			}
		}

		$this->gateway->addPaciente($paciindentis, $tiidcodigos,
		$paciprinoms, $pacisegnoms, $pacipriapes, $pacisegapes,
		$pacifecnacis, $sexocodigos, $paciemail, $locacodigos,
		$pacidirecios, $pacitelefons, $pacihisclis, $paciobservs, $pacinumcels);
		if ($this->gateway->consult == false)
		return 100;
		$this->UnsetRequest();
		return 3;
	}

	function updatePaciente($paciindentis, $tiidcodigos, $paciprinoms, $pacisegnoms,
	$pacipriapes, $pacisegapes, $pacifecnacis, $sexocodigos,
	$paciemail, $locacodigos, $pacidirecios, $pacitelefons, $pacihisclis, $paciobservs, $paciactivos, $pacinumcels) {

		settype($rcTmp,"array");
		settype($rcData, "string");

		if ($this->gateway->existPaciente($paciindentis) == 1) {
	                $dbnull= Application::getConstant("DB_NULL");	
		        if(!empty($pacihisclis) && ($pacihisclis != $dbnull)){	
				$rcData = $this->gateway->getPacienteByPacihisclis($pacihisclis);
				if(is_array($rcData) & $rcData){
					if($rcData[0]["paciindentis"]!=$paciindentis){
						return 37;
					}
				}
			}
				
			$this->gateway->updatePaciente($paciindentis, $tiidcodigos, $paciprinoms,
			$pacisegnoms, $pacipriapes, $pacisegapes, $pacifecnacis, $sexocodigos,
			$paciemail, $locacodigos, $pacidirecios, $pacitelefons, $pacihisclis, $paciobservs, $paciactivos, $pacinumcels);
			if ($this->gateway->consult == false)
			return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deletePaciente($paciindentis) {
		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcReq, "array");
		if ($this->gateway->existPaciente($paciindentis) == 1) {
			//Valida que el paciente no tenga casos asociados
			$objService = Application :: loadServices('Cross300');
			$objGateway = $objService->getGateWay('OrdenempresaExtended');
			$rcReq = $objGateway->getReqByPaciente($paciindentis);
			$objService->close();
			if (is_array($rcReq))
			return 35;
			$this->gateway->deletePaciente($paciindentis);
			if ($this->gateway->consult == false)
			return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdPaciente($paciindentis) {
		settype($rcData, "array");
		$rcData = $this->gateway->getByIdPaciente($paciindentis);
		return $rcData;
	}

	function getAllPaciente() {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["paciente__paciindentis"]);
		unset ($_REQUEST["paciente__tiidcodigos"]);
		unset ($_REQUEST["paciente__pacifecnacis"]);
		unset ($_REQUEST["paciente__sexocodigos"]);
		unset ($_REQUEST["paciente__paciprinoms"]);
		unset ($_REQUEST["paciente__pacisegnoms"]);
		unset ($_REQUEST["paciente__pacipriapes"]);
		unset ($_REQUEST["paciente__pacisegapes"]);
		unset ($_REQUEST["paciente__paciemail"]);
		unset ($_REQUEST["paciente__locacodigos"]);
		unset ($_REQUEST["paciente_locacodigos_desc"]);
		unset ($_REQUEST["paciente__pacidirecios"]);
		unset ($_REQUEST["paciente__pacitelefons"]);
		unset ($_REQUEST["paciente__paciobservs"]);
		unset ($_REQUEST["paciente__pacihisclis"]);
		unset ($_REQUEST["paciente__paciactivos"]);
		unset ($_REQUEST["paciente__pacinumcels"]);
	}
}
?>
