<?php 
class FeCuClienteManager {
	var $gateway;
	function FeCuClienteManager() {
		$this->gateway = Application :: getDataGateway("cliente");
	}
	function addCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
						$clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps, 
						$clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
						$cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, $clienumfaxs, 
						$clieaparaers, $clieactivas) {
		if ($this->gateway->existCliente($cliecodigos) == 0) {
			$this->gateway->addCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
									   $clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps, 
									   $clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
									   $cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, $clienumfaxs, 
									   $clieaparaers, $clieactivas);
			if($this->gateway->consult == false)
				return 100;
			$this->UnsetRequest();
			return 3;
		} else {
			return 1;
		}
	}
	function updateCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
						   $clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps, 
						   $clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
						   $cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, $clienumfaxs, 
						   $clieaparaers, $clieactivas) {
						   	
		settype($rcTmp,"array");
						   	
		if ($this->gateway->existCliente($cliecodigos) == 1) {
			
			//se valida que la identificacion del cliente no este registrada
			$rcTmp = $this->gateway->getByIdentif($clieidentifs);
			if($rcTmp){
				if($rcTmp[0]["cliecodigos"]!=$cliecodigos){
					return 25;
				}
			}
			
			$this->gateway->updateCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
										  $clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps, 
										  $clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
										  $cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, $clienumfaxs, 
										  $clieaparaers, $clieactivas);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function deleteCliente($cliecodigos) {
		
		settype($objGateway, "object");
		settype($rcTmp, "array");
		
		if ($this->gateway->existCliente($cliecodigos) == 1) {
		//Valida que el contacto no este registrado en la tabla de solicitantes
			$objGateway = Application :: getDataGateway("solicitante");
			$objGateway->setData(array("cliecodigos"=>$cliecodigos));
			$objGateway->getSolicitante();
			$rcTmp = $objGateway->getResult();
			if(is_array($rcTmp) && $rcTmp){
				return 10;
			}
			$this->gateway->deleteCliente($cliecodigos);
			if($this->gateway->consult == false)
				return 2;
			$this->UnsetRequest();
			return 3;
		} else {
			return 2;
		}
	}
	function getByIdCliente($cliecodigos) {
		$data_cliente = $this->gateway->getByIdCliente($cliecodigos);
		return $data_cliente;
	}
	function getByIdentif($clieidentifs) {
		$data_cliente = $this->gateway->getByIdentif($clieidentifs);
		return $data_cliente;
	}
	function getAllCliente() {
		//$this->gateway->
	}
	function getByCliente_fkey($locacodigos) {
		//$this->gateway->
	}
	function getByCliente_fkey1($esclcodigos) {
		//$this->gateway->
	}
	function getByCliente_fkey2($ticlcodigos) {
		//$this->gateway->
	}
	function getByCliente_fkey3($tiidcodigos) {
		//$this->gateway->
	}
	function UnsetRequest() {
		unset ($_REQUEST["cliente__cliecodigos"]);
		unset ($_REQUEST["cliente__clieidentifs"]);
		unset ($_REQUEST["cliente__ticlcodigos"]);
		unset ($_REQUEST["cliente__clienombres"]);
		unset ($_REQUEST["cliente__clierepprnos"]);
		unset ($_REQUEST["cliente__clierepsenos"]);
		unset ($_REQUEST["cliente__cliereppraps"]);
		unset ($_REQUEST["cliente__clierepseaps"]);
		unset ($_REQUEST["cliente__clielocalizs"]);
		unset ($_REQUEST["cliente__clietelefons"]);
		unset ($_REQUEST["cliente__locacodigos"]);
		unset ($_REQUEST["cliente_locacodigos_desc"]);
		unset ($_REQUEST["cliente__cliepagwebs"]);
		unset ($_REQUEST["cliente__cliemails"]);
		unset ($_REQUEST["cliente__esclcodigos"]);
		unset ($_REQUEST["cliente__tiidcodigos"]);
		unset ($_REQUEST["cliente__grclcodigos"]);
		unset ($_REQUEST["cliente__clienumfaxs"]);
		unset ($_REQUEST["cliente__clieaparaers"]);
		unset ($_REQUEST["cliente__clieactivas"]);
	}
}
?>	
