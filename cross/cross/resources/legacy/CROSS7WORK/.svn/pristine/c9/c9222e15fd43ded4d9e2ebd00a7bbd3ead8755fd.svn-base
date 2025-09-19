<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeEnCmdDeletePregformula {

    function execute()
    {
        extract($_REQUEST);
        
        if(($pregformula__pregcodigon != NULL) && ($pregformula__pregcodigon != "") && ($pregformula__formcodigon != NULL) && ($pregformula__formcodigon != "")){
           $pregformula_manager = Application::getDomainController('PregformulaManager'); 
           $message = $pregformula_manager->deletePregformula($pregformula__pregcodigon,$pregformula__formcodigon);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
