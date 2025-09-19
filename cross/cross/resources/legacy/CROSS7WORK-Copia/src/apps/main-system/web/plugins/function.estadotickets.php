<?php
/**
 * @Copyright 2004 ï¿½ FullEngine
 *
 * Smarty plugin
 * Pinta el listado de ordenes
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 09-dic-2004 10:26:01
 * @location Cali - Colombia
 */
function smarty_function_estadotickets($params, & $smarty) {
	if (!$_REQUEST["consult__flag"])
	return null;

	settype($sbCant,"string");
	settype($sbCantH,"string");
	settype($rcHtml,"array");
	settype($rcExcel,"array");
	settype($rcResult,"array");

	//Carga el servicio de fechas
	$dateService = Application :: loadServices("DateController");
	$dateSeparator = $dateService->dateSeparator;

	foreach ($_REQUEST as $key => $value)
	{
		$blContinue = false;
		if ((strpos($key,"__")!==false) && (strpos($key,'__')!==0))
		{
			//Extrae los nombres de los campos y el orden
			$rcTmp = explode("__",$key);
			$rcKeys[] = $rcTmp[0].".".$rcTmp[1];

			//Hace la conversion de fechas y la separacio
			if ($_REQUEST[$key])
			{
				$rcTmp = explode($dateSeparator, $_REQUEST[$key]);
				if ($rcTmp[1]){
					$rcTmp = explode("_",$key);
					$rcDatosDate[$rcTmp[0].".".$rcTmp[2]] = $dateService->fncdatetoint($_REQUEST[$key]);
				}else{
					$rcTmp = explode("_",$key);
					$rcWhere[$rcTmp[0].".".$rcTmp[2]] = $_REQUEST[$key];
				}
			}
		}
		else if(strpos($key,"check")!==false)
		{
			$rcTmp = explode("check",$key);
			$camposOrdena[$rcTmp[1]] = str_replace("__",".",$value);
		}
	}
	//Limpia el vector
	unset ($rcWhere["consult.flag"]);
	if (is_array($rcDatosDate))
	{
		//Ajusta las fechas de Ingreso
		$rcTmp = setDates($rcDatosDate["orden.ordefecingd1"], $rcDatosDate["orden.ordefecingd2"], $dateService);
		$rcDatosDate["orden.ordefecingd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecingd2"] = $rcTmp[1];

		//Ajusta las fechas de Registro
		$rcTmp = setDates($rcDatosDate["orden.ordefecregd1"], $rcDatosDate["orden.ordefecregd2"], $dateService);
		$rcDatosDate["orden.ordefecregd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecregd2"] = $rcTmp[1];

		//Ajusta las fechas de Vencimiento
		$rcTmp = setDates($rcDatosDate["orden.ordefecvend1"], $rcDatosDate["orden.ordefecvend2"], $dateService);
		$rcDatosDate["orden.ordefecvend"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecvend2"] = $rcTmp[1];

		//Ajusta las fechas de Finalizacion
		$rcTmp = setDates($rcDatosDate["orden.ordefecfinad1"], $rcDatosDate["orden.ordefecfinad2"], $dateService);
		$rcDatosDate["orden.ordefecfinad"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecfinad2"] = $rcTmp[1];
	}
	//Carga el manager del listado
	$manager = Application :: getDomainController("ListadoOrdenManager");

	//Genera el sql
	$rcConsult = $manager->getListadoOrden($rcWhere, $rcDatosDate, $camposOrdena, $rcKeys ,$_REQUEST['children']);
	$nuTotal = $manager->nuTotal;
	$nuOffset = $manager->nuOffset;
	$sql = $manager->sql;

	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();

	if (!is_array($rcUser))
	$rcUser["lang"] = Application :: getSingleLang();
	else {
		$HR = Application::loadServices("Human_resources");
		$perfilAdmin = Application::getConstant("PERFIL_ADMIN");
		$HR->close();
		$mostrarOpcionEliminarTicket = false;
		if(in_array($rcUser["prof_code"],$perfilAdmin))
		$mostrarOpcionEliminarTicket = true;
	}
	include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	if(!is_array($rcConsult)){
		return "<script language='javascript'>alert('".$rcmessages[22]."')</script>";
	}
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();

	if (!is_array($rcUser))
	$rcUser["lang"] = Application :: getSingleLang();

	//Incluye los  el archivo de lenguaje
	include ($rcUser["lang"]."/".$rcUser["lang"].".listadoorden.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	//Pinta la consulta
	if($_REQUEST["consult__flag"] == 1)
	$rcHtml[] = "<table border='0' align='center' width='75%'>";
	else
	$rcHtml[] = "<table border='1' align='center' cellpadding='0' cellspacing='0' width='100%'>";

	//Pinta la cabecera de la consulta
	$rcHead = array_keys($rcConsult[0]);

	foreach ($rcConsult as $nuCont=>$rcRow) {
		$rcResult[$rcRow["ordenumeros"]] = $rcRow;
	}

	if($rcConsult){
		$sbCantH = sizeof($rcHead)+2;
		$sbCant = (string) sizeof($rcResult);

		//AGREGUEMOS LOS LINKS DE PAGINACIÓN
		$Pager = Application::loadServices("Pager");
		$rcHtml[] = "<tr><td align='center' colspan='$sbCantH'>";
			
		$nuCuantos = ($nuTotal-$nuOffset)<100?($nuTotal-$nuOffset):100;
		$rcHtml[] = $Pager->paginar($rcConsult,"ListadoOrden",100,true,$nuTotal);
		$rcHtml[] = "</tr></td>";
	}

	foreach($rcHead as $headName)
	$rcFilaLabels[] = $rclabels[$headName]["label"];

	$sbLabels = join("=>",$rcFilaLabels);
	SaveSql($sql,$sbLabels);

	$sbExcel = "<tr><td><a onClick=\"getExcel();\">";
	$sbExcel .= Application::getConstant('EXCEL_IMAGE0');
	$sbExcel .= "</a></td>";
	$rcHtml[] = $sbExcel;

	//se pinta la cantidad de registros - freina - 24-Jun-2005
	$rcHtml[] = "<td colspan='".($sbCantH-1)."'>".$rclabels["total"]["label"]." ".($nuOffset+1)." al ".($nuOffset+$nuCuantos)." de ".$nuTotal."</td></tr>";

	$rcHtml[] = "<tr>";
	$nuAux = 1;
	foreach($rcHead as $headName)
	{
		$rcHtml[] = "<td class='titulofila' align='center'>
				<a onClick='document.frmListadoOrden.orderby.value=".$nuAux.";
									document.frmListadoOrden.action.value=\"FeCrCmdDefaultListadoOrden\";
									document.frmListadoOrden.consult__flag.value=1;
									document.frmListadoOrden.submit();'
				 style='text-decoration:none;FONT-SIZE: 11px; BACKGROUND: #1c49bc; COLOR: #ffffff; FONT-FAMILY: Helvetica'>".
		$rclabels[$headName]["label"]."</a></td>";
		$nuAux++;
	}
	if($_REQUEST["consult__flag"] == 1)
	$rcHtml[] = "<td class='titulofila' colspan=2>".$rclabels["action"]["label"]."</td>";
	$rcHtml[] = "</tr>";

	//Pinta el cuerpo de la consulta
	reset($rcResult);
	unset($value);
	$nuCont=0;
	foreach($rcResult as $key => $rcBody){
		$rcHtml[] = "<tr>";
		unset($rcBody["actafechfinn"]);

		//Calcula el interlineado
		if(fmod($nuCont,2)  ==  0)$estilo = "celda"; else $estilo = "celda2";
		foreach($rcBody as $sbKey=>$value){
			if(!$value)
			$value = "&nbsp;";
			if($sbKey == 'ordenumeros') {
				$rcHtml[] = "<td class='$estilo'>".$value."</td>";
			}
			else
			$rcHtml[] = "<td class='$estilo'>".$value."</td>";
		}
		if($_REQUEST["consult__flag"] == 1)
		$rcHtml[] = "<td class='$estilo'><a title='".$rclabels_generic["view"]."' onClick=\"javascript:fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadFicha&mainFrame=FeCrCmdDefaultBodyFichaOrd&orden__ordenumeros=".$rcBody["ordenumeros"]."&vars=orden__ordenumeros');\" ><img src='web/images/consultar_002.gif' border='0' alt='".$rclabels_generic["view"]."'></a></td>";
		$rcHtml[] = "</tr>";
		$nuCont++;
	}
	$rcHtml[] = "</table>";
	if($_REQUEST["consult__flag"] == 1)
	{
		//Visualiza
		return implode("\n",$rcHtml);
	}else
	{
		//imprime
		$file = "listadoCaso.{$rcUser["username"]}.html";
		$path = Application::getBaseDirectory()."/tmp/$file";
		$fd = fopen($path,'w');
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
		chmod($path, 0777);
		$cadena = "<script language=\"javascript\">OpenWindows('tmp/$file');</script>";
		return $cadena;
	}
}
/**
 * @Copyright 2004 ï¿½ FullEngine
 *
 *
 * @param integer $date fecha inicial
 * @param integer $date1 fecha final
 * @param object $dateservice Servicio de control de fechas
 * @return array
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 11-dic-2004 10:09:58
 * @location Cali - Colombia
 */
function setDates($date, $date1, $dateservice) {

	$addDay = $dateservice->nuSecsDay;
	$today = $dateservice->fncintdatehour();
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

function SaveSql($sql,$sbLabels) {
	
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
	fwrite($sbFile,$sql);
	fwrite($sbFile,"_____");
	fwrite($sbFile,$sbLabels);
	fclose($sbFile);
}
?>