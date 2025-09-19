<?php
/**Copyright 2004 FullEngine
*
* Visualiza los parametros delos reportes
* @author freina <freina@parquesoft.com>
* @date 13-Jul-2006 11:39
* @location Cali - Colombia
*/
function smarty_function_view_html_municipio_params($params, & $smarty) {
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
		$sbTmp = $objService->PluginsFactory($rclabels, $rcUser, $rcPlugins, $rcParams, "report", "dimension", $dimension, 1);
		$sbTmp = substr_replace($sbTmp,"",strrpos($sbTmp, "</table>"),8);
		$sbHtml .= $sbTmp;
		$objService->close();
		
		//campos not null
		$rcNotullFields = getNotNullFields($dimension);
		if($rcNotullFields){
			$sbNotullFields = implode(",",$rcNotullFields);
		}
		
		//TIPO DE CASO
		$sbCombo = getDataCombo("tipoorden","tiorcodigos","tiornombres");
		if ($rclabels["tiorcodigos"]["label"]) {
			$sbName = $rclabels["tiorcodigos"]["label"];
			$sbAccessKey = strtoupper(substr($sbName, 0, 1));
			$sbName = "<u>".$sbAccessKey."</u>".substr($sbName, 1);
		}
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td width=\"100%\">";
		$sbHtml .= "<table border=\"0\" align=\"center\" width=\"100%\">";
		$sbHtml .="<tr><td width='25%'><B>".$sbName."</B></td><td width='60%'>";
		$sbHtml .="<select name='tiorcodigos' id='tiorcodigos' accessKey='".$sbAccessKey."'>".$sbCombo."</select>";
        $sbHtml .="</tr>";
        $sbHtml .= "</table>";
        $sbHtml .= "</td>";
        $sbHtml .= "</tr>";
        
        unset($sbName);
		unset($sbAccessKey);
		if ($rclabels_crl["CmdAdd"]) {
			$sbName = $rclabels_crl["CmdAdd"];
			$sbAccessKey = strtoupper(substr($sbName, 0, 1));
		}
		$sbHtml .="<tr><td colspan=\"2\">&nbsp;</td></td></tr>";
		$sbHtml .= "<tr><td colspan=\"2\"><div align=\"center\">";
		$sbHtml .= "<input class=boton name='CmdAdd' type='button' id='CmdAdd' value='".$sbName."' accessKey='".$sbAccessKey."'";
		$sbHtml .= " onClick=\"javascript:jsSend('index.php', 'FeCrCmdDefaultViewReport', " ;
		$sbHtml .= "'frmReport_".$report."','".$report."','".$sbNotullFields.",tiorcodigos','".$sbMessage."','".$sbReport."');\">";
		$sbHtml .= "</div></td>";
		$sbHtml .= "</tr>";
		
		//cierre de tabla que abre el componente de pluguins
		$sbHtml .= "</table>";
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

function getDataCombo($tabla,$value,$label) {
	$gateWay = Application::getDataGateway($tabla);
	$sbFunc = "getAll".ucfirst($tabla);
	$rcData = $gateWay->$sbFunc();
	
	if(!is_array($rcData))
		return false;

	$sbHtml = "<option value=''>...</option>";
	foreach ($rcData as $rcRow) {
		if($_REQUEST[$value] == $value)
			$sbHtml .= "<option value='".$rcRow[$value]."' SELECTED>".$rcRow[$label]."</option>";
		else
			$sbHtml .= "<option value='".$rcRow[$value]."'>".$rcRow[$label]."</option>";
	}
	return $sbHtml;
}
?>