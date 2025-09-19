<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowByIdPregformula {

    function execute()
    {
        extract($_REQUEST);

        if(($pregformula__pregcodigon != NULL) && ($pregformula__pregcodigon != "") && ($pregformula__formcodigon != NULL) && ($pregformula__formcodigon != "")){
           $pregformula_manager = Application::getDomainController('PregformulaManager'); 
           $pregformula_data = $pregformula_manager->getByIdPregformula($pregformula__pregcodigon,$pregformula__formcodigon); 
           
           $_REQUEST["pregformula__pregcodigon"] = $pregformula_data[0]["pregcodigon"];
           $_REQUEST["pregformula__formcodigon"] = $pregformula_data[0]["formcodigon"];

        }else{
		
           $_REQUEST["pregformula__pregcodigon"] = WebSession::getProperty("pregformula__pregcodigon");
           $_REQUEST["pregformula__formcodigon"] = WebSession::getProperty("pregformula__formcodigon");		
        }
		
        WebSession::unsetProperty("pregformula__pregcodigon");
        WebSession::unsetProperty("pregformula__formcodigon");

        return "success";       
    }

}

?>	
