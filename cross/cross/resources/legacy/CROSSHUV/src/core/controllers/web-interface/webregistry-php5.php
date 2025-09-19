<?php

/**
* Custom class that will catch a
* NumberFormatException:
*/
class CommandNotFoundException
{
    private $message;
    function __construct($message)
    {
        $this->message = $message;
    }
    /**
     * All exceptions has a toString() function:
     */
    function toString()
    {
        return 'CommandNotFoundException : ' . $this->message;
    }
}

class ViewNotFoundException
{
    private $message;
       function __construct($message)
    {
        $this->message = $message;
    }
    /**
     * All exceptions has a toString() function:
     */
    function toString()
    {
        return 'ViewNotFoundException : ' . $this->message;
    }
}

class WebRegistry
{
    function getWebCommand($name) {
        if ($name == "prueba") {
            return new WebCommand();
        } else {
            throw new CommandNotFoundException("$name not found");
        }
    }
    
    function init() {

    }
}

try {
    WebRegistry::getWebCommand("otro");
    echo "sin errores";
} catch (CommandNotFoundException $e) {
    echo "con errores";
    echo $e->toString();
}

?>
