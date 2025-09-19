<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdDeleteProveedor {
    function execute()
    {
        extract($_REQUEST);
        if(($proveedor__provcodigos != NULL) && ($proveedor__provcodigos != "")){
           $proveedor_manager = Application::getDomainController('ProveedorManager'); 
           $message = $proveedor_manager->deleteProveedor($proveedor__provcodigos);  
           WebRequest::setProperty('cod_message', $message);
           return "success";         
        }else{
            WebRequest::setProperty('cod_message',$message = 0); 
            return "fail";
        }
    }
}
?>	
