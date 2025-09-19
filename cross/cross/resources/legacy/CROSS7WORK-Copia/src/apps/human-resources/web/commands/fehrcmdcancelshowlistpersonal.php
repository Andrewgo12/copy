<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdCancelShowListPersonal {
    function execute()
    {
        $_REQUEST["personal__perscodigos"] = WebSession::getProperty("personal__perscodigos");
        $_REQUEST["personal__persidentifs"] = WebSession::getProperty("personal__persidentifs");
        $_REQUEST["personal__persnombres"] = WebSession::getProperty("personal__persnombres");
        $_REQUEST["personal__persapell1s"] = WebSession::getProperty("personal__persapell1s");
        $_REQUEST["personal__persapell2s"] = WebSession::getProperty("personal__persapell2s");
        $_REQUEST["personal__persusrnams"] = WebSession::getProperty("personal__persusrnams");
        $_REQUEST["personal__cargcodigos"] = WebSession::getProperty("personal__cargcodigos");
        $_REQUEST["personal__persprofecs"] = WebSession::getProperty("personal__persprofecs");
        $_REQUEST["personal__perstelefo1"] = WebSession::getProperty("personal__perstelefo1");
        $_REQUEST["personal__perstelefo2"] = WebSession::getProperty("personal__perstelefo2");
        $_REQUEST["personal__locacodigos"] = WebSession :: getProperty("personal__locacodigos");
        $_REQUEST["personal__persdireccis"] = WebSession::getProperty("personal__persdireccis");
        $_REQUEST["personal__persemails"] = WebSession::getProperty("personal__persemails");
        $_REQUEST["personal__perscontacts"] = WebSession::getProperty("personal__perscontacts");
        $_REQUEST["personal__perstelcont"] = WebSession::getProperty("personal__perstelcont");
        $_REQUEST["personal__persestadoc"] = WebSession::getProperty("personal__persestadoc");
        WebSession::unsetProperty("personal__perscodigos");
        WebSession::unsetProperty("personal__persidentifs");
        WebSession::unsetProperty("personal__persnombres");
        WebSession::unsetProperty("personal__persapell1s");
        WebSession::unsetProperty("personal__persapell2s");
        WebSession::unsetProperty("personal__persusrnams");
        WebSession::unsetProperty("personal__cargcodigos");
        WebSession::unsetProperty("personal__persprofecs");
        WebSession::unsetProperty("personal__perstelefo1");
        WebSession::unsetProperty("personal__perstelefo2");
        WebSession::unsetProperty("personal__locacodigos");
        WebSession::unsetProperty("personal__persdireccis");
        WebSession::unsetProperty("personal__persemails");
        WebSession::unsetProperty("personal__perscontacts");
        WebSession::unsetProperty("personal__perstelcont");
        WebSession::unsetProperty("personal__persestadoc");
        return "success";  
    }
}
?>	
