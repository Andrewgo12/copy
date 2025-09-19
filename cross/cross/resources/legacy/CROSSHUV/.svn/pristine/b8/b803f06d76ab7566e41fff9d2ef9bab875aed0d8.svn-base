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
	settype($objGateway,"object");
	settype($objManager,"object");
	settype($rcanexos,"array");
	settype($rcTransfer,"array");
	settype($rcDataExtraActa,"array");
	settype($rcActaParams,"array");
	settype($rcTmp,"array");
	settype($rcTmpData,"array");
	settype($rcData_A,"array");
	settype($sbIndex,"string");
	settype($sbValue,"string");
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

	
	//Busco la orden en la tabla orden  (SQL 1)
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
	$rcData = $gateway->getByIdOrdenempresajoin($orden__ordenumeros); //(SQL 2,3,4,5,6)

	$rcTmpData = $gateway->getByOrdenOrdenempresa($orden__ordenumeros);   //(SQL 7,8,9,10,11,12,13,14,15,16,17,18)
	$rcParams['proccodigos'] = $rcTmpData[0]['proccodigos'];
	$rcParams['tiorcodigos'] = $rcTmpData[0]['tiorcodigos'];
	$rcParams['evencodigos'] = $rcTmpData[0]['evencodigos'];
	$rcParams['causcodigos'] = $rcTmpData[0]['causcodigos'];

	//Traigo el gurpo de interés
	$rcGrupoInteres = $gateway->getReqByGrupoInteres($orden__ordenumeros);

        if(is_array($rcGrupoInteres) && !empty($rcGrupoInteres)){	
           $rcData["grincodigos"] = $rcGrupoInteres[0]["grinnombres"];
        }
        else{
           $rcData["grincodigos"]=null;
        }

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
	$dimensionManager->execute();                                //(SQL 19,20)

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
	unset($rcData['oremradicas']);

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
	//se actualizan los labels
	$rcTmp = changeDesc($rcTmpData[0]);    ////(SQL 21,22,23,24,25)
	
	if($rcTmp && is_array($rcTmp)){
		foreach($rcTmp as $sbIndex=>$sbValue){
			if($sbValue){
				$rcData[$sbIndex] = $sbValue;
			}
		}
	}

	$rcHtml[] = $htmlService->genCard($rcData, $rclabels, $rcParams);
	$rcHtml[] = "</td></tr>";
	if(is_array($rcExtraData) && $rcExtraData){
		unset($rcExtraData["ordenumeros"]);
		$rcHtml[] = "<tr><td class='piedefoto'>";
		$rcHtml[] = $htmlService->genCard($rcExtraData, $rclabels, $rcParams);
		$rcHtml[] = "</td></tr>";
	}

	$rcHtml[] = "<tr><td class='piedefoto'>";
	$rcHtml[] = "<table align='center' width='100%'>";
	$rcHtml[] = "<tr><td>{$rclabels['ordeobservs']['label']} : {$rcObservacion['ordeobservs']}</td></tr>";
	$rcHtml[] = "</table>";

	//obtiene los anexos de la orden
	$rcHtml[] = paintCasesFiles($orden__ordenumeros, $rclabels);   //(SQL 26)

	//Trae las actas de la orden
	$gateway = Application :: getDataGateway("SqlExtended");
	$rcActas = $gateway->getActas($orden__ordenumeros);            //(SQL 27)
	$rcHtml[] = "<tr><td class='piedefoto'><hr></td></tr>";
	$rcHtml[] = "<tr><td></td></tr><tr><td class='piedefoto'>";

	//Arma las fichas de las actas
	if (is_array($rcActas)) {
		
		//se obtien la compuerta de atenciones
		$objGateway = Application :: getDataGateway("actaempresa");
		
		$rcHtml[] = "<table align='left' width='90%'>";
		foreach ($rcActas as $rcTmpActa) {
			$rcHtml[] = "<tr><th>".$rclabels["tareas"]["label"]."</th></tr>";
			$rcParams["cols"] = 1;
			$actacodigos = $rcTmpActa["actacodigos"];
			$rcActaParams["tarecodigos"] = $rcTmpActa["tarecodigos"];
			//actualizacion de labels deacuerdo al lenguaje
			$rcTmp = changeDesc($rcTmpActa);                        //(SQL 28,29)
			if($rcTmp && is_array($rcTmp)){
				foreach($rcTmp as $sbIndex=>$sbValue){
					if($sbValue){
						$rcTmpActa[$sbIndex] = $sbValue;
					}
				}
			}
			unset($rcTmpActa["actacodigos"]);
			unset($rcTmpActa["actaactivas"]);
			unset($rcTmpActa["ordenumeros"]);
			unset($rcTmpActa["actaestacts"]);
			$rcParams["size_table"] = "100%";
			$rcParams["align"] = "center";
			unset($rcTmpActa["tarecodigos"]);

			$rcTmpActa["actafechingn"] = $servceDate->fncformatofechahora($rcTmpActa["actafechingn"]);
			$rcTmpActa["actafechinin"] = $servceDate->fncformatofechahora($rcTmpActa["actafechinin"]);
            $rcTmpActa["actafechvenn"] = $servceDate->fncformatofechahora($rcTmpActa["actafechvenn"]);
			$rcHtml[] = "<tr><td class='piedefoto'>".$htmlService->genCard($rcTmpActa, $rclabels, $rcParams)."</td><tr>";

			//Consulta las transferencias del acta
			$gateway = Application :: getDataGateway("SqlExtended");
			$rcTranferencias = $gateway->getTranfertarea($actacodigos);       //(SQL 30)
			if(is_array($rcTranferencias)){
				$rcHtml[] = "<tr><th><div align='left'>".$rclabels["transferencia"]["label"]."</div></th></tr>";
				$rcHtml[] = "<tr><td class='piedefoto'><table align='left' width='90%'>";

				//Pinta el encabezado
				$rcHtml[] = "<tr>
								<td class='titulofila'>".$rclabels["organombres"]["label"]."</td>
								<td class='titulofila'>".$rclabels["trtafecingn"]["label"]."</td>
								<td class='titulofila'>".$rclabels["trtafechan"]["label"]."</td>
								<td class='titulofila'>".$rclabels["trtaobservas"]["label"]."</td>
							</tr>";
				foreach($rcTranferencias as $rcTmpValues){
					$rcHtml[] = "<tr>
									<td class=''>".$rcTmpValues["organombres"]."</td>
									<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["trtafecingn"])."</td>
									<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["trtafechan"])."</td>
									<td class=''>".$rcTmpValues["trtaobservas"]."</td>
							 	</tr>";
				}
				$rcHtml[] = "</table></td></tr>";
			}

			//Consulta las atenciones del acta
			$rcAtenc = $gateway->getListActaempresa($actacodigos);            //(SQL 31)
			if (is_array($rcAtenc)) {
				$rcParams["align"] = "left";
				$rcParams["cols"] = 1;
				$rcParams["size_table"] = "90%";
				$rcHtml[] = "<tr><th><div align='left'>".$rclabels["atenciones"]["label"]."</div></th></tr>";
				foreach ($rcAtenc as $rcTmpAtenc) {
					
					//actualizacion de labels deacuerdo al lenguaje
					$rcData_A = $objGateway->getByIdActaempresa($actacodigos,$rcTmpAtenc["acemnumeros"]);
					if($rcData_A && is_array($rcData_A)){
						$rcTmp = changeDesc($rcData_A[0]);
						if($rcTmp && is_array($rcTmp)){
							foreach($rcTmp as $sbIndex=>$sbValue){
								if($sbValue){
									$rcTmpAtenc[$sbIndex] = $sbValue;
								}
							}
						}	
					}
					
					$actencion = $rcTmpAtenc["acemnumeros"];
					$rcDataExtraActa = getDataAdicionalActa($actencion, $rcDataOrden, $rcActaParams);
					$rcObservaciones["acemobservas"] = $rcTmpAtenc["acemobservas"];
					unset($rcTmpAtenc["acemnumeros"]);
					unset($rcTmpAtenc["acemobservas"]);
					unset($rcTmpAtenc["acemradicas"]);
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
					$rcHtml[] = "<tr><th><div align='left'>".$rclabels["acemobservas"]["label"]."</div></th></tr>";
					$rcHtml[] = "<tr><td>".$rcObservaciones["acemobservas"]."</td></tr>";
					$rcHtml[] = "</table>";
					$rcHtml[] = "</td><tr>";
					if (is_array($rcDataExtraActa) && $rcDataExtraActa) {
						unset($rcDataExtraActa["acemnumeros"]);
						$rcHtml[] = "<tr><td class='piedefoto'>";
						$rcHtml[] = "<table align='left' width='90%'>";
						$rcHtml[] = "<tr><td class='piedefoto'>".getFichaDataAdicionalActa($rcDataExtraActa, $rclabels,$rcParams)."</td><tr>";
						$rcHtml[] = "</table>";
						$rcHtml[] = "</td><tr>";
					}
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
						//actualizacion de labels deacuerdo al lenguaje
							$rcTmp = changeDesc($rcTmpValues);
							if($rcTmp && is_array($rcTmp)){
								foreach($rcTmp as $sbIndex=>$sbValue){
									if($sbValue){
										$rcTmpValues[$sbIndex] = $sbValue;
									}
								}
							}
							$rcHtml[] = "<tr>
											<td class=''>".$rcTmpValues["acticodigos"]."</td>
											<td class=''>".$rcTmpValues["actinombres"]."</td>
									 	</tr>";
						}
						$rcHtml[] = "</table></td></tr>";
					}
					//Consulta los compromisos de una atencion
					$rcCompromisos = $gateway->getAcemcompromiByAcem($actencion);
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
							$rcTmp = changeDesc($rcTmpValues);
							if($rcTmp && is_array($rcTmp)){
								foreach($rcTmp as $sbIndex=>$sbValue){
									if($sbValue){
										$rcTmpValues[$sbIndex] = $sbValue;
									}
								}
							}
							$rcHtml[] = "<tr>
											<td class=''>".$rcTmpValues["compcodigos"]."</td>
											<td class=''>".$rcTmpValues["compdescris"]."</td>
											<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["accofecrevn"])."</td>
											<td class=''>".$estadosCompromisos[$rcTmpValues["accoactivas"]]."</td>
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
/**
 * @copyright Copyright 2006 FullEngine
 * Archivos anexos del caso
 * @param array $rcLabels Arreglo con los labels
 * @param string $sbOrdenumeros Cadena con el codigo del caso
 * @author freina<freina@parquesoft.com>
 * @date 02-Jun-2007 12:35
 * @location Cali-Colombia
 */
