<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdAddPregformula {

    function execute()
    {
        extract($_REQUEST);
        if(($formulario__formcodigon != NULL) && ($formulario__formcodigon != ""))
        {
            $pregformula_manager = Application::getDomainController('PregformulaManager');
            $pregformula_manager->deleteAllPregformula($formulario__formcodigon); 
            
            foreach ($_REQUEST as $key=>$value)
            {
            	if(strstr($key,"pregunta"))
            		$message = $pregformula_manager->addPregformula($value,$formulario__formcodigon); 
            }
            WebRequest::setProperty('cod_message', $message=3);
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