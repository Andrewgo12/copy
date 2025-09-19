<?php


/*** @Copyright 2004 Â© FullEngine
*
* Smarty plugin: Pinta el listado de consulta
* @author creyes <cesar.reyes@parquesoft.com>
* @date 14-feb-2005 14:44:19
* @location Cali - Colombia
* example: {consult_table table_name="personal" llaves="perscodigos" form_name="
* frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
*/

function smarty_function_consult_table_orden($params, & $smarty) {
	extract($params);

	settype($rcTmp, "array");
	settype($rcParam, "array");
	settype($sbIndex, "string");
	settype($sbValue,"string");
	settype($sbId,"string");
	settype($sbSql, "string");
	settype($nuCont, "integer");
	
	$sbId = 'CR3';

	if (!$_REQUEST['sqlConsult']) {
		
		unset($_SESSION[$sbId."_curr_page"]);
		
		//Trae el sql para ejecutar
		$gateWay = Application :: getDataGateway("SqlExtended");
		if ($sqlid) {
			$rcreq["sql"] = $gateWay->getSqlConsult($sqlid, $rcParam);
		} else {
			if (!$viewfields)
				$viewfields = '*';
			$rcreq["sql"] = $gateWay->getGenericSql($table_name, $viewfields);
		}

		//Busca los valores de la interfaz para ejecutar filtros
		foreach ($_REQUEST as $key => $value) {
			if ((strpos($key,"__")!==false) && $value) {
				if(strpos($key,'__')!==0){
					$nameField = str_replace('__', ".", $key);
					$rcFields[$nameField] = $value;	
				}
			}
		}
		
		if(is_array($rcFields)){
			if(array_key_exists("ordenempresa.orgacodigos",$rcFields)) {
				$rcFields["acta.orgacodigos"] = $rcFields["ordenempresa.orgacodigos"];
				unset($rcFields["ordenempresa.orgacodigos"]);
			}
			foreach ($rcFields as $key => $value){
				if(!(strpos($key, "anexos"))){
					unset($rcFields[$key]);
				}	
			}	
		}
		
		//se elimina la informacion de las columnas dinamicas
		$rcFields = cleanDynamicColumns($rcFields);

		$rcreq["sql"] = $gateWay->setFilterSql($rcreq["sql"], $rcFields);
		$sbSql = htmlentities(html_entity_decode($rcreq["sql"]));
		echo "<input type='hidden' name='sqlConsult' value=\"".$sbSql."\">";
	} else {
		$rcreq["sql"] = html_entity_decode(stripslashes($_REQUEST['sqlConsult']));
		$sbSql = htmlentities(html_entity_decode($rcreq["sql"]));
		echo "<input type='hidden' name='sqlConsult' value=\"".$sbSql."\">";
	}
	$rcreq["sql"] = htmlentities(html_entity_decode($rcreq["sql"]));
	$rcreq["sql"] = html_entity_decode($rcreq["sql"]);
	
	if(is_array($_REQUEST) && $_REQUEST){
		foreach($_REQUEST as $sbIndex=>$sbValue){
			if($sbIndex!=$sbId."_next_page" && $sbIndex!="link" && $sbIndex!="order_by"){
				unset($_REQUEST[$sbIndex]);
			}
		}
	}

	$rcreq["service"] = $service;
	$rcreq["datefields"] = $date_fields;
	$rcreq["action"] = $command;
	$rcreq["table"] = $table_name;
	$rcreq["view_fields"] = "*";
	$rcreq["key_return"] = $llaves;
	$rcreq["order_by"] = $_REQUEST["order_by"];
	$appId = Application :: getAppId();
	$rcreq["command"] = $appId."CmdShowById".ucfirst($table_name);
	$rcreq["form"] = $form_name; // add by Diego Ramirez Software House
	$rcreq["jsfunction"] = "loadConsult";
	if ($cache == "true")
		$rcreq["cache"] = true;
	else
		$rcreq["cache"] = false;
	if ($num_rows)
		$rcreq["num_rows"] = $num_rows;
	else
		$rcreq["num_rows"] = 20;

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
		return;
	$rcLlaves = explode(",", $llaves);

	//'&var1='+value0+'&var2='+var3
	foreach ($rcLlaves as $key => $value) {
		$rcTmpParams[] = "keyValue$key";
		$rcTmpValues[] = "'&".$table_name."__".$value."='+keyValue$key";
	}
	//Pinta la funcion de javascript
	$jsCad = "\n<script language='javascript'>"."\nfunction loadConsult(cmd,".implode(",", $rcTmpParams)."){"."	\n\tlocation.href='index.php?action='+cmd+".implode("+", $rcTmpValues).";
					}\n</script>\n";
	echo $jsCad;

	//Carga las etiquetas de la tabla en la sesion
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, $sbId, true, false);
	$pager->Render();
}
/**
    * Copyright 2006 FullEngine
    * 
    * funcion para limpiar campos dinamicos
    * @author freina<freina@parquesoft.com>
    * @param array $rcData Arreglo con los datos de la interfaz 	
    * @date 06-March-2006 12:39:00
    * @location Cali-Colombia
*/
function cleanDynamicColumns($rcData) {

	settype($objService, "object");
	settype($objManager, "object");
	settype($rcUser, "array");
	settype($rcDetalle, "array");
	settype($rcDimension, "array");
	settype($sbResult, "string");
	settype($sbIndex, "string");
	settype($sbValue, "string");
	settype($nuDimecodigon, "integer");
	
	$sbResult=false;
	
	if ($rcData) {
		//se determina si existe las dimeciones
		foreach ($rcData as $sbIndex => $sbValue) {
			if((strpos($sbIndex,"dimension")!==false) && $rcData[$sbIndex]){
				$sbResult=true;
				break;
			}
		}

		if ($sbResult) {

			$rcDimension = explode(",", $rcData[$sbIndex]);
			unset ($rcData[$sbIndex]);

			//Carga el servicio de human_resources
			$rcUser = Application :: getUserParam();
			$objService = Application :: loadServices('General');
			$objManager = $objService->InitiateClass('DimensionManager');
			foreach ($rcDimension as $nuDimecodigon) {
				$objManager->setCodDimension($nuDimecodigon);
			}
			$objManager->setOperation('getDetalleDimensionById');
			$objManager->setIdProcess($rcUser["username"]);
			$sbResult = $objManager->execute();
			if ($sbResult) {
				$rcDetalle = $objManager->getDetalleDimension();
			}
			$objService->close();
			
			if ($rcDetalle) {
				//se procede a eliminar las columnas dinamicas del arreglo de datos
				
				if(array_walk($rcData, "clean", $rcDetalle) && $rcData){
					foreach($rcData as $sbIndex=>$sbValue){
						if($sbValue){
							$rcTmp[$sbIndex]=$sbValue;
						}
					}
					$rcData=$rcTmp;
				}
			}
		}
	}
	
	return $rcData;
}
/**
    * Copyright 2006 FullEngine
    * 
    * funcion que elimina una posicion del arreglo de datos si se encuentra en 
    * el arreglo de dimenciones
    * @author freina<freina@parquesoft.com>
    * @param string $sbValue Cadena con el valor de la posicion del arreglo 	
    * @param string $sbIndex Cadena con el id del arreglo
    * @param array $rcDetalle Arreglo con los indices de la dimencion
    * @date 06-March-2006 13:21:00
    * @location Cali-Colombia
*/
function clean(&$sbValue, $sbindex, $rcDetalle) {

	settype($rcTmp, "array");
	settype($nuIndex, "integer");
	if ((strpos($sbindex,"ordenumeros")===false)) {
		
		foreach ($rcDetalle as $nuIndex => $rcTmp) {
			if (strpos($sbindex,$rcTmp["dedinombres"])!==false) {
				$sbValue=null;
				break;
			}
		}
	}
}
?>