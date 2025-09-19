<?php  
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeHrCmdShowByIdOrganizacion {
	function execute() {
		
		settype($serviceDate,"object");
		settype($objService,"object");
    	settype($rcTmp,"array");
		extract($_REQUEST);
		if (($organizacion__orgacodigos != NULL) && ($organizacion__orgacodigos != "")) {
			$organizacion_manager = Application :: getDomainController('OrganizacionManager');
			$organizacion_data = $organizacion_manager->getByIdOrganizacion($organizacion__orgacodigos);
            $generalService = Application::loadServices('General');
            $rcInactive = $generalService->getParam('human_resources','ORG_INACT');
            //Consulta el padre
            if($organizacion_data[0]["orgacgpads"] && in_array($organizacion_data[0]["esorcodigos"],$rcInactive)){
                $organizacion_padre = $organizacion_manager->getByIdOrganizacion($organizacion_data[0]["orgacgpads"]);
                if(in_array($organizacion_padre[0]["esorcodigos"],$rcInactive)){
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
                    $this->unsetSession();
                    WebRequest::setProperty('cod_message', $message=18);
                    WebRequest::setProperty('extra', $extra = array("VAR1" => $organizacion_padre[0]["organombres"]));
                    return "success";
                }
            }
			$_REQUEST["organizacion__orgacodigos"] = $organizacion_data[0]["orgacodigos"];
			$_REQUEST["organizacion__organombres"] = $organizacion_data[0]["organombres"];
			$_REQUEST["organizacion__tiorcodigos"] = $organizacion_data[0]["tiorcodigos"];
			$_REQUEST["organizacion__orgacgpads"] = $organizacion_data[0]["orgacgpads"];
			$_REQUEST["organizacion__orgaordenn"] = $organizacion_data[0]["orgaordenn"];
			if($organizacion_data[0]["orgafechcred"]){
				$serviceDate = Application :: loadServices("DateController");
				$_REQUEST["organizacion__orgafechcred"] = $serviceDate->fncformatofechahora($organizacion_data[0]["orgafechcred"]);
			}
			$_REQUEST["organizacion__esorcodigos"] = $organizacion_data[0]["esorcodigos"];
			$_REQUEST["organizacion__grupcodigos"] = $organizacion_data[0]["grupcodigos"];
			$_REQUEST["organizacion__orgatelefo1s"] = $organizacion_data[0]["orgatelefo1s"];
			$_REQUEST["organizacion__orgatelefo2s"] = $organizacion_data[0]["orgatelefo2s"];
			if($organizacion_data[0]["locacodigos"]){
           		$objService = Application :: loadServices("General");
           		$_REQUEST["organizacion__locacodigos"] = $organizacion_data[0]["locacodigos"];
           		$rcTmp = $objService->getByIdLocalizacion($_REQUEST["organizacion__locacodigos"]);
           		$_REQUEST["organizacion_locacodigos_desc"] = $rcTmp[0]["locanombres"];
           }
		} else {
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
		}
        $this->unsetSession();
		return "success";
	}
    function unsetSession(){
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
    }
}
?>