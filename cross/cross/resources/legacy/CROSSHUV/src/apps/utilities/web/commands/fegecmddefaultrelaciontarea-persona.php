<?php
/*
 // you can define the commando extending the WebCommand

 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */

require_once "Web/WebRequest.class.php";

Class FeGeCmdDefaultRelacionTarea_Persona {

	function execute(){
		extract($_REQUEST);
		//SI limpia el $_REQUEST
		if($clean_table){
			unset($_REQUEST["clean_table"]);
		}
		if(isset($_REQUEST["relatarepers__orgacodigos"])){
			unset($_REQUEST["relatarepers__orgacodigos"]);
		}
		if(isset($_REQUEST["orgacodigos_desc"])){
			unset($_REQUEST["orgacodigos_desc"]);
		}
		if(WebSession :: issetProperty("_rcRelacionTarea_Persona")){
			WebSession :: unsetProperty("_rcRelacionTarea_Persona");	
		}
		
		return "success";
	}
}
?>