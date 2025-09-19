<?php
class FeCrExcelManager{

	function FeCrExcelManager()	{
	}

	function execute($rcLabels,$rcData,$sbSql=false,$sbOrigen=null){

		settype($objLib,"object");
		settype($objDate,"object");
		settype($rcDateField,"array");
		settype($rcRow,"array");
		settype($sbHtml,"string");
		settype($sbExt,"string");
		settype($sbSlash,"string");
		settype($sbSubPath,"string");
		settype($sbSplit,"string");
		settype($sbPath,"string");
		settype($sbResult,"string");
		settype($sbHtml,"string");
		settype($sbFlag,"string");
		settype($sbIndex,"string");
		settype($sbValue,"string");
		settype($nuX,"integer");
		settype($nuCont,"integer");
		
		$sbFlag = false;
		$rcDateField = Application :: getConstant("DATE_FIELD");
		if(is_array($rcDateField) && $rcDateField){
			$sbFlag = true;
			$objDate = Application :: loadServices("DateController");
		}
		//SI TRAE UN QUERY, EJECUTÉMOLO
		if($sbSql) {
			
			$this->gateway = Application :: getDataGateway("SqlExtended");
			$this->gateway->objdb->fncadoselect($sbSql,FETCH_ASSOC);
			$rcData = $this->gateway->objdb->rcresult;
				
			if(is_array($rcData) && $rcData){
				
				foreach ($rcData as $nuCont=>$rcRow) {
					//se recorre los campos
					foreach($rcRow as $sbIndex=>$sbValue){
						if($sbFlag && in_array($sbIndex,$rcDateField) && $sbValue){
							$rcRow[$sbIndex] = $objDate->fncformatofechahora($sbValue);
						}
						$rcData[$nuCont] = $rcRow; 
					}
				}
				switch ($sbOrigen) {
					case "actuareq":
						$rcResult = $rcData;
						break;
					default:
						foreach ($rcData as $nuCont=>$rcRow) {
							$rcResult[$rcRow["ordenumeros"]] = $rcRow;
						}
				}
			}
				
			unset($rcData);
			$rcData = $rcResult;
		}

		//Pone los labels al inicio del rcData
		array_unshift($rcData,$rcLabels);

		//Necesita algunas constantes
		$sbExt = Application :: getConstant("EXCEL_EXT");
		$sbSlash = Application::getConstant("SLASH");
		$sbSubPath = Application :: getTmpDir();
		$sbSubPath = substr($sbSubPath,(strpos($sbSubPath,"/")+1));
		$sbSplit = Application::getConstant("SEP_DOC");
		$nuX = md5($_REQUEST["PHPSESSID"].rand(0,100));

		//Arma la ruta
		$sbPath = $sbSubPath.$sbSlash.$nuX.$sbExt;

		//Instancia la libreria y genera el libro
		$objLib = Application::loadLib("excel");
		$sbResult = $objLib->execute($rcData,$sbPath);

		//Armemos el link para bajar el libro de excel
		if($sbResult)
		{
			passthru("chmod 755 ".$sbPath);
			if(!$sbSql) {
				$sbHtml .= Application::getConstant('EXCEL_IMAGE1');
				$sbHtml .= $sbPath;
				$sbHtml .= Application::getConstant('EXCEL_IMAGE2');
			}
			else {
				return $sbPath;
			}
		}
		return $sbHtml;
	}
}
?>
