<?php 
/**Copyright 2007 FullEngine
*
* Consulta y visualiza la ficha de requerieminto
* @author mrestrepo <mrestrepo@parquesoft.com>
* @date 09-sep-2004 11:58:26
* @location Cali - Colombia
*/
function smarty_function_viewFichaEvento($params, & $smarty)
{
	extract($_REQUEST);
	
	//DEFINICIÓN DE VARIABLES
	settype($sbHtml,"string");
	settype($rcTipoOrgani,"array");
	settype($dataEntrada,"array");
	settype($dataRefer,"array");
	settype($sbCateg,"string");
	settype($sbTarea,"string");
	settype($entradaExtended,"object");
	settype($entradaGateway,"object");
	settype($organEntrada,"array");
	
	if(!$entrcodigon)
		return null;
		
	$rcUser = Application :: getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".fichaevento.php");
	
	$sbHtml .= '<tr><td><table width="100%" align=center border=1 cellpadding=0 cellspacing=0><tr><td>';
	$sbHtml .= '<table width="100%" border=0>';
	
	//TIPO DE EVENTO
	$entradaExtended = Application::getDataGateway("entradaExtended");
	$sbCateg = $entradaExtended->getCategEntry($entrcodigon);
	$sbHtml .= "<tr><td><B>".$rclabels["catecodigon"]["label"].": </B></td><td>".$sbCateg."</td></tr>";
	
	//CONSULTAMOS Y MOSTRAMOS LA INFO BÁSICA DEL EVENTO
	$entradaGateway = Application::getDataGateway("entrada");
	$dataEntrada = $entradaGateway->getByIdEntrada($entrcodigon);
	$dataEntrada = $dataEntrada[0];
	if(is_array($dataEntrada))
	{
		$objdate = Application::loadServices("DateController");
		$sbHtml .= "<tr><td><B>".$rclabels["entrfechorun"]["label"].": </B></td><td>".$objdate->fncformatofechahora($dataEntrada["entrfechorun"])."</td></tr>";
		$sbHtml .= "<tr><td><B>".$rclabels["entrduracion"]["label"].": </B></td><td>".$objdate->fncformatofechahora($dataEntrada["entrduracion"])."</td></tr>";
		$sbHtml .= "<tr><td><B>".$rclabels["entrdescris"]["label"].": </B></td><td>".$dataEntrada["entrdescris"]."</td></tr>";
		$sbHtml .= "<tr><td><B>".$rclabels["entractivas"]["label"].": </B></td><td>".$entradaExtended->getStatusEntry($dataEntrada["entractivas"])."</td></tr>";
	}
	
	//CONSULTAMOS Y MOSTRAMOS LA INFO DE LAS DEPENDENCIAS, RRFF Y PERSONAS INVOLUCRADAS
	$entradaExtended = Application::getDataGateway("entradaExtended");
	$organEntrada = $entradaExtended->getByIdOrganentradaAndPreentrada($entrcodigon);
	if(is_array($organEntrada))
	{
		foreach ($organEntrada as $rcRow)
		{
			if($rcRow["contcodigon"]<>'')
				$perscodigos = $rcRow["contcodigon"];
			$rcOrgacodigos[] = $rcRow["orgacodigos"];
		}
		$rcNombres = getOrganombres($rcOrgacodigos);
		$sbHtml .= '<tr><td><B>'.$rclabels["dependencia"]["label"].': </B></td><td>';
		$nuCont=0;
		foreach ($rcOrgacodigos as $orgacodigos)
		{
			if($nuCont)
				$sbHtml .= " ,";
			$sbHtml .= $rcNombres[$orgacodigos];
			$nuCont++;
		}
		$sbHtml .= '</td></tr>';
		if($perscodigos)
		{
			$rcInfoContacto = getContnombres($perscodigos);
			$sbHtml .= '<tr><td><B>'.$rclabels["ciudadano"]["label"].': </B></td><td>';
			$sbHtml .= $rcInfoContacto["contnombre"]." (".$rcInfoContacto["contnumcels"]." - ".$rcInfoContacto["contdirecios"]." - ".$rcInfoContacto["conttelefons"]." - ".$rcInfoContacto["contemail"].")";
			$sbHtml .= '</td></tr>';
		}
	}
	$sbHtml .= '</td></tr></table></td></tr></table>';
	unset($rcRow,$rcTipoOrgani,$organEntrada,$entradaExtended,$entradaGateway,$dataEntrada,$dataRefer);
	return $sbHtml;
}

function getOrganombres($rcOrgacodigos)
{
	settype($rcResult,"array");
	settype($HRService,"object");
	settype($HRGateway,"object");
	
	$HRService = Application::loadServices("Human_resources");
	$HRGateway = $HRService->getGateWay("organizacionExtended");
	$rcResult = $HRGateway->getEntesByIdInArray($rcOrgacodigos);
	$HRService->close();
	
	if(!is_array($rcResult))
		return false;
	return $rcResult;
}

function getContnombres($nuContcodigon){
	
	settype($objService,"object");
	settype($objGateway,"object");
	settype($rcResult,"array");
	
	if($nuContcodigon){
		$objService = Application::loadServices("Customers");
		$objGateway = $objService->getGateWay("contacto");
		$rcResult = $objGateway->getByIdContacto($nuContcodigon);
		if(is_array($rcResult) && $rcResult){
			$rcResult = $rcResult[0];
		}
	}
	
	return $rcResult;
}

function getTarea($actacodigos)
{
	$objCross = Application::loadServices("Cross300");
	$sbTarea = $objCross->getNombreTarea($actacodigos);
	$objCross->close();
	
	return $sbTarea;
}
?>