<?php

class WebSession {

    public static function init() {
        session_start();
    }

    function setProperty($name="", &$objVar) {
        $_SESSION[$name] = $objVar;
    }

    function &getProperty($name="") {
        return $_SESSION[$name];
    }
    
    function unsetProperty($name="") {
       unset($_SESSION[$name]);
    }

    function &getParameterList() {
        return array_keys($_SESSION);
    }
    
    function issetProperty($name="") {
        if(isset($_SESSION[$name])){
            return 1;
        }else{
            return 0;
        }
    }
    function unsetPropertyForms() {
        unset($_SESSION["_forms"]);
    }
    function close() {
        session_destroy();
    }

}

WebSession::init();

?>
