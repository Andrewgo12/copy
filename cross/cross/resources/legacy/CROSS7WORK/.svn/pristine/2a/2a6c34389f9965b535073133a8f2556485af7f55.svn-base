<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeScCmdDeleteCategoria {

    function execute()
    {
        extract($_REQUEST);
        
        if(($categoria__catecodigon != NULL) && ($categoria__catecodigon != "")){
           $categoria_manager = Application::getDomainController('CategoriaManager'); 
           $message = $categoria_manager->deleteCategoria($categoria__catecodigon);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
