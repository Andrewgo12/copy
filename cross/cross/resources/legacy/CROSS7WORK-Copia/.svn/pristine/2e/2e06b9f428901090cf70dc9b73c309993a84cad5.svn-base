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
class FePrCmdLogin {
    function execute()
    {
        //Destruye de la sesion los datos del usuario si existe alguna
        $rcDataUser = WebSession::getProperty('_authsession');
        if(is_array($rcDataUser))
            WebSession::unsetProperty('_authsession');
        unset($rcDataUser);
        
        //Si existe un autenticaci�n de usuario externa
        if(array_key_exists("REMOTE_USER",$_SERVER)) {
	        if($_SERVER["REMOTE_USER"]){
	            $login_manager = Application::getDomainController('LoginManager');
				$_authsession = $login_manager->getSessionDataUser($_SERVER["REMOTE_USER"]);
				if(!is_array($_authsession)){
				    WebRequest::setProperty('cod_message',$message = 5);
				    return "fail";
				}
				//Pone en sesion los datos del usuario
				WebSession::setProperty("_authsession",$_authsession);
	            return "success";
	        }
    	}
            
    	extract($_REQUEST);
        if(($username != NULL) && ($username != "") && ($password != NULL) && ($password != ""))
        {
        	$login_manager = Application::getDomainController('LoginManager');
        	
        	//Hace la autentixaci�n del usuario
        	$blAuth = $login_manager->getAuth($username, $password);
			if ($blAuth == true) {
				$_authsession = $login_manager->getSessionDataUser($username);
				if(!is_array($_authsession)){
				     WebRequest::setProperty('cod_message',$_authsession);
				     return "fail";
				}
				
                //valida el estado (Activo/Inactivo)
                $regInact = Application::getConstant('REG_INACT');
                if($_authsession["estate"] == $regInact){
                    WebRequest::setProperty('cod_message',$message = 8);
				    return "fail";
                }
				if(is_array($_authsession['schema'])){
					$_authsession['schema'] = 1;
					//Pone en sesion los datos del usuario
					WebSession::setProperty("_authsession",$_authsession);
					return "setschema";
				}
				//Pone en sesion los datos del usuario
				WebSession::setProperty("_authsession",$_authsession);
				return "success";
	        }else{
	            WebRequest::setProperty('cod_message',$message = 4);
	            return "fail";
	        }
        }else{
            WebRequest::setProperty('cod_message',$message = 7);
            return "fail";
        }
    }
}
?>
