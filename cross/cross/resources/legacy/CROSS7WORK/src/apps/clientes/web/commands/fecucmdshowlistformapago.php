<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListFormapago {
    function execute()
    {
       extract($_REQUEST);
       if(!WebSession::issetProperty("formapago__fopacodigos"))
           WebSession::setProperty("formapago__fopacodigos",$formapago__fopacodigos);
       if(!WebSession::issetProperty("formapago__fopanombres"))
           WebSession::setProperty("formapago__fopanombres",$formapago__fopanombres);
       if(!WebSession::issetProperty("formapago__fopatiempon"))
           WebSession::setProperty("formapago__fopatiempon",$formapago__fopatiempon);
       if(!WebSession::issetProperty("formapago__fopacancuotn"))
           WebSession::setProperty("formapago__fopacancuotn",$formapago__fopacancuotn);
       if(!WebSession::issetProperty("formapago__fopadescrips"))
           WebSession::setProperty("formapago__fopadescrips",$formapago__fopadescrips);
       if(!WebSession::issetProperty("formapago__fopaactivos"))
           WebSession::setProperty("formapago__fopaactivos",$formapago__fopaactivos);
        return "success";  
    }
}
?>	
