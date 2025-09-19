<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
  
require_once "Web/WebRequest.class.php";
Class FePrCmdDeleteSchema {

    function execute(){
    	settype($nuMessage,"integer");
		extract($_REQUEST);
		if(($schema__schecodigon != NULL) && ($schema__schecodigon != "")){
			$schema_manager = Application::getDomainController('SchemaManager'); 
			$nuMessage = $schema_manager->deleteSchema($schema__schecodigon);  
			WebRequest::setProperty('cod_message', $nuMessage);
			return "success";         
		}else{
			WebRequest::setProperty('cod_message',$nuMessage = 0); 
			return "fail";
		}
	}
}
?>