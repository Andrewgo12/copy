<?php

require_once "Data/Serializer.class.php";

class ASAP
{

    function getAsapDirectory() {
        return realpath(dirname(__FILE__)."/../../.");
    }
    
    function getPluginsDirectory() {
        // must be set by configuration
        return ASAP::getAsapDirectory()."/system/plugins";
    }
    
    /**
    * If you need static properties, you can use this method
    * to simulate them. Eg. in your method(s)
    * do this: $myVar = &ASAP::getStaticProperty('myVar');
    * You MUST use a reference, or they will not persist!
    *
    * @access public
    * @param  string $class  The calling classname, to prevent clashes
    * @param  string $var    The variable to retrieve.
    * @return mixed   A reference to the variable. If not set it will be
    *                 auto initialised to NULL.
    */
    function &getStaticProperty($class, $var)
    {
        static $properties;
        return $properties[$class][$var];
    }

    function &__getVar($nom_var) {

        $config = &ASAP::getStaticProperty('ASAP','config');
        
        // if configuration data is not set
        if (!isset($config)) {
            // load the configuration data
            // filename = <ASAP-dir>/config/system.conf.data
            $config = Serializer::load(getAsapDir() . '/config/system.conf.data');
        }
        if (!is_array($config)) {
            return PEAR::raiseError('cannot load the configuration file');
        }
        return $config[$nom_var];
    }
    
}

?>