function paintCasesFiles($sbOrdenumeros, $rcLabels) {

	settype($objGateway, "object");
	settype($objService, "object");
	settype($rcResult, "array");
	settype($rcTmp, "array");
	settype($rcParams, "array");
	settype($rcTiposFile, "array");
	settype($sbHtml, "string");
	settype($sbTipo, "string");
	settype($sbTmp, "string");
	settype($nuCont, "integer");

	if ($sbOrdenumeros) {

		//se obtienen los posibles archivos anexos de la atencion.
		$objService = Application :: loadServices('General');
		$rcTiposFile = $objService->getConstant('TIPO_FILE');
		$sbTipo = $rcTiposFile["anexo"];
		$objService = Application :: loadServices('General');
		$objGateway = $objService->loadGateway('Archivos');
		$rcResult = $objGateway->getDescArchivo($sbTipo, $sbOrdenumeros);
		$objService->close();
		if ($rcResult) {

			$rcParams["cols"] = 1;
			$rcParams["size_table"] = "100%";
			$rcParams["size_data"] = "100%";
			$rcParams["size_label"] = "45%";
			$rcParams["size_puntos"] = "5%";
			$rcParams["size_datos"] = "50%";

			$objService = Application :: loadServices("Html");

			//se pinta el href
			foreach ($rcResult as $nuCont => $rcTmp) {
				$sbTmp .= "<a href='#' "."onclick=\"fncopenwindows('FeCrCmdDefaultDownloadFile','archcodigon={$rcTmp['archcodigon']}');\" "."title='{$rcLabels['descargar']['label']}'>".$rcTmp['archnombres']."</a><br>";
			}

			$rcA["files"] = $sbTmp;
			$sbHtml .= "<tr><td class='piedefoto'><hr></td></tr>";
			$sbHtml .= "<tr><th>".$rcLabels["anexos"]["label"]."</th></tr><tr><td class='piedefoto'>";
			$sbHtml .= "<table align='center' width='50%'><tr><td class='piedefoto'>";
			$sbHtml .= $objService->genCard($rcA, $rcLabels, $rcParams);
			$sbHtml .= "</td></tr></table></td></tr>";
		}
	}
	return $sbHtml;
}
/**
 * @Copyright 2010  FullEngine
 *
 * Obtiene las datos dinamicos de  las actas.
 * @param string $sbAcemnumeros codigo de la atencion
 * @param array $rcData Arreglo con los datos de la orden
 * @param array $ircParams arreglo con los parametros de busqueda (codigo de la tarea)
 * @return array $rcResult arreglo con la data
 * @author freina<freina@parquesoft.com>
 * @date 24-Oct-2010  19:51
 * @location Cali - Colombia
 */
function getDataAdicionalActa($sbAcemnumeros, $rcData, $rcParams) {

	settype($objService, "object");
	settype($objManager, "object");
	settype($objGateway, "object");
	settype($rcVadidominios, "array");
	settype($rcDimension, "array");
	settype($rcField, "array");
	settype($rcDateFields, "array");
	settype($rcUser, "array");
	settype($rcResult, "array");
	settype($sbResult, "string");
	settype($sbTable, "string");

	//se obtiene el dominio de los datos
	$objService = Application :: loadServices("General");
	$rcVadidominios = $objService->getParam("general", "DOM_COL_DIN");

	//datos del usuario
	$rcUser = Application :: getUserParam();

	$objService = Application :: loadServices('General');
	$objManager = $objService->InitiateClass('DimensionManager');
	$objManager->setCodidominios('proceso');
	$objManager->setCodidomicams('proccodigos');
	$objManager->setCodidomivals($rcData[0]['proccodigos']);
	$objManager->setIdProcess($rcUser["username"]);
	$objManager->setVadidominios($rcVadidominios['atencion']);
	$objManager->setVadidomivals($sbAcemnumeros);
	$objManager->setParams($rcParams);
	$objManager->setOperation('getValorDimension');
	$objManager->execute();
	$sbResult = $objManager->getResult();
	$sbTable = $objManager->getTmpTable();
	$rcDimension = $objManager->getDetalleDimension();
	$objService->close();

	//Consulta los datos adicionales
	if ($sbResult) {
		//Determina los campos fecha
		if (is_array($rcDimension)) {
			foreach ($rcDimension as $rcField) {
				if ($rcField['dediformatos'] == 'date')
				$rcDateFields[] = $rcField['dedinombres'];
			}
		}
		$objGateway = Application :: getDataGateway("OrdenempresaExtended");
		$rcResult = $objGateway->getDataAdicionalActa($sbTable, $rcDateFields);
		if($rcResult){
			unset($rcResult["ordenumeros"]);
		}
	}
	return $rcResult;
}
/**
 * @Copyright 2010  FullEngine
 *
 * Obtiene las datos dinamicos de  las actas.
 * @param array $rcData Arreglo con los datos de la orden
 * @param array $rcLabels Arreglo con los labels
 * @param array $rcParams Arreglo con parametros de visualizacion
 * @return array $sbResult string con la ficha
 * @author freina<freina@parquesoft.com>
 * @date 24-Oct-2010  19:52
 * @location Cali - Colombia
 */
function getFichaDataAdicionalActa($rcData, $rcLabels,$rcParams=null) {

	settype($objservice, "object");
	settype($sbResult, "string");

	if ($rcData) {
		if($rcParams){
			$rcParams["cols"] = 2;
			$rcParams["size_table"] = "100%";
			$rcParams["size_data"] = "100%";
			$rcParams["size_label"] = "45%";
			$rcParams["size_puntos"] = "5%";
			$rcParams["size_datos"] = "50%";
		}
		$objservice = Application :: loadServices("Html");
		$sbResult = $objservice->genCard($rcData, $rcLabels, $rcParams);
	}
	return $sbResult;
}
//======================================
/**
*   Propiedad intelectual del FullEngine.
*
*   cambia los descriptores de acuerdo al lenguaje.
*   @author freina
*   @date 21-Apr-2012 18:45
*   @location Cali-Colombia
*/
function changeDesc($rcData){
	
	settype($objService,"object");
	settype($rcResult,"array");
	settype($rcConstant,"array");
	settype($rcTmp,"array");
	settype($sbIndex,"string");
	settype($sbValue,"string");
	settype($sbTmp,"string");
	settype($sbResult,"string");
	settype($sbTiorcodigos,'string');
	settype($sbEvencodigos,"string");
	
	if($rcData && is_array($rcData)){
		$sbTiorcodigos = $rcData["tiorcodigos"];
		$sbEvencodigos = $rcData["evencodigos"];
		//se obtiene la constante de configuracion
		$objService = Application :: loadServices("General");
		$rcConstant = Application :: getConstant("TAB_TIP_DESC");
		$objService->close();
		foreach($rcData as $sbIndex=>$sbValue){
			switch($sbIndex){
				case "tiorcodigos":
					$rcTmp = $rcConstant["tipoorden"];
					$sbResult = getDescLang("tipoorden",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;	
					} 
				break;
				case "evencodigos":
					$rcTmp = $rcConstant["evento"];
					$sbTmp = $sbTiorcodigos.",".$sbValue;
					$sbResult = getDescLang("evento",$sbTmp,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;
					} 
				break;
				case "causcodigos":
					$rcTmp = $rcConstant["causa"];
					$sbTmp = $sbTiorcodigos.",".$sbEvencodigos.",".$sbValue;
					$sbResult = getDescLang("causa",$sbTmp,$rcTmp);
					if($sbResult){
						$rcResult["causcodigos"] = $sbResult;
					} 
				break;
				case "merecodigos":
					$rcTmp = $rcConstant["mediorecepcion"];
					$sbResult = getDescLang("mediorecepcion",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;
					} 
				break;
				case "priocodigos":
					$rcTmp = $rcConstant["prioridad"];
					$sbResult = getDescLang("prioridad",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult["priocodigos"] = $sbResult;
					} 
				break;
				case "tarecodigos":
					$rcTmp = $rcConstant["tarea"];
					$sbResult = getDescLang("tarea",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;
					} 
				break;
				case "actaestacts":
					$rcTmp = $rcConstant["estadoacta"];
					$sbResult = getDescLang("estadoacta",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;	
					} 
				break;
				case "acticodigos":
					$rcTmp = $rcConstant["actividad"];
					$sbResult = getDescLang("actividad",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;	
					}
				break;
				case "compcodigos":
					$rcTmp = $rcConstant["compromiso"];
					$sbResult = getDescLang("compromiso",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult[$rcTmp["name_desc"]] = $sbResult;	
					}
				break;
				case "esaccodigos":
					$rcTmp = $rcConstant["estadoacta"];
					$sbResult = getDescLang("estadoacta",$sbValue,$rcTmp);
					if($sbResult){
						$rcResult["esaccodigos"] = $sbResult;	
					} 
				break;
			}
		}	
	}
	
	return $rcResult;
}
/**
*   Propiedad intelectual del FullEngine.
*
*   Obtiene los descriptores de acuerdo al lenguaje.
*   @author freina
*   @date 21-Apr-2012 18:45
*   @location Cali-Colombia
*/
function getDescLang($sbTatlnomtabls,$sbTatlvalcods,$rcTemplate){

	settype($objService,"object");
	settype($objGateway,"object");
	settype($rcResult,"array");
	settype($rcUser,"array");
	settype($sbResult,"string");
	
	if($sbTatlnomtabls && $sbTatlvalcods && $rcTemplate && is_array($rcTemplate)){
		
		//Para cargar el lenguaje
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		//se obtiene la constante de configuracion
		$objService = Application :: loadServices("General");
		//$rcConstante = Application :: getConstant("TAB_TIP_DESC");
		$objGateway = $objService->getGateWay("tablastipole");
		$objGateway->setData(array("tatlnomtabls"=>$sbTatlnomtabls,"tatlnomcacos"=>$rcTemplate["primarykey"],
								   "tatlnocadess"=>$rcTemplate["name_desc"],"tatlvalcods"=>$sbTatlvalcods,"langcodigos"=>$rcUser["lang"]));
		$objGateway->getTablastipoleByParams();
		$rcResult = $objGateway->getResult();
		$objService->close();
		if($rcResult && is_array($rcResult)){
			$sbResult = $rcResult[0]["tatlvaldesls"];
		}
	}
	
	return $sbResult;
}
?>
