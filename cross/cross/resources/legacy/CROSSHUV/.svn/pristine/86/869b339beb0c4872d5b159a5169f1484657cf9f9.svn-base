<?php 
/**Copyright 2007 FullEngine
*
* Consulta y visualiza la ficha de requerieminto
* @author mrestrepo <mrestrepo@parquesoft.com>
* @date 09-sep-2004 11:58:26
* @location Cali - Colombia
*/
function smarty_function_viewFichaEventoSP($params, & $smarty)
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
	
	if(!$preecodigon)
		return null;
		
	$rcUser = Application :: getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".fichaevento.php");
	
	$sbHtml .= '<tr><td><table width="90%" align=center border=0 cellpadding=0 cellspacing=0><tr><td>';
	$sbHtml .= '<table width="100%" border=1 cellpadding=0 cellspacing=0>';
	
	//TIPO DE EVENTO
	$entradaExtended = Application::getDataGateway("entradaExtended");
	$sbCateg = $entradaExtended->getCategPreEntry($preecodigon);
	$sbHtml .= "<tr><td><B>".$rclabels["catecodigon"]["label"].": </B></td><td>".$sbCateg."</td></tr>";
	
	//CONSULTAMOS Y MOSTRAMOS LA INFO BÁSICA DEL EVENTO
	$dataEntrada = $entradaExtended->getByPreEntrada($preecodigon);
	$dataEntrada = $dataEntrada[0];
	if(is_array($dataEntrada)){
		
		$objdate = Application::loadServices("DateController");
		$sbHtml .= "<tr><td><B>".$rclabels["preefecregn"]["label"].": </B></td><td>".$objdate->fncformatofechahora($dataEntrada["preefecregn"])."</td></tr>";
		$sbHtml .= "<tr><td><B>".$rclabels["preedescris"]["label"].": </B></td><td>".$dataEntrada["preedescris"]."</td></tr>";
		$rcDataContacto = getContnombres($dataEntrada["contcodigon"]);
		$sbHtml .= "<tr rowspan=4><td><B>".$rclabels["ciudadano"]["label"].": </B></td><td>".$rcDataContacto["contcodigon"]."<br>".
																			   $rcDataContacto["contnombre"]."<br>".
																			   $rcDataContacto["contnumcels"]."<br>".
																			   $rcDataContacto["contemail"]."<br>".
																			   $rcDataContacto["conttelefons"]."<br></td></tr>";
	}
	$sbHtml .= '</td></tr></table></td></tr></table>';
	unset($rcRow,$rcTipoOrgani,$organEntrada,$entradaExtended,$entradaGateway,$dataEntrada,$dataRefer);
	return $sbHtml;
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
?>