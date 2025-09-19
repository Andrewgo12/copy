<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCuCmdCancelShowListCliente {
    function execute()
    {
        $_REQUEST["cliente__cliecodigos"] = WebSession::getProperty("cliente__cliecodigos");
        $_REQUEST["cliente__clieidentifs"] = WebSession::getProperty("cliente__clieidentifs");
        $_REQUEST["cliente__ticlcodigos"] = WebSession::getProperty("cliente__ticlcodigos");
        $_REQUEST["cliente__clienombres"] = WebSession::getProperty("cliente__clienombres");
        $_REQUEST["cliente__clierepprnos"] = WebSession::getProperty("cliente__clierepprnos");
        $_REQUEST["cliente__clierepsenos"] = WebSession::getProperty("cliente__clierepsenos");
        $_REQUEST["cliente__cliereppraps"] = WebSession::getProperty("cliente__cliereppraps");
        $_REQUEST["cliente__clierepseaps"] = WebSession::getProperty("cliente__clierepseaps");
        $_REQUEST["cliente__clielocalizs"] = WebSession::getProperty("cliente__clielocalizs");
        $_REQUEST["cliente__clietelefons"] = WebSession::getProperty("cliente__clietelefons");
        $_REQUEST["cliente__locacodigos"] = WebSession::getProperty("cliente__locacodigos");
        $_REQUEST["cliente_locacodigos_desc"] = WebSession::getProperty("cliente_locacodigos_desc");
        $_REQUEST["cliente__cliepagwebs"] = WebSession::getProperty("cliente__cliepagwebs");
        $_REQUEST["cliente__cliemails"] = WebSession::getProperty("cliente__cliemails");
        $_REQUEST["cliente__esclcodigos"] = WebSession::getProperty("cliente__esclcodigos");
        $_REQUEST["cliente__tiidcodigos"] = WebSession::getProperty("cliente__tiidcodigos");
        $_REQUEST["cliente__grclcodigos"] = WebSession::getProperty("cliente__grclcodigos");
        $_REQUEST["cliente__clienumfaxs"] = WebSession::getProperty("cliente__clienumfaxs");
        $_REQUEST["cliente__clieaparaers"] = WebSession::getProperty("cliente__clieaparaers");
        WebSession::unsetProperty("cliente__cliecodigos");
        WebSession::unsetProperty("cliente__clieidentifs");
        WebSession::unsetProperty("cliente__ticlcodigos");
        WebSession::unsetProperty("cliente__clienombres");
        WebSession::unsetProperty("cliente__clierepprnos");
        WebSession::unsetProperty("cliente__clierepsenos");
        WebSession::unsetProperty("cliente__cliereppraps");
        WebSession::unsetProperty("cliente__clierepseaps");
        WebSession::unsetProperty("cliente__clielocalizs");
        WebSession::unsetProperty("cliente__clietelefons");
        WebSession::unsetProperty("cliente__locacodigos");
        WebSession::unsetProperty("cliente_locacodigos_desc");
        WebSession::unsetProperty("cliente__cliepagwebs");
        WebSession::unsetProperty("cliente__cliemails");
        WebSession::unsetProperty("cliente__esclcodigos");
        WebSession::unsetProperty("cliente__tiidcodigos");
        WebSession::unsetProperty("cliente__grclcodigos");
        WebSession::unsetProperty("cliente__clienumfaxs");
        WebSession::unsetProperty("cliente__clieaparaers");
        return "success";  
    }
}
?>