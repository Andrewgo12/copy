<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeScCmdDeleteEntrada {

    function execute()
    {
        extract($_REQUEST);
        
        if(($entrcodigon != NULL) 
        && ($entrcodigon != ""))
        {
           $entrada_manager = Application::getDomainController('RefercrossManager'); 
           $message = $entrada_manager->deleteAllRefercrossEntrada($entrcodigon); 
           
           $entrada_manager = Application::getDomainController('EntradaManager'); 
           $message = $entrada_manager->deleteAllOrganentrada($entrcodigon); 
           
           $entrada_manager = Application::getDomainController('EntradaManager'); 
           $message = $entrada_manager->deleteEntrada($entrcodigon); 
           
           $entrada_manager = Application::getDataGateway('sqlExtended'); 
           $message = $entrada_manager->deletePreentradaByEntrada($entrcodigon);  
            
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }
        else
        {
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>