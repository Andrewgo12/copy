<?php

/**
*   Propiedad intelectual del FullEngine.
*	
*	Hace autenticacion de usuario
*	@param array  
*	@author creyes
*	@date 02-ago-20049:15:54
*	@location Cali-Colombia
*/
require_once "Web/WebRequest.class.php";
class FePrCmdSetschema {
	function execute() {
		extract($_REQUEST);
		//Obtene los datos del usuario
		$rcDataUser = WebSession :: getProperty('_authsession');
		WebSession :: unsetProperty('_authsession');

		//Modifica su esquema
		$rcDataUser['schema'] = $schecodigon;
		$rcDataUser['schecodigon'] = $schecodigon;
		//Pone en sesion los datos del usuario
		WebSession :: setProperty("_authsession", $rcDataUser);
		return "success";
	}
}
?>