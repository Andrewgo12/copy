<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdActiveFormulario {

    function execute()
    {
        extract($_REQUEST);

        if(($formulario__formcodigon != NULL) && ($formulario__formcodigon != ""))
        {
        	$formulario_manager = Application::getDomainController('FormularioManager');
            $message = $formulario_manager->activeFormulario($formulario__formcodigon);
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