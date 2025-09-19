<?php
require_once "Web/WebRequest.class.php";
class FeGeCmdLoadExcel {
	function execute() {
		extract($_REQUEST);

		settype($objManager, "object");
		settype($rcParams,"array");
		settype($rcLabels,"array");
		settype($sbSql, "string");
		settype($sbLabels,"string");
		settype($sbResult,"string");

		settype($sbTmp, "string");
		$sbTmp = $this->readSql();
		
		if($sbTmp){
			$rcParams = explode('_____',$sbTmp);
			$sbSql = $rcParams[0];
			$sbLabels = $rcParams[1];

			$sbSql = str_replace('"integralog"."inlofchaejin"',"TIMESTAMPTZ 'epoch' + inlofchaejin * INTERVAL '1 second' as inlofchaejin",$sbSql);
			$sbSql = str_replace('"integralog"."inlofchaejfn"',"TIMESTAMPTZ 'epoch' + inlofchaejfn * INTERVAL '1 second' as inlofchaejfn",$sbSql);
			
			$rcLabels = explode(",",($sbLabels));
			$objManager = Application::getDomainController("ExcelManager");
			$objManager->setData(array("rcLabels"=>$rcLabels,"sbSql"=>$sbSql));
			$objManager->execute();
			$sbResult = $objManager->getResult();
		}

		die($sbResult);
	}

	function readSql() {

		settype($sbPath,"string");
		settype($sbFile,"string");
		settype($sbReturn,"string");

		$sbPath = Application::getTmpDirectory().Application::getConstant("SLASH")."sql_".$_REQUEST["PHPSESSID"];
		if(file_exists($sbPath)) {
			$sbFile = fopen($sbPath,"r");
			$sbReturn = fread($sbFile,filesize($sbPath));
			fclose($sbFile);
			//unlink($sbPath);
		}
		return $sbReturn;
	}
}
?>