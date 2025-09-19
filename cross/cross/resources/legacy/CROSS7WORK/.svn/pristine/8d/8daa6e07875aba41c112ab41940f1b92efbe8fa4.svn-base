<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdShowListContrato {
    function execute()
    {
       extract($_REQUEST);
       $serviceDate = Application :: loadServices("DateController");
       
       if(!WebSession::issetProperty("contrato__contnics"))
           WebSession::setProperty("contrato__contnics",$contrato__contnics);
       if(!WebSession::issetProperty("contrato__clieidentifs"))
           WebSession::setProperty("contrato__clieidentifs",$contrato__clieidentifs);
       if(!WebSession::issetProperty("contrato_clieidentifs_desc"))
           WebSession::setProperty("contrato_clieidentifs_desc",$contrato_clieidentifs_desc);
       if(!WebSession::issetProperty("contrato__ticocodigos"))
           WebSession::setProperty("contrato__ticocodigos",$contrato__ticocodigos);
       if(!WebSession::issetProperty("contrato_contobjetos"))
           WebSession::setProperty("contrato_contobjetos",$contrato_contobjetos);
       if(!WebSession::issetProperty("contrato__timocodigos"))
           WebSession::setProperty("contrato__timocodigos",$contrato__timocodigos);
       if(!WebSession::issetProperty("contrato__contmonton"))
           WebSession::setProperty("contrato__contmonton",$contrato__contmonton);
       if(!WebSession::issetProperty("contrato__fopacodigos"))
           WebSession::setProperty("contrato__fopacodigos",$contrato__fopacodigos);
       if(!WebSession::issetProperty("contrato__contfchainin")){
           WebSession::setProperty("contrato__contfchainin",$contrato__contfchainin);
           $_REQUEST['contrato__contfchainin'] = $serviceDate->fncdatehourtoint($contrato__contfchainin);
       }
       if(!WebSession::issetProperty("contrato__contfchafinn")){
           WebSession::setProperty("contrato__contfchafinn",$contrato__contfchafinn);
           $_REQUEST['contrato__contfchafinn'] = $serviceDate->fncdatehourtoint($contrato__contfchafinn);
       }
       if(!WebSession::issetProperty("contrato__contfchfirmn")){
           WebSession::setProperty("contrato__contfchfirmn",$contrato__contfchfirmn);
           $_REQUEST['contrato__contfchfirmn'] = $serviceDate->fncdatehourtoint($contrato__contfchfirmn);
       }
       if(!WebSession::issetProperty("contrato__contestados"))
           WebSession::setProperty("contrato__contestados",$contrato__contestados);
       if(!WebSession::issetProperty("contrato_contdescrips"))
           WebSession::setProperty("contrato_contdescrips",$contrato_contdescrips);
        return "success";  
    }
}
?>	
