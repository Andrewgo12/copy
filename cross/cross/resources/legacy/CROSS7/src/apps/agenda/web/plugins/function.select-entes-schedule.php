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
function smarty_function_select_entes_schedule($params, & $smarty) 
{
	extract($_REQUEST);
	extract($params);
	
	settype($sbHtml,"string");
	$rcUser = Application::getUserParam();
	
	//Veamos quién está logueado
	$objService = Application :: loadServices("Human_resources");
	$sbUserName = $rcUser["username"];
	$rcPersonal = $objService->getPersDatos($sbUserName,true);
	
	$rcAllPersonal = $objService->getAllActivePersonal(false);
	$rcGroupLeaders = $objService->getGroupLeaders();
	if(!is_array($rcPersonal))
		return null;
		
	$perscodigos = $rcPersonal["perscodigos"];
	$orgacodigos = $objService->getOrgacodigosByPersonal($perscodigos);
	$rcOrga = $objService->rcDataOrg;
	$objService->close();
	if(!is_array($rcOrga))
		return null;
		
	$Schedule = Application::getDomainController("ScheduleManager");
	$rcTiorcodigos = $Schedule->getTiorcodigosSelectEntes($rcOrga);
	$rcEntes = getEntes($rcAllPersonal,$rcGroupLeaders,$rcTiorcodigos);
	if(!is_array($rcEntes))
		return null;
	$nuSizeEntes = sizeof($rcEntes);
	
	$sbHtml = '';
	$sbHtml .= "<select name='".$name."[]' id='".$id."' multiple>";
	$sbHtml .= "<option value=''>---</optional>";

	for ($nuCont = 0; $nuCont < $nuSizeEntes; $nuCont ++) {
		$sbHtml .= "<option value='";
		$sbHtml .= $rcEntes[$nuCont]["perscodigos"];
		if (is_array($_REQUEST[$name]) && in_array($rcEntes[$nuCont]["perscodigos"],$_REQUEST[$name]))
			$sbHtml .= "' selected>";
		else
			$sbHtml .= "'>";
		$sbHtml .= $rcEntes[$nuCont]["persnombres"]." ".$rcEntes[$nuCont]["persapell1s"]." ".$rcEntes[$nuCont]["persapell2s"]." - ".$rcEntes[$nuCont]["persusrnams"];
		$sbHtml .= "</option>";
	}
	$sbHtml .= "</select>";

	$objdate = Application::loadServices("DateController");
	$now = $objdate->fncintdate();
	
	$sbHtml .= "<a href='javascript:Availability(".$now.",\"".$name."[]\",\"perscodigos\");'><img border=0 src='web/images/calendar.gif'></a>";
	return $sbHtml;
}

function getEntes($rcPersonal,$rcGroupLeaders,$rcTiorcodigos)
{
	settype($rcResult,"array");
	settype($rcAssigned,"array");
	if(!is_array($rcPersonal))
		return false;
	if(!is_array($rcGroupLeaders))
		return false;
		
	//Démole otro formato al personal para poder recorrerlo más abajo	
	$rcPersonal = getOrderPersonal($rcPersonal);
	
	foreach ($rcGroupLeaders as $orgacodigos=>$rcAtt)
		if (array_key_exists($rcAtt["perscodigos"],$rcPersonal))
			if(array_key_exists($rcAtt["tiorcodigos"],$rcTiorcodigos))
				if(!in_array($rcAtt["perscodigos"],$rcAssigned))
				{
					$rcResult[] = $rcPersonal[$rcAtt["perscodigos"]];
					$rcAssigned[] = $rcAtt["perscodigos"];
				}
	return $rcResult;
}

function getOrderPersonal($rcPersonal)
{
	settype($rcResult,"array");
	foreach ($rcPersonal as $rcRow)
		$rcResult[$rcRow["perscodigos"]] = $rcRow;
	return $rcResult;
}
?>