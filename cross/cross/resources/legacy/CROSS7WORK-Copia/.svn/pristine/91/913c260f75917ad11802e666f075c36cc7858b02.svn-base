<?php 
/**Copyright 2004 � FullEngine
Libreria de Centro de Consulta al cliente
@author cazapata <cazapata@parquesoft.com>
@date 03-sep-2004 11:08:26
@location Cali - Colombia
*/
function smarty_function_viewrevertperformance($params, & $smarty) {
	extract($_REQUEST);
	extract($params);
	
	settype($objGateway,"object");
	settype($objManager,"object");
	settype($rcUser,"array");
	settype($rcDataOrden,"array");
	settype($rcAnexos,"array");
	settype($rcTransfer,"array");
	settype($rcTmp,"array");
	settype($rcObservacion,"array");
    settype($rcObservaciones,"array");
	settype($sbValue,"string");
	settype($sbName,"string");
	settype($sbTmp,"string");
	settype($sbAppId,"string");
	settype($sbJavascript,"string");
	settype($sbActacodigos,"string");
	settype($sbAcemnumeros,"string");
	

    //Para cargar el lenguaje
	$rcUser = Application :: getUserParam();

	if($ordenumerosFO){
		$orden__ordenumeros = $ordenumerosFO; 
	}

	if (!$orden__ordenumeros && !$signal)
		return null;

	if (!$orden__ordenumeros && $signal){
        include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        echo "<script>alert('{$rcmessages[0]}')</script>";
        return null;
    }

    
    //Para cargar el lenguaje
	include ($rcUser["lang"]."/".$rcUser["lang"].".revertperformance.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	//Obtiene el Id de la aplicacion
	$sbAppId = Application :: getAppId();
	
    //Obtiene la compuerta
	$objGateway = Application :: getDataGateway("orden");
	
	//Busco la orden en la tabla orden
	$rcDataOrden = $objGateway->getByIdOrden($orden__ordenumeros);
	if (!$rcDataOrden){
        include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        echo "<script>alert('{$rcmessages[21]} $orden__ordenumeros')</script>";
		return null;
    }

	//Obtiene la compuerta
	$objGateway = Application :: getDataGateway("OrdenempresaExtended");
	
	//Busco la orden en ordenempresa
	$rcData = $objGateway->getByIdOrdenempresajoin($orden__ordenumeros);
	$rcObservacion['ordeobservs'] = $rcData['ordeobservs'];
    unset($rcData['ordeobservs']);
	unset($rcData["oremradicas"]);
	
	//Carga el servicio de control de fechas 
	$servceDate = Application :: loadServices("DateController");
	
	$rcHtml[] = "<table align='center' width='100%'>" ;
	$rcHtml[] = "<tr><th>".$rclabels["consulttitle"]."</th></tr>";
	$rcHtml[] ="<tr><td class='piedefoto'>";
	
	//Carga el servicio de HTML para elaborar las fichas y los listados
	$htmlService = Application :: loadServices("Html");
	$rcParams["cols"] = 2;
	$rcParams["size_table"] = "100%";
	$rcParams["size_data"] = "100%";
	$rcParams["size_label"] = "45%";
	$rcParams["size_puntos"] = "5%";
	$rcParams["size_datos"] = "50%";
	$rcHtml[] = $htmlService->genCard($rcData, $rclabels, $rcParams);
	$rcHtml[] = "</td></tr>";
	$rcHtml[] = "<tr><td>";
    $rcHtml[] = "<table align='center' width='100%'>";
    $rcHtml[] = "<tr><td>{$rclabels['ordeobservs']['label']} : {$rcObservacion['ordeobservs']}</td></tr>";
    $rcHtml[] = "</table>";
   $rcHtml[] = "</td></tr>"; 
	
	$objGeneral = Application::loadServices("General");
	$seguimiento = $objGeneral->getParam("cross300","TAREA_SEGUIMIENTO");
		
	//Trae las actas de la orden
	$objGateway = Application :: getDataGateway("SqlExtended");
	$objGateway->tarecodigos = $seguimiento;
	$rcActas = $objGateway->getActas($orden__ordenumeros);
	$rcHtml[] = "<tr><th>".$rclabels["tareas"]["label"]."</th></tr><tr><td class='piedefoto'>";

	//Arma las fichas de las actas
	if (is_array($rcActas)) {
		foreach ($rcActas as $rcTmpActa) {
			$rcHtml[] = "<table align='center' width='70%'>";
			$sbActacodigos = $rcTmpActa["actacodigos"];
            unset($rcTmpActa["actaactivas"]);
            unset($rcTmpActa["ordenumeros"]);
            unset($rcTmpActa["actacodigos"]);
            unset($rcTmpActa["actaestacts"]);
            
			if($rcTmpActa["tarecodigos"] == $seguimiento) {
				unset($rcTmpActa["esacnombres"]);
			}
			unset($rcTmpActa["tarecodigos"]);

            //Hace la conversion de fechas
            $rcTmpActa["actafechingn"] = $servceDate->fncformatofechahora($rcTmpActa["actafechingn"]);
            $rcTmpActa["actafechinin"] = $servceDate->fncformatofechahora($rcTmpActa["actafechinin"]);
            $rcTmpActa["actafechvenn"] = $servceDate->fncformatofechahora($rcTmpActa["actafechvenn"]);
            $rcParams["cols"] = 1;
            $rcParams["size_table"] = "100%";
            $rcParams["align"] = "center";
			$rcParams["size_table"] = "100%";
			$rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcTmpActa, $rclabels, $rcParams)."</td></tr>";
			
			//Consulta las atenciones del acta
			$rcAtenc = $objGateway->getListActaempresa($sbActacodigos);
			if (is_array($rcAtenc)) {
				$rcParams["align"] = "right";
				$rcParams["cols"] = 2;
				$rcParams["size_table"] = "80%";
				$rcHtml[] = "<tr><th><div align='left'>".$rclabels["atenciones"]["label"]."</div></th></tr>";
				foreach ($rcAtenc as $rcTmpAtenc) {
                    $rcObservaciones["acemobservas"] = $rcTmpAtenc["acemobservas"];
                    unset($rcTmpAtenc["acemobservas"]);
                    unset($rcTmpAtenc["acemradicas"]);
					$sbAcemnumeros = $rcTmpAtenc["acemnumeros"];
					$rcTmpAtenc["acemnumeros"] = "<font size=8><a href='#' title=\"".$rclabels_generic["CmdDelete"]."\" onClick=\"".$form.".action.value='".$sbAppId."CmdDeleteActaempresa';".
					$form.".acta.value='".$sbActacodigos."';".
					$form.".acemnumeros.value='".$sbAcemnumeros."';".
					$form.".orden.value='".$orden__ordenumeros."';".$form.".submit();\" >".$rclabels["delete"]["label"]."</a></font>";
					if (is_array($rcTmpAtenc["acemusuars"])) {
						foreach ($rcTmpAtenc["acemusuars"] as $k => $rcPersonal) {
							($rcPersonal["persrespons"] == 'S') ? $respon = "*" : $respon = "";
							$rcTemporal[$k] = ($k +1).". ({$rcPersonal["persidentifs"]}) {$rcPersonal["persnombres"]} {$rcPersonal["persapell1s"]} {$rcPersonal["persapell2s"]}$respon";
						}
						$rcTmpAtenc["acemusuars"] = implode("<br>\n", $rcTemporal);
					}
					$rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcTmpAtenc, $rclabels, $rcParams)."</td><tr>";
                                        $rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcObservaciones, $rclabels, $rcParams)."</td><tr>";
                                        
					//Consulta las actividades de una atencion
					$rcActividades = $objGateway->getActiviactaByAcem($sbAcemnumeros);
					if (is_array($rcActividades)) {
						$rcHtml[] = "<tr><td class='piedefoto'><table align='right' width='60%'>";
						
						//Pinta el encabezado
						$rcHtml[] = "<tr>
										<td class='titulofila'>".$rclabels["acticodigos"]["label"]."</td>
										<td class='titulofila'>".$rclabels["actinombres"]["label"]."</td>
									</tr>";
						foreach($rcActividades as $rcTmpValues){
							$rcHtml[] = "<tr>
											<td class=''>".$rcTmpValues["acticodigos"]."</td>
											<td class=''>".$rcTmpValues["actinombres"]."</td>
									 	</tr>";
						}
						$rcHtml[] = "</table></td></tr>";
					}

					//Consulta los compromisos de una atencion
					$gateway = Application :: getDataGateway("SqlExtended");
					$rcCompromisos = $gateway->getAcemcompromiByAcem($sbAcemnumeros);
					if (is_array($rcCompromisos)) {
						$estadosCompromisos = Application::getConstant("ACCOACTIVAS");
                        $rcHtml[] = "<tr><th><div align='left'>".$rclabels["compromisos"]["label"]."</div></th></tr>";
						$rcHtml[] = "<tr><td class='piedefoto'><table align='left' width='90%'>";
						
						//Pinta el encabezado
						$rcHtml[] = "<tr>
										<td class='titulofila'>".$rclabels["compcodigo"]["label"]."</td>
										<td class='titulofila'>".$rclabels["compdescris"]["label"]."</td>
										<td class='titulofila'>".$rclabels["accofecrevn"]["label"]."</td>
										<td class='titulofila'>".$rclabels["accoactivas"]["label"]."</td>
									</tr>";
						foreach($rcCompromisos as $rcTmpValues){
							$rcHtml[] = "<tr>
											<td class=''>".$rcTmpValues["compcodigos"]."</td>
											<td class=''>".$rcTmpValues["compdescris"]."</td>
											<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["accofecrevn"])."</td>
											<td class=''>".$estadosCompromisos[$rcTmpValues["accoactivas"]]."</td>
									 	</tr>";
						}
						$rcHtml[] = "</table></td></tr>";
					}


				}
			}
			$rcHtml[] = "<tr><td class='piedefoto'><hr></td></tr></table>";
		}
	}
	$rcHtml[] = "</td></tr></table>";
	return implode("\n", $rcHtml);
}
?>