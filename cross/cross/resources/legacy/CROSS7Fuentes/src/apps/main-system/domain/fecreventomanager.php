<?php 
   				

class FeCrEventoManager {
	var $gateway;

	function FeCrEventoManager() {
		$this->gateway = Application :: getDataGateway("evento");
	}

	function addEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos) {
		if ($this->gateway->existEvento($tiorcodigos, $evencodigos) == 0) 
		{
			$this->gateway->addEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} 
		else 
		{
			return 1;
		}
	}

	function updateEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos) {
		if ($this->gateway->existEvento($tiorcodigos, $evencodigos) == 1) {
			$this->gateway->updateEvento($tiorcodigos, $evencodigos, $evennombres, $evendescrips, $evenactivos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function deleteEvento($tiorcodigos, $evencodigos) {
		if ($this->gateway->existEvento($tiorcodigos, $evencodigos) == 1) {
            //Valida si es usado el los req
            $gateway = Application::getDataGateway('SqlExtended');
            $rcReq = $gateway->getRequerimientoByEvento($tiorcodigos, $evencodigos);
            if(is_array($rcReq))
                return 47;
			$this->gateway->deleteEvento($tiorcodigos, $evencodigos);
			if ($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}

	function getByIdEvento($tiorcodigos, $evencodigos) {
		$data_evento = $this->gateway->getByIdEvento($tiorcodigos, $evencodigos);
		return $data_evento;
	}

	function getAllEvento() {
		//$this->gateway->
	}

	function getByEvento_fkey($tiorcodigos) {
		//$this->gateway->
	}

	function UnsetRequest() {
		unset ($_REQUEST["evento__tiorcodigos"]);
		unset ($_REQUEST["evento__evencodigos"]);
		unset ($_REQUEST["evento__evennombres"]);
		unset ($_REQUEST["evento__evendescrips"]);
		unset ($_REQUEST["evento__evenactivos"]);
	}

}

?>	
 	