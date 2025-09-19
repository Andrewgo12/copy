<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListContrato {
    function execute()
    {
        $_REQUEST["contrato__contnics"] = WebSession::getProperty("contrato__contnics");
        $_REQUEST["contrato__clieidentifs"] = WebSession::getProperty("contrato__clieidentifs");
        $_REQUEST["contrato_clieidentifs_desc"] = WebSession::getProperty("contrato_clieidentifs_desc");
        $_REQUEST["contrato__ticocodigos"] = WebSession::getProperty("contrato__ticocodigos");
        $_REQUEST["contrato_contobjetos"] = WebSession::getProperty("contrato_contobjetos");
        $_REQUEST["contrato__timocodigos"] = WebSession::getProperty("contrato__timocodigos");
        $_REQUEST["contrato__contmonton"] = WebSession::getProperty("contrato__contmonton");
        $_REQUEST["contrato__fopacodigos"] = WebSession::getProperty("contrato__fopacodigos");
        $_REQUEST["contrato__contfchainin"] = WebSession::getProperty("contrato__contfchainin");
        $_REQUEST["contrato__contfchafinn"] = WebSession::getProperty("contrato__contfchafinn");
        $_REQUEST["contrato__contfchfirmn"] = WebSession::getProperty("contrato__contfchfirmn");
        $_REQUEST["contrato__contestados"] = WebSession::getProperty("contrato__contestados");
        $_REQUEST["contrato_contdescrips"] = WebSession::getProperty("contrato_contdescrips");
        WebSession::unsetProperty("contrato__contnics");
        WebSession::unsetProperty("contrato__clieidentifs");
        WebSession::unsetProperty("contrato_clieidentifs_desc");
        WebSession::unsetProperty("contrato__ticocodigos");
        WebSession::unsetProperty("contrato_contobjetos");
        WebSession::unsetProperty("contrato__timocodigos");
        WebSession::unsetProperty("contrato__contmonton");
        WebSession::unsetProperty("contrato__fopacodigos");
        WebSession::unsetProperty("contrato__contfchainin");
        WebSession::unsetProperty("contrato__contfchafinn");
        WebSession::unsetProperty("contrato__contfchfirmn");
        WebSession::unsetProperty("contrato__contestados");
        WebSession::unsetProperty("contrato_contdescrips");
        return "success";  
    }
}
?>	
