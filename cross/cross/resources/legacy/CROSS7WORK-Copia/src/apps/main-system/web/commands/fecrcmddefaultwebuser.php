<?php   
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/

require_once "Web/WebRequest.class.php";
Class FeCrCmdDefaultWebUser {

	function execute() {

		settype($objService, "object");
		settype($rcConf, "array");
		settype($rcUser, "array");
		settype($rcFileName, "array");
		settype($rcTmp, "array");
		settype($nuMessage, "integer");
		settype($nuCont, "integer");
        
        extract($_REQUEST);
        
        //Valida que sea enviado por url el nombre del usuario
        if(!$username){
            die('<p><b>ERROR: The user name is not known, verifies the URL</b></p>');
        }
        
        //Valida que sea enviado por url el codigo del contexto
        if(!$context){
            die('<p><b>ERROR: The context code is not known, verifies the URL</b></p>');
        }
        
        //se obtienen los datos del usuario
		$objService = Application :: loadServices('Profiles');
		$rcUser = $objService->getAuth($username);

		if (!is_array($rcUser)) {
			die('<p><b>ERROR: The user does not exist, verifies the URL user name.</b></p>');
		}
		
		//Valida que el usuario tenga el contexto
		if(is_array($rcUser['schema'])){
			$flag = false;
			foreach($rcUser['schema'] as $rcTmp){
				if($rcTmp['schecodigon'] == $context){
					$flag = true;
					break;
				}
			}
			if($flag == false)
				die('<p><b>ERROR: The context has not been assigned to the Web user.</b></p>');
		}else{
			if($rcUser['schema'] != $context)
				die('<p><b>ERROR: The context has not been assigned to the Web user.</b></p>');	
		}
	
		//Completa los datos del usuario con el contexto
		$rcUser["schema"] = $context;
		$rcUser["schecodigon"] = $context;
		
		//Pone en sesion los datos del usuario
		if($_REQUEST["lang"])
			$rcUser["lang"] = $_REQUEST["lang"];
		else if($_SESSION["_authsession"]["lang"])
			$rcUser["lang"] = $_SESSION["_authsession"]["lang"];
		WebSession :: setProperty("_authsession", $rcUser);
		
		//Se obtienen los datos de configuracion de la inetrfaz Web
		$objService = Application :: loadServices('General');
		$rcConf = $objService->getParam("cross300", "web_user_conf");
		
        //Valida que el usuario sea el definido userweb para este esquema
        if($username != $rcConf['user']){
            WebSession::unsetProperty('_authsession');
            die('<p><b>ERROR: This user is not defined for this entrance, verifies the URL user name.</b></p>');
        }
		//se montan al $_REQUEST los valores de la forma
		$_REQUEST["ordenempresa__orgacodigos"] = $rcConf["orgacodigos"];
		$objService = Application :: loadServices('DateController');
		
        //Deatermina si la fecha es con horas o no
        $generalService = Application::loadServices('General');
        $paramHour = $generalService->getParam('workflow','PROC_HOURS');
        if($paramHour == true)
            $_REQUEST["orden__ordefecregd"] = $objService->fncformatofechahora($objService->fncintdatehour());
        else
            $_REQUEST["orden__ordefecregd"] = $objService->fncformatofecha($objService->fncintdatehour());
		$_REQUEST["ordenempresa__merecodigos"] = $rcConf["merecodigos"];

		//SI limpia el $_REQUEST
		if (($clean_table)) {
			$this->UnsetRequest();
			unset ($_REQUEST["clean_table"]);
		}
		
		
		if ((WebSession :: issetProperty("_rcCasosFileList"))) {
			
			//se obtienen los archivos ya guardados
			$rcFileName = WebSession :: getProperty("_rcCasosFileList");
			foreach ($rcFileName as $nuCont => $rcTmp) {
				if(!$rcTmp["id"]){
					WebSession :: unsetProperty($rcTmp["index"]);
				}
			}
			$rcTmp =array();
			WebSession :: setProperty("_rcCasosFileList",$rcTmp);
		}
		return "success";
	}
    
	function UnsetRequest() {
		settype($sbKey, "string");
		settype($sbValue, "string");
		foreach ($_REQUEST as $sbKey => $sbValue) {
			if (strpos($sbKey,"__")!==false) {
				if ($sbKey != "ordenempresa__orgacodigos" && $sbKey != "orden__ordefecregd" && $sbKey != "ordenempresa__merecodigos") {
					unset ($_REQUEST[$sbKey]);
				}
			}
		}
        unset ($_REQUEST["ordenempresa_locacodigos_desc"]);
		unset ($_REQUEST["attachment"]);
		unset ($_REQUEST["deleteattachment"]);
		unset ($_REQUEST["consult"]);
		unset ($_REQUEST["contidentis_desc"]);
		unset ($_REQUEST["infrcodigos_desc"]);
	}
}
?>