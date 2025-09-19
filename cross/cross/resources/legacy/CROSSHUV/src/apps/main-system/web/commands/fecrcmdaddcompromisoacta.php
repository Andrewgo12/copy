<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdAddCompromisoActa {

    function execute() {
    	
    	extract($_REQUEST);
    	settype($sbvalue,"string");
    	settype($nucont,"integer");
    	
    	//verifica que se haya seleccionado una actividad
    	$objDate = Application::loadServices("DateController");
    	if($cmbOriginal == null || $cmbOriginal == ""){
    		WebRequest::setProperty('cod_message',$message = 16);
        	return "fail";
    	}
    	
    	if(is_array($cmbOriginal))
    	{
    		foreach ($cmbOriginal as $sbValue)
    		{
    			if(strlen($accofecrevn))
    				$rcTmpCombo[$sbValue] = $objDate->fncdatehourtoint($accofecrevn);
    		}
    		$cmbOriginal = $rcTmpCombo;
    	}
    		
    	if(strlen($acemcompromis))
    		$acemcompromis .= "_FILA_";
    	$acemcompromis .= $this->fsbJoin($cmbOriginal);
    	$_REQUEST["acemcompromis"] = ($acemcompromis);
    	$_REQUEST["focusposition"] = "cmbOriginal";
   		return "success";
    }
    
    function frcExplode($acemcompromis)
    {
    	if(strpos($acemcompromis,"_FILA_")!==false)
    	{
    		$rcTmp = explode("_FILA_",$acemcompromis);
	    	foreach ($rcTmp as $value)
	    	{
	    		$rcTmp2 = explode("_COL_",$value);
	    		$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
	    	}
    	}
    	elseif(strpos($acemcompromis,"_COL_")!==false)
    	{
    		$rcTmp2 = explode("_COL_",$acemcompromis);
	    	$rcReturn[$rcTmp2[0]] = $rcTmp2[1];
    	}
    	return $rcReturn;
    }
    
    function fsbJoin($acemcompromis)
    {
    	if(!is_array($acemcompromis))
    		return false;
    	foreach ($acemcompromis as $compcodigos=>$fecha)
    	{
    		if(strlen($sbResult>0))
    			$sbResult .= "_FILA_";
    		$sbResult .= $compcodigos."_COL_".$fecha;
    	}
    	return $sbResult;
    }
    
    function arrayMerge($acemcompromis,$cmbOriginal)
    {
    	if(is_array($cmbOriginal))
    		foreach ($cmbOriginal as $key=>$value)
    			$acemcompromis[$key] = $value;
    	return $acemcompromis;
    }
}
?>