<?php 

/**
* @Copyright 2004 FullEngine
*
* Comando de modificar a la tabla $tabla
* @author Ingravity 0.0.8
* @date 14-dic-2004
* @location Cali - Colombia
*/

require_once "Web/WebRequest.class.php";

Class FePrCmdUpdateAuth {

	function execute() {
		extract($_REQUEST);

		if (($auth__authusernams != NULL) && ($auth__authusernams != "") 
		&& ($auth__authuserpasss != NULL) && ($auth__authuserpasss != "") 
		&& ($auth__authrealname != NULL) && ($auth__authrealname != "") 
		&& ($auth__applcodigos != NULL) && ($auth__applcodigos != "") 
		&& ($auth__stylcodigos != NULL) && ($auth__stylcodigos != "") 
		&& ($auth__langcodigos != NULL) && ($auth__langcodigos != "") 
		&& ($auth__profcodigos != NULL) && ($auth__profcodigos != "")
        && ($auth__authestados != NULL) && ($auth__authestados != "")
        && ($auth__schecodigon != NULL) && ($auth__schecodigon != "")) 
		{
			$objServ = Application :: loadServices("Data_type");
			
			//Hace la valizacion del tama� min 4 caracteres
			if(strlen($auth__authusernams) < 4 || strlen($auth__authuserpasss) < 4)
			{
				WebRequest :: setProperty('cod_message', $message = 9);
		        if ($auth__authusernams == Application::getConstant('ADMIN_USER'))
		            return "admin";
		        if ($auth__authusernams == Application::getConstant('WEB_USER'))
		            return "webuser";
				return "fail";
			}
			//Valida que username y key solo sean [A-Z][a-z][0-9][.,_]
			if ($objServ->basePrimary($auth__authusernams) == false || $objServ->basePrimary($auth__authuserpasss) == false) 
			{
				WebRequest :: setProperty('cod_message', $message = 10);
		        if ($auth__authusernams == Application::getConstant('ADMIN_USER'))
		            return "admin";
		        if ($auth__authusernams == Application::getConstant('WEB_USER'))
		            return "webuser";
				return "fail";
			}

			//Hace la validacion de campos numericos y formateo de campos cadena
			$auth__authrealape1 = $objServ->formatString($auth__authrealape1);
			$auth__authrealape2 = $objServ->formatString($auth__authrealape2);

            if($auth__authemail){
                if(!$objServ->IsEmail($auth__authemail)){
                    WebRequest :: setProperty('cod_message', $message = 13);
			        if ($auth__authusernams == Application::getConstant('ADMIN_USER'))
			            return "admin";
			        if ($auth__authusernams == Application::getConstant('WEB_USER'))
			            return "webuser";
                    return "fail";
                }
            }
            
			$auth_manager = Application::getDomainController("AuthManager");
			$message = $auth_manager->updateAuth($auth__authusernams, $auth__authuserpasss, $auth__authrealname, $auth__authrealape1, $auth__authrealape2, $auth__authemail, $auth__applcodigos, $auth__stylcodigos, $auth__langcodigos, $auth__profcodigos, $auth__authestados);
			if($message==3)
			{
				$authSchemaManager = Application::getDomainController("AuthschemaManager");
				$blDel = $authSchemaManager->deleteAuthschema($auth__authusernams);
				
				if($blDel){
					if ($auth__authusernams == Application::getConstant('ADMIN_USER')){
						$message = $authSchemaManager->addAuthschema($auth__authusernams,$auth__schecodigon);
					}else{
						foreach ($auth__schecodigon as $nuCont=>$nuValue)
							$message = $authSchemaManager->addAuthschema($auth__authusernams,$nuValue);
					}
				}
			}
			WebRequest :: setProperty('cod_message', $message);
			return "success";
		} else {
			WebRequest :: setProperty('cod_message', $message = 0);
	        if ($auth__authusernams == Application::getConstant('ADMIN_USER'))
	            return "admin";
	        if ($auth__authusernams == Application::getConstant('WEB_USER'))
	            return "webuser";
			return "fail";
		}
	}

}

?>	
