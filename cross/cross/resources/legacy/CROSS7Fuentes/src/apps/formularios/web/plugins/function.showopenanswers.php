<?php
/**
 * * @Copyright 2014 Parquesoft
 *
 * Imprime las respuestas abiertas de una pregunta
 * @author freina<freina@fullengine.com>
 *
 * @location Cali - Colombia
 */
function smarty_function_showopenanswers($params, & $smarty) {
	extract($params);
	extract($_REQUEST);

	settype($objGateway,"object");
	settype($objDate,"object");
	settype($rcData,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcDetail, "array");
	settype($sbPregdescris, "string");
	settype($nuCont,"integer");

	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

	if($pregcodigon && $reprcodigon && $nuIndex){

		$objDate = Application::loadServices("DateController");
		$objGateway = Application::getDataGateway("detarespusua");
		$objGateway->setData(array("oprecodigon"=>$reprcodigon,"order_by"=>"derucodigon"));
		$objGateway->getDetarespusua();
		$rcData = $objGateway->getResult();

		if(is_array($rcData) && $rcData){

			// Se obtiene el encabezado de las respuestas
			$objGateway = Application::getDataGateway("respuestausu");
			foreach($rcData as $nuCont=>$rcRow){
				$objGateway->setData(array("reuscodigon"=>$rcRow["reuscodigon"]));
				$objGateway->getRespuestausu();
				$rcTmp = $objGateway->getResult();
				if(is_array($rcTmp) && $rcTmp){
					$rcDetail[$rcRow["reuscodigon"]] = $rcTmp[0];
				}
			}

			$objGateway = Application::getDataGateway("pregunta");
			$objGateway->setData(array("pregcodigon"=>$pregcodigon));
			$objGateway->getPregunta();
			$rcTmp = $objGateway->getResult();
			if(is_array($rcTmp) && $rcTmp){
				$sbPregdescris = $rcTmp[0]["pregdescris"];
			}
				
			//se obtiene la tabla del reporte
			$sbHtml = getTabla($rcData,$rcDetail,$sbPregdescris,$nuIndex);
		}else {
			$sbHtml .= "<script>alert('".$rcmessages[22]."');window.close();</script>";
		}
	}else{
		$sbHtml .= "<script>alert('".$rcmessages[0]."');window.close();</script>";
	}

	return $sbHtml;
}

function getTabla ($rcData,$rcDetail,$sbPregdescris, $nuIndex){

	extract($_REQUEST);
	settype($objDate, "object");
	settype($objService, "object");
	settype($objGateway, "object");
	settype($rcRow,"array");
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($sbHtml,"string");
	settype($sbStyle, "string");
	settype($nuCont, "integer");

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	$objDate = Application :: loadServices("DateController");

	include ($rcUser["lang"]."/".$rcUser["lang"].".report.php");

	if(is_array($rcData) && $rcData && is_array($rcDetail)  && $rcDetail && $sbPregdescris && $nuIndex){

		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='left'><strong><font size=\"3\">".$rclabels["title7"]." ".(string)$nuCant."</font></strong></td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\"align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='center'>";
		$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\"align='left'>";
		$sbHtml .=" <b>".$rclabels["title8"] .": </b> &nbsp; <b> &nbsp; " . (string) $nuIndex." &nbsp; ". $sbPregdescris."</b>";
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='center'>";
		$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center' width=\"65%\">".$rclabels["title1"]."</td>";
		$sbHtml .= "<td class='titulofila' align='center' width=\"35%\">".$rclabels["title9"]."</td>";
		$sbHtml .= "<td class='titulofila' align='center' width=\"35%\">".$rclabels["title10"]."</td>";
		$sbHtml .= "<td class='titulofila' align='center' width=\"35%\">".$rclabels["title11"]."</td>";
		$sbHtml .= "</tr>";
		foreach($rcData as $nuCont => $rcRow){
			
			//Calcula el interlineado
			if (fmod($nuCont, 2) == 0) {
				$sbStyle = "celda";
			} else {
				$sbStyle = "celda2";
			}
				
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='$sbStyle' align='left' width=\"65%\">".$rcRow["deruvalorabis"]."</td>";
			$sbHtml .= "<td class='$sbStyle' align='center' width=\"35%\">";
			if($rcDetail[$rcRow["reuscodigon"]]["reusfecingn"]){
				$sbHtml .= $objDate->fncformatofechahora($rcDetail[$rcRow["reuscodigon"]]["reusfecingn"]);
			}else{
				$sbHtml .= "&nbsp;";
			}
			$sbHtml .= "</td>";
			
			$sbHtml .= "<td class='$sbStyle' align='center' width=\"35%\">";
			if($rcDetail[$rcRow["reuscodigon"]]["contindentis"]){
				$objService = Application :: loadServices("Customers");
				$objGateway =  $objService->loadGateway("solicitante");
				$objGateway->setData(array("solicodigos"=>$rcDetail[$rcRow["reuscodigon"]]["contindentis"]));
				$objGateway->getViewSolicitante();
				$rcTmp = $objGateway->getResult();
				if(is_array($rcTmp) && $rcTmp){
					$rcTmp = $rcTmp[0];
					$sbHtml .= $rcTmp["contnombres"];
					if($rcTmp["cliecodigos"]){
						$sbHtml .= "&nbsp;(".$rcTmp["cliecodigos"]."&nbsp;".$rcTmp["clienombres"].")";
					}
				}
				$objService->close();
			}else{
				$sbHtml .= "&nbsp;";
			}
			$sbHtml .= "</td>";
			
			$sbHtml .= "<td class='$sbStyle' align='center' width=\"35%\">";
			if($rcDetail[$rcRow["reuscodigon"]]["paciindentis"]){
				$objService = Application :: loadServices("Customers");
				$objGateway =  $objService->loadGateway("paciente");
				$rcTmp = $objGateway->getByIdPaciente($rcDetail[$rcRow["reuscodigon"]]["paciindentis"]);
				if(is_array($rcTmp) && $rcTmp){
					$rcTmp = $rcTmp[0];
					$sbHtml .= $rcTmp["paciindentis"]." ".$rcTmp["pacinombres"];
					if($rcTmp["pacihisclis"]){
						$sbHtml .= " ".$rclabels["title12"]." ".$rcTmp["pacihisclis"];
					}
				}
				$objService->close();
			}else{
				$sbHtml .= "&nbsp;";
			}
			$sbHtml .= "</td>";
			
			$sbHtml .= "</tr>";
		}
		$sbHtml .= "</table>";
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td class=\"piedefoto\" align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "</table>";
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "</table>";

	}
	return $sbHtml;
}
?>