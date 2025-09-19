<?php 
/**Copyright 2004 FullEngine
*
* Consulta y visualiza la ficha de requerieminto
* @author creyes <cesar.reyes@parquesoft.com>
* @date 03-sep-2004 11:08:26
* @location Cali - Colombia
*/
function smarty_function_viewfichaord($params, & $smarty) {
	extract($_REQUEST);
	
	settype($gateway,"object");
	settype($objManager,"object");
	settype($rcanexos,"array");
	settype($rcTransfer,"array");
	settype($rctmp,"array");
	settype($sbvalue,"string");
	settype($sbname,"string");
	settype($sbTmp,"string");
	
	if($ordenumerosFO){
		$orden__ordenumeros = $ordenumerosFO; 
	}

	if (!$orden__ordenumeros)
		return false;

        //Para cargar el lenguaje
	$rcuser = Application :: getUserParam();
    
	include ($rcuser["lang"]."/".$rcuser["lang"].".fichaord.php");
	
        //Obtiene la compuerta
	$gateway = Application :: getDataGateway("orden");
	//Busco la orden en la tabla orden
	$rcDataOrden = $gateway->getByIdOrden($orden__ordenumeros);
	if (!is_array($rcDataOrden)){
        include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
        echo "<script language='javascript'>alert('".$rcmessages[21]." $orden__ordenumeros')\n" .
        " if(parent.opener!=null){\n" .
        " parent.close();\n".
        "}\n".
        "</script>";
		return null;
    }

	//Obtiene la compuerta
	$gateway = Application :: getDataGateway("OrdenempresaExtended");
	//Busco la orden en ordenempresa
	$rcData = $gateway->getByIdOrdenempresajoin($orden__ordenumeros);
    $rcTmpData = $gateway->getByOrdenOrdenempresa($orden__ordenumeros);
    $rcParams['tiorcodigos'] = $rcTmpData[0]['tiorcodigos'];
    $rcParams['evencodigos'] = $rcTmpData[0]['evencodigos'];
    $rcParams['causcodigos'] = $rcTmpData[0]['causcodigos'];
    unset($rcTmpData);

    $generalService = Application::loadServices('General');
    $dimensionManager = $generalService->InitiateClass('DimensionManager');
    $dimensionManager->setCodidominios ('proceso');
    $dimensionManager->setCodidomicams ('proccodigos');
    $dimensionManager->setCodidomivals ($rcDataOrden[0]['proccodigos']);
    $dimensionManager->setIdProcess($rcuser["username"]);
    $dimensionManager->setVadidominios ('ordenumeros');
    $dimensionManager->setVadidomivals ($orden__ordenumeros);
    $dimensionManager->setParams($rcParams);
    $dimensionManager->setOperation ('getValorDimension');
    $dimensionManager->execute();
    $result = $dimensionManager->getResult();
    $tmpTable = $dimensionManager->getTmpTable();
    $rcDimension = $dimensionManager->getDetalleDimension();
    $generalService->close();
    
    //Consulta los datos adicionales
    if($result){
        //Determina los campos fecha
        if(is_array($rcDimension)){
            foreach($rcDimension as $rcField){
                if($rcField['dediformatos'] == 'date')
                    $rcDateFields[] = $rcField['dedinombres'];
            }
        }
        $rcExtraData = $gateway->getDataFichaAdicional($tmpTable, $orden__ordenumeros, $rcDateFields);
    }
    
    
	$rcObservacion['ordeobservs'] = $rcData['ordeobservs'];
    unset($rcData['ordeobservs']);
	
	//Carga el servicio de control de fechas 
	$servceDate = Application :: loadServices("DateController");
	
	$rcHtml[] = "<table align='center' width='90%'><tr><th>".$rclabels["title"]."</th></tr><tr><td class='piedefoto'>";
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
    if(is_array($rcExtraData)){
        $rcHtml[] = "<tr><td class='piedefoto'>";
        $rcHtml[] = $htmlService->genCard($rcExtraData, $rclabels, $rcParams);
        $rcHtml[] = "</td></tr>";
    }
    $rcHtml[] = "<tr><td class='piedefoto'>";
    $rcHtml[] = "<table align='center' width='100%'>";
    $rcHtml[] = "<tr><td>{$rclabels['ordeobservs']['label']} : {$rcObservacion['ordeobservs']}</td></tr>";
    $rcHtml[] = "</table>";
	
	//obtiene los anexos de la orden
	$gateway = Application :: getDataGateway("anexos");
	$rcanexos = $gateway->getByAnexos_fkey($orden__ordenumeros);
	if($rcanexos){
		
		foreach($rcanexos as $rctmp){
			$sbname =$orden__ordenumeros."__".$rctmp["anexnombarch"];
			$sbvalue .="<a href=# onclick=\"OpenWindows('data/anexos/".$sbname."');\">".$rctmp["anexnombarch"]."</a><br>";
		}
		$rcHtml[] = "<tr><th>".$rclabels["anexos"]["label"]."</th></tr><tr><td class='piedefoto'>";
		$rcHtml[] = "<table align='center' width='50%'><tr><td class='piedefoto'>";
		//Carga el servicio de HTML para elaborar las fichas y los listados
		$rcParams["cols"] = 1;
		unset($rctmp);
		$rctmp["files"] = $sbvalue; 
		$rcHtml[] = $htmlService->genCard($rctmp, $rclabels, $rcParams);
		$rcHtml[] = "</td></tr></table></td></tr>";
	}
		
	//Trae las actas de la orden
	$gateway = Application :: getDataGateway("SqlExtended");
	$rcActas = $gateway->getActas($orden__ordenumeros);
	$rcHtml[] = "<tr><td class='piedefoto'><hr></td></tr>";
	$rcHtml[] = "<tr><td></td></tr><tr><td class='piedefoto'>";

	//Arma las fichas de las actas
	if (is_array($rcActas)) {
		$rcHtml[] = "<table align='left' width='90%'>";
		foreach ($rcActas as $rcTmpActa) {
            $rcHtml[] = "<tr><th>".$rclabels["tareas"]["label"]."</th></tr>";
            $rcParams["cols"] = 1;
            $actacodigos = $rcTmpActa["actacodigos"];
            unset($rcTmpActa["actacodigos"]);
            unset($rcTmpActa["actaactivas"]);
            unset($rcTmpActa["ordenumeros"]);
            unset($rcTmpActa["actaestacts"]);
            $rcParams["size_table"] = "100%";
            $rcParams["align"] = "center";
            //Hace la conversion de fechas
            $rcTmpActa["actafechingn"] = $servceDate->fncformatofechahora($rcTmpActa["actafechingn"]);
			$rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcTmpActa, $rclabels, $rcParams)."</td><tr>";
			//Consulta las transferencias del acta
            $rcTranferencias = $gateway->getTranfertarea($actacodigos);
            if(is_array($rcTranferencias)){
                $rcHtml[] = "<tr><th><div align='left'>".$rclabels["transferencia"]["label"]."</div></th></tr>";
				$rcHtml[] = "<tr><td class='piedefoto'><table align='left' width='90%'>";
				//Pinta el encabezado
				$rcHtml[] = "<tr>
								<td class='titulofila'>".$rclabels["organombres"]["label"]."</td>
								<td class='titulofila'>".$rclabels["trtafechan"]["label"]."</td>
							</tr>";
				foreach($rcTranferencias as $rcTmpValues){
					$rcHtml[] = "<tr>
									<td class=''>".$rcTmpValues["organombres"]."</td>
									<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["trtafechan"])."</td>
							 	</tr>";
				}
				$rcHtml[] = "</table></td></tr>";
            }

            //Consulta las atenciones del acta
			$rcAtenc = $gateway->getListActaempresa($actacodigos);
			if (is_array($rcAtenc)) {
				$rcParams["align"] = "left";
				$rcParams["cols"] = 1;
				$rcParams["size_table"] = "90%";
				$rcHtml[] = "<tr><th><div align='left'>".$rclabels["atenciones"]["label"]."</div></th></tr>";
				foreach ($rcAtenc as $rcTmpAtenc) {
                    $actencion = $rcTmpAtenc["acemnumeros"];
                    $rcObservaciones["acemobservas"] = $rcTmpAtenc["acemobservas"]; 
                    unset($rcTmpAtenc["acemnumeros"]);
                    unset($rcTmpAtenc["acemobservas"]);
					if (is_array($rcTmpAtenc["acemusuars"])) {
						foreach ($rcTmpAtenc["acemusuars"] as $k => $rcPersonal) {
							($rcPersonal["persrespons"] == 'S') ? $respon = "*" : $respon = "";
							$rcTemporal[$k] = ($k + 1).". ({$rcPersonal["persidentifs"]}) {$rcPersonal["persnombres"]} {$rcPersonal["persapell1s"]} {$rcPersonal["persapell2s"]}$respon";
						}
						$rcTmpAtenc["acemusuars"] = implode("<br>\n", $rcTemporal);
					}
					$rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcTmpAtenc, $rclabels, $rcParams)."</td><tr>";
                    $rcHtml[] = "<tr><td class='piedefoto'>";
                    $rcHtml[] = "<table align='left' width='90%'>";
                    $rcHtml[] = "<tr><td>{$rclabels['acemobservas']['label']} : {$rcObservaciones["acemobservas"]}</td></tr>";
                    $rcHtml[] = "</table>";
                    $rcHtml[] = "</td><tr>";
                    
//                    $rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcObservaciones, $rclabels, $rcParams)."</td><tr>";
					//Consulta las actividades de una atencion
					$rcActividades = $gateway->getActiviactaByAcem($actencion);
					if (is_array($rcActividades)) {
                        $rcHtml[] = "<tr><th><div align='left'>".$rclabels["actividades"]["label"]."</div></th></tr>";
						$rcHtml[] = "<tr><td class='piedefoto'><table align='left' width='90%'>";
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
					$rcHtml[] = paintAttentionFiles($actencion,$rclabels);
                    $rcHtml[] = "<tr><td class='piedefoto'><hr></td></tr>";
				}
			}
		}
		$rcHtml[] = "<tr><td class='piedefoto'><hr></td></tr></table></td></tr>";
	}
	$rcHtml[] = "</table>";
	return implode("\n", $rcHtml);
}
/**
* @copyright Copyright 2006 FullEngine
* Archivos anexos a la atencion
* @param array $rcLabels Arreglo con los labels
* @param string $sbAcemnumeros Cadena con el codigo de la atencion
* @author freina<freina@parquesoft.com>
* @date 20-Dec-2006 17:32
* @location Cali-Colombia
*/
function paintAttentionFiles($sbAcemnumeros,$rcLabels){
	
	settype($objGateway,"object");
	settype($objService,"object");
	settype($rcResult,"array");
	settype($rcTmp,"array");
	settype($rcParams,"array");
	settype($rcTiposFile,"array");
	settype($sbHtml,"string");
	settype($sbTipo,"string");
	settype($sbTmp,"string");
	settype($nuCont,"integer");
	
	if($sbAcemnumeros){
		
		//se obtienen los posibles archivos anexos de la atencion.
		$objService = Application::loadServices('General');
    	$rcTiposFile = $objService->getConstant('TIPO_FILE');
    	$sbTipo = $rcTiposFile["atencion"];
    	$objService = Application::loadServices('General');
        $objGateway = $objService->loadGateway('Archivos');
        $rcResult = $objGateway->getDescArchivo($sbTipo,$sbAcemnumeros);
        $objService->close();
        if($rcResult){
        	
        	$rcParams["cols"] = 1;
			$rcParams["size_table"] = "100%";
			$rcParams["size_data"] = "100%";
			$rcParams["size_label"] = "45%";
			$rcParams["size_puntos"] = "5%";
			$rcParams["size_datos"] = "50%";
			
			$objService = Application :: loadServices("Html");
        	
        	//se pinta el href
        	foreach($rcResult as $nuCont=>$rcTmp){
        		$sbTmp .="<a href='#' " .
        				"onclick=\"fncopenwindows('FeCrCmdDefaultDownloadFile','archcodigon={$rcTmp['archcodigon']}');\" " .
        				"title='{$rcLabels['descargar']['label']}'>".$rcTmp['archnombres']."</a><br>";
        	}
        	
        	$rcA["files"]=$sbTmp;
        	$sbHtml .= "<tr><th>".$rcLabels["anexos_at"]["label"]."</th></tr><tr><td class='piedefoto'>";
			$sbHtml .= "<table align='center' width='50%'><tr><td class='piedefoto'>";
			$sbHtml .= $objService->genCard($rcA, $rcLabels, $rcParams);
			$sbHtml .= "</td></tr></table></td></tr>";
        }
	}
	return $sbHtml;
}
?>