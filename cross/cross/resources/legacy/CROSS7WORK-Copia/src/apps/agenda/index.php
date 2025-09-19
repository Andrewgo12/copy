<?php

/**
* index.php
*
* standalone receiver
* freestanding code to load the FrontController
* requires the "config.inc.php"
*/

require_once "config/config.inc.php";
require_once "ASAP.class.php";
require_once "Web/FrontController.class.php";

// run the Front Controller
FrontController::execute();

?>