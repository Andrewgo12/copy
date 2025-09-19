<?php
class FeEnRespuestausuManager{
	function FeEnRespuestausuManager(){
		$this->objGateway = Application::getDataGateway("respuestausu");
		$this->objGateway_D = Application::getDataGateway("detarespusua");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function addRespuesta(){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcRow,"array");
		settype($rcSql_1,"array");
		settype($rcSql_2,"array");
		settype($rcSql,"array");
		settype($sbResult,"string");
		settype($nuCant,"integer");
		settype($nuReuscodigon,"integer");
		settype($nuDerucodigon,"integer");
		settype($nuPregcodigon,"integer");
		

		$rcData = $this->rcData;
		
		if($rcData && is_array($rcData)){
			extract($rcData);
			
			$this->objGateway->setExecuteSql(false);
			$this->objGateway_D->setExecuteSql(false);
			
			$objManager = Application :: getDomainController('NumeradorManager');
			
			if($formcodigon && $reusfecingn && $usuacodigos && $rcDetalle && is_array($rcDetalle)){
				
				$nuReuscodigon = $objManager->fncgetByIdNumerador("respuestausu");
				
				$this->objGateway->setData(array("reuscodigon"=>$nuReuscodigon,"formcodigon"=>$formcodigon,"reusfecingn"=>$reusfecingn,"usuacodigos"=>$usuacodigos,
										"reusdirips"=>$reusdirips,"ordenumeros"=>$ordenumeros,"orgacodigos"=>$orgacodigos,
										"contindentis"=>$contindentis,"paciindentis"=>$paciindentis));
				$this->objGateway->addRespuestausu();
				
				$nuCant = sizeof($rcDetalle);
				$nuDerucodigon = $objManager->fncgetByIdNumerador("detarespusua",$nuCant);
				foreach($rcDetalle as $nuPregcodigon=>$rcRow){
					
					$this->objGateway_D->setData(array("reuscodigon"=>$nuReuscodigon,"derucodigon"=>$nuDerucodigon,"pregcodigon"=>$nuPregcodigon,
											"oprecodigon"=>$rcRow["oprecodigon"],"deruvalorabis"=>$rcRow["deruvalorabis"]));
					$this->objGateway_D->addDetarespusua();
					$nuDerucodigon++;
				}
				
				$rcSql_1 = $this->objGateway->getSql();
				$rcSql_2 = $this->objGateway_D->getSql();
				
				if($rcSql_1 && is_array($rcSql_1)){
					$rcSql = $rcSql_1;
				}
				
				if($rcSql_2 && is_array($rcSql_2)){
					if($rcSql && is_array($rcSql)){
						$rcSql = array_merge($rcSql,$rcSql_2);
					}else{
						$rcSql = $rcSql_2;	
					}
				}
				
				//transaccion
				$this->objGateway->setSql($rcSql);
				$this->objGateway->executeTrans();
				$sbResult = $this->objGateway->getConsult();
				 if($sbResult){
				 	$rcResult["result"] = true;
				 }else{
				 	$rcResult["result"] = false;
				 }
				
			}else{
				
			}
			
		}else{
			$rcResult["result"] = false;
		}
			
		$this->rcResult = $rcResult;
	}
	
	/**
	 * @Copyright 2010 Parquesoft
	 *
	 * Obtiene las respuestas de usuario relacionadas a un formulario
	 * @author freina<freina@parquesoft.com>
	 *
	 * @location Cali - Colombia
	 */
	function getByIdFormulario(){
		
		if($this->rcData){
			$this->objGateway->setData($this->rcData);
			$this->objGateway->getByIdFormulario();
			$this->rcResult = $this->objGateway->getResult();
		}
	}
	
	function UnsetRequest() {
		settype($sbKey,"string");
		settype($sbValue,"string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false)
				unset ($_REQUEST[$sbKey]);
		}
        unset ($_REQUEST["orgacodigos_desc"]);
	}
}
?>