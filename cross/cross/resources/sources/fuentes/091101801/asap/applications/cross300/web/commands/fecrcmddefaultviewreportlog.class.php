<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultViewReportLog {
    function execute(){
    	extract($_REQUEST);
    	settype($rcTmp,"array");
    	
    	if(strpos ($period,",")===false){
    		if($month){
    			$_REQUEST["initial_month"]=$month;
    			$_REQUEST["final_month"]=$month;
    		}else{
    			$_REQUEST["initial_month"]=$period;
    			$_REQUEST["final_month"]=$period;
    		}
    	}else{
    		$rcTmp = explode(",",$period);
    		$_REQUEST["initial_month"]=$rcTmp[0];
    		$_REQUEST["final_month"]=$rcTmp[1];
    	}
        return "success";  
    }
}
?>