<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeCuCmdDeleteContacto {

    function execute()
    {
        extract($_REQUEST);
        
        if(($contacto__contcodigon != NULL) && ($contacto__contcodigon != "")){
           $contacto_manager = Application::getDomainController('ContactoManager'); 
           $message = $contacto_manager->deleteContacto($contacto__contcodigon);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
