<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de Eliminar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdDeleteAuth {

	function execute() {
		extract($_REQUEST);

		if (($auth__authusernams != NULL) && ($auth__authusernams != "")) 
		{
			$authSchema = Application::getDomainController("AuthschemaManager");
			$message = $authSchema->deleteAuthschema($auth__authusernams);
			
			if($message==3)
			{
				$auth_manager = Application::getDomainController("AuthManager");
				$message = $auth_manager->deleteAuth($auth__authusernams);				
			}
			
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} 
		else 
		{
			WebRequest :: setProperty('cod_message', $message = 0);
			return "fail";
		}
	}

}

?>	
