<?php
class FeWFFindError {
    function fncFindError($nuerror) {
    	session_start();
    	//Determina el lenguaje del usuario
    	$rcuser = Application::getUserParam();
    	$sbinclude = $rcuser["lang"].".messages.php";
    	include_once($sbinclude);
    	if(!$rcamessages[$nuerror])
    		return "The message not this formed msg: $nuerror";
    	return $rcamessages[$nuerror];
    }
}
?>