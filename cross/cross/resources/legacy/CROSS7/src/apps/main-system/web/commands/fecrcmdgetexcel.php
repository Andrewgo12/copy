<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCrCmdGetExcel {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($rcResult, "array");
		settype($rcUser,"array");
		settype($rcParam,"array");
		settype($objManager, "object");
		settype($sbOutput, "string");
		settype($sbResult,"string");
		settype($sbParams,"string");
		settype($sbSql,"string");
		settype($sbLabel,"string");
		settype($sbTmp,"string");

		$objJson = new Services_JSON();
		$objService = Application :: loadServices("Data_type");

		//Trae los datos del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

		$sbParams = $this->readSql();
		$rcParam = explode('_____',$sbParams);
		$sbSql = $rcParam[0];
		$sbLabel = $rcParam[1];
		$objManager = Application::getDomainController("ExcelManager");
		$sbResult = $objManager->execute(explode("=>",($sbLabel)),false,($sbSql),$origen);

		if($sbResult){
			if(file_exists($sbResult)){
				$sbResult = basename($sbResult);
			}
			$rcResult[0]=1;
			$rcResult[1]= $objService->encode($sbResult);
			$rcResult[2]= $objService->encode($sbTmp);
		}else{
			$rcResult[0]=0;
			$rcResult[1]= $objService->encode($sbResult);
			$rcResult[2]= $objService->encode($rcmessages[100]);
		}

		$sbOutput = $objJson->encode($rcResult);

		die($sbOutput);
	}

	function readSql() {
		settype($sbPath,"string");
		settype($sbFile,"string");
		settype($sbParams,"string");
		$sbPath = Application::getTmpDirectory().Application::getConstant("SLASH")."sql_".$_REQUEST["PHPSESSID"];
		if(file_exists($sbPath)) {
			$sbFile = fopen($sbPath,"r");
			$sbParams = fread($sbFile,filesize($sbPath));
			fclose($sbFile);
			//unlink($sbPath);
			return $sbParams;
		}
	}
}
?>
