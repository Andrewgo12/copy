<?php
class FeGeRelatarepersManager{
	function FeGeRelatarepersManager(){
		$this->objGateway = Application::getDataGateway("relatarepers");
		$this->objGateway_D = Application::getDataGateway("detaretape");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}
	
	/**
	* @copyright Copyright 2009 FullEngine
	*
	* ingresa la relacion a la bd
	* @author freina <freina@parquesoft.com>
	* @date 12-sep-2009 17:45
	* @location Cali-Colombia
	*/
	function addRelacion(){

		settype($objManager,"object");
		settype($objDate,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcSql_1,"array");
		settype($rcSql_2,"array");
		settype($rcSql,"array");
		settype($sbResult,"string");
		settype($sbProccodigos,"string");
		settype($sbTarecodigos,"string");
		settype($sbRetpcodigos,"string");
		settype($sbDrtpcodigos,"string");
		settype($sbState,"string");
		settype($sbStateI,"string");
		settype($nuDate,"integer");
		settype($nuCant,"integer");
		
		$rcData = $this->rcData;
		
		if($rcData && is_array($rcData) && $rcData[1] && is_array($rcData[1])){
			
			$this->objGateway_D->setExecuteSql(false);
			
			$objDate = Application :: loadServices("DateController");
			$nuDate = $objDate->fncintdatehour();
			$sbState = Application :: getConstant("REG_ACT");
			$sbStateI = Application :: getConstant("REG_INACT");
			
			$sbProccodigos = $rcData[0]["proccodigos"];
			$sbTarecodigos = $rcData[0]["tarecodigos"];
			
			//se determina si existe algun registro activo para el par proceso tarea
			$this->objGateway->setData(array("proccodigos"=>$sbProccodigos,"tarecodigos"=>$sbTarecodigos,"retpactivos"=>$sbState));
			$this->objGateway->getExistRow();
			$rcTmp = $this->objGateway->getResult();
			$this->objGateway->setExecuteSql(false);
			//si existe se desactiva
			if($rcTmp && is_array($rcTmp)){
				$rcTmp = $rcTmp[0];
				$this->objGateway->setData(array("retpcodigos"=>$rcTmp["retpcodigos"],"retpactivos"=>$sbStateI));
				$this->objGateway->updateState();
			}
			
			
			$objManager = Application :: getDomainController('NumeradorManager');
			$sbRetpcodigos = $objManager->fncgetByIdNumerador("relatarepers");
			$this->objGateway->setData(array("retpcodigos"=>$sbRetpcodigos,"proccodigos"=>$sbProccodigos,"tarecodigos"=>$sbTarecodigos,
												"retpfeccren"=>$nuDate,"retpactivos"=>$sbState));
			$this->objGateway->addRelatarepers();

			$nuCant = sizeof($rcData[1]);
			$sbDrtpcodigos = $objManager->fncgetByIdNumerador("detaretape",$nuCant);
			foreach($rcData[1] as $nuCont=>$rcTmp){
				//se recorre uno a uno las personas configuradas
				$this->objGateway_D->setData(array("retpcodigos"=>$sbRetpcodigos,"drtpcodigos"=>$sbDrtpcodigos,"orgacodigos"=>$rcTmp["orgacodigos"]));
				$this->objGateway_D->addDetaretape();
				$sbDrtpcodigos++;
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
			$rcResult["result"] = false;
		}
			
		$this->rcResult = $rcResult;
	}
	
	/**
	* @copyright Copyright 2009 FullEngine
	*
	* Obtiene la relacion de personas a la tarea deun proceso
	* @author freina <freina@parquesoft.com>
	* @date 12-sep-2009 17:45
	* @location Cali-Colombia
	*/
	function getRelacion(){
		
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($sbState,"string");
		settype($nuCont,"integer");
		
		extract($this->rcData);
		if($proccodigos && $tarecodigos){
			$sbState = Application :: getConstant("REG_ACT");
			$this->objGateway->setData(array("proccodigos"=>$proccodigos,"tarecodigos"=>$tarecodigos,"retpactivos"=>$sbState));
			$this->objGateway->getExistRow();
			$rcTmp = $this->objGateway->getResult();
			
			//se obtiene el detalle
			if($rcTmp && is_array($rcTmp)){
				$rcTmp = $rcTmp[0];
				$rcResult[0]["proccodigos"]=$rcTmp["proccodigos"];
				$rcResult[0]["tarecodigos"]=$rcTmp["tarecodigos"];
				$this->objGateway_D->setData(array("retpcodigos"=>$rcTmp["retpcodigos"]));
				$this->objGateway_D->getByRetpcodigos();
				$rcRow = $this->objGateway_D->getResult();
				
				if($rcRow && is_array($rcRow)){
					$rcResult[1] = $rcRow;	
				}else{
					$rcResult[1] = null;
				}
			}
		}
		$this->rcResult = $rcResult;
	}
	
	/**
	* @copyright Copyright 2009 FullEngine
	*
	* en realidad desactiva una relacion
	* @author freina <freina@parquesoft.com>
	* @date 13-sep-2009 11:23
	* @location Cali-Colombia
	*/
	function deleteRelacion(){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcSql,"array");
		settype($sbResult,"string");
		settype($sbProccodigos,"string");
		settype($sbTarecodigos,"string");
		settype($sbState,"string");
		settype($sbStateI,"string");
		
		$rcData = $this->rcData;
		
		if($rcData["proccodigos"] && $rcData["tarecodigos"]){
			
			$sbState = Application :: getConstant("REG_ACT");
			$sbStateI = Application :: getConstant("REG_INACT");
			
			$sbProccodigos = $rcData["proccodigos"];
			$sbTarecodigos = $rcData["tarecodigos"];
			
			//se determina si existe algun registro activo para el par proceso tarea
			$this->objGateway->setData(array("proccodigos"=>$sbProccodigos,"tarecodigos"=>$sbTarecodigos,"retpactivos"=>$sbState));
			$this->objGateway->getExistRow();
			$rcTmp = $this->objGateway->getResult();
			$this->objGateway->setExecuteSql(false);
			
			//si existe se desactiva
			if($rcTmp && is_array($rcTmp)){
				
				$rcTmp = $rcTmp[0];
				$this->objGateway->setData(array("retpcodigos"=>$rcTmp["retpcodigos"],"retpactivos"=>$sbStateI));
				$this->objGateway->updateState();
				$rcSql = $this->objGateway->getSql();
				
				//transaccion
				$this->objGateway->setSql($rcSql);
				$this->objGateway->executeTrans();
				$sbResult = $this->objGateway->getConsult();
				
				 if($sbResult){
				 	$rcResult["result"] = true;
				 }else{
				 	$rcResult["result"] = false;
				 	$rcResult["error"] = 1;
				 }
			}else{
				$rcResult["result"] = false;
				$rcResult["error"] = 2;
			}
			
		}else{
			$rcResult["result"] = false;
			$rcResult["error"] = 3;
		}
			
		$this->rcResult = $rcResult;
	}
}
?>