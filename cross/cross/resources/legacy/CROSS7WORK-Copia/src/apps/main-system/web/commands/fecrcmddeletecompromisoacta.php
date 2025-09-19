<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDeleteCompromisoacta {
    function execute() {
    	
    	extract($_REQUEST);
    	settype($rctmp,"array");
    	settype($rcresult,"array");
    	settype($sbvalue,"string");
    	settype($nucont,"integer");
    	
    	if($acemcompromis)
    	{
    		$rctmp = $this->frcExplode($acemcompromis);
    		unset($rctmp[$delacemcompromis]);
    		if($rctmp)
    		{
    			foreach($rctmp as $sbvalue=>$fecha)
   					$rcresult[$sbvalue] = $fecha;
    			$_REQUEST["acemcompromis"] = $this->fsbJoin($rcresult);
    		}
    		else
    		{
    			unset($_REQUEST["acemcompromis"]);
    		}	
    	}
    	unset($_REQUEST["delacemcompromis"]);
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
}
?>