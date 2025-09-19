<?php
/**
 * @Copyright 2004 FullEngine
 *
 * Smarty plugin
 * Pinta el listado de ordenes
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 09-dic-2004 10:26:01
 * @location Cali - Colombia
 */
function smarty_function_listadoorden($params, & $smarty) {
	if (!$_REQUEST["consult__flag"])
	return null;

	settype($objDate,"object");
	settype($objPager,"object");
	settype($objManager,"object");
	settype($rcHtml,"array");
	settype($rcExcel,"array");
	settype($rcFilaLabels,"array");
	settype($rcResult,"array");
	settype($rcTmp,"array");
	settype($rcKeys,"array");
	settype($rcDateKey,"array");
	settype($rcDatosDate,"array");
	settype($rcCamposOrdena,"array");
	settype($rcWhere,"array");
	settype($rcConsult,"array");
	settype($rcUser,"array");
	settype($rcHead,"array");
	settype($rcRow,"array");
	settype($rcBody,"array");
	settype($sbCant,"string");
	settype($sbCantH,"string");
	settype($sbDateSep,"string");
	settype($sbKey,"string");
	settype($sbValue,"string");
	settype($sbContinue,"string");
	settype($sbSql,"string");
	settype($sbCadena,"string");
	settype($sbLabels,"string");
	settype($sbExcel,"string");
	settype($sbFile,"string");
	settype($sbPath,"string");
	settype($sbHeadName,"string");
	settype($sbEstilo,"string");
	settype($nuTotal,"integer");
	settype($nuOffset,"integer");
	settype($nuCuantos,"integer");
	settype($nuAux,"integer");
	settype($nuCont,"integer");

	//Carga el servicio de fechas
	$objDate = Application :: loadServices("DateController");
	$sbDateSep = $objDate->dateSeparator;
	$rcDateKey = array("ordefecingd1","ordefecingd2","ordefecregd1","ordefecregd2","ordefecvend1","ordefecvend2","ordefecfinad1","ordefecfinad2");

	foreach ($_REQUEST as $sbKey => $sbValue) {

		$sbContinue = false;
		
		if ((strpos($sbKey,"__")!==false) && (strpos($sbKey,'__')!==0)){

			//Extrae los nombres de los campos y el orden
			$rcTmp = explode("__",$sbKey);
			$rcKeys[] = $rcTmp[0].".".$rcTmp[1];

			//Hace la conversion de fechas y la separacio
			if ($sbValue){
				if (in_array($rcTmp[1],$rcDateKey)){
					$rcDatosDate[$rcTmp[0].".".$rcTmp[1]] = $objDate->fncdatetoint($sbValue);
				}else{
					$rcWhere[$rcTmp[0].".".$rcTmp[1]] = $sbValue;
				}
			}
		}else if(strpos($sbKey,"check")!==false){
			$rcTmp = explode("check",$sbKey);
			$rcCamposOrdena[$rcTmp[1]] = str_replace("__",".",$sbValue);
		}
	}

	//Limpia el vector
	unset ($rcWhere["consult.flag"]);
	if (is_array($rcDatosDate)) {
		//Ajusta las fechas de Ingreso
		$rcTmp = setDates($rcDatosDate["orden.ordefecingd1"], $rcDatosDate["orden.ordefecingd2"], $objDate);
		$rcDatosDate["orden.ordefecingd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecingd2"] = $rcTmp[1];

		//Ajusta las fechas de Registro
		$rcTmp = setDates($rcDatosDate["orden.ordefecregd1"], $rcDatosDate["orden.ordefecregd2"], $objDate);
		$rcDatosDate["orden.ordefecregd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecregd2"] = $rcTmp[1];

		//Ajusta las fechas de Vencimiento
		$rcTmp = setDates($rcDatosDate["orden.ordefecvend1"], $rcDatosDate["orden.ordefecvend2"], $objDate);
		$rcDatosDate["orden.ordefecvend"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecvend2"] = $rcTmp[1];

		//Ajusta las fechas de Finalizacion
		$rcTmp = setDates($rcDatosDate["orden.ordefecfinad1"], $rcDatosDate["orden.ordefecfinad2"], $objDate);
		$rcDatosDate["orden.ordefecfinad"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecfinad2"] = $rcTmp[1];
	}
	//Carga el manager del listado
	$objManager = Application :: getDomainController("ListadoOrdenManager");

	//Genera el sql
	$rcConsult = $objManager->getListadoOrden($rcWhere, $rcDatosDate, $rcCamposOrdena, $rcKeys ,$_REQUEST['children'] ,$_REQUEST['tareacc']);
	$nuTotal = $objManager->nuTotal;
	$nuOffset = $objManager->nuOffset;
	$sbSql = $objManager->sql;

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser) || !$rcUser){
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	if(!is_array($rcConsult)){
		return "<script language='javascript'>alert('".$rcmessages[22]."')</script>";
	}

	//Incluye los  el archivo de lenguaje
	include ($rcUser["lang"]."/".$rcUser["lang"].".listadoorden.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	//Pinta la consulta
	if($_REQUEST["consult__flag"] == 1){
		$rcHtml[] = "<table border='0' align='center' width='100%'>";
	}else{
		$rcHtml[] = "<table border='1' align='center' cellpadding='0' cellspacing='0' width='100%'>";
	}

	//Pinta la cabecera de la consulta
	$rcHead = array_keys($rcConsult[0]);

	foreach ($rcConsult as $nuCont=>$rcRow) {
		$rcResult[$rcRow["ordenumeros"]] = $rcRow;
	}

	if($rcConsult){
		$sbCantH = sizeof($rcHead)+2;
		$sbCant = (string) sizeof($rcResult);

		//AGREGUEMOS LOS LINKS DE PAGINACIÓN
		$objPager = Application::loadServices("Pager");
		$rcHtml[] = "<tr><td align='center' colspan='$sbCantH'>";
			
		$nuCuantos = ($nuTotal-$nuOffset)<100?($nuTotal-$nuOffset):100;
		$rcHtml[] = $objPager->paginar($rcConsult,"ListadoOrden",100,true,$nuTotal);
		$rcHtml[] = "</tr></td>";
	}

	foreach($rcHead as $sbHeadName)
	$rcFilaLabels[] = $rclabels[$sbHeadName]["label"];

	$sbLabels = join("=>",$rcFilaLabels);
	SaveSql($sbSql,$sbLabels);

	$sbExcel = "<tr><td><a onClick=\"getExcel();\">";
	$sbExcel .= Application::getConstant('EXCEL_IMAGE0');
	$sbExcel .= "</a></td>";
	$rcHtml[] = $sbExcel;

	//se pinta la cantidad de registros - freina - 24-Jun-2005
	$rcHtml[] = "<td colspan='".($sbCantH-1)."'>".$rclabels["total"]["label"]." ".($nuOffset+1)." al ".($nuOffset+$nuCuantos)." de ".$nuTotal."</td></tr>";

	$rcHtml[] = "<tr>";
	$nuAux = 1;
	foreach($rcHead as $sbHeadName)
	{
		$rcHtml[] = "<td class='titulofila' align='center'>
				<a onClick='document.frmListadoOrden.orderby.value=".$nuAux.";
									document.frmListadoOrden.action.value=\"FeCrCmdDefaultListadoOrden\";
									document.frmListadoOrden.consult__flag.value=1;
									document.frmListadoOrden.submit();'
				 style='text-decoration:none;FONT-SIZE: 11px; BACKGROUND: #1c49bc; COLOR: #ffffff; FONT-FAMILY: Helvetica'>".
		$rclabels[$sbHeadName]["label"]."</a></td>";
		$nuAux++;
	}
	if($_REQUEST["consult__flag"] == 1)
	$rcHtml[] = "<td class='titulofila'>".$rclabels["action"]["label"]."</td>";
	$rcHtml[] = "</tr>";

	//Pinta el cuerpo de la consulta
	reset($rcResult);
	unset($sbValue);
	$nuCont=0;
	foreach($rcResult as $sbKey => $rcBody){
		$rcHtml[] = "<tr>";
		unset($rcBody["actafechfinn"]);

		//Calcula el interlineado
		if(fmod($nuCont,2)  ==  0)$sbEstilo = "celda"; else $sbEstilo = "celda2";
		foreach($rcBody as $sbKey=>$sbValue){
			if(!$sbValue)
			$sbValue = "&nbsp;";
			if($sbKey == 'ordenumeros') {
				$rcHtml[] = "<td class='$sbEstilo'>".$sbValue."</td>";
			}
			else
			$rcHtml[] = "<td class='$sbEstilo'>".$sbValue."</td>";
		}

		if($_REQUEST["consult__flag"] == 1)
		$rcHtml[] = "<td class='$sbEstilo'><a title='".$rclabels_generic["view"]."' onClick=\"javascript:fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadFicha&mainFrame=FeCrCmdDefaultBodyFichaOrd&orden__ordenumeros=".$rcBody["ordenumeros"]."&vars=orden__ordenumeros');\" ><img src='web/images/consultar_002.gif' border='0' alt='".$rclabels_generic["view"]."'></a></td>";
		$rcHtml[] = "</tr>";
		$nuCont++;
	}
	$rcHtml[] = "</table>";
	if($_REQUEST["consult__flag"] == 1){
		//Visualiza
		return implode("\n",$rcHtml);
	}else{
		//imprime
		$sbFile = "listadoCaso.{$rcUser["username"]}.html";
		$sbPath = Application::getBaseDirectory()."/tmp/$sbFile";
		$fd = fopen($sbPath,'w');
		fwrite($fd,"<html>
                        <head>
                        <title>{$rclabels['title']}</title>
                        <meta http-equiv=\"Content-Type\" content=\"text/html;\" content=\"text/html; charset=ISO-8859-15\">
                        </head>
                        <body onload=\"window.close();\">
                        <form>
                        ".implode("\n",$rcHtml)."
                        </form>
                        <script> window.print(); </script>
                        </body>
                        </html>");
		fclose($fd);
		chmod($sbPath, 0777);
		$sbCadena = "<script language=\"javascript\">OpenWindows('tmp/$sbFile');</script>";
		return $sbCadena;
	}
}
/**
 * @Copyright 2004 - FullEngine
 *
 *
 * @param integer $date fecha inicial
 * @param integer $date1 fecha final
 * @param object $objDate Servicio de control de fechas
 * @return array
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 11-dic-2004 10:09:58
 * @location Cali - Colombia
 */
function setDates($date, $date1, $objDate) {

	$addDay = $objDate->nuSecsDay;
	$today = $objDate->fncintdatehour();
	if (!$date && !$date1)
	return array (null, null);
	if ($date && !$date1) {
		$date1 = $today;
	}
	if (!$date && $date1) {
		$date = "0";
		$date1 = $date1 + ($addDay -1);
	}
	if ($date && $date1) {
		$date1 = $date1 + ($addDay -1);
	}
	return array ($date, $date1);
}
function SaveSql($sbSql,$sbLabels) {
	
	settype($sbPath,"string");
	settype($sbUmask,"string");
	settype($sbFile,"string");
	
	$sbPath = Application::getTmpDirectory();
	//Se valida si el directorio existe
	if(!is_dir($sbPath)){
		$sbUmask = umask(0);
		mkdir($sbPath, 0775);
		umask($sbUmask);
	}
	$sbPath .= Application::getConstant("SLASH")."sql_".$_REQUEST["PHPSESSID"];
	if(file_exists($sbPath)){
		unlink($sbPath);	
	}
	$sbFile = fopen($sbPath,"w");
	fwrite($sbFile,$sbSql);
	fwrite($sbFile,"_____");
	fwrite($sbFile,$sbLabels);
	fclose($sbFile);
}
?>