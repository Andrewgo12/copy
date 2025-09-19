<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeEnCmdloadRespuestas {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService, "object");
		settype($objManager, "object");
		settype($rcResult, "array");
		settype($rcTmp, "array");
		settype($rcReturn, "array");
		settype($rcRow,"array");
		settype($rcPreg_Ab,"array");
		settype($rcPreg_Ce,"array");
		settype($rcObject,"array");
		settype($sbOutput, "string");
		settype($sbTipo,"string");
		settype($sbFlag,"string");
		settype($sbCharset, "string");
		settype($nuOprecodigon,"integer");
		settype($nuCont,"integer");
		settype($nuRow,"integer");
		
		$sbFlag = false;
		$sbCharset = strtoupper(ini_get("default_charset")) ;

		$objJson = new Services_JSON();
		//primero de dtermina el tipo de respuesta
		$sbTipo = Application :: getConstant("PREG_CER");
		$objService = Application::loadServices('General');
        $nuOprecodigon = $objService->getParam("encuestas","RESP_ABIERTA",false);
        $rcPreg_Ab = $objService->getParam("encuestas","OBJ_PREG_ABIERTA",false);
        $rcPreg_Ce = $objService->getParam("encuestas","OBJ_PREG_CERRADA");
        
        $objService = Application :: loadServices("Data_type");
        
        if($pregcodigon){
        	$objManager = Application :: getDomainController('PreguntaManager');
			$rcTmp = $objManager->getByIdPregunta($pregcodigon);
			if($rcTmp && is_array($rcTmp)){
				$rcTmp = $rcTmp[0];
				if($rcTmp["pregtipopres"]==$sbTipo){
					$sbFlag = true;
				}
				//data de repuestas
				if($nuOprecodigon){
					$objManager = Application :: getDomainController('OpcionrepuesManager');
					if($sbFlag){
						$objManager->setPrecodigon($pregcodigon);
						$objManager->getOpcionrepuesByPregcodigon();
						$rcTmp = $objManager->getResult();
						foreach($rcTmp as $nuCont=>$rcRow){
							if($rcRow[0]!=$nuOprecodigon){
								if($sbCharset=='UTF-8'){
									$rcRow[1] = utf8_decode($rcRow[1]);
								}
								$rcRow[1] = $objService->encode($rcRow[1]);
								$rcResult[$nuRow] = $rcRow;
								$nuRow ++;	
							}
						}
					}else{
						$objManager->setOprecodigon($nuOprecodigon);
						$objManager->getByIdOpcionrepues();
						$rcTmp = $objManager->getResult();
						$rcResult[0][0]= $rcTmp[0]["oprecodigon"];
						if($sbCharset=='UTF-8'){
							$rcTmp[0]["opredescrisp"]= utf8_decode($rcTmp[0]["opredescrisp"]);
						}
						$rcResult[0][1]= $objService->encode($rcTmp[0]["opredescrisp"]);
					}	
					$rcReturn[0] = $rcResult;
				}
				//se obtiene informacion de los objetos para la pregunta
				if($sbFlag){
					if($rcPreg_Ce && is_array($rcPreg_Ce)){
						$rcObject = $rcPreg_Ce;
					}
				}else{
					if($rcPreg_Ab && is_array($rcPreg_Ab)){
						$rcObject = $rcPreg_Ab; 
					}
				}
				
				if($rcObject && is_array($rcObject)){
					$objManager = Application :: getDomainController('ObjetoManager');
					$objManager->getAllObjeto();
					$rcTmp = $objManager->getResult();
					if($rcTmp && is_array($rcTmp)){
						unset($rcResult);
						$nuRow = 0;
						foreach($rcTmp as $rcRow){
							if(in_array($rcRow["objecodigon"],$rcObject)){
								$rcResult[$nuRow][0]= $rcRow["objecodigon"];
								if($sbCharset=='UTF-8'){
									$rcRow["objenombres"] = utf8_decode($rcRow["objenombres"]);
								}
								$rcResult[$nuRow][1]= $objService->encode($rcRow["objenombres"]);
								$nuRow ++;	
							}
						}
						$rcReturn[1] = $rcResult;
					}
				}
			}
        }
        
        //respuesta
		$sbOutput = $objJson->encode($rcReturn);
		die($sbOutput);
	}
}
?>
