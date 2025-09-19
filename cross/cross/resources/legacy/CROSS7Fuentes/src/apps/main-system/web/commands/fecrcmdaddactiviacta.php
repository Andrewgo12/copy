<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdAddactiviacta {

    function execute() {
    	
    	extract($_REQUEST);
    	settype($rctmp,"array");
    	settype($sbvalue,"string");
    	settype($nucont,"integer");
    	
    	//se almacena el $_REQUEST para el control de campos dinamicos
		WebSession :: setProperty("rcRequest", $_REQUEST);
    	
    	//verifica que se haya seleccionado una actividad
    	if($cmbOriginal == null || $cmbOriginal == ""){
    		WebRequest::setProperty('cod_message',$message = 16);
        	return "fail";
    	}
    	
    	if($activities){
    		$rctmp = explode(",",$activities);
    		foreach($rctmp as $sbvalue){
    			if($sbvalue == $cmbOriginal){
    				return "success";
    			}
    		}
    	}
    	$rctmp = array_merge($rctmp,$cmbOriginal);
    	$_REQUEST["activities"] = implode(",",$rctmp);
    	$_REQUEST["focusposition"] = "cmbOriginal";
   		return "success";
    }
}
?>