<?php  
require_once "Web/WebRequest.class.php";
Class FeCrCmdDefaultFichaOrdWeb {

	function execute() {
		settype($objService, "object");
		settype($rcConf, "array");
		settype($rcUser, "array");

        extract($_REQUEST);
        
        // Validación básica de parámetros
        if(!$username){
            die('<p><b>ERROR: Nombre de usuario requerido</b></p>');
        }
        if(!$context){
            die('<p><b>ERROR: Código de contexto requerido</b></p>');
        }
        
        // Autenticación del usuario web
		$objService = Application::loadServices('Profiles');
		$rcUser = $objService->getAuth($username);
		if (!is_array($rcUser)) {
			die('<p><b>ERROR: Usuario no existe</b></p>');
		}
		
		// Validar contexto del usuario
		$contextValid = false;
		if(is_array($rcUser['schema'])){
			foreach($rcUser['schema'] as $rcTmp){
				if($rcTmp['schecodigon'] == $context){
					$contextValid = true;
					break;
				}
			}
		} else {
			$contextValid = ($rcUser['schema'] == $context);
		}
		
		if(!$contextValid) {
			die('<p><b>ERROR: Contexto no asignado al usuario</b></p>');
		}
	
		// Configurar sesión
		$rcUser["schema"] = $context;
		$rcUser["schecodigon"] = $context;
		$rcUser["lang"] = $_REQUEST["lang"] ?? $_SESSION["_authsession"]["lang"] ?? "es";
		WebSession::setProperty("_authsession", $rcUser);
		
		// Validar configuración web
		$objService = Application::loadServices('General');
		$rcConf = $objService->getParam("cross300", "web_user_conf");
		
        if($username != $rcConf['user']){
            WebSession::unsetProperty('_authsession');
            die('<p><b>ERROR: Usuario no autorizado para esta entrada</b></p>');
        }
        
		return "success";
	}
}
?>