<?php
/*
  // you can define the commando extending the WebCommand
  
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";

Class FeCuCmdCancelShowListPaciente {

	function execute() {

		$_REQUEST["paciente__paciindentis"] = WebSession :: getProperty("paciente__paciindentis");
		$_REQUEST["paciente__tiidcodigos"] = WebSession::getProperty("paciente__tiidcodigos");
		$_REQUEST["paciente__paciprinoms"] = WebSession :: getProperty("paciente__paciprinoms");
		$_REQUEST["paciente__pacisegnoms"] = WebSession :: getProperty("paciente__pacisegnoms");
		$_REQUEST["paciente__pacipriapes"] = WebSession :: getProperty("paciente__pacipriapes");
		$_REQUEST["paciente__pacisegapes"] = WebSession :: getProperty("paciente__pacisegapes");
		$_REQUEST["paciente__paciemail"] = WebSession :: getProperty("paciente__paciemail");
		$_REQUEST["paciente__locacodigos"] = WebSession :: getProperty("paciente__locacodigos");
		$_REQUEST["paciente_locacodigos_desc"] = WebSession :: getProperty("paciente_locacodigos_desc");
		$_REQUEST["paciente__pacidirecios"] = WebSession :: getProperty("paciente__pacidirecios");
		$_REQUEST["paciente__pacitelefons"] = WebSession :: getProperty("paciente__pacitelefons");
		$_REQUEST["paciente__paciobservs"] = WebSession :: getProperty("paciente__paciobservs");
		$_REQUEST["paciente__pacihisclis"] = WebSession :: getProperty("paciente__pacihisclis");
		$_REQUEST["paciente__sexocodigos"] = WebSession :: getProperty("paciente__sexocodigos");
		$_REQUEST["paciente__pacifecnacis"] = WebSession :: getProperty("paciente__pacifecnacis");
		$_REQUEST["paciente__pacinumcels"] = WebSession :: getProperty("paciente__pacinumcels");

		WebSession :: unsetProperty("paciente__paciindentis");
		WebSession::unsetProperty("paciente__tiidcodigos");
		WebSession :: unsetProperty("paciente__paciprinoms");
		WebSession :: unsetProperty("paciente__pacisegnoms");
		WebSession :: unsetProperty("paciente__pacipriapes");
		WebSession :: unsetProperty("paciente__pacisegapes");
		WebSession :: unsetProperty("paciente__paciemail");
		WebSession :: unsetProperty("paciente__locacodigos");
		WebSession :: unsetProperty("paciente_locacodigos_desc");
		WebSession :: unsetProperty("paciente__pacidirecios");
		WebSession :: unsetProperty("paciente__pacitelefons");
		WebSession :: unsetProperty("paciente__paciobservs");
		WebSession :: unsetProperty("paciente__pacihisclis");
		WebSession :: unsetProperty("paciente__sexocodigos");
		WebSession :: unsetProperty("paciente__pacifecnacis");
		WebSession :: unsetProperty("paciente__pacinumcels");

		return "success";
	}
}
?>