<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeEnCmdShowByIdRespuestausu {

    function execute()
    {
        extract($_REQUEST);

        if(($respuestausu__usuacodigon != NULL) && ($respuestausu__usuacodigon != "") && ($respuestausu__formcodigon != NULL) && ($respuestausu__formcodigon != "") && ($respuestausu__pregcodigon != NULL) && ($respuestausu__pregcodigon != "") && ($respuestausu__reuscodigon != NULL) && ($respuestausu__reuscodigon != "")){
           $respuestausu_manager = Application::getDomainController('RespuestausuManager'); 
           $respuestausu_data = $respuestausu_manager->getByIdRespuestausu($respuestausu__usuacodigon,$respuestausu__formcodigon,$respuestausu__pregcodigon,$respuestausu__reuscodigon); 
           
           $_REQUEST["respuestausu__usuacodigon"] = $respuestausu_data[0]["usuacodigon"];
           $_REQUEST["respuestausu__formcodigon"] = $respuestausu_data[0]["formcodigon"];
           $_REQUEST["respuestausu__pregcodigon"] = $respuestausu_data[0]["pregcodigon"];
           $_REQUEST["respuestausu__reuscodigon"] = $respuestausu_data[0]["reuscodigon"];
           $_REQUEST["respuestausu__varecodigon"] = $respuestausu_data[0]["varecodigon"];
           $_REQUEST["respuestausu__respcodigon"] = $respuestausu_data[0]["respcodigon"];
           $_REQUEST["respuestausu__reusvalorabis"] = $respuestausu_data[0]["reusvalorabis"];

        }else{
		
           $_REQUEST["respuestausu__usuacodigon"] = WebSession::getProperty("respuestausu__usuacodigon");
           $_REQUEST["respuestausu__formcodigon"] = WebSession::getProperty("respuestausu__formcodigon");
           $_REQUEST["respuestausu__pregcodigon"] = WebSession::getProperty("respuestausu__pregcodigon");
           $_REQUEST["respuestausu__reuscodigon"] = WebSession::getProperty("respuestausu__reuscodigon");
           $_REQUEST["respuestausu__varecodigon"] = WebSession::getProperty("respuestausu__varecodigon");
           $_REQUEST["respuestausu__respcodigon"] = WebSession::getProperty("respuestausu__respcodigon");
           $_REQUEST["respuestausu__reusvalorabis"] = WebSession::getProperty("respuestausu__reusvalorabis");		
        }
		
        WebSession::unsetProperty("respuestausu__usuacodigon");
        WebSession::unsetProperty("respuestausu__formcodigon");
        WebSession::unsetProperty("respuestausu__pregcodigon");
        WebSession::unsetProperty("respuestausu__reuscodigon");
        WebSession::unsetProperty("respuestausu__varecodigon");
        WebSession::unsetProperty("respuestausu__respcodigon");
        WebSession::unsetProperty("respuestausu__reusvalorabis");

        return "success";       
    }

}

?>	
