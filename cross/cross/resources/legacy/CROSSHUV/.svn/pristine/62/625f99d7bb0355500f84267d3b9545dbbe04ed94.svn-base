<?php     
/**
*	Propiedad Intelectual de FullEngine
*	
* Pinta un select con los entes organizacionales a los cuales les puedo puedo
* transferir tareas, se toma en cuenta a el usuario logueado enel sistema
*	@author freina<freina@parquesoft.com>
*	@date 29-Jun-2005 11:41:00
*	@location Cali-Colombia
*/
function smarty_function_select_transference($params, & $smarty) {

	extract($params);

	settype($objService, "object");
	settype($objManager, "object");
	settype($workFlowService, "object");
	settype($rcUser, "array");
	settype($rcTmp, "array");
	settype($rcLista, "array");
	settype($rcValue, "array");
	settype($rcValueP, "array");
	settype($rcEntes, "array");
	settype($rcPersDatos, "array");
	settype($rcEntesPermisos, "array");
	settype($rcPermisos, "array");
	settype($workFlowService, "array");
	settype($sbHtml, "string");
	settype($sbIndex, "string");
	settype($sbNamedesc, "string");
	settype($sbValue, "string");
	settype($sbFlag, "string");

	$sbFlag = false;

	$objService = Application :: loadServices("General");
	$rcTmp = $objService->getParam("human_resources", "acceso_total");

    //Consulta el acta
    $workFlowService = Application::loadServices('Workflow');
    $rcActa = $workFlowService->getByIdActa($_REQUEST['acta']);
	//Obtiene los datos del usuario
	$rcUser = Application :: getUserParam();

	//Obtiene los entes organizacionales en los cuales el usuario es responsable
	$objService = Application :: loadServices("Human_resources");
	$rcPersDatos = $objService->getPersDatos($rcUser["username"], true);
	$rcEntes = $objService->getActiveBeingEmployee($rcPersDatos["perscodigos"]);

	//se valida si el usuario puede ver todos los entes
	if ($rcTmp && $rcEntes) {
		foreach ($rcEntes as $rcValue) {
			if (in_array($rcValue["orgacodigos"], $rcTmp)) {
				$sbFlag = true;
			}
		}
	} else {
		$sbFlag = false;
	}

	if ($sbFlag) {

		$sbNamedesc = $id."_desc";
		$sbHtml = "<input name='".$name."' type='text' id='".$id."' value=\"".$_REQUEST[$name]."\" onBlur=\"if(this.value)autoReference('organizacion','orgacodigos',Array(this),this.form.".$sbNamedesc.")\">";
		$sbHtml .= "<a href='#' onClick=\"javascript:fncopenwindows('FeCrCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=".$name."&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.".$form.".".$name.".value);\"><img src='web/images/menu.gif' border='0' align='middle'></img></a>";
		$sbHtml .= "<input name='".$sbNamedesc."' type='text' size='35' value=\"".$_REQUEST[$sbNamedesc]."\">";
	} else {
		//Descarga de la sesion la lista deplegable
		$rcLista = WebSession :: getProperty("rcListaTransfer");
        
		if (!$rcLista) {
			
			//si el usuario tiene dependencias a cargo
			if(is_array($rcEntes) && $rcEntes){
				
				$rcTmp = array();
				
				//se carga las dependecias configuradas para transferencia de trabajo caso 0000932012
				$objService = Application :: loadServices("General");
				$objManager = $objService->InitiateClass("TransferdependenciesManager");
				$rcEntesPermisos = $objManager->getTransferdependencies();
				$objService->close();
				if(is_array($rcEntesPermisos) && $rcEntesPermisos){
					foreach ($rcEntes as $rcValue){
						foreach ($rcEntesPermisos as $sbIndex=>$rcValueP) {
							if(($sbIndex == $rcValue["orgacodigos"])){
								if(is_array($rcValueP) && $rcValueP){
									if(is_array($rcPermisos) & $rcPermisos){
										$rcPermisos = array_merge($rcPermisos,$rcValueP);
									}else{
										$rcPermisos = $rcValueP;
									}
								}
								break;
							}
						}
					}
				}
			}
			
			if(is_array($rcPermisos) && $rcPermisos){
				
				$rcPermisos = array_unique($rcPermisos);
				$rcPermisos =  array_values($rcPermisos);
				
                //Carga el servicio de human_resources
                $objService = Application :: loadServices("Human_resources");
                $rcLista = $objService->getEntesByIdInArray($rcPermisos);
            }

			if (!is_array($rcLista))
				return null;

			//Pone la lista en sesion para evitar posteriores consultas
			WebSession :: setProperty("rcListaTransfer", $rcLista);
		}
		if (isset ($command_default)) {
			$reload = "onchange=\"action.value = '".$command_default."';submit();\"";
		}
        
		//Pinta la lista desplegable
		$sbHtml = "<select name='$name' size='$size' id=\"$id\" $reload>\n";
		if ($is_null == "true") {
			$sbHtml .= "<option value=''>---</option>\n";
		}

		//PInta las opciones
		foreach ($rcLista as $sbIndex => $sbValue) {
            if($rcActa[0]['orgacodigos'] != $sbIndex){
                $sbHtml .= "<option value='$sbIndex'";
                if ($_REQUEST[$name]) {
                    if ($_REQUEST[$name] == $sbIndex) {
                        $sbHtml .= " selected";
                    }
                }
                $sbHtml .= ">$sbValue</option>\n ";
            }
		}
		$sbHtml .= "</select>\n";
	}

	print $sbHtml;
}
?>