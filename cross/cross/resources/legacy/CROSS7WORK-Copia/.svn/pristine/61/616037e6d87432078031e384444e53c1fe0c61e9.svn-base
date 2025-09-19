<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";

Class FeEnCmdDeleteRespuestausu {

    function execute()
    {
        extract($_REQUEST);
        
        if(($respuestausu__usuacodigon != NULL) && ($respuestausu__usuacodigon != "") && ($respuestausu__formcodigon != NULL) && ($respuestausu__formcodigon != "") && ($respuestausu__pregcodigon != NULL) && ($respuestausu__pregcodigon != "") && ($respuestausu__reuscodigon != NULL) && ($respuestausu__reuscodigon != "")){
           $respuestausu_manager = Application::getDomainController('RespuestausuManager'); 
           $message = $respuestausu_manager->deleteRespuestausu($respuestausu__usuacodigon,$respuestausu__formcodigon,$respuestausu__pregcodigon,$respuestausu__reuscodigon);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }

}

?>	
