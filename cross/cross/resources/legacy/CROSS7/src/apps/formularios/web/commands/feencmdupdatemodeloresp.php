<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdUpdateModeloresp {

    function execute(){
    	
        extract($_REQUEST);
        settype($objService,"object");
        settype($objManager,"object");
        settype($nuMessage,"integer");

        if(($modeloresp__morecodigon != NULL) && ($modeloresp__morecodigon != "") 
        && ($modeloresp__morenombres != NULL) && ($modeloresp__morenombres != "")){
        	
        	$objService = Application :: loadServices("Data_type");
        	$modeloresp__morenombres = $objService->formatString($modeloresp__morenombres);
        	$modeloresp__moredescrips = $objService->formatString($modeloresp__moredescrips);
        	
            $objManager = Application::getDomainController('ModelorespManager'); 
            $nuMessage = $objManager->updateModeloresp($modeloresp__morecodigon,$modeloresp__morenombres,$modeloresp__moredescrips); 
            WebRequest::setProperty('cod_message', $nuMessage);
            return "success";       
        }else{
            WebRequest::setProperty('cod_message',$nuMessage = 0);
            return "fail";
        }
    }
}
?>