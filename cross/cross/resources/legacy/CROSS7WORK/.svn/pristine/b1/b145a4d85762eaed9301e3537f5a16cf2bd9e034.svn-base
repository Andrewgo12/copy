<?php


class FeCuInfractorManager
{
	var $gateway;

	function FeCuInfractorManager()
	{
		$this->gateway = Application::getDataGateway("infractor");
	}

	function addInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas)
	{
		if($this->gateway->existInfractor($infrcodigos) == 0){
			$this->gateway->addInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
				return 3;
		}else{
			return 1;
		}
	}

	function updateInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas)
	{
		if($this->gateway->existInfractor($infrcodigos) == 1){
			$this->gateway->updateInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas);
			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
				return 3;
		}
		else{
			return 2;
		}
	}

	function deleteInfractor($infrcodigos)
	{
		if($this->gateway->existInfractor($infrcodigos) == 1)
		{
			$this->gateway->deleteInfractor($infrcodigos);

			if ($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
				return 3;
		}
		else
			return 2;
	}

	function getByIdInfractor($infrcodigos)
	{
		$data_infractor = $this->gateway->getByIdInfractor($infrcodigos);
		return $data_infractor;
	}

	function getAllInfractor()
	{
		//$this->gateway->
	}

	function getByInfractor_fkey($locacodigos)
	{
		//$this->gateway->
	}

	function getByInfractor_fkey1($ticlcodigos)
	{
		//$this->gateway->
	}

	function getByInfractor_fkey2($tiidcodigos)
	{
		//$this->gateway->
	}


	function UnsetRequest()
	{
		unset($_REQUEST["infractor__tiidcodigos"]);
		unset($_REQUEST["infractor__infrcodigos"]);
		unset($_REQUEST["infractor__ticlcodigos"]);
		unset($_REQUEST["infractor__infrnombres"]);
		unset($_REQUEST["infractor__infrrepreses"]);
		unset($_REQUEST["infractor__infrlocalizs"]);
		unset($_REQUEST["infractor__infrtelefons"]);
		unset($_REQUEST["infractor__locacodigos"]);
		unset($_REQUEST["infractor_locacodigos_desc"]);
		unset($_REQUEST["infractor__infrnumfaxs"]);
		unset($_REQUEST["infractor__infractivas"]);
	}

}

?>	
 	