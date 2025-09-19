<?php
/*
 // you can define the commando extending the WebCommand
 require_once "Web/WebCommand.php";
 class DefaultCommand extends WebCommand {
 }
 // really... is not neccesary extend the WebCommand
 */
require_once "Web/WebRequest.class.php";
class FeCrCmdShowByIdOrden {
	function execute() {
		settype($objManager,"object");
		settype($objManagerE,"object");
		settype($objDate, "object");
		settype($objService, "object");
		settype($rcData,"array");
		settype($rcDataE,"array");
		settype($rcTmp, "array");
		settype($rcOrganizacion, "array");
		extract($_REQUEST);
		//Carga el servicio de control de fechas

		$objDate = Application :: loadServices("DateController");
		if (($orden__ordenumeros != NULL) && ($orden__ordenumeros != "")) {
			
			$_REQUEST["customer_type"] = 0;
			$objManager = Application :: getDomainController('OrdenManager');
			$objManagerE = Application :: getDomainController('OrdenempresaManager');
			$rcData = $objManager->getByIdOrden($orden__ordenumeros);
			$rcDataE = $objManagerE->getByIdOrdenempresa($orden__ordenumeros);

			$_REQUEST["orden__ordenumeros"] = $rcData[0]["ordenumeros"];
			$_REQUEST["ordenumeros_load"] = $rcData[0]["ordenumeros"];
			
			if($rcData[0]["ordesitiejes"]){
				$objService = Application :: loadServices("Human_resources");
				$rcOrganizacion = $objService->getByIdEntesOrg($rcData[0]["ordesitiejes"]);
				if(is_array($rcOrganizacion) && $rcOrganizacion ){
					$_REQUEST["orden__ordesitiejes"] = $rcData[0]["ordesitiejes"];
					$_REQUEST["orden_ordesitiejes_desc"] = $rcOrganizacion[0]["organombres"];
				}
			}else{
				$_REQUEST["orden__ordesitiejes"] = $rcData[0]["ordesitiejes"];	
			}
			
			if($rcDataE[0]["paciindentis"]){
				$_REQUEST["ordenempresa__paciindentis"] = $rcDataE[0]["paciindentis"];
				$_REQUEST["paciindentis_desc"] = $rcDataE[0]["pacinombres"];
				$_REQUEST["ordenempresa__sesocodigos"] = $rcDataE[0]["sesocodigos"];
				$_REQUEST["ordenempresa__couscodigos"] = $rcDataE[0]["couscodigos"];
				$_REQUEST["ordenempresa__ipsecodigos"] = $rcDataE[0]["ipsecodigos"];
				$_REQUEST["ordenempresa__contidentis_p"] = $rcDataE[0]["contidentis"];
				$_REQUEST["contidentis_desc_p"] = $rcDataE[0]["contnombre"];
				$_REQUEST["customer_type"] = 1;
			}else{
				if($rcDataE[0]["contidentis"]){
					$_REQUEST["ordenempresa__contidentis"] = $rcDataE[0]["contidentis"];
					$_REQUEST["contidentis_desc"] = $rcDataE[0]["contnombre"];
					$_REQUEST["customer_type"] = 2;
				}
			}
			
			$_REQUEST["orden__ordeobservs"] = $rcData[0]["ordeobservs"];
			$_REQUEST["orden__ordefecregd"] = $objDate->fncformatofechahora($rcData[0]["ordefecregd"]);
			$_REQUEST["orden__ordefecvend"] = $objDate->fncformatofechahora($rcData[0]["ordefecvend"]);
			$_REQUEST["infrcodigos_desc"] = $rcDataE[0]["infrnombres"];

			$_REQUEST["ordenempresa__priocodigos"] = $rcDataE[0]["priocodigos"];
			$_REQUEST["ordenempresa__tiorcodigos"] = $rcDataE[0]["tiorcodigos"];
			$_REQUEST["ordenempresa__evencodigos"] = $rcDataE[0]["evencodigos"];
			$_REQUEST["ordenempresa__causcodigos"] = $rcDataE[0]["causcodigos"];

			$_REQUEST["ordenempresa__oremradicas"] = $rcDataE[0]["oremradicas"];
			$_REQUEST["ordenempresa__infrcodigos"] = $rcDataE[0]["infrcodigos"];

			$_REQUEST["ordenempresa__orgacodigos"] = $rcDataE[0]["orgacodigos"];
			
			if($rcDataE[0]["orgacodigos"]){
				$objService = Application :: loadServices("Human_resources");
				$rcTmp = $objService->getDataEntesOrg($rcDataE[0]["orgacodigos"],true);
				$_REQUEST["orgacodigos_desc"] = $rcTmp["nombre"];	
			}
			
			$_REQUEST["ordenempresa__merecodigos"] = $rcDataE[0]["merecodigos"];

			$objService = Application :: loadServices("General");
			if ($rcDataE[0]["locacodigos"]) {
				$_REQUEST["ordenempresa__locacodigos"] = $rcDataE[0]["locacodigos"];
				$rcTmp = $objService->getByIdLocalizacion($_REQUEST["ordenempresa__locacodigos"]);
				$_REQUEST["ordenempresa_locacodigos_desc"] = $rcTmp[0]["locanombres"];
			}
			else
			$objService->close();
			$_REQUEST["consult"] = 1;
		} else {
			$_REQUEST["orden__ordenumeros"] = WebSession :: getProperty("orden__ordenumeros");
			$_REQUEST["ordenumeros_load"] = WebSession :: getProperty("ordenumeros_load");
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
			$_REQUEST["orgacodigos_desc"] = WebSession :: getProperty("orgacodigos_desc");
			$_REQUEST["ordenempresa__merecodigos"] = WebSession :: getProperty("ordenempresa__merecodigos");
			$_REQUEST["ordenempresa__locacodigos"] = WebSession :: getProperty("ordenempresa__locacodigos");
			$_REQUEST["ordenempresa_locacodigos_desc"] = WebSession :: getProperty("ordenempresa_locacodigos_desc");

			$_REQUEST["ordenempresa__oremradicas"] = WebSession :: getProperty("ordenempresa__oremradicas");
			
			$_REQUEST["ordenempresa__paciindentis"] = WebSession :: getProperty("ordenempresa__paciindentis");
			$_REQUEST["paciindentis_desc"] = WebSession :: getProperty("paciindentis_desc");
			$_REQUEST["ordenempresa__sesocodigos"] = WebSession :: getProperty("ordenempresa__sesocodigos");
			$_REQUEST["ordenempresa__couscodigos"] = WebSession :: getProperty("ordenempresa__couscodigos");
			$_REQUEST["ordenempresa__ipsecodigos"] = WebSession :: getProperty("ordenempresa__ipsecodigos");
			$_REQUEST["ordenempresa__contidentis_p"] = WebSession :: getProperty("ordenempresa__contidentis_p");
			$_REQUEST["contidentis_desc_p"] = WebSession :: getProperty("contidentis_desc_p");
			$_REQUEST["customer_type"] = WebSession :: getProperty("customer_type");
		}
		WebSession :: unsetProperty("orden__ordenumeros");
		WebSession :: unsetProperty("ordenumeros_load");
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

		WebSession :: unsetProperty("ordenempresa__oremradicas");

		WebSession :: unsetProperty("ordenempresa_locacodigos_desc");
		
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