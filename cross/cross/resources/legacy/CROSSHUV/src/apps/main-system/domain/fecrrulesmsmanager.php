<?php
class FeCrRuleSMSManager {
	var $rcdatos;
	var $gateway;
	var $gatewayae;
	var $gatewayaex;
	var $gatewayac;

	function RuleSMSManager() {
		$this->gateway = Application :: getDataGateway("SqlExtended");
		$this->gatewayaex = Application :: getDataGateway("actaempresaExtended");
		$this->gatewayac = Application :: getDataGateway("activiactaExtended");

	}
	function setData($rcData){
		$this->rcdatos = $rcData;
	}
	/**
	 *   Propiedad intelectual del FullEngine.
	 *
	 *   Genera un email cuando a un  cliente cuando una tarea cambia de estado.
	 *   @author freina
	 *	@return array or null (Arreglo con los resultados de los metodos )
	 *									[result] boolean, Indica si el metodo fue ejecutado exitosamente
	 *									[type] cadena, Tipo de resultado sql o execute
	 *									[service]Nombre del servicio en donde se encuentra el metodo a ejecutar
	 *									[method] Nombre del metodo a ejecutar
	 *									[query] Cadena con el sql en caso de que el tipo sea sql
	 *   @date 07-Oct-2004 10:46
	 *   @location Cali-Colombia
	 */
	function sendNotificationCustomer() {

		settype($objDate,"object");
		settype($objService, "object");
		settype($objGateway, "object");
		settype($rcUser, "array");
		settype($rcData, "array");
		settype($rcResult, "array");
		settype($rcParam,"array");
		settype($rcTmpCo, "array");
		settype($rcContact, "array");
		settype($sbcontidentis, "string");
		settype($sbMensaje,"string");
		settype($sbNombre,"string");

		$rcResult["result"] = false;
		$rcData = $this->rcdatos;

		if ($rcData) {
				
			$objDate = Application :: loadServices("DateController");
			if($rcData["ordefecfinad"]){
				$rcData["ordefecfinad"] = $objDate->fncformatofecha($rcData["ordefecfinad"]);
			}else{
				return $rcResult;
			}

			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				$rcUser['lang'] = Application :: getSingleLang();
			}

			include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
				
			//se obtiene el contacto
			if ($rcData["contidentis"]) {
				$sbcontidentis = $rcData["contidentis"];
				$objService = Application :: loadServices("Customers");
				$objGateway = $objService->getGateWay("solicitante");
				$objGateway->setData(array("solicodigos"=>$sbcontidentis));
				$objGateway->getSolicitante();
				$rcTmpCo = $objGateway->getResult();
				if(is_array($rcTmpCo) && $rcTmpCo){
					$rcTmpCo = $rcTmpCo[0];
					$objGateway = $objService->getGateWay("contacto");
					$rcContact = $objGateway->getByIdContacto($rcTmpCo["contcodigon"]);
					if(is_array($rcContact) && $rcContact){
						$sbNombre = $rcContact[0]["contnombre"];
						$rcParam["celular"] = $rcContact[0]["contnumcels"];
					}
				}
				$objService->close();
			}
			
			$sbMensaje = $rcmessages[71];
			$sbMensaje = str_replace("__NUMERO_CASO__",$rcData["ordenumeros"],$sbMensaje);
			$sbMensaje = str_replace("__NOMBRE__",$sbNombre,$sbMensaje);
			$sbMensaje = str_replace("__FECHA__",$rcData["ordefecfinad"],$sbMensaje);
			$rcParam["mensaje"] = $sbMensaje;
		}

		if ($rcParam["celular"] && $rcParam["mensaje"]) {
			$rcResult["result"] = true;
			$rcResult["type"] = "execute";
			$rcResult["query"] = "";
			$rcResult["parameters"] = $rcParam;
			$rcResult["service"] = "General";
			$rcResult["method"] = "SendSMS";
		}
			
		return $rcResult;
	}
}
?>