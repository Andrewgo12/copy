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
 * frame_principal="de cada 10 personas que ven televisión, 5 son la mitad" 
 * }
 *
 */
function smarty_function_viewReportManagementActiviTarea($params, & $smarty) 
{
	extract($params);
	extract($_REQUEST);
	
	//VAR SET
	settype($rcInterval,"array");
	settype($rcAbcis,"array");
	settype($rcX,"array");
	settype($rcY,"array");
	settype($sbHtml,"string");
	settype($blNoGraph,"boolean");
	
	//DATOS DE SESIÓN Y MULTILANGUISH
	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");
		
	$blNoGraph = true;
	$rcAbcis = false;
	if($year>2037)
		return $sbHtml .= "<script>alert('".$rcmessages[57]."');window.close();</script>";
	
	//ALGUNOS SERVICIOS Y MANAGERS
	$reportesManager = Application::getDomainController("ReportesManager");
	$objGraph = Application::getDomainController("GraphicManager");
	$objDataService = Application::loadServices("Data_type");
	$objDate = Application::loadServices("DateController");
	
	//SE OBTIENE LA DATA PARA EL REPORTE
    $reportesManager->setStartDate($ini_date);
  	$reportesManager->setEndDate($fin_date);

    $reportesManager->getCasesByActa();
  	$reporte = $reportesManager->getReport();
  	$rcDataTareas = $reportesManager->getDataReport();
  	if($orgacodigos)
    	$reportesManager->gateway->setOrganization($orgacodigos);
  	
  	//algunas constantes
  	$rcLabelColumnas = $rcReportLabels[$report];
	$rcMethods = Application::getConstant("TIPOGRAPH_METHODS");
	$rcInterval = $reportesManager->getDateInterval();
	
	if(is_array($reporte))
  		$rcAbcis = getDataXY($rcX,$rcY,$reporte);
  	if(is_array($rcAbcis))
  	{
	  	//Cargamos los labels
	  	$sbTitle = $rcLabelColumnas[1]['title'];
	  	
	  	if($organombres)
			$sbTitle .= "<br>".$organombres;
	  	$sbTitleGraph = $rcLabelColumnas[1]['title'];
	  	if($organombres)
			$sbTitleGraph .= "\n".$organombres;
		$rcAdit['x-label'] = $rcLabelColumnas[1]['x-label'];
		$rcAdit['y-label'] = $rcLabelColumnas[1]['y-label'];
		if(array_key_exists('z-label',$rcLabelColumnas[1]))
			$rcAdit['z-label'] = $rcLabelColumnas[1]['z-label'];
			
		//Encabezado y título del reporte
		$sbHtml .= "<table border=0 width=100%>";
		$sbHtml .= getTablaReporte($rcLabelColumnas[0],$objDate,$objDataService,$objGraph,$rcInterval,$reporte,$rcY,$rcAbcis,$rcAdit,$sbTitle,$sbTitleGraph,$rcMethods,$blNoGraph,$grafico);
		
		//veamos qué actividades tiene cada tarea
		$reportesManager->getCasesByActividad();
		$reporte = $reportesManager->getReport();
  		foreach ($reporte as $tarecodigos=>$rcData)
  		{
  			if(is_array($rcData))
  			{
  				$rcX = null;
  				$rcY = null;
  				$rcAbcis = getDataXY($rcX,$rcY,$rcData);
  			}
  			if(is_array($rcAbcis))
  			{
  				//Cargamos los labels
				$sbTitle = $rcDataTareas[$tarecodigos];
				if($rcLabelColumnas[2]['title'])
					$sbTitle .= "<br>".$rcLabelColumnas[2]['title'];
				if($organombres)
					$sbTitle .= "<br>".$organombres;
  				$sbTitleGraph = $rcDataTareas[$tarecodigos];
  				if($rcLabelColumnas[2]['title'])
  					$sbTitleGraph .= "\n".$rcLabelColumnas[2]['title'];
  				if($organombres)
					$sbTitleGraph .= "\n".$organombres;
				$rcAdit['x-label'] = $rcLabelColumnas[2]['x-label'];
				$rcAdit['y-label'] = $rcLabelColumnas[2]['y-label'];
				if(is_array($rcLabelColumnas[2]))
					if(array_key_exists('z-label',$rcLabelColumnas[2]))
						$rcAdit['z-label'] = $rcLabelColumnas[2]['z-label'];
				
				$sbHtml .= "<tr class='piedefoto'><td>&nbsp;</td></tr>";
				$sbHtml .= getTablaReporte($rcLabelColumnas[0],$objDate,$objDataService,$objGraph,$rcInterval,$rcData,$rcY,$rcAbcis,$rcAdit,$sbTitle,$sbTitleGraph,$rcMethods,$blNoGraph,$grafico);
  			}
  		}
  		$sbHtml .= "</table>";
  	}
  	else 
  	{
  		$sbHtml .= "<script>alert('".$rcmessages[57]."');window.close();</script>";
  	}
  	return $sbHtml;
}

function getDataXY(&$rcX,&$rcY,$reporte)
{
	settype($rcAbscis,"array");
	
	$nuCont=0;
	foreach ($reporte as $cont=>$rcData)
	{
		$rcAbscis[] = ++$nuCont;
		$rcX[] = $rcData[0];
		$rcY[] = $rcData[1];
		if(is_array($rcData))
			if(array_key_exists(2,$rcData))
				$rcScale2[] = $rcData[2];
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

function getTablaReporte($rcLabelColumnas,$objDate,$objDataService,&$objGraph,$rcInterval,$reporte,$rcY,$rcAbcis,$rcAdit,$sbTitle,$sbTitleGraph,$rcMethods,$blNoGraph,$grafico)
{
	settype($sbHtml,"string");
	settype($nuCount,"integer");
	settype($nuCont,"integer");
	
	//GRÁFICO
	if($grafico)
		$blNoGraph = $objGraph->$rcMethods[$grafico]($rcY,$rcAbcis,$sbTitleGraph,$rcAdit);
	else
		$blNoGraph = false;
			
	//CADENA HTML
	$sbHtml = '<tr><td><table width="60%" border="0" align=center>
	  				<tr> 
	    			<td align="center"><strong><font size="3" face="Helvetica">'.$sbTitle.'</font></strong></td>
	 				</tr>
	  				<tr> 
	    			<td align="center"><strong><font size="3" face="Helvetica">'.
					$objDate->fncformatofecha($rcInterval[0]).' - '.$objDate->fncformatofecha($rcInterval[1]).
					'</font></strong></td>
	 				</tr>
					</table>
					<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>';
		

	if(is_array($rcLabelColumnas))
	{
		$nuCount=0;
		$sbHtml .= '<table width="100%" border="1"  cellspacing="0" cellpadding="0" align="center"><tr class="piedefoto">';
		$sbHtml .= '<td align="center" class="titulofila" width="5%"><strong>&nbsp;</strong></td>';
		foreach ($rcLabelColumnas as $sbKey=>$sbLabel)
		{
			if(++$nuCount==1)
				$nuW = 30;
			else
				$nuW = strlen($sbLabel);
			$sbHtml .= '<td align="center" class="titulofila" width="'.$nuW.'%"><strong>'.$sbLabel.'</strong></td>';
		}
		$sbHtml .= "</tr>";
		$nuSuma = 0;
		foreach ($reporte as $nuCount=>$rcRow)
		{
			$sbHtml .= '<tr>';
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
					$nuSuma += $value;
					$value = $objDataService->NumberFormat($value);
					$objDataService->resetNumberFormat();
				}
				else
					$sbAlign = "align=left";
				$sbHtml .= '<td class="'.$sbStyle.'" '.$sbAlign.'>'.$value.'</td>';
			}
			$sbHtml .= '</tr>';
		}
		$sbHtml .= "<tr><td align=center colspan=2>Total</td><td align=right><B>".$objDataService->NumberFormat($nuSuma)."</B></td><tr>";
		$sbHtml .= "</table></td>";
	}

	//Recoger los datos para el excel
	$rcExcel = $reporte;
	array_unshift($rcExcel,$rcLabelColumnas);
	array_unshift($rcExcel,array($sbTitle));
	array_unshift($rcExcel,array());
	array_unshift($rcExcel,array());
	if(!$_REQUEST["rcData"]){
		$_REQUEST["rcData"] = array();
	}
	$_REQUEST["rcData"] = array_merge($_REQUEST["rcData"],$rcExcel);
		
	//Dibujar Gráfico del reporte
	if($blNoGraph)
	{	
	    $sbHtml .= '<td><table width=60% align="left" border=0><tr><td align="left" class="piedefoto">';
	    $sbHtml .= '<img src="'.$objGraph->sbFileName.'" align="left">';
	    $sbHtml .= '</td></tr></table></td>';
	}
	$sbHtml .= '</tr>';
	$sbHtml .= '</table></td></tr>';
	return $sbHtml;	    
}
?>