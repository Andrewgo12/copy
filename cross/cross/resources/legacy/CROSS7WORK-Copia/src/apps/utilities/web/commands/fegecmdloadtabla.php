<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeGeCmdloadTabla {
	function execute() {
		extract($_REQUEST);

		settype($objJson, "object");
		settype($objService, "object");
		settype($rcUser, "array");
		settype($rcTmp, "array");
		settype($rcReturn, "array");
		settype($rcResult, "array");
		settype($rcTablas,"array");
		settype($sbOutput, "string");
		settype($sbIndex , "string");
		settype($sbCharset, "string");
		settype($nuCont,"integer");
		

		$objJson = new Services_JSON();
		//primero de dtermina el tipo de respuesta
		$rcTablas = Application :: getConstant("TAB_TIP_DESC");
        $objService = Application :: loadServices("Data_type");
        $sbCharset = strtoupper(ini_get("default_charset")) ;
        
        if($rcTablas && is_array($rcTablas)){
        	
        	$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
			include ($rcUser["lang"]."/".$rcUser["lang"].".nuevadescripcion.php");
			
			foreach($rcTablas as $sbIndex=>$rcTmp){
				$rcResult[$nuCont][0] = $sbIndex;
				$rclabels[$sbIndex]["label"] = $objService->my_html_entity_decode($rclabels[$sbIndex]["label"]);
				if($sbCharset=='UTF-8'){
					$rclabels[$sbIndex]["label"] = utf8_decode($rclabels[$sbIndex]["label"]);
				}
				$rcResult[$nuCont][1] = $objService->encode($rclabels[$sbIndex]["label"]); 
				$nuCont++;
			}
			
			$rcReturn[0]=1;
			$rcReturn[1]=$rcResult;
        }else{
        	$rcResult[0]=0;
			$rcmessages[0] = $objService->my_html_entity_decode($rcmessages[0]);
			if($sbCharset=='UTF-8'){
				$rcmessages[0] = utf8_decode($rcmessages[0]);
			}
			$rcResult[1]= $objService->encode($rcmessages[0]);
        }
        
        //respuesta
		$sbOutput = $objJson->encode($rcReturn);
		die($sbOutput);
	}
}
?>