<?php
require_once "Web/WebRequest.class.php";
require_once "JSON/JSON.php";
class FeCrCmdValidateDate {
    function execute(){
    	extract($_REQUEST);
    	
    	settype($objJson, "object");
    	settype($objService,"object");
		settype($rcResult, "array");
		settype($objManager, "object");
		settype($sbOutput, "string");
    	settype($rcUser,"array");
    	settype($nuDate,"integer");
    	settype($nuFecha,"integer");
    	settype($nuMaxTime,"integer");
    	settype($nuSeg,"integer");
    	
    	$objJson = new Services_JSON();
	    //info del usuario
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)){
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		//parametro de tiempo
		$objService = Application::loadServices('General');
        $nuMaxTime = $objService->getParam("cross300","CANT_DIAS_ING");

        if($nuMaxTime){
	        //se valida la fecha
			$objService = Application :: loadServices("DateController");
			$nuDate = $objService->fncintdatehour();
			$nuFecha = $objService->fncdatehourtoint($fecha);
			$nuSeg = $objService->nuSecsDay;
			
			//modulo general
			$objService = Application :: loadServices("General");
			$nuFecha = $objService->getDateStart($nuFecha,false);
			
			$nuMaxTime = (int) $nuMaxTime;
			if($nuMaxTime){
				$nuMaxTime = $nuMaxTime * $nuSeg;
			}
			$nuFecha = $objService->getDateEnd($nuFecha, $nuMaxTime);
			
			// 0 fuera de rango 1 esta bien.
			if($nuFecha>=$nuDate){
				 $rcResult[0] = 1; 
			}else{
				$rcResult[0] = 0;
			}	
        }else{
        	$rcResult[0] = 1; 
        }
		
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        $rcResult[1] = $rcmessages[69];
        $sbOutput = $objJson->encode($rcResult);
		die($sbOutput);  
    }
}
?>