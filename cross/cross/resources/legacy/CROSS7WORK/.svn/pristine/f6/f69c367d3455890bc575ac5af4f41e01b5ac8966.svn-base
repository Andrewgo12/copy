<?php
class FeCrRuleEmailEmployeeManager {

	function RuleEmailEmployeeManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");

	}
	function setData($rcData) {
		$this->rcdatos = $rcData;
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Genera un email a un empleado cuando se le asigna una nueva tarea 
	*   @author freina
	*	@return array or null (Arreglo con los resultados de los metodos )
	*									[result] boolean, Indica si el metodo fue ejecutado exitosamente
	*									[type] cadena, Tipo de resultado sql o execute
	*									[service]Nombre del servicio en donde se encuentra el metodo a ejecutar
	*									[method] Nombre del metodo a ejecutar
	*									[query] Cadena con el sql en caso de que el tipo sea sql
	*   @date 08-Apr-2006 12:15
	*   @location Cali-Colombia
	*/
	function fncInternalEmployeeEmail() {

		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcUser, "array");
		settype($rcData, "array");
		settype($rcTmp, "array");
		settype($rcTexto, "array");
		settype($rcEmail, "array");
		settype($rcResult, "array");
		settype($rcInfoCompany, "array");
		settype($rcEmployee, "array");
		settype($rcTmpC, "array");
		settype($rcContact, "array");
		settype($rcCliente, "array");
		settype($sbOrgacodigos, "string");
		settype($sbContnombre, "string");
		settype($sbcontidentis, "string");
		settype($sbCompanyemail, "string");
		settype($sbTarecodigos, "string");
		settype($sbTarenombres, "string");
		settype($nuActafechingn, "integer");

		$rcData = $this->rcdatos;

		//Busca el email corporativo para el from del correo
		$objService = Application :: loadServices('General');
		$rcInfoCompany = $objService->getParam('general', 'empresa');
		$sbCompanyemail = $rcInfoCompany['empremail'];

		if ($rcData) {

			$rcResult["result"] = false;
			
			$sbTarecodigos = $rcData["task"]["tarecodigos"];
			$nuActafechingn = $rcData["task"]["fecha_reg"];
			
			// solo se ejecuta esta regla si la tarea es nueva
			//NO, YA SE DETECTÓ UN CAMBIO DE ESTADO EN ACTAEMPRESAMANAGER Y ADEMÁS ESTO VIENE DADO POR RUTAREGLA
			if ($sbTarecodigos) {

				//obtiene el nombre de la tarea
				$sbTarenombres = $this->getTaskName($sbTarecodigos);

				$rcUser = Application :: getUserParam();

				//se obtiene el nombre del ente organizacional
				if ($rcData["task"]["orgacodigos"]) {

					$sbOrgacodigos = $rcData["task"]["orgacodigos"];

					$rcEmployee = $this->getOrdered($sbOrgacodigos);
				}

				//se obtiene el contacto
				if($rcData["contidentis"]){
					$sbcontidentis = $rcData["contidentis"];
					$objService = Application :: loadServices("Customers");
					$objGateway = $objService->getGateWay("solicitante");
					$objGateway->setData(array("solicodigos"=>$sbcontidentis));
					$objGateway->getSolicitante();
					$rcTmpC = $objGateway->getResult();
					if(is_array($rcTmpC) && $rcTmpC){
						$rcTmpC = $rcTmpC[0];
						$objGateway = $objService->getGateWay("contacto");
						$rcContact = $objGateway->getByIdContacto($rcTmpC["contcodigon"]);
						if(is_array($rcContact) && $rcContact){
							$rcContact = $rcContact[0];
							$sbContnombre = "(".$rcContact["contindentis"].") ".
											$rcContact["contnombre"];
						}
						if($rcTmpC["cliecodigos"]){
							$objGateway = $objService->getGateWay("cliente");
							$rcCliente = $objGateway->getByIdCliente($rcTmpC["cliecodigos"]);
							if(is_array($rcCliente) && $rcCliente){
								$rcCliente = $rcCliente[0];
								$sbContnombre .= " -- "."(".$rcCliente["clieidentifs"].") ".$rcCliente["clienombres"];
							}
						}
					}
					$objService->close();
				}

				//email destino
				$rcEmail["dir_destino"] = $rcEmployee["email"];
				
				$rcEmail["formato"] = "";
				
				//servicio de fechas
				$objService = Application :: loadServices("DateController");
				$rcEmail["ordefecregd"] = $objService->fncformatofecha($rcData["ordefecregd"]);
				$rcTexto = array ("cliente" => $sbContnombre, "caso" => $rcData["ordenumeros"], "fecha_reg" => $objService->fncformatofecha($nuActafechingn), "tarea" => $sbTarenombres, "responsable" => $rcEmployee["nombre"]);
				$rcEmail["caso"] = $rcData["ordenumeros"];
				$rcEmail["responsable"] = $sbOrgacodigos;
				$rcEmail["dir_origen"] = $sbCompanyemail;
				$rcEmail["usuario"] = $rcUser["username"];
				$rcEmail["adjunto"] = "";

				$objService = Application :: loadServices("General");
				$rcEmail["texto"] = $objService->getTextEmail_Employee($rcTexto, false);
				$rcEmail["texto"] .= "\n";
				$rcEmail["texto"] .= "\n";
				$rcEmail["texto"] .= "\nObservaciones:  ";
				$rcEmail["texto"] .= $rcData["ordeobservs"];
				$rcEmail["asunto"] = $objService->getSubjectEmail_Employee($rcTexto);
		
				if ($rcEmail["texto"] && $rcEmail["asunto"]) {
					$rcResult["result"] = true;
					$rcResult["type"] = "execute";
					$rcResult["query"] = "";
					$rcResult["parameters"] = $rcEmail;
					$rcResult["service"] = "General";
					$rcResult["method"] = "sendEmail";
				}
			}
		}
		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina el empleado responsable de la dependencia
	* @param string $sbOrgacodigos (Cadena con el codigo de la dependencia
	* @return array $rcResult arreglo con el nombre y email del responsable
	* @author freina <freina@parquesoft.com>
	* @date 08-Apr-2006 16:09
	* @location Cali-Colombia
	*/
	function getOrdered($sbOrgacodigos) {

		settype($objService, "object");
		settype($rcResult, "array");

		if ($sbOrgacodigos) {
			$objService = Application :: loadServices("Human_resources");
			$rcTmp = $objService->getActiveGroup($sbOrgacodigos, false);

			if ($rcTmp) {
				$rcResult = $objService->getOrderedByGrupo($rcTmp[0]["grupcodigon"]);
			} else {
				$objService->close();
			}
		}

		return $rcResult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el nombrede la tarea
	* @param string $sbTarecodigos Cadena con el codigo de la tarea
	* @return string $sbResult Cadena con el nombre de la tarea
	* @author freina <freina@parquesoft.com>
	* @date 10-Apr-2006 12:44
	* @location Cali-Colombia
	*/
	function getTaskName($sbTarecodigos) {

		settype($objService, "object");
		settype($rcTmp, "array");
		settype($sbResult, "string");

		if ($sbTarecodigos) {

			$objService = Application :: loadServices("Workflow");
			$rcTmp = $objService->getDataTarea($sbTarecodigos);

			if ($rcTmp) {
				$sbResult = $rcTmp[0]['tarenombres'];
			}
		}
		return $sbResult;
	}
}
?>