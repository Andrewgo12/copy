<?php
require_once "Web/WebRequest.class.php";

class FeCrCmdTestPQRSF {
    
    function execute() {
        // Simular autenticación web
        $rcUser = array(
            "username" => "webuser",
            "schema" => "2",
            "schecodigon" => "2",
            "lang" => "es"
        );
        WebSession::setProperty("_authsession", $rcUser);
        
        return "success";
    }
}
?>