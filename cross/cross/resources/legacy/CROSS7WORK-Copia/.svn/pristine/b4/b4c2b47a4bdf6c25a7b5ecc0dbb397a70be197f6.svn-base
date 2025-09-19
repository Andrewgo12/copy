<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCrCmdLoadDescTipoorden {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService,"object");
		settype($rcResult, "array");
		settype($objManager, "object");
		settype($sbOutput, "string");
		settype($sbCharset, "string");

		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");

		if ($tiorcodigos) {
			$sbCharset = strtoupper(ini_get("default_charset")) ;
			$objManager = Application :: getDataGateway('tipoorden');
			$rcResult = $objManager->getTiordescrips($tiorcodigos);
			$rcResult = $this->getDescLang($rcResult,"desc_tipoorden","tiorcodigos","tiordescrips");
			if($sbCharset=='UTF-8'){
				$rcResult[0]["tiordescrips"] = utf8_decode($rcResult[0]["tiordescrips"]);
			}
			$sbOutput = $objJson->encode($objService->encode($rcResult[0]["tiordescrips"]));
			die($sbOutput);
		}
	
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene los descripotores de acuerdo al lenguaje.
	*   @author freina
	*   @date 19-Apr-2012 14:34
	*   @location Cali-Colombia
	*/
	function getDescLang($rcData,$sbTable,$sbKey,$sbName){
	
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcConstante,"array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcIndex,"array");
		settype($sbValue,"string");
		settype($nuCont,"integer");
		settype($nuRow,"string");
		
		if($rcData && is_array($rcData) && $sbTable && $sbKey && $sbName){
			
			//Para cargar el lenguaje
			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			
			$sbTable = strtolower($sbTable);
			$sbKey = strtolower($sbKey);
			$sbName = strtolower($sbName);
			
			//se obtiene la constante de configuracion
			$objService = Application :: loadServices("General");
			$rcConstante = Application :: getConstant("TAB_TIP_DESC");
			$objGateway = $objService->getGateWay("tablastipole");
			$objGateway->setData(array("entidad"=>$sbTable,"langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcTmp = $objGateway->getResult();
			$objService->close();
			if($rcConstante && is_array($rcConstante) && $rcTmp && is_array($rcTmp)){
				$rcConstante = $rcConstante[$sbTable];
				foreach($rcTmp as $nuRow=>$rcRow){
					$rcIndex[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
				}
				
				//por ultimo se toma el valor de del nuevo lenguaje y se actualiza
				foreach($rcData as $nuCont=>$rcTmp){
					$rcResult[$nuCont][$sbKey] = $rcTmp[$sbKey];
					$rcResult[$nuCont][$sbName] = $rcIndex[$rcTmp[$sbKey]];
				}
			}else{
				$rcResult = $rcData;
			}
		}
		
		return $rcResult;
	}
}
?>