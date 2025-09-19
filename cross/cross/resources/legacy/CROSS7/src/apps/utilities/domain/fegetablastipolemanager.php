<?php
class FeGeTablastipoleManager{
	function FeGeTablastipoleManager(){
		$this->objGateway = Application::getDataGateway("tablastipole");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function saveTablastipole(){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");
		settype($sbTatlcodigos,"string");

		$rcData = $this->rcData;
		
		if($rcData && is_array($rcData)){
			
			extract($rcData);
			
			if($tatlcodigos){
				//update
				$this->objGateway->setData(array("tatlcodigos"=>$tatlcodigos,"tatlvaldesls"=>$tatlvaldesls));
				$this->objGateway->updateTablastipole();
				$rcResult["message"]=70;
			}else{
				$objManager = Application :: getDomainController('NumeradorManager');
				$sbTatlcodigos = $objManager->fncgetByIdNumerador("tablastipole");
				//insert
				$tatlvalcods = str_replace("_",",",$tatlvalcods);
				$this->objGateway->setData(array("tatlcodigos"=>$sbTatlcodigos,"tatlnomtabls"=>$tatlnomtabls,"tatlnomcacos"=>$tatlnomcacos,
									   "tatlnocadess"=>$tatlnocadess,"tatlvalcods"=>$tatlvalcods,"tatlvaldescs"=>$tatlvaldescs,
									   "langcodigos"=>$langcodigos,"tatlvaldesls"=>$tatlvaldesls));
				$this->objGateway->addTablastipole();
				$rcResult["message"]=69;
				$rcResult["tatlcodigos"] = $sbTatlcodigos;
			}
			
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
	
	function deleteTablastipole(){
		
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($sbResult,"string");

		$rcData = $this->rcData;
		
		if($rcData && is_array($rcData)){
			
			extract($rcData);
			
			if($tatlcodigos){
				//update
				$this->objGateway->setData(array("tatlcodigos"=>$tatlcodigos));
				$this->objGateway->deleteTablastipole();
				$rcResult["message"]=71;
			}
			
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
}
?>