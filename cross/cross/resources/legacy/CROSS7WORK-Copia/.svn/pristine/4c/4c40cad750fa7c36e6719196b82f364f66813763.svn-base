<?php 
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeStCmdCancelShowListMovimialmace {
	function execute() {
		$_REQUEST["movimialmace__moalcodigos"] = WebSession :: getProperty("movimialmace__moalcodigos");
		$_REQUEST["movimialmace__bodecodigos"] = WebSession :: getProperty("movimialmace__bodecodigos");
		$_REQUEST["movimialmace__recucodigos"] = WebSession :: getProperty("movimialmace__recucodigos");
		$_REQUEST["movimialmace__moalfechmovd"] = WebSession :: getProperty("movimialmace__moalfechmovd");
		$_REQUEST["movimialmace__comocodigos"] = WebSession :: getProperty("movimialmace__comocodigos");
		$_REQUEST["movimialmace__moalcantrecf"] = WebSession :: getProperty("movimialmace__moalcantrecf");
		$_REQUEST["movimialmace__perscodigos"] = WebSession :: getProperty("movimialmace__perscodigos");
		$_REQUEST["movimialmace__tidocodigos"] = WebSession :: getProperty("movimialmace__tidocodigos");
		$_REQUEST["movimialmace__moalnumedocs"] = WebSession :: getProperty("movimialmace__moalnumedocs");
		$_REQUEST["movimialmace__moalsignos"] = WebSession :: getProperty("movimialmace__moalsignos");
		WebSession :: unsetProperty("movimialmace__moalcodigos");
		WebSession :: unsetProperty("movimialmace__bodecodigos");
		WebSession :: unsetProperty("movimialmace__recucodigos");
		WebSession :: unsetProperty("movimialmace__moalfechmovd");
		WebSession :: unsetProperty("movimialmace__comocodigos");
		WebSession :: unsetProperty("movimialmace__moalcantrecf");
		WebSession :: unsetProperty("movimialmace__perscodigos");
		WebSession :: unsetProperty("movimialmace__tidocodigos");
		WebSession :: unsetProperty("movimialmace__moalnumedocs");
		WebSession :: unsetProperty("movimialmace__moalsignos");
		WebRequest :: setProperty('cleanSession', $cleanSession = "NO");
		return "success";
	}
}
?>	
