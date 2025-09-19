<?php
/*
// you can define the commando extending the WebCommand
require_once "Web/WebCommand.php";
class DefaultCommand extends WebCommand {
}
// really... is not neccesary extend the WebCommand
*/
require_once "Web/WebRequest.class.php";
class FeCrCmdShowListOrden {
	function execute() {
		settype($serviceDate, "object");
		settype($objService, "object");
		extract($_REQUEST);		
		
		$objService = Application :: loadServices("Data_type");
		if ($orden__ordeobservs)
			$_REQUEST["orden__ordeobservs"] = $objService->formatString($orden__ordeobservs);
		if ($orden__ordesitiejes)
			$_REQUEST["orden__ordesitiejes"] = $objService->formatString($orden__ordesitiejes);

		if (!WebSession :: issetProperty("orden__ordenumeros"))
			WebSession :: setProperty("orden__ordenumeros", $orden__ordenumeros);
		if (!WebSession :: issetProperty("orden__ordesitiejes"))
			WebSession :: setProperty("orden__ordesitiejes", $orden__ordesitiejes);
			
		if (!WebSession :: issetProperty("orden_ordesitiejes_desc"))
			WebSession :: setProperty("orden_ordesitiejes_desc", $orden_ordesitiejes_desc);
			
		if (!WebSession :: issetProperty("orden__ordeobservs"))
			WebSession :: setProperty("orden__ordeobservs", $orden__ordeobservs);
		if (!WebSession :: issetProperty("ordenempresa__contidentis"))
			WebSession :: setProperty("ordenempresa__contidentis", $ordenempresa__contidentis);
		if (!WebSession :: issetProperty("contidentis_desc"))
			WebSession :: setProperty("contidentis_desc", $contidentis_desc);
		if (!WebSession :: issetProperty("ordenempresa__priocodigos"))
			WebSession :: setProperty("ordenempresa__priocodigos", $ordenempresa__priocodigos);
		if (!WebSession :: issetProperty("ordenempresa__tiorcodigos"))
			WebSession :: setProperty("ordenempresa__tiorcodigos", $ordenempresa__tiorcodigos);
		if (!WebSession :: issetProperty("ordenempresa__evencodigos"))
			WebSession :: setProperty("ordenempresa__evencodigos", $ordenempresa__evencodigos);
		if (!WebSession :: issetProperty("ordenempresa__causcodigos"))
			WebSession :: setProperty("ordenempresa__causcodigos", $ordenempresa__causcodigos);
		if (!WebSession :: issetProperty("ordenempresa__orgacodigos"))
			WebSession :: setProperty("ordenempresa__orgacodigos", $ordenempresa__orgacodigos);
		if (!WebSession :: issetProperty("orgacodigos_desc"))
			WebSession :: setProperty("orgacodigos_desc", $orgacodigos_desc);
		if (!WebSession :: issetProperty("ordenempresa__merecodigos"))
			WebSession :: setProperty("ordenempresa__merecodigos", $ordenempresa__merecodigos);
		if (!WebSession :: issetProperty("ordenempresa__locacodigos"))
			WebSession :: setProperty("ordenempresa__locacodigos", $ordenempresa__locacodigos);
		if (!WebSession :: issetProperty("ordenempresa_locacodigos_desc"))
			WebSession :: setProperty("ordenempresa_locacodigos_desc", $ordenempresa_locacodigos_desc);
		if (!WebSession :: issetProperty("orden__ordefecregd"))
			WebSession :: setProperty("orden__ordefecregd", $orden__ordefecregd);

		$serviceDate = Application :: loadServices("DateController");
		if ($orden__ordefecregd) {
			$_REQUEST["orden__ordefecregd"] = $serviceDate->fncdatehourtoint($orden__ordefecregd);
		}
		if ($orden__ordefecvend) {
			$_REQUEST["orden__ordefecvend"] = $serviceDate->fncdatehourtoint($orden__ordefecvend);
		}
		
		
		if (!WebSession :: issetProperty("ordenempresa__paciindentis"))
			WebSession :: setProperty("ordenempresa__paciindentis", $ordenempresa__paciindentis);
		if (!WebSession :: issetProperty("ordenempresa__contidentis_p"))
			WebSession :: setProperty("ordenempresa__contidentis_p", $ordenempresa__contidentis_p);
		if (!WebSession :: issetProperty("contidentis_desc_p"))
			WebSession :: setProperty("contidentis_desc_p", $contidentis_desc_p);
		if (!WebSession :: issetProperty("customer_type"))
			WebSession :: setProperty("customer_type", $customer_type);
			
		return "success";
	}
}
?>