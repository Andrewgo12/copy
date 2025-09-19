<?php 
/*
 * Smarty plugin
 * Type:     function
 * Name:     viewReportManagement
 * Version:  1.0
 * Date:     11-Jul-2006
 *  Author:                                mrestrepo<mrestrepo@parquesoft.com>
 * Purpose: display a Frameset 
 * Input: frame_principal:
 *
 * Examples: {viewReportManagement
 * frame_principal="" 
 * }
 *
 */
function smarty_function_viewReportLogRotacion($params, & $smarty) 
{
	extract($params);
	extract($_REQUEST);
	
	settype($rcInterval,"array");
	settype($rcAbcis,"array");
	settype($rcX,"array");
	settype($rcY,"array");
	settype($rcExcel,"array");
	settype($sbHtml,"string");
	settype($blNoGraph,"boolean");
	
	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");
		
	$blNoGraph = true;
	$rcAbcis = false;
	if($year>2037)
		return $sbHtml .= "<script>alert('".$rcmessages[57]."');window.close();</script>";
	
	$reportesManager = Application::getDomainController("ReportesManager");
	$objDataService = Application::loadServices("Data_type"); 
  	       	
	//11 Indicador de casos de soporte atendido
    $reportesManager->setStartDate($ini_date);
  	$reportesManager->setEndDate($fin_date);
    $reportesManager->getLogRotacion();
 
	//SE OBTIENE LA DATA PARA EL REPORTE
  	$reporte = $reportesManager->getReport();
  	$objDate = Application::loadServices("DateController");
  	$rcInterval = $reportesManager->getDateInterval();
  	$rcGroups = $reportesManager->getMonthMarks();

	//000267AT - FECHA DE DIGITACIÓN
	//Convierto las fechas de digitación
	if ($ordefecdiginin && $ordefecdigfinn) {
		$ordefecdiginin = $objDate->fncdatetoint($ordefecdiginin);
		$ordefecdigfinn = $objDate->fncdatetoint($ordefecdigfinn);
		
		//Añade a la fecha final la cantidad de segundos del día
		$ordefecdigfinn += 86399;

		//INSTANCIAMOS LAS FECHAS DE DIGITACIÓN
		$reportesManager->gateway->setFechasDigitacion($ordefecdiginin,$ordefecdigfinn);
	}
  	
  	if(is_array($reporte))
  		$rcAbcis = getDataXY($rcX,$rcY,$reporte,$report);
  	if(is_array($reporte))
  	{
	  	//Cargamos los labels
		$rcLabelColumnas = $rcReportLabels[$report];
		
		$rcMethods = Application::getConstant("TIPOGRAPH_METHODS");
		$rcAdit['x-label'] = $rcLabelColumnas[1]['x-label'];
		$rcAdit['y-label'] = $rcLabelColumnas[1]['y-label'];
		if(array_key_exists('z-label',$rcLabelColumnas[1]))
			$rcAdit['z-label'] = $rcLabelColumnas[1]['z-label'];
		$sbTitle = $rcLabelColumnas[1]['title'];
		if($organombres)
			$rcLabelColumnas[1]['title'] .= "<br>".$organombres;
		if($tiornombres)
			$rcLabelColumnas[1]['title'] .= "<br>".$tiornombres;
		
		$objGraph = Application::getDomainController("GraphicManager");
		if($grafico && is_array($rcAbcis))
			$blNoGraph = $objGraph->$rcMethods[$grafico]($rcY,$rcAbcis,$sbTitle,$rcAdit);
		else
			$blNoGraph = false;
			
		//Encabezado y título del reporte
		$sbHtml = '<table width="60%" border="0" align=center>
	  				<tr> 
	    			<td colspan=2>
				    <div align="center"><strong><font size="3" face="Helvetica">'.$rcLabelColumnas[1]['title'].'</font></strong></div></td>
	 				</tr>
	  				<tr> 
	    			<td colspan=2>
				    <div align="center"><strong><font size="3" face="Helvetica">'.$objDate->fncformatofecha($rcInterval[0]).' - '.$objDate->fncformatofecha($rcInterval[1]).'</font></strong></div></td>
	 				</tr>
					</table>
					<table width="80%" border="1"  cellspacing="0" cellpadding="0" align="center">';
		
		//Etiquetas de Columnas
		if(is_array($rcLabelColumnas[0]))
		{
			$nuCount=0;
			$sbHtml .= '<tr class="piedefoto">';
			if($blNoGraph)
				$sbHtml .= '<td align="center" class="titulofila" width="5%"><strong>&nbsp;</strong></td>';
			foreach ($rcLabelColumnas[0] as $sbKey=>$sbLabel)
			{
				if(++$nuCount==1)
					$nuW = 30;
				else
					$nuW = strlen($sbLabel);
				$sbHtml .= '<td align="center" class="titulofila" width="'.$nuW.'%"><strong>'.$sbLabel.'</strong></td>';
			}
			$sbHtml .= "</tr>";
		}
		
		//Tabla con los resultados del reporte
		if(is_array($rcGroups))
		{
			if(in_array(0,$rcGroups))
			{
				$nuKey = array_search(0,$rcGroups);
				$sbHtml .= '<tr><td colspan=3 align="center"><B>'.$rcMonths[$nuKey].'</B></td></tr>';
			}
		}
		foreach ($reporte as $nuCount=>$rcRow)
		{
			$sbHtml .= '<tr>';
			if($blNoGraph)
				$sbHtml .= '<td align=center><B>'.$rcAbcis[$nuCount].'</B></td>';
			$sbStyle = "celda";
			$nuCont=0;
			foreach ($rcRow as $key=>$value)
			{
				$nuCont++;
				if(is_numeric($value) && $nuCont>1)
				{
					if(is_float($value))
						$objDataService->sbNumberFormat = 'ICD';
					$sbAlign = "width=20% align=right";
					$value = $objDataService->NumberFormat($value);
					$objDataService->resetNumberFormat();
				}
				else
					$sbAlign = "align=center";
				if(!strlen($value))
					$sbHtml .= '<td class="'.$sbStyle.'" '.$sbAlign.'>&nbsp;</td>';
				else if($key == 'ordenestopadres' || $key == 'ordenesneworgs') {
					$value = str_replace("<br>",",",$value);
					$sbHtml .= '<td class="'.$sbStyle.'" '.$sbAlign.'><a onClick="verCasos(\''.$value.'\');">ver...</a></td>';
				}
				else
					$sbHtml .= '<td class="'.$sbStyle.'" '.$sbAlign.'>'.$value.'</td>';
			}
			$sbHtml .= '</tr>';
			if(is_array($rcGroups))
			{
				if($nuCount && in_array($nuCount,$rcGroups))
				{
					$nuKey = array_search($nuCount,$rcGroups);
					$sbHtml .= '<tr><td colspan=3 align="center"><B>'.$rcMonths[$nuKey].'</B></td></tr>';
				}
			}
		}
		//Recoger los datos para el excel
		$rcExcel = $reporte;
		array_unshift($rcExcel,$rcLabelColumnas[0]);
		array_unshift($rcExcel,array($sbTitle));
		$_REQUEST["rcData"] = $rcExcel;
		
		//Dibujar Gráfico del reporte
		$sbHtml .= '</table>';
		$sbHtml .= '<table align="center"><tr><td class="piedefoto">&nbsp;</td></tr></table>';
	    if($blNoGraph)
	    {	
	    	$sbHtml .= '<table width=60% align="left" border=0><tr><td align="left" class="piedefoto">';
	    	$sbHtml .= '<img src="'.$objGraph->sbFileName.'" align="left">';
	    	$sbHtml .= '</td></tr></table>';
	    }
  	}
  	else 
  	{
  		$sbHtml .= "<script>alert('".$rcmessages[57]."');window.close();</script>";
  	}
  	return $sbHtml;
}

function getDataXY(&$rcX,&$rcY,$reporte,$tiporep)
{
	settype($rcAbscis,"array");
	
	$nuCont=0;
	foreach ($reporte as $cont=>$rcData)
	{
		$rcAbscis[] = ++$nuCont;
		$rcX[] = $rcData[0];
		$rcY[] = $rcData[1];
		if(array_key_exists(2,$rcData))
		{
			$rcScale2[] = $rcData[2];
		}
	}
	if($rcScale2)
	{
		if(array_sum($rcY)==0)
			$rcAbscis = false;
		$rcOrdinates[0] = $rcY;
		$rcOrdinates[1] = $rcScale2;
		$rcY = $rcOrdinates;
	}
	else if(array_sum($rcY)==0)
		$rcAbscis = false;
	
	return $rcAbscis;
}

function getAditionalData($table,$key,$find)
{
	$gateWay = Application::getDataGateway($table);
	$sbFunction = "getById".ucfirst($table);
	$rcData = $gateWay->$sbFunction($key);
	if(!is_array($rcData))
		return false;
	$rcData = $rcData[0];
	return $rcData[$find];
}
?>