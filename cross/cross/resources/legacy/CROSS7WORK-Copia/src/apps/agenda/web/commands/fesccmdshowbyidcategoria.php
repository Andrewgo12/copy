<?php

/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";

Class FeScCmdShowByIdCategoria {

    function execute()
    {
        extract($_REQUEST);

        if(($categoria__catecodigon != NULL) && ($categoria__catecodigon != "")){
           $categoria_manager = Application::getDomainController('CategoriaManager'); 
           $categoria_data = $categoria_manager->getByIdCategoria($categoria__catecodigon); 
           
           $_REQUEST["categoria__catecodigon"] = $categoria_data[0]["catecodigon"];
           $_REQUEST["categoria__catenombres"] = $categoria_data[0]["catenombres"];
           $_REQUEST["categoria__catedescris"] = $categoria_data[0]["catedescris"];
           $_REQUEST["categoria__cateactivas"] = $categoria_data[0]["cateactivas"];

        }else{
		
           $_REQUEST["categoria__catecodigon"] = WebSession::getProperty("categoria__catecodigon");
           $_REQUEST["categoria__catenombres"] = WebSession::getProperty("categoria__catenombres");
           $_REQUEST["categoria__catedescris"] = WebSession::getProperty("categoria__catedescris");
           $_REQUEST["categoria__cateactivas"] = WebSession::getProperty("categoria__cateactivas");		
        }
		
        WebSession::unsetProperty("categoria__catecodigon");
        WebSession::unsetProperty("categoria__catenombres");
        WebSession::unsetProperty("categoria__catedescris");
        WebSession::unsetProperty("categoria__cateactivas");

        return "success";       
    }

}

?>	
