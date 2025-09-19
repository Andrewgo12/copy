<?php
class FeEnFormularioManager
{
	var $gateway;

	function FeEnFormularioManager()
	{
		$this->gateway = Application::getDataGateway("formulario");
	}

	function addFormulario($formnombres,$formfeccrean,$formintrodus,$formpredets,$formactivos){

		settype($objManager,"object");
		settype($nuFormcodigon,"integer");
		settype($sbState,"string");
		settype($sbState_N,"string");

		$objManager = Application::getDomainController('NumeradorManager');
		$nuFormcodigon = $objManager->fncgetByIdNumerador('formulario');

		if($this->gateway->existFormulario($nuFormcodigon) == 0){
			$this->gateway->addFormulario($nuFormcodigon,$formnombres,$formfeccrean,$formintrodus,$formpredets,$formactivos);
			if($this->gateway->consult){
				//se valida si se desea que el formulario se convierta en el predeterminado
				$sbState = Application :: getConstant("FORM_PRED");
				if($formpredets==$sbState){

					$sbState_N = Application :: getConstant("FORM_NO_PRED");
					$this->gateway->setData(array("formcodigon"=>null,"formpredets"=>$sbState_N));
					$this->gateway->setFormulario();
					$this->gateway->getConsult();

					$this->gateway->setData(array("formcodigon"=>$nuFormcodigon,"formpredets"=>$sbState));
					$this->gateway->setFormulario();
					$this->gateway->getConsult();
				}
				$this->UnsetRequest();
				return 3;
			}else{
				return 100;
			}
		}else{
			return 1;
		}
	}

	function updateFormulario($formcodigon,$formnombres,$formintrodus,$formpredets,$formactivos){

		settype($objManager,"object");
		settype($rcData,"array");
		settype($sbState,"string");
		settype($sbState_N,"string");
		settype($sbResult,"string");
		
		$sbResult = false;

		if($this->gateway->existFormulario($formcodigon) == 1){
				
			//valida que no haya relacion con preguntas
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("formcodigon"=>$formcodigon));
			$objManager->getByIdFormulario();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				$sbResult = true;
			}else{
				$this->gateway->updateFormulario($formcodigon,$formnombres,$formintrodus,$formpredets,$formactivos);
				$sbResult = $this->gateway->consult;
			}
			
			if($sbResult){
				//se valida si se desea que el formulario se convierta en el predeterminado
				$sbState = Application :: getConstant("FORM_PRED");
				if($formpredets==$sbState){

					$sbState_N = Application :: getConstant("FORM_NO_PRED");
					$this->gateway->setData(array("formcodigon"=>null,"formpredets"=>$sbState_N));
					$this->gateway->setFormulario();
					$this->gateway->getConsult();

					$this->gateway->setData(array("formcodigon"=>$formcodigon,"formpredets"=>$sbState));
					$this->gateway->setFormulario();
					$this->gateway->getConsult();
				}
				$this->UnsetRequest();
				return 3;
			}else{
				return 100;
			}
		}else{
			return 2;
		}
	}

	function deleteFormulario($formcodigon){

		settype($objManager,"object");
		settype($rcData,"array");

		if($this->gateway->existFormulario($formcodigon) == 1){

			//valida que no haya relacion con preguntas
			$objManager = Application::getDomainController('PregformulaManager');
			$objManager->setData(array("formcodigon"=>$formcodigon));
			$objManager->getByIdFormulario();
			$rcData = $objManager->getResult();
			if(is_array($rcData) && $rcData){
				return 18;
			}

			$result = $this->gateway->deleteFormulario($formcodigon);
			if($this->gateway->consult)
			{
				$this->UnsetRequest();
				return 3;
			}
			else
			return 100;
		}
		else
		return 2;
	}

	function activeFormulario($formcodigon)
	{
		if($this->gateway->existFormulario($formcodigon) == 1){
			$this->gateway->activeFormulario($formcodigon);
			$this->UnsetRequest();
			return 3;
		}else{
			return 2;
		}
	}

	function getByIdFormulario($formcodigon)
	{
		$data_formulario = $this->gateway->getByIdFormulario($formcodigon);
		return $data_formulario;
	}

	function getAllFormulario()
	{
		return $this->gateway->getAllFormulario();
	}


	function UnsetRequest()
	{
		unset($_REQUEST["formulario__formcodigon"]);
		unset($_REQUEST["formulario__formnombres"]);
		unset($_REQUEST["formulario__formfeccrean"]);
		unset($_REQUEST["formulario__formintrodus"]);
		unset($_REQUEST["formulario__formpredets"]);
		unset($_REQUEST["formulario__formactivos"]);
	}
}
?>