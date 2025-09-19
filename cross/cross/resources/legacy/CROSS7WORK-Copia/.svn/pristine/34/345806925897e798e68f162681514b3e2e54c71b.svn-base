<?php
/**
 Copyright 2004 FullEngine

 Pinta un select con la data obtenida de un servicio.
 La data debe estar almacenada en un array
 @author freina <freina@parquesoft.com>
 @date 02-Sep-2004 10:13
 @location Cali-Colombia
 */
function smarty_function_select_estadotarea($params, & $smarty) {

	extract($params);
	settype($objService,"object");
	settype($objGateway,"object");
	settype($rcTmp, "array");
	settype($rcTmp_S, "array");
	settype($rcData, "array");
	settype($rcStatus, "array");
	settype($rcStatusD, "array");
	settype($sbHtml, "string");
	settype($sbProccodigos,"string");
	settype($sbTarecodigos,"string");
	settype($sbIndex, "string");
	settype($nuCont,"integer");

	$is_null="true";
	$value="esaccodigos";
	$label="esacnombres";
	$id="esaccodigos";
	$name="actaempresa__esaccodigos";

	//Carga el servicio del general
	//$obj = Application :: loadServices("Workflow");
	$obj = Application::getDataGateway('SqlExtended');

	//obtiene la data
	$rcData = $obj->getEstadostareaByActa($_REQUEST['acta'],$_REQUEST['tarecodigos']);


	if (!isset ($label)) {
		$label = $value;
	}
	if (!isset ($size)) {
		$size = 1;
	}

	$sbHtml .= "<select name='$name' size='$size' id='$id'>";
	if ($is_null == "true") {
		$sbHtml .= "<option value=''>---</optional>";
	}
	if ($rcData && is_array($rcData)) {

		//se obtiene el proceso del caso
		$objGateway = Application :: getDataGateway("orden");
		$rcTmp =  $objGateway->getByIdOrden($_REQUEST["ordenumeros"]);
		if(is_array($rcTmp) && $rcTmp){
			$sbProccodigos = $rcTmp[0]["proccodigos"];
			unset($rcTmp);
			if($_REQUEST['acta']){
				$objService = Application::loadServices("Workflow");
				$rcTmp = $objService->getByIdActa($_REQUEST['acta']);
				if(is_array($rcTmp) && $rcTmp){
					$sbTarecodigos = $rcTmp[0]["tarecodigos"];
				}
			}else{
				$sbTarecodigos = $_REQUEST['tarecodigos'];
			}
			if($sbProccodigos && $sbTarecodigos){
				$objService = Application::loadServices("Workflow");
				$rcStatus = $objService->getEstTarea($sbProccodigos, $sbTarecodigos);
				if(is_array($rcStatus) && $rcStatus){
					//se organiza el arreglo
					foreach($rcStatus as $nuCont=>$rcTmp){
						$rcTmp_S[$nuCont] = $rcTmp["rutaesactas"];
					}
					if(is_array($rcTmp_S) && $rcTmp_S){
						$rcTmp_S = array_unique($rcTmp_S);
					}
				}
				//se obtienen los estado por defecto
				$objService = Application::loadServices('General');
            	$rcStatusD = $objService->getParam("workflow","DEFAULT_STATUS");
            	if(is_array($rcStatusD) && $rcStatusD){
            		if(is_array($rcTmp_S) && $rcTmp_S){
            			$rcTmp_S = array_merge($rcTmp_S,$rcStatusD);
            		}else{
            			$rcTmp_S = $rcStatusD; 
            		}
            	}
			}

		}

		foreach ($rcData as $sbIndex => $rcTmp) {

			if(in_array($rcTmp[$value],$rcTmp_S)) {
					
				$sbHtml .= "<option value='";
				$sbHtml .= $rcTmp[$value];
				if ($_REQUEST[$name] == $rcTmp[$value]) {
					$sbHtml .= "' selected>";
				} else {
					$sbHtml .= "'>";
				}
				$sbHtml .= $rcTmp[$label];
				$sbHtml .= "</option>";
			}
		}
	}
	$sbHtml .= "</select>";
	print $sbHtml;
}
?>