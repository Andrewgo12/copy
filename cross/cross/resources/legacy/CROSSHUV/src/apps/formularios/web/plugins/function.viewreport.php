<?php
/**
 * * @Copyright 2009 Parquesoft
 *
 * Reporte por tipo de servicios
 * @author freina<freina@fullengine.com>
 *
 * @location Cali - Colombia
 */
function smarty_function_viewReport($params, & $smarty) {
	extract($params);
	extract($_REQUEST);

	settype($objManager,"object");
	settype($objDate,"object");
	settype($rcReporte,"array");
	settype($rcData,"array");
	settype($sbHtml, "string");

	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");

	if($fechaini && $fechafin && $formcodigon){

		$objManager = Application::getDomainController("ReportesManager");
		$objDate = Application::loadServices("DateController");

		//Ajusta las fechas de inicio y fin
		$rcData["fechaini"] = $objDate->fncdatehourtoint($fechaini);
		$rcData["fechafin"] = $objDate->fncdatehourtoint($fechafin);
		$rcData["formcodigon"] = $formcodigon;

		$objManager->setData($rcData);
		$objManager->getReport();
		$rcReporte = $objManager->getResult();
			
		if(is_array($rcReporte) && $rcReporte){
			$sbHtml .= getTablaReporte($rcReporte);
		}
		else {
			$sbHtml .= "<script>alert('".$rcmessages[22]."');window.close();</script>";
		}
	}else{
		$sbHtml .= "<script>alert('".$rcmessages[0]."');window.close();</script>";
	}

	return $sbHtml;
}

function getTablaReporte($rcReport){

	settype($objService, "object");
	settype($rcUser,"array");
	settype($rcDescP,"array");
	settype($rcDescR,"array");
	settype($rcDescE,"array");
	settype($rcDescT,"array");
	settype($rcTmp,"array");
	settype($rcData,"array");
	settype($rcData_E,"array");
	settype($rcData_T,"array");
	settype($rcRow,"array");
	settype($rcRowR, "array");
	settype($rcData_F, "array");
	settype($rcIndex, "array");
	settype($rcIndexT, "array");
	settype($rcAll, "array");
	settype($rcExcel, "array");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbId,"string");
	settype($sbLabel,"string");
	settype($sbTmp, "array");
	settype($nuPregcodigon,"integer");
	settype($nuCont,"integer");
	settype($nuContE,"integer");
	settype($nuContT,"integer");
	settype($nuCant, "integer");
	settype($nuIndex, "integer");
	settype($nuContP, "integer");
	settype($nuCantP, "integer");
	settype($nuOprecodigon, "integer");
	settype($nuContEx, "integer");
	settype($nuPercent, "float");
	settype($nuPV, "float");

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	$objService = Application::loadServices('General');
    $nuOprecodigon = $objService->getParam("encuestas","RESP_ABIERTA");

	include ($rcUser["lang"]."/".$rcUser["lang"].".report.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	if($rcReport && is_array($rcReport)){
		//se pinta las respuestas configuradas.
		$rcDescP=$rcReport["lp"];
		$rcDescR=$rcReport["lr"];
		$rcDescE=$rcReport["le"];
		$rcDescT=$rcReport["lt"];
		$rcData_E=$rcReport["ae"];
		$rcData_T=$rcReport["at"];
		$rcData_F=$rcReport["fr"];
		$nuCant = $rcReport["total"];
		$rcAll = $rcReport["all"];

		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbTmp = $rclabels["title6"]." ".(string)$nuCant;
		$rcExcel[$nuContEx] = array($sbTmp,"","","");
		$nuContEx ++;
		$rcExcel[$nuContEx] = array("","","","");
		$nuContEx ++;
		$sbHtml .= "<td align='left'><strong><font size=\"3\">".$sbTmp."</font></strong></td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		//ciclo para pintar los ejes
		if(is_array($rcData_E) && $rcData_E){
			$nuContE = 1;
			foreach($rcData_E as $sbIndex=>$rcRow){
				
				$sbLabel = (string)$nuContE.". ".$rcDescE[$sbIndex];
				
				$rcExcel[$nuContEx] = array($sbLabel,"","","");
				$nuContEx ++;
				$rcExcel[$nuContEx] = array("","","","");
				$nuContEx ++;
				
				$sbHtml .= "<tr>";
				$sbHtml .= "<td align='left'><strong><font size=\"3\">".$sbLabel."</font></strong></td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "<tr>";
				if(is_array($rcRow) && $rcRow){
					$sbHtml .= "<td align='center'>";
					$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
					foreach($rcRow as $nuContT=>$sbIndex){
						$nuContT++;
						$sbLabel = (string)$nuContE.".".(string)$nuContT." ".$rcDescT[$sbIndex];
						$rcExcel[$nuContEx] = array($sbLabel,"","","");
						$nuContEx ++;
						$rcExcel[$nuContEx] = array("","","","");
						$nuContEx ++;
						$nuContI = 1;
						$sbHtml .= "<tr>";
						$sbHtml .= "<td align='left'><strong><font size=\"3\">".$sbLabel."</font></strong></td>";
						$sbHtml .= "</tr>";
						$sbHtml .= "<tr>";
						$sbHtml .= "<td align='center'>";
							
						//pinta las respuestas
						$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
						$sbHtml .= "<tr>";
						$sbHtml .= "<td colspan=\"2\" align='center'>&nbsp;</td>";
						$sbHtml .= "</tr>";
							
						foreach($rcReport["pi"] as $nuCont=>$nuPregcodigon){
							if(in_array($nuPregcodigon,$rcData_T[$sbIndex])){

								$nuCantP = 0;
								//se obtiene el arbol de preguntas
								$rcIndex = array();
								$nuIndex = 0;
								$rcIndexT[$nuPregcodigon] = $sbId = (string)$nuContE.".".(string)$nuContT.".".(string)$nuContI;
								select($nuPregcodigon, $rcAll, $rcIndex, $rcIndexT, $sbId, $nuIndex);
								$nuContI ++;

								if(is_array($rcIndex) && $rcIndex){
									array_unshift($rcIndex,$nuPregcodigon);
								}else{
									$rcIndex=array($nuPregcodigon);
								}

								//se pintan las preguntas
								$nuCantP = sizeof($rcIndex);

								for ($nuContP=0;$nuContP<$nuCantP;$nuContP++){
									$nuPV = 0;
									$rcData = $rcReport["cp"][$rcIndex[$nuContP]];
										
									$sbHtml .= "<tr>";
									$sbHtml .= "<td colspan=\"2\" align='left'><strong>";
									
									$sbTmp = $rcIndexT[$rcIndex[$nuContP]]." ".$rcDescP[$rcIndex[$nuContP]];
									$rcExcel[$nuContEx] = array($sbTmp,"","","");
									$nuContEx ++;
									
									$sbHtml .= $rcIndexT[$rcIndex[$nuContP]]."&nbsp;".$rcDescP[$rcIndex[$nuContP]];
									$sbHtml .= "</strong></td>";
									$sbHtml .= "</tr>";
									$sbHtml .= "<tr>";
									$sbHtml .= "<td  colspan=\"2\" align='center'>";
									$rcTmp = $rcData["answer"];
									if($rcTmp && is_array($rcTmp)){
										$sbHtml .= "<table border=\"1\" align=\"center\" width=\"100%\">";
										
										$rcExcel[$nuContEx] = array($rclabels["title1"],$rclabels["title2"],$rclabels["title3"],$rclabels["title4"]);
										$nuContEx ++;										

										$sbHtml .= "<tr>";
										$sbHtml .= "<td class='titulofila' align='center' width=\"40%\">".$rclabels["title1"]."</td>";
										$sbHtml .= "<td class='titulofila' align='center' width=\"20%\">".$rclabels["title2"]."</td>";
										$sbHtml .= "<td class='titulofila' align='center' width=\"20%\">".$rclabels["title3"]."</td>";
										$sbHtml .= "<td class='titulofila' align='center' width=\"20%\">".$rclabels["title4"]."</td>";
										$sbHtml .= "</tr>";

										foreach($rcTmp as $rcRowR){
											$nuPercent = 0;
											$sbHtml .= "<tr>";
											if($nuOprecodigon==$rcRowR["oprecodigon"]){
												$sbHtml .= "<td> <a href=\"#\" onClick=\"jsShowOpenAnswers('".$rcIndex[$nuContP]."','".$rcRowR["reprcodigon"]."','".$rcIndexT[$rcIndex[$nuContP]]."');\">".$rcDescR[$rcRowR["oprecodigon"]]."</a></td>";
											}else{
												$sbHtml .= "<td> <b>".$rcDescR[$rcRowR["oprecodigon"]]."</b></td>";	
											}											
											$sbHtml .= "<td><b>".$rcRowR["reprpeson"]."</b></td>";
											if(!$rcData_F[$rcRowR["reprcodigon"]]){
												$rcData_F[$rcRowR["reprcodigon"]] = 0;
											}else{
												$nuPercent = (($rcData_F[$rcRowR["reprcodigon"]] * 100) / $nuCant);
											}
											$sbHtml .= "<td><b>".$rcData_F[$rcRowR["reprcodigon"]]."</b></td>";
											$sbHtml .= "<td><b>".(string)$nuPercent." % </b></td>";
											$sbHtml .= "</tr>";
											$nuPV +=  $rcRowR["reprpeson"] * $nuPercent;
											
											$rcExcel[$nuContEx] = array($rcDescR[$rcRowR["oprecodigon"]],$rcRowR["reprpeson"],$rcData_F[$rcRowR["reprcodigon"]],$nuPercent);
											$nuContEx ++;
										}
										$nuPV = $nuPV /100;
										$sbHtml .= "</table>";
									}else{
										$sbHtml .="&nbsp;";
									}
									$sbHtml .= "</td>";
									$sbHtml .= "</tr>";
									$sbHtml .= "<tr>";
									$sbHtml .= "<td width=\"40%\" class='titulofila' align='center'>";
									$sbHtml .= $rclabels["title5"];
									$sbHtml .= "</td>";
									$sbHtml .= "<td width=\"60%\" colspan=\"3\" align='left'><b>";
									$sbHtml .= (string) $nuPV;
									$sbHtml .= "</b></td>";
									$sbHtml .= "</tr>";
									$sbHtml .= "<tr>";
									$sbHtml .= "<td colspan=\"2\" align='center'>&nbsp;</td>";
									$sbHtml .= "</tr>";
									$rcExcel[$nuContEx] = array($rclabels["title5"],$nuPV,"","");
									$nuContEx ++;
									$rcExcel[$nuContEx] = array("","","","");
									$nuContEx ++;									
								}
							}
						}
						$sbHtml .= "</table>";
							
						$sbHtml .= "</td>";
						$sbHtml .= "</tr>";
					}
					$sbHtml .= "</table>";
					$sbHtml .= "</td>";
				}else{
					$sbHtml .= "<td align='center'>&nbsp;</td>";
				}
				$sbHtml .= "</tr>";
				$nuContE++;
			}
		}
		$_REQUEST["rcData"] = $rcExcel;
		$sbHtml .= "</table>";

	}
	return $sbHtml;

}
function select($nuPregcodigon, & $rcData, & $rcResult, & $rcIndexT, & $sbId, & $nuIndex) {

	settype($sbIndex, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuRow, "integer");

	$nuCant = sizeof($rcData);
	$nuRow = 1;
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($rcData[$nuCont]["pregpadren"] == $nuPregcodigon) {
			$rcResult[$nuIndex] = $rcData[$nuCont]["pregcodigon"];
			$rcIndexT[$rcData[$nuCont]["pregcodigon"]] = $sbIndex = $sbId . ".". (string) $nuRow;
			$nuIndex ++;
			select($rcData[$nuCont]["pregcodigon"], $rcData, $rcResult, $rcIndexT, $sbIndex, $nuIndex);
			$nuRow ++;
		}
	}
	return;
}
?>