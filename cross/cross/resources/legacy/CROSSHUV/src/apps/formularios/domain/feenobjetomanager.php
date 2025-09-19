<?php
class FeEnObjetoManager{

	function FeEnObjetoManager(){
		$this->objGateway = Application::getDataGateway("objeto");
	}

	function setObjecodigon($nuObjecodigon){
		$this->nuObjecodigon = $nuObjecodigon;
	}

	function getResult(){
		return $this->rcResult;
	}

	function getAllObjeto(){
		settype($rcData,"array"); 
		$this->objGateway->getAllObjeto();
		$rcData = $this->objGateway->getResult();	
		$this->rcResult = $rcData;
	}
	
	function getByIdObjeto(){
		settype($rcData,"array");
		if($this->nuObjecodigon){
			$this->objGateway->setObjecodigon($this->nuObjecodigon); 
			$this->objGateway->getByIdObjeto();
			$rcData = $this->objGateway->getResult();	
		}
		
		$this->rcResult = $rcData;
	}
}
?>