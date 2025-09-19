<?php
/**Copyright 2004 FullEngine
*
* Visualiza los parametros delos reportes
* @author freina <freina@parquesoft.com>
* @date 13-Jul-2006 11:39
* @location Cali - Colombia
*/
function smarty_function_view_html_location_params($params, & $smarty) {
	extract($_REQUEST);

	settype($objService, "object");
	settype($objManager, "object");
	settype($rcPlugins, "array");
	settype($rcNotullFields, "array");
	settype($rcUser, "array");
	settype($sbHtml, "string");
	settype($sbAccessKey, "string");
	settype($sbName, "string");
	settype($sbNotullFields, "string");
	settype($sbMessage, "string");
	settype($sbReport, "string");
	settype($sbTmp, "string");

	if ($report && $dimension) {

		$sbHtml .= "<form method=\"post\" name=\"frmReport_".$report."\">";
		$sbHtml .= "<table border=\"0\" align=\"center\" width=\"100%\">";
		$sbHtml .= "<tr><td colspan=\"3\" class=\"piedefoto\">&nbsp;</td></tr>";
		$sbHtml .= "<tr><td colspan=\"3\" class=\"piedefoto\">";
		$rcParams["report"] = $report;
		$rcPlugins = Application :: getConstant("RCPLUGINS");
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion 
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".reportscenter.php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");

		//mensaje
		$sbMessage = $rcmessages[0];
		
		//nombre del reporte
		$sbReport = "report_".$dimension;
		$sbReport = $rclabels[$sbReport];

		$objService = Application :: loadServices("Dimentions");
		$sbTmp = $objService->PluginsFactory($rclabels, $rcUser, $rcPlugins, $rcParams, "report", "dimension", $dimension);
		$sbTmp = str_replace("</table>","",$sbTmp);
		$sbTmp = str_replace("59%","75%",$sbTmp);
		$sbTmp = str_replace("16%","0%",$sbTmp);
		$sbHtml .= $sbTmp;
		$objService->close();
		//campos not null
		$rcNotullFields = getNotNullFields($dimension);
		if($rcNotullFields){
			$sbNotullFields = implode(",",$rcNotullFields);
		}
		if ($rclabels["locacodigos"]["label"]) {
			$sbName = $rclabels["locacodigos"]["label"];
			$sbAccessKey = strtoupper(substr($sbName, 0, 1));
			$sbName = "<b><u>".$sbAccessKey."</u>".substr($sbName, 1)."</b>";
		}
		$sbHtml .="<tr><td>".$sbName."</td><td>";
		$sbHtml .="<input name='locacodigos' type='text' id='locacodigos'  accessKey='".$sbAccessKey;
		$sbHtml .="' onBlur=\"if(this.value)jsGetDescription('index.php','FeCrCmdGetValues','frmReport_".$report."','locacodigos','locanombres',";
		$sbHtml .="'&sbSqlId=localizacion&sbFunction=autoReference&rcParams[locacodigos]='+this.value,'tilocodigos','&sbSqlId=tipolocaliza&sbFunction=selectValues&rcParams[locacodigos]='+this.value)\">";
	    $sbHtml .="<a href='#' onClick=\"javascript:fncopenwindows('FeCrCmdTreeHelp',";
	    $sbHtml .="'table=localizacion&sqlid=localizacion&return_obj=frmReport_".$report.",locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmReport_".$report.".";
		$sbHtml .="locacodigos.value);\"><img src='web/images/menu.gif' border='0' align='middle'></img></a>";
        $sbHtml .="<input name='locanombres' type='text' size='35' ><b>*</b>";
        $sbHtml .="</td><td class=\"piedefoto\"></td></tr>";
        unset($sbName);
		unset($sbAccessKey);
        if ($rclabels["tilocodigos"]["label"]) {
			$sbName = $rclabels["tilocodigos"]["label"];
			$sbAccessKey = strtoupper(substr($sbName, 0, 1));
			$sbName = "<b><u>".$sbAccessKey."</u>".substr($sbName, 1)."</b>";
		}
        $sbHtml .="<tr><td>".$sbName."</td>";
        $sbHtml .="<td><select name='tilocodigos' size='1'  id=\"tilocodigos\" accessKey='".$sbAccessKey."'><option value=''>---</optional></select><b>*</b></td>";
        $sbHtml .="<td class=\"piedefoto\">&nbsp;</td></tr>";
        unset($sbName);
		unset($sbAccessKey);
		if ($rclabels_crl["CmdAdd"]) {
			$sbName = $rclabels_crl["CmdAdd"];
			$sbAccessKey = strtoupper(substr($sbName, 0, 1));
		}
		$sbHtml .="<tr><td colspan=\"2\">&nbsp;</td><td class=\"piedefoto\"></td></tr>";
		$sbHtml .= "<tr><td colspan=\"2\"><div align=\"center\">";
		$sbHtml .= "<input class=boton name='CmdAdd' type='button' id='CmdAdd' value='".$sbName."' accessKey='".$sbAccessKey."'";
		$sbHtml .= " onClick=\"javascript:jsSend('index.php', 'FeCrCmdDefaultViewReport', " ;
		$sbHtml .= "'frmReport_".$report."','".$report."','".$sbNotullFields.",locacodigos,tilocodigos','".$sbMessage."','".$sbReport."');\">";
		$sbHtml .= "</div></td>";
		$sbHtml .= "<td class=\"piedefoto\"></td>";
		$sbHtml .= "</tr>";
		unset($sbName);
		unset($sbAccessKey);
		
		$sbHtml .= "</table>";
		$sbHtml .= "</td></tr>";
		$sbHtml .= "</table>";
		$sbHtml .= "</form>";
	}

	print $sbHtml;
}
/**
    * Copyright 2006 FullEngine
    * 
    * Metodo que obtiene los campos dinamicos que no deben ser nulos
    * @author freina<freina@parquesoft.com>
    * @param integer $nuDimecodigon entero con el numero de la dimension
    * @return array Areglo con el nombre de los campos que no deben ser nulos 	
    * @date 15-Jul-2006 18:41:00
    * @location Cali-Colombia
    */
function getNotNullFields($nuDimecodigon) {

	settype($objService, "object");
	settype($objManager, "object");
	settype($rcResult, "array");

	if ($nuDimecodigon) {

		//Carga el servicio de human_resources
		$objService = Application :: loadServices('General');
		$objManager = $objService->InitiateClass('DimensionManager');
		$objManager->setCodDimension($nuDimecodigon);
		$objManager->setIdProcess($nuDimecodigon);
		$objManager->setOperation('getNotNullFields');
		$rcResult = $objManager->execute();
		$objService->close();
	}
	return $rcResult;
}
?>