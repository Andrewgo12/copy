<?php
require_once "Web/WebRequest.class.php";
Class FeScCmdUpdateEntrada
{
	function execute(){

		settype($objService,"object");
		settype($objNumerador,"object");
		settype($objDate,"object");
		settype($rcTmp,"array");
		settype($rcUser,"array");
		settype($sbUsername,"string");
		settype($sbValue,"string");

		extract($_REQUEST);

		if(($entrada__entrcodigon != NULL) && ($entrada__entrcodigon != "")
		&& ($entrada__entrusucreas != NULL) && ($entrada__entrusucreas != "")
		&& ($entrada__entrfechorun != NULL) && ($entrada__entrfechorun != "")
		&& ($entrada__entrduracion != NULL) && ($entrada__entrduracion != "")
		&& ($entrada__catecodigon != NULL) && ($entrada__catecodigon != "")
		&& ($entrada__entrdescris != NULL) && ($entrada__entrdescris != "")){
			
			//Las fechas horas de inicio y fin vienen con formato de fecha, el cual debe cambiarse a timestamp
			$objDate = Application::loadServices("DateController");
			$sbEntrfechorun = $entrada__entrfechorun;
			$sbEntrdurationn = $entrada__entrduracion;
			$entrada__entrfechorun = $objDate->fncdatehourtoint($sbEntrfechorun);
			$entrada__entrduracion = $objDate->fncdatehourtoint($sbEntrdurationn);

			//Usuario al que se le está registrando la cita.
			$rcUser = Application::getUserParam();
			$sbUsername = $rcUser["username"];
			
			//se obtienen las dependencias de sesion
			if(WebSession :: issetProperty("_rcOrgSchedule")){
				$orgacodigos = WebSession :: getProperty("_rcOrgSchedule");
				$orgacodigos = array_keys($orgacodigos);
			}else{
				$orgacodigos = null;
			}

			if(isset($perscodigos) && $perscodigos){
				$objService = Application :: loadServices("Human_resources");
				$rcTmp[] = $perscodigos;
				$rcPersonal = $objService->getPersonalbyUsername($rcTmp,false);
				$perscodigos = $rcPersonal[0]["perscodigos"];
				$sbUsername =  $rcPersonal[0]["persusrnams"];
				$orgacodigosOwner = $objService->getOrgacodigosByPersonal($perscodigos);
				$objService->close();
			}else{
				if(!isset($orgacodigos) || !$orgacodigos){
					WebRequest::setProperty('cod_message',$message = 54);
					return "fail";
				}
			}

			if($entrada__entrfechorun<$objDate->fncintdatehour()){
				WebRequest::setProperty('cod_message',$message = 22);
				return "fail";
			}
			if($entrada__entrfechorun>=$entrada__entrduracion){
				WebRequest::setProperty('cod_message',$message = 21);
				return "fail";
			}
			if($entrada__entrduracion<$objDate->fncintdatehour()){
				WebRequest::setProperty('cod_message',$message = 23);
				return "fail";
			}

			//UPDATE
			//VALIDEMOS COLISIONES
			$entrada_manager = Application::getDomainController('EntradaManager');
			$blColision = $this->validarColisiones($entrada__entrfechorun,$entrada__entrduracion,$orgacodigosOwner,$orgacodigos,$entrada_manager,$entrada__entrcodigon);
			if($blColision)
			{
				$message = $blColision;
				WebRequest::setProperty('cod_message',$message);
				return "fail";
			}
			
			$objNumerador = Application::getDomainController("NumeradorManager");
			if(strlen($ordenumeros))
			$entrada__recrcodigon = $objNumerador->fncgetByIdNumerador("refercross");
			
			$message = $entrada_manager->updateEntrada($entrada__entrcodigon,$entrada__entrusucreas,$entrada__entrfechorun,$entrada__entrduracion,$entrada__entrprioridas,$entrada__catecodigon,$entrada__entrdescris);
			if($message==3){
				if($entrada__recrcodigon){
					//Guardarmos en refercross aquellos valores que se asocian con expediente, órdenes y acta
					$referCrossManager = Application::getDomainController("RefercrossManager");
					$referCrossManager->deleteAllRefercrossEntrada($entrada__entrcodigon);
					$message = $referCrossManager->addRefercross($entrada__entrcodigon,$entrada__recrcodigon,$ordenumexps,$ordenumeros,$actacodigos);
				}
					
				$entrada_manager->deleteAllOrganentrada($entrada__entrcodigon);
					
				//DEPENDENCIA
				if(is_array($orgacodigos) && $orgacodigos){
					foreach($orgacodigos as $sbValue){
						$entrada_manager->addOrganentrada(($entrada__entrcodigon),$sbValue);	
					}	
				}
					
				//OWNER
				if(isset($perscodigos) && $perscodigos){
					$entrada_manager->addOrganentrada(($entrada__entrcodigon),$orgacodigosOwner,$perscodigos);
				}
			}
			$_REQUEST["date"] = $date;
			WebRequest::setProperty('cod_message', $message);
			return "success";
		}
		else
		{
			WebRequest::setProperty('cod_message',$message = 0);
			return "fail";
		}
	}

	function validarColisiones($entrada__entrfechorun,$entrada__entrduracion,$juez,$defensores,$entrada_manager,$entrcodigon=false){
		
		settype($rcActores,"array");
		settype($sbValue,"string");
		settype($nuCont,"integer");
		
		$rcActores = array_merge($juez,$defensores);
		
		if(is_array($rcActores) && $rcActores){
			foreach ($rcActores as $nuCont=>$sbValue){
				$blColision = $entrada_manager->getSesionColision($sbValue,$entrada__entrfechorun,$entrada__entrduracion,$entrcodigon);
				if($blColision){
					return $blColision;	
				}
			}	
		}
		return false;
	}
}
?>