<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdCancelShowListOrganizacion {
	function execute() {
		$_REQUEST["organizacion__orgacodigos"] = WebSession :: getProperty("organizacion__orgacodigos");
		$_REQUEST["organizacion__organombres"] = WebSession :: getProperty("organizacion__organombres");
		$_REQUEST["organizacion__tiorcodigos"] = WebSession :: getProperty("organizacion__tiorcodigos");
		$_REQUEST["organizacion__orgacgpads"] = WebSession :: getProperty("organizacion__orgacgpads");
		$_REQUEST["organizacion__orgaordenn"] = WebSession :: getProperty("organizacion__orgaordenn");
		$_REQUEST["organizacion__orgafechcred"] = WebSession :: getProperty("organizacion__orgafechcred");
		$_REQUEST["organizacion__esorcodigos"] = WebSession :: getProperty("organizacion__esorcodigos");
		$_REQUEST["organizacion__grupcodigos"] = WebSession :: getProperty("organizacion__grupcodigos");
		$_REQUEST["organizacion__orgatelefo1s"] = WebSession :: getProperty("organizacion__orgatelefo1s");
		$_REQUEST["organizacion__orgatelefo2s"] = WebSession :: getProperty("organizacion__orgatelefo2s");
		$_REQUEST["organizacion__locacodigos"] = WebSession :: getProperty("organizacion__locacodigos");
		$_REQUEST["organizacion_locacodigos_desc"] = WebSession :: getProperty("organizacion_locacodigos_desc");
		WebSession :: unsetProperty("organizacion__orgacodigos");
		WebSession :: unsetProperty("organizacion__organombres");
		WebSession :: unsetProperty("organizacion__tiorcodigos");
		WebSession :: unsetProperty("organizacion__orgacgpads");
		WebSession :: unsetProperty("organizacion__orgaordenn");
		WebSession :: unsetProperty("organizacion__orgafechcred");
		WebSession :: unsetProperty("organizacion__esorcodigos");
		WebSession :: unsetProperty("organizacion__grupcodigos");
		WebSession :: unsetProperty("organizacion__orgatelefo1s");
		WebSession :: unsetProperty("organizacion__orgatelefo2s");
		WebSession :: unsetProperty("organizacion__locacodigos");
		WebSession :: unsetProperty("organizacion_locacodigos_desc");
		return "success";
	}
}
?>