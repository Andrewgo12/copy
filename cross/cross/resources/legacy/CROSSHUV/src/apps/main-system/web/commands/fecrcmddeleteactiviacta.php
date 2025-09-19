<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteActiviacta {
    function execute() {
    	
    	extract($_REQUEST);
    	settype($rctmp,"array");
    	settype($rcresult,"array");
    	settype($sbvalue,"string");
    	settype($nucont,"integer");
    	
    	//se almacena el $_REQUEST para el control de campos dinamicos
		WebSession :: setProperty("rcRequest", $_REQUEST);
    	
    	if($activities){
    		$rctmp = explode(",",$activities);
    		unset($rctmp[$delactiviacta]);
    		if($rctmp){
    			foreach($rctmp as $sbvalue){
    				$rcresult[$nucont] = $sbvalue;
    				$nucont ++;
    			}
    			$_REQUEST["activities"] = implode(",",$rcresult);
    		}else{
    			unset($_REQUEST["activities"]);
    		}	
    	}
    	unset($_REQUEST["delactiviacta"]);
    	$_REQUEST["focusposition"] = "cmbOriginal";
    	return "success";
    }
}
?>