<?php     
/**
*	Propiedad Intelectual de FullEngine
*	
*	Pinta un select row con los entes organizaciones asigandos a una persona y todos los entes 
*	subordinados, el personal se determina desde la sesion.
*	
*	@author creyes <cesar.reyes@parquesoft.com>
*	@date 24-ago-2004 16:54:48
*	@location Cali-Colombia
*/
function smarty_function_select_entes($params, & $smarty) {

	extract($params);

	settype($objService, "object");
	settype($rcUser, "array");
	settype($rcTmp, "array");
	settype($rcLista, "array");
	settype($rcValue, "array");
	settype($rcEntes, "array");
	settype($rcPersDatos, "array");
	settype($sbHtml, "string");
	settype($sbIndex, "string");
	settype($sbNamedesc, "string");
	settype($sbValue, "string");
	settype($sbFlag, "string");
	settype($nuCont, "integer");
	
	$sbFlag = false;
	
	$objService = Application :: loadServices("General");
	$rcTmp = $objService->getParam("human_resources", "acceso_total");
	
	//Obtiene los datos del usuario
	$rcUser = Application :: getUserParam();
	
	//Obtiene los entes organizacionales en los cuales el usuario es responsable
	$objService = Application :: loadServices("Human_resources");
	$rcPersDatos = $objService->getPersDatos($rcUser["username"], true);
	$rcEntes = $objService->getActiveBeingEmployee($rcPersDatos["perscodigos"]);
	
    //Si el usuario no tiene personal
    if(!is_array($rcEntes))
        return null;
	//se valida si el usuario puede ver todos los entes
	if($rcTmp){
		foreach($rcEntes as $rcValue){
			if(in_array($rcValue["orgacodigos"],$rcTmp)){
				$sbFlag=true;
			}
		}
	}else{
		$sbFlag=false;
	}
	
	if ($sbFlag) {
		
		$sbNamedesc = $id."_desc";
		$sbHtml .="<input name='".$name."' type='text' id='".$id."' value=\"".$_REQUEST[$name]."\" onBlur=\"if(this.value!='')autoReference('organizacion','orgacodigos',Array(this),document.$form.".$sbNamedesc.");else document.$form.".$sbNamedesc.".value='';\">";
	    $sbHtml .="<a href='#' onClick=\"javascript:fncopenwindows('FeScCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=".$name."&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.".$form.".".$name.".value+'&".$sbNamedesc."='+document.$form.".$sbNamedesc.".value);\"><img src='web/images/menu.gif' border='0' align='middle'></img></a>";
        $sbHtml .="<input name='".$sbNamedesc."' type='text' size='35' value=\"".$_REQUEST[$sbNamedesc]."\">";
	} else {
		//Descarga de la sesion la lista deplegable
		$rcLista = WebSession :: getProperty("rcLista");

		if (!$rcLista) {
			//Carga el servicio de human_resources
			$objService = Application :: loadServices("Human_resources");
			
			//Obtiene los entes organizacionales en los cuales el usuario es responsable y los hijos
			$rcLista = $objService->getActiveBeingSonEmployee($rcPersDatos["perscodigos"]);

            //Determina los permisos de acceso a otros entes organizacionales
            $objService = Application :: loadServices("General");
            $rcEntesPermisos = $objService->getParam("human_resources", "permisos_entes");
            $rcPermisosTmp = $rcEntesPermisos[$rcUser["username"]];
            
            //Filtra los permisos para evitar duplicados
            if(is_array($rcPermisosTmp)){
                foreach($rcPermisosTmp as $enteOrg){
                    $sbTmp = $rcLista[$enteOrg];
                    if(!$sbTmp)
                        $rcPermisos[] = $enteOrg;
                }
            }
            if(is_array($rcPermisos))
            {
                //Carga el servicio de human_resources
                $objService = Application :: loadServices("Human_resources");
                $rcTmpLista = $objService->getEntesByIdInArray($rcPermisos);
            }
            if(is_array($rcTmpLista))
                $rcLista = $rcLista + $rcTmpLista;

			if (!is_array($rcLista))
				return null;

			//Pone la lista en sesion para evitar posteriores consultas
			WebSession :: setProperty("rcLista", $rcLista);
		}
		if (isset ($command_default)) {
			$reload = "onchange=\"action.value = '".$command_default."';submit();\"";
		}

		//Pinta la lista desplegable
		$sbHtml = "<select name='$name' size='$size' id=\"$id\" $reload>\n";
		
		//PInta las opciones
		foreach ($rcLista as $sbIndex => $sbValue) {
			$sbHtml .= "<option value='$sbIndex'";
            if ($_REQUEST[$name]) {
            	if ($_REQUEST[$name] == $sbIndex) {
            		$sbHtml .= " selected";
                }
            }
			$sbHtml .= ">$sbValue</option>\n ";
			$nuCont ++;
		}
		$sbHtml .= "</select>\n";
	}
	print $sbHtml;
}
?>