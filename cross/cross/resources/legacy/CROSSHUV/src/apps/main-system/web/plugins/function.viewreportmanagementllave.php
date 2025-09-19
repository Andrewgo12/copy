<?php 
/**
 * * @Copyright 2009 Parquesoft
*
* Genera la nueva llave e ingresa la información a la bd
* @author freina<freina@parquesoft.com>
*
* @location Cali - Colombia
*/
function smarty_function_viewReportManagementLlave($params, & $smarty) {
	extract($params);
	extract($_REQUEST);
	
	settype($objManager,"object");
	settype($objDataService,"object");
	settype($objDate,"object");
	settype($rcReporte,"array");
	settype($rcData,"array");
	settype($rcInterval,"array");
	
	//DATOS DE SESIÓN Y MULTILANGUISH
	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");
	
	//ALGUNOS SERVICIOS Y MANAGERS
	$objManager = Application::getDomainController("ReportesManager");
	$objDataService = Application::loadServices("Data_type");
	$objDate = Application::loadServices("DateController");
	
	//Ajusta las fechas de inicio y fin
    $rcData["fechaini"] = $objDate->fncdatetoint($ini_date); 
    $rcData["fechafin"] = $objDate->fncdatetoint($fin_date) + ($objDate->nuSecsDay - 1);
    if($llavusuauts){
    	$rcData["llavusuauts"] = $llavusuauts;	
    }
    if($llavususols){
    	$rcData["llavususols"] = $llavususols;	
    }
    
    $objManager->setData($rcData);
    $objManager->getLlave();
  	$rcReporte = $objManager->getReport();

  	//algunas constantes
  	$rcLabelColumnas = $rcReportLabels[$report];
  	
	$rcInterval[0] = $objDate->fncformatofecha($objDate->fncdatehourtoint($ini_date));
	$rcInterval[1] = $objDate->fncformatofecha($objDate->fncdatehourtoint($fin_date));
	
  	if(is_array($rcReporte) && $rcReporte){
	  	//Cargamos los labels
	  	$sbTitle = $rcLabelColumnas[1]['title'];
		//Encabezado y título del reporte
		$sbHtml .= "<table border=0 width=100%>";
		$sbHtml .= getTablaReporte($rcLabelColumnas,$objDate,$objDataService,$rcInterval,$rcReporte,$sbTitle);
  		$sbHtml .= "</table>";
  	}
  	else {
  		$sbHtml .= "<script>alert('".$rcmessages[57]."');window.close();</script>";
  	}
  	return $sbHtml;
}

function getTablaReporte($rcLabelColumnas,$objDate,$objDataService,$rcInterval,$rcReporte,$sbTitle){
	
	settype($rcTmp,"array");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbIndex_2,"string");
	settype($sbKey,"string");
	settype($sbLabel,"string");
	settype($nuCount,"integer");
	settype($nuCont,"integer");
	settype($nuW,"integer");
			
	//CADENA HTML
	
	$sbHtml .= '<tr><td><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">';
	$sbHtml .= '<tr><td><table width="80%" border="0" align=center>
  	<tr> 
    <td align="center"><strong><font size="3" face="Helvetica">'.$sbTitle.'</font></strong></td>
 	</tr>
  	<tr> 
    <td align="center"><strong><font size="3" face="Helvetica">'.
	$rcInterval[0].' - '.$rcInterval[1].
	'</font></strong></td>
 	</tr>
	</table></td></tr>';
	$sbHtml .='<tr><td>';
	
	foreach($rcReporte[0] as $sbIndex=>$rcTmp){
		
		$sbHtml .= '<table width="100%" border="0"  cellspacing="0" cellpadding="0" align="center">';
		$sbHtml .= '<tr class="piedefoto">';
		$sbHtml .= '<td align="center"><strong><font size="3" face="Helvetica">('.$sbIndex.") ".$rcTmp[0].
		'</font></strong></td>
	 	</tr>';
		$sbHtml .='<tr><td>';
		$sbHtml .='<table width="100%" border="1"  cellspacing="0" cellpadding="0" align="center">';
		$sbHtml .='<tr>';
		foreach ($rcLabelColumnas[0] as $sbKey=>$sbLabel){
			$nuW = strlen($sbLabel);
			$sbHtml .= '<td align="center" class="titulofila" width="'.$nuW.'%"><strong>'.$sbLabel.'</strong></td>';
		}
		$sbHtml .='</tr>';
		foreach($rcTmp[1] as $sbIndex_2=>$rcRow){
			if(!$rcRow["total"]){
				$rcRow["total"]=0;
			}
			if(!$rcRow["used"]){
				$rcRow["used"]=0;
			}
			if(!$rcRow["lost"]){
				$rcRow["lost"]=0;
			}
			$sbHtml .='<tr>';
			$sbHtml .= '<td align="center" >'.$rcRow["name"].'</td>';
			$sbHtml .= '<td align="center" >'.$rcRow["total"].'</td>';
			$sbHtml .= '<td align="center" >'.$rcRow["used"].'</td>';
			$sbHtml .= '<td align="center" >'.$rcRow["lost"].'</td>';
			$sbHtml .='</tr>';
		}
		$sbHtml .='</table>';
		$sbHtml .='</td></tr>';
		$sbHtml .='<tr><td colspan=\''.sizeof($rcLabelColumnas[0]).'\'>&nbsp;</td></tr>';
		$sbHtml .='</table>';
	}
	$sbHtml .='</td></tr>';
	$sbHtml .= '</table></td></tr>';
	
	//Recoger los datos para el excel
	$rcExcel = $rcReporte[1];
	array_unshift($rcExcel,$rcLabelColumnas[2]);
	$_REQUEST["rcData"] = array_merge($_REQUEST["rcData"],$rcExcel);
	
	return $sbHtml;	    
}
?>