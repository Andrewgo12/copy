<?php
class FeGeExcelManager {

	function FeGeExcelManager()	{
		$this->gateway = Application :: getDataGateway("SqlExtended");
	}

	function setData($rcData){
		$this->rcData = $rcData;
	}

	function getResult(){
		return $this->rcResult;
	}

	function execute(){

		settype($objLib,"object");
		settype($rcData,"array");
		settype($sbHtml,"string");
		settype($sbResult,"string");
		settype($sbExt,"string");
		settype($sbSlash,"string");
		settype($sbSubPath,"string");
		settype($sbPath,"string");
		settype($sbTmp,"string");
		settype($nuX,"integer");

		extract($this->rcData);

		//SI TRAE UN QUERY,
		if($sbSql) {
				
			$this->gateway->objdb->fncadoselect($sbSql,FETCH_ASSOC);
			$rcData = $this->gateway->objdb->rcresult;
		}
		
		if(is_array($rcData) && $rcData && is_array($rcLabels) && $rcLabels){
			//Pone los labels al inicio del rcData
			array_unshift($rcData,$rcLabels);

			//Necesita algunas constantes
			$sbExt = Application :: getConstant("EXCEL_EXT");
			$sbSlash = Application::getConstant("SLASH");
			$sbSubPath = "tmp";
			$nuX = md5($_REQUEST["PHPSESSID"].rand(0,100));

			//Arma la ruta
			$sbPath = $sbSubPath.$sbSlash.$nuX.$sbExt;

			//Instancia la libreria y genera el libro
			$objLib = Application::loadLib("excel");
			$sbTmp = $objLib->execute($rcData,$sbPath);
			
			//Armemos el link para bajar el libro de excel
			if($sbTmp){
				passthru("chmod 755 ".$sbPath);
				$sbResult = $sbPath;
			}
		}
		$this->rcResult =  $sbResult;
	}
}
?>