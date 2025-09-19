<?php  
/**
* @Copyright 2004 � FullEngine
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
    
	settype($sbCant,"string");
	settype($sbCantH,"string");
	//Carga el servicio de fechas 
	$dateService = Application :: loadServices("DateController");
	$dateSeparator = $dateService->dateSeparator;
	foreach ($_REQUEST as $key => $value) {
		if ((strpos($key,"__")!==false) && (strpos($key,'__')!==0)) {
			//Extrae los nombres de los campos y el orden
			$rcTmp = explode("_",$key);
			if($rcTmp[3]){
				$rcKeys[$rcTmp[3]] = $rcTmp[0].".".$rcTmp[2];
			}
			//Hace la conversion de fechas y la separacio
			if ($_REQUEST[$key]) {
				$rcTmp = explode($dateSeparator, $_REQUEST[$key]);
				if ($rcTmp[1]){
					$rcTmp = explode("_",$key);
					$rcDatosDate[$rcTmp[0].".".$rcTmp[2]] = $dateService->fncdatetoint($_REQUEST[$key]);
				}else{
					$rcTmp = explode("_",$key);
					$rcDatos[$rcTmp[0].".".$rcTmp[2]] = $_REQUEST[$key];
				}
			}
		}
	}
	//Limpia el vector
	unset ($rcDatos["consult.flag"]);
	if (is_array($rcDatosDate)) {
		//Ajusta las fechas de Ingreso
		$rcTmp = setDates($rcDatosDate["orden.ordefecingd"], $rcDatosDate["orden.ordefecingd2"], $dateService);
		$rcDatosDate["orden.ordefecingd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecingd2"] = $rcTmp[1];
		//Ajusta las fechas de Registro
		$rcTmp = setDates($rcDatosDate["orden.ordefecregd"], $rcDatosDate["orden.ordefecregd2"], $dateService);
		$rcDatosDate["orden.ordefecregd"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecregd2"] = $rcTmp[1];
		//Ajusta las fechas de Vencimiento
		$rcTmp = setDates($rcDatosDate["orden.ordefecvend"], $rcDatosDate["orden.ordefecvend2"], $dateService);
		$rcDatosDate["orden.ordefecvend"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecvend2"] = $rcTmp[1];
		//Ajusta las fechas de Finalizacion
		$rcTmp = setDates($rcDatosDate["orden.ordefecfinad"], $rcDatosDate["orden.ordefecfinad2"], $dateService);
		$rcDatosDate["orden.ordefecfinad"] = $rcTmp[0];
		$rcDatosDate["orden.ordefecfinad2"] = $rcTmp[1];
	}
	//Extrae los campos del ordenamiento
	if($rcDatos[".ordenamiento"]){
		$camposOrdena = "14,".$rcDatos[".ordenamiento"];
		unset ($rcDatos[".ordenamiento"]);
	}else
		$camposOrdena = "14"; //Siempre se pinta el campo de orden
	//Carga el manager del listado
	$manager = Application :: getDomainController("ListadoOrdenManager");
	//Genera el sql
	$rcConsult = $manager->getListadoOrden($rcDatos, $rcDatosDate, $camposOrdena, $rcKeys ,$_REQUEST['children']);
	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser))
		$rcUser["lang"] = Application :: getSingleLang();
	if(!is_array($rcConsult)){
        include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
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
	
	//se pinta la cantidad de registros - freina - 24-Jun-2005
	if($rcConsult){
		$sbCantH = (string) sizeof($rcHead) + 1;
		$sbCant = (string) sizeof($rcConsult);
		$rcHtml[] = "<tr><td colspan='$sbCantH'>".$rclabels["total"]["label"].$sbCant."</td></tr>";
	}
	
	$rcHtml[] = "<tr>";
	foreach($rcHead as $headName)
		$rcHtml[] = "<td class='titulofila'>".$rclabels[$headName]["label"]."</td>";
    if($_REQUEST["consult__flag"] == 1)
        $rcHtml[] = "<td class='titulofila'>".$rclabels["action"]["label"]."</td>";
	$rcHtml[] = "</tr>";
	//Pinta el cuerpo de la consulta
	foreach($rcConsult as $key => $rcBody){
		$rcHtml[] = "<tr>";
		//Calcula el interlineado
		if(fmod($key,2)  ==  0)$estilo = "celda"; else $estilo = "celda2";
		foreach($rcBody as $value){
            if(!$value)
                $value = "&nbsp;";
			$rcHtml[] = "<td class='$estilo'>$value</td>";
        }
        if($_REQUEST["consult__flag"] == 1)
            $rcHtml[] = "<td class='$estilo'><a href='#' title='".$rclabels_generic["view"]."' onClick=\"javascript:fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadFicha&mainFrame=FeCrCmdDefaultBodyFichaOrd&orden__ordenumeros=".$rcBody["ordenumeros"]."&vars=orden__ordenumeros');\" ><img src='web/images/consultar_002.gif' border='0' title='".$rclabels_generic["view"]."'></a></td>";
		$rcHtml[] = "</tr>";
	}
	$rcHtml[] = "</table>";
    if($_REQUEST["consult__flag"] == 1){
        //Visualiza
        return implode("\n",$rcHtml);
    }else{
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
* @Copyright 2004 � FullEngine
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
?>
