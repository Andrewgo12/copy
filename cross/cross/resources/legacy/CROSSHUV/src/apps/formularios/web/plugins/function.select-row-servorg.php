<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_row_table_service_org
 * Version:  1.0
 * Date:     Mar 25, 2014
 * Author:	 Fernando Reina	<freina@fullengine.com>
 * Purpose:
 * Input:
 *      name = is the name of the select (required)
 *      table_name = name of table in data base (required)
 *      value = is the name of the row in the tabla that specifies the value of select (required)
 *      label = is the name of the row in the tabla that specifies the laber of select(optional)
 *      size = this sets the number of visible choices(optional)
 *      is_null = especifica si el 'select_row_table' debe tener el valor nulo.  'true|false' (optional)
 *		id = Id del objeto
 *     command = name of the command (optional)
 *
 * Examples:
 *       {select_row_table_service_org name="Mycombo" table_name="dept" value="deptno"}
 *       {select_row_table_service_org name="Mycombo" table_name="dept" value="deptno" label="dname" size="5" is_null="true" command="FeCrCmdDefaultOrden"}
 *
 * --------------------------------------------------------------------
 */
function smarty_function_select_row_servorg($params, & $smarty) {

	extract($params);
	extract($_REQUEST);

	settype($objService, "object");
	settype($rcTmp, "array");
	settype($rcData, "array");
	settype($sbid, "string");
	settype($sbCommand, "string");
	settype($sbHtml, "string");
	settype($sbIndex, "string");
	settype($sbValues, "string");
	settype($nuCont, "integer");
	settype($nuCant, "integer");


	$objService = Application::loadServices('General');
	$rcTmp = $objService->getParam("human_resources","SERV_ORG");

	if(is_array($rcTmp) && $rcTmp){

		//se obtienen las dependencias consideradas como servicios
		$objService = Application :: loadServices("Human_resources");
		$rcTmp = $objService->getEntesByIdInArray($rcTmp);

		if(is_array($rcTmp) && $rcTmp){
			
			//se organiza la informacion
			foreach($rcTmp as $sbIndex=>$sbValues){
				$rcData[$nuCont][$value] = $sbIndex;
				$rcData[$nuCont][$label] = $sbValues;
				$nuCont++;
			}
			

			if ($command_default) {
				$sbCommand = " onchange=\"action.value = '".$command_default."';submit();\" ";
			}else{
				if($onchange){
					$sbCommand = " onchange=\"".$onchange."\" ";
				}
			}
				
			$rcData = LimpiarDuplicados($rcData, $value);

			if (!isset ($label)) {
				$label = $value;
			}

			if (!isset ($size)) {
				$size = 1;
			}

			if (isset ($id)) {
				$sbid = " id=\"$id\"";
			}

			$sbHtml .= "<select name='$name' size='$size' $sbid ".$sbCommand.">";

			if ($is_null == "true") {
				$sbHtml .= "<option value=''>---</optional>";
			}
				
			$nuCant = sizeof($rcData);

			for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
				$sbHtml .= "<option value='";
				$sbHtml .= $rcData[$nuCont][$value];
				if ($_REQUEST[$name] == $rcData[$nuCont][$value]) {

					$sbHtml .= "' selected>";
				} else {
					$sbHtml .= "'>";
				}
				if(strstr($action,"ShowById")==false){
					$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
				}
				$sbHtml .= $rcData[$nuCont][$label];
				$sbHtml .= "</option>";
			}
			$sbHtml .= "</select>";
		}
	}

	return $sbHtml;
}

/*
 * Borra los valores duplicados que tenga una vector multidimencional.
 */
function LimpiarDuplicados($rcData, $indice) {

	settype($rcVector, "array");
	settype($nuCont, "integer");
	settype($nuCant, "integer");
	settype($nuIndex, "integer");

	$nuCant = sizeof($rcData);

	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if (!Existe_Registro($rcVector, $indice, $rcData[$nuCont][$indice])) {
			$rcVector[$nuIndex] = $rcData[$nuCont];
			$nuIndex ++;
		}
	}
	return $rcVector;
}

/*
 * Busca un registro en el vector,retorna 1 si lo encuentra
 * retorna 0 si no lo encuentra.
 */
function Existe_Registro($rcData, $indice, $sbValue) {

	settype($nuCont, "integer");
	settype($nuCant, "integer");

	$nuCant = sizeof($rcData);

	for ($nuCont = 0; $nuCont < count($rcData); $nuCont ++) {
		if ($rcData[$nuCont][$indice] === $sbValue) {
			return 1;
		}
	}
	return 0;
}
?>