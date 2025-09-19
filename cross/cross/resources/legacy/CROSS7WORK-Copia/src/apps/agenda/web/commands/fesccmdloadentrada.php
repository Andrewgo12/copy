<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeScCmdloadEntrada {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($objServiceRH,"object");
		settype($objGateway, "object");
		settype($rcResult, "array");
		settype($rcSession,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcUser,"array");
		settype($sbHtml,"string");
		settype($sbOutput, "string");
		settype($sbCharset, "string");
		settype($nuCont, "integer");

		//labels
		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");
		$sbCharset = strtoupper(ini_get("default_charset")) ;
			
		if($entrcodigon){
			$objGateway = Application::getDataGateway("entradaExtended");
			$objGateway->setData(array("entrcodigon"=>$entrcodigon,"perscodigos_isnull"=>true));
			$objGateway->_getOrganentrada();
			$rcTmp = $objGateway->getResult();
			if(is_array($rcTmp) && $rcTmp){
				
				//se obtienen las dependencias relacionadas
				$objServiceRH = Application :: loadServices("Human_resources");
				$objGateway = $objServiceRH->getGateWay("organizacion");
				
				foreach($rcTmp as $rcRow){
					$rcRow = $objGateway->getByIdOrganizacion($rcRow["orgacodigos"]);
					if(is_array($rcRow) && $rcRow){
						$rcRow = $rcRow[0];
						$rcSession[$rcRow["orgacodigos"]] = $rcRow["organombres"];
					}	
				}
				$objServiceRH->close();

				if(is_array($rcSession) && $rcSession){

					WebSession :: setProperty("_rcOrgSchedule",$rcSession);

					$sbHtml = $this->drawList();
					$rcResult[0]=1;
					$rcResult[1]=$objService->encode($sbHtml);
				}else{
					//resultado de los * son obligatorios
					$rcResult[0]=0;
					$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
					if($sbCharset=='UTF-8'){
						$rcmessages[0] = utf8_decode($rcmessages[0]);
					}
					$rcResult[1]= $objService->encode($rcmessages[0]);
				}
			}else{
				//resultado de los * son obligatorios
				$rcResult[0]=1;
				$rcResult[1]=$objService->encode("");
			}
		}else{
			//resultado de los * son obligatorios
			$rcResult[0]=1;
			$rcResult[1]=$objService->encode("");
		}

		$sbOutput = $objJson->encode($rcResult);
		die($sbOutput);
	}
	function drawList(){

		settype($sbPath,"string");
		settype($sbHtml,"string");
			
		$sbPath = Application::getPluginsDirectory()."/function.drawOrg.php";
		include($sbPath);
		$sbHtml = smarty_function_drawOrg(array(),$this,false);
		return $sbHtml;
	}
}
?>