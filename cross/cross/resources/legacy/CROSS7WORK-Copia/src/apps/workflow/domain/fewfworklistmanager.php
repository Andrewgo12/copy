<?php

class FeWFWorkListManager {

	function FeWFWorkListManager() {
		return true;
	}
	/**
	 * @copyright Copyright 2004 &copy; FullEngine
	 *
	 * Obtiene el ente organizacional mas apto
	 * @param string $tarecodigos
	 * @param array $rcOrgacodigos (optional)
	 * @param array $rcDaros (optional) Vector con datos extra que pueden intervenir en la decisión.
	 * @return datatype Name desc
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 18-nov-2004 10:26:11
	 * @location Cali-Colombia
	 */
	function getAptOrganizacional($tarecodigos,$rcOrgacodigos=null,$rcDatos=null){

		settype($objGateway,"object");
		settype($rcTarea,"array");
		settype($sbOrgacodigos,"string");

		//se determina el encargado de acuerdo a la carga de trabajo
		if($rcDatos["proccodigos"] && $tarecodigos){
			$sbOrgacodigos = $this->getOrgacodigosByWorkload($rcDatos["proccodigos"],$tarecodigos);
		}
		if(!$sbOrgacodigos){
			//Se busca en el ente en las tareas
			$objGateway =  Application :: getDataGateway("tarea");
			$rcTarea = $objGateway->getByIdTarea($tarecodigos);

			if(is_array($rcTarea) && $rcTarea){
				$rcTarea = $rcTarea[0];
				if($rcTarea["orgacodigos"]){
					$sbOrgacodigos = $rcTarea["orgacodigos"];
				}
			}
			if($rcDatos["ind_tar_sig"]){
				if(!$sbOrgacodigos){
					//Si solo existe un ente organizacional los retorna como el mas apto
					if(is_array($rcOrgacodigos) && $rcOrgacodigos){
						//Si solo existe un ente organizacional los retorna como el mas apto
						$sbOrgacodigos = $rcOrgacodigos[0];
					}
				}
			}else{
				if(is_array($rcOrgacodigos) && $rcOrgacodigos){
					//Si solo existe un ente organizacional los retorna como el mas apto
					$sbOrgacodigos = $rcOrgacodigos[0];
				}
			}
		}
		return $sbOrgacodigos;
	}
	function getOrgacodigosByWorkload($proccodigos,$tarecodigos){

		settype($objService,"object");
		settype($objManager,"object");
		settype($objGateway,"object");
		settype($rcResult,"array");
		settype($rcTmp,"array");
		settype($rcWorkload,"array");
		settype($rcRow,"array");
		settype($sbResult,"string");
		settype($sbState,"string");
		settype($nuCont,"integer");

		if($proccodigos && $tarecodigos){

			//lo primero es determinar si existe configurada una relacion
			//se obtiene el nombre del proceso y tarea
			$objService = Application::loadServices("General");
			$objManager = $objService->InitiateClass("RelatarepersManager");
			$objManager->setData(array("proccodigos"=>$proccodigos,"tarecodigos"=>$tarecodigos));
			$objManager->getRelacion();
			$rcResult = $objManager->getResult();
			$objService->close();
			if($rcResult && is_array($rcResult) && $rcResult[1] && is_array($rcResult[1])){
				$sbState = Application :: getConstant("REG_ACT");
				$objService = Application::loadServices("Cross300");
				$objGateway = $objService->getGateWay("tipoordenExtended");
				foreach($rcResult[1] as $nuCont=>$rcTmp){
					$objGateway->setData(array("orgacodigos"=>$rcTmp["orgacodigos"],"actaactivas"=>$sbState));
					$objGateway->getPesotipoByOrgacodigos();
					$rcRow = $objGateway->getResult();
					$rcTmp["orgacodigos"] = (string) $rcTmp["orgacodigos"];
					if($rcRow && is_array($rcRow)){
						$rcWorkload[$rcTmp["orgacodigos"]] = (int) $rcRow[0]["peso"];
					}else{
						$rcWorkload[$rcTmp["orgacodigos"]] = 0;
					}
				}
				$objService->close();
					
				//se determina la depedencia con menor carga
				if($rcWorkload && is_array($rcWorkload)){
					asort($rcWorkload);
					$rcRow = array_keys($rcWorkload);
					$sbResult = $rcRow[0];
				}
			}
		}
		return $sbResult;
	}
}
?>