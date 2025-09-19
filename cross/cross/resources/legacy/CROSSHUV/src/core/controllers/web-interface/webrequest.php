<?php

class WebRequest {

    function setProperty($name="", &$objVar) {
        $params =& ASAP::getStaticProperty('Request', 'parameters');
        if (!isset($params)) {
            $params = array();
        }
        $params[$name] = $objVar;
    }

    function &getProperty($name="") {
        $params =& ASAP::getStaticProperty('Request', 'parameters');
        if (!isset($params)) {
            $params = array();
        }
        return $params[$name];
    }

    function &getParameterList() {
        $params =& ASAP::getStaticProperty('Request', 'parameters');
        if (!isset($params)) {
            $params = array();
        }
        return $params;
    }
	//Adicionada por Cesar Reyes
    function getEnvValue($name="")
    {
        return $_REQUEST[$name];
    }
    //Adicionada por freina
    function getEnvVar()
    {
        return $_REQUEST;
    }
    //Adicionada por freina
    function getPostFiles($filename)
    {
        return $_FILES[$filename];
    }
}
?>