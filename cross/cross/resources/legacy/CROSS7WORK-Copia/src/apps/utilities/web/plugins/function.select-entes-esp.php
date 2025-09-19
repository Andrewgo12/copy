<?php     
/**
*	Propiedad Intelectual de FullEngine
*	
*	Pinta un select row con los entes organizaciones asigandos a una persona y todos los entes 
*	subordinados, el personal se determina desde la sesion.
*	
*	@author freina<freina@fullengine.com>
*	@date 29-Sep-2015 10:59:00
*	@location Cali-Colombia
*/
function smarty_function_select_entes_esp($params, & $smarty) {

	extract($params);

	settype($objService, "object");
	settype($rcUser, "array");
	settype($rcTmp, "array");
	//settype($rcLista, "array");
	settype($rcValue, "array");
	settype($rcEntes, "array");
	settype($rcPersDatos, "array");
	settype($sbHtml, "string");
	//settype($sbIndex, "string");
	settype($sbNamedesc, "string");
	//settype($sbValue, "string");
	settype($sbFlag, "string");
	//settype($nuCont, "integer");
	
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
    if(!is_array($rcEntes)){
    	return null;
    }
        
	//se valida si el usuario puede ver todos los entes
	if(is_array($rcTmp) && $rcTmp){
		foreach($rcEntes as $rcValue){
			if(in_array($rcValue["orgacodigos"],$rcTmp)){
				$sbFlag=true;
			}
		}
	}else{
		$sbFlag=false;
	}
	
	$sbNamedesc = $id."_desc";
	
	if ($sbFlag) {
		
		$sbHtml .="<input name='".$name."' type='text' id='".$id."' value=\"".$_REQUEST[$name]."\" onBlur=\"if(this.value!='')autoReference('organizacion','orgacodigos',Array(this),document.$form.".$sbNamedesc.");else document.$form.".$sbNamedesc.".value='';\">";
	    $sbHtml .="<a href='#' onClick=\"javascript:fncopenwindows('FeGeCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=".$name."&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.".$form.".".$name.".value+'&".$sbNamedesc."='+document.$form.".$sbNamedesc.".value);\"><img src='web/images/menu.gif' border='0' align='middle'></img></a>";
        $sbHtml .="<input name='".$sbNamedesc."' type='text' size='35' value=\"".$_REQUEST[$sbNamedesc]."\">";
	} else {
		$sbHtml .="<input name='".$name."' type='text' readonly id='".$id."' value=\"".$_REQUEST[$name]."\" onBlur=\"if(this.value!='')autoReference('organizacion','orgacodigos',Array(this),document.$form.".$sbNamedesc.");else document.$form.".$sbNamedesc.".value='';\">";
	    $sbHtml .="<a href='#' onClick=\"javascript:fncopenwindows('FeGeCmdTreeHelpEsp','table=organizacion&sqlid=organizacion&return_obj=".$name."&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.".$form.".".$name.".value+'&".$sbNamedesc."='+document.$form.".$sbNamedesc.".value);\"><img src='web/images/menu.gif' border='0' align='middle'></img></a>";
        $sbHtml .="<input name='".$sbNamedesc."' type='text' readonly size='35' value=\"".$_REQUEST[$sbNamedesc]."\">";
	}
	print $sbHtml;
}
?>