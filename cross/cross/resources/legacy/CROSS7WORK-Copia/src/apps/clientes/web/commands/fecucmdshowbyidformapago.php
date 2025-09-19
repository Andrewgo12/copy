<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowByIdFormapago {
    function execute()
    {
        extract($_REQUEST);
        if(($formapago__fopacodigos != NULL) && ($formapago__fopacodigos != "")){
           $formapago_manager = Application::getDomainController('FormapagoManager'); 
           $formapago_data = $formapago_manager->getByIdFormapago($formapago__fopacodigos); 
           $_REQUEST["formapago__fopacodigos"] = $formapago_data[0]["fopacodigos"];
           $_REQUEST["formapago__fopanombres"] = $formapago_data[0]["fopanombres"];
           $_REQUEST["formapago__fopatiempon"] = $formapago_data[0]["fopatiempon"];
           $_REQUEST["formapago__fopacancuotn"] = $formapago_data[0]["fopacancuotn"];
           $_REQUEST["formapago__fopadescrips"] = $formapago_data[0]["fopadescrips"];
           $_REQUEST["formapago__fopaactivos"] = $formapago_data[0]["fopaactivos"];
        }else{
           $_REQUEST["formapago__fopacodigos"] = WebSession::getProperty("formapago__fopacodigos");
           $_REQUEST["formapago__fopanombres"] = WebSession::getProperty("formapago__fopanombres");
           $_REQUEST["formapago__fopatiempon"] = WebSession::getProperty("formapago__fopatiempon");
           $_REQUEST["formapago__fopacancuotn"] = WebSession::getProperty("formapago__fopacancuotn");
           $_REQUEST["formapago__fopadescrips"] = WebSession::getProperty("formapago__fopadescrips");
           $_REQUEST["formapago__fopaactivos"] = WebSession::getProperty("formapago__fopaactivos");		
        }
        WebSession::unsetProperty("formapago__fopacodigos");
        WebSession::unsetProperty("formapago__fopanombres");
        WebSession::unsetProperty("formapago__fopatiempon");
        WebSession::unsetProperty("formapago__fopacancuotn");
        WebSession::unsetProperty("formapago__fopadescrips");
        WebSession::unsetProperty("formapago__fopaactivos");
        return "success";       
    }
}
?>	
