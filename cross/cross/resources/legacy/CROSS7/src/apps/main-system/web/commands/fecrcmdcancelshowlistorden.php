<?php
/*
  // you can define the commando extending the WebCommand
  require_once "Web/WebCommand.php";
  class DefaultCommand extends WebCommand {
  }
  // really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdCancelShowListOrden {

	function execute() {
		$_REQUEST["orden__ordenumeros"] = WebSession :: getProperty("orden__ordenumeros");
		$_REQUEST["orden__ordesitiejes"] = WebSession :: getProperty("orden__ordesitiejes");
		$_REQUEST["orden__ordeobservs"] = WebSession :: getProperty("orden__ordeobservs");
		$_REQUEST["orden__ordefecregd"] = WebSession :: getProperty("orden__ordefecregd");
		$_REQUEST["orden__ordefecvend"] = WebSession :: getProperty("orden__ordefecvend");

		$_REQUEST["ordenempresa__contidentis"] = WebSession :: getProperty("ordenempresa__contidentis");
		$_REQUEST["contidentis_desc"] = WebSession :: getProperty("contidentis_desc");

		$_REQUEST["ordenempresa__priocodigos"] = WebSession :: getProperty("ordenempresa__priocodigos");
		$_REQUEST["ordenempresa__tiorcodigos"] = WebSession :: getProperty("ordenempresa__tiorcodigos");
		$_REQUEST["ordenempresa__evencodigos"] = WebSession :: getProperty("ordenempresa__evencodigos");
		$_REQUEST["ordenempresa__causcodigos"] = WebSession :: getProperty("ordenempresa__causcodigos");
		$_REQUEST["ordenempresa__orgacodigos"] = WebSession :: getProperty("ordenempresa__orgacodigos");
		$_REQUEST["ordenempresa__merecodigos"] = WebSession :: getProperty("ordenempresa__merecodigos");
		$_REQUEST["ordenempresa__locacodigos"] = WebSession :: getProperty("ordenempresa__locacodigos");
		$_REQUEST["ordenempresa_locacodigos_desc"] = WebSession :: getProperty("ordenempresa_locacodigos_desc");
		$_REQUEST["orden__ordefecregd"] = WebSession :: getProperty("orden__ordefecregd");
		$_REQUEST["orgacodigos_desc"] = WebSession :: getProperty("orgacodigos_desc");
		
		$_REQUEST["orden_ordesitiejes_desc"] = WebSession :: getProperty("orden_ordesitiejes_desc");
		$_REQUEST["ordenempresa__paciindentis"] = WebSession :: getProperty("ordenempresa__paciindentis");
		$_REQUEST["paciindentis_desc"] = WebSession :: getProperty("paciindentis_desc");
		$_REQUEST["ordenempresa__sesocodigos"] = WebSession :: getProperty("ordenempresa__sesocodigos");
		$_REQUEST["ordenempresa__couscodigos"] = WebSession :: getProperty("ordenempresa__couscodigos");
		$_REQUEST["ordenempresa__ipsecodigos"] = WebSession :: getProperty("ordenempresa__ipsecodigos");
		$_REQUEST["ordenempresa__contidentis_p"] = WebSession :: getProperty("ordenempresa__contidentis_p");
		$_REQUEST["contidentis_desc_p"] = WebSession :: getProperty("contidentis_desc_p");
		$_REQUEST["customer_type"] = WebSession :: getProperty("customer_type");				

		WebSession :: unsetProperty("orden__ordenumeros");
		WebSession :: unsetProperty("orden__ordesitiejes");
		WebSession :: unsetProperty("orden__ordeobservs");
		WebSession :: unsetProperty("orden__ordefecregd");
		WebSession :: unsetProperty("orden__ordefecvend");

		WebSession :: unsetProperty("ordenempresa__contidentis");
		WebSession :: unsetProperty("contidentis_desc");

		WebSession :: unsetProperty("ordenempresa__priocodigos");
		WebSession :: unsetProperty("ordenempresa__tiorcodigos");
		WebSession :: unsetProperty("ordenempresa__evencodigos");
		WebSession :: unsetProperty("ordenempresa__causcodigos");
		WebSession :: unsetProperty("ordenempresa__orgacodigos");
		WebSession :: unsetProperty("orgacodigos_desc");
		WebSession :: unsetProperty("ordenempresa__merecodigos");
		WebSession :: unsetProperty("ordenempresa__locacodigos");
		WebSession :: unsetProperty("ordenempresa_locacodigos_desc");
		WebSession :: unsetProperty("orden__ordefecregd");
		
		WebSession :: unsetProperty("orden_ordesitiejes_desc");
		WebSession :: unsetProperty("ordenempresa__paciindentis");
		WebSession :: unsetProperty("paciindentis_desc");
		WebSession :: unsetProperty("ordenempresa__sesocodigos");
		WebSession :: unsetProperty("ordenempresa__couscodigos");		
		WebSession :: unsetProperty("ordenempresa__ipsecodigos");
		WebSession :: unsetProperty("ordenempresa__contidentis_p");
		WebSession :: unsetProperty("contidentis_desc_p");
		WebSession :: unsetProperty("customer_type");						

		return "success";
	}
}
?>