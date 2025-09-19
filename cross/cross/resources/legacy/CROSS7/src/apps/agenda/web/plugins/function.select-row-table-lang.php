<?php 
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     select_row_table
 * Version:  1.0
 * Date:     Dic 03, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
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
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno"}
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno" label="dname" size="5" is_null="true" command="FeCrCmdDefaultOrden"}
 *
 * --------------------------------------------------------------------
 */
function smarty_function_select_row_table_lang($params, & $smarty) {
	
	extract($params);
	extract($_REQUEST);
	
	settype($rcParams, "array");
	settype($rcTmp, "array");
	settype($sbid, "string");
	settype($sbCommand, "string");
	settype($nuCont, "integer");
	
	if ($command_default) {
		$sbCommand = " onchange=\"action.value = '".$command_default."';submit();\" ";
	}else{
		if($onchange){
			$sbCommand = " onchange=\"".$onchange."\" ";
		}
	}
	
	if (!isset ($sqlid)) {
		$gateway = Application :: getDataGateway("$table_name");
		$v = call_user_func(array ($gateway, "getAll$table_name"));
	} else {
		if($param){
			$rcTmp = explode(",",$param);
			foreach($rcTmp as $sbIndex){
				$rcParams[$nuCont] = $_REQUEST[$sbIndex];
				$nuCont ++;
			}
			
		}
		$gateway = Application :: getDataGateway("SqlExtended");
		$v = $gateway->getDataCombo($sqlid,$rcParams);
	}
	
	$v = limpiarValoresDuplicados($v, $value);
	
	$v = getDescLang($v,$table_name,$value,$label);

	if (!isset ($label)) {
		$label = $value;
	}

	if (!isset ($size)) {
		$size = 1;
	}

	if (isset ($id)) {
		$sbid = " id=\"$id\"";
	}

	$html_result = '';
	$html_result .= "<select name='$name' size='$size' $sbid ".$sbCommand.">";

	if ($is_null == "true") {
		$html_result .= "<option value=''>---</optional>";
	}

	for ($i = 0; $i < count($v); $i ++) {
		$html_result .= "<option value='";
		$html_result .= $v[$i][$value];
		if ($_REQUEST[$name] == $v[$i][$value]) {
			$html_result .= "' selected>";
		} else {
			$html_result .= "'>";
		}
		if(strstr($action,"ShowById")==false)
    		$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
    	$html_result .= $v[$i][$label];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";

	return $html_result;

}

/*
* Borra los valores duplicados que tenga una vector multidimencional.
*/
function limpiarValoresDuplicados($v, $indice) {
	$indice_vector_nuevo = 0;
	$nuevo_vector;

	for ($i = 0; $i < count($v); $i ++) {
		if (!existeRegistro($nuevo_vector, $indice, $v[$i][$indice])) {
			$nuevo_vector[$indice_vector_nuevo] = $v[$i];
			$indice_vector_nuevo ++;
		}
	}
	return $nuevo_vector;
}

/*
* Busca un registro en el vector,retorna 1 si lo encuentra
* retorna 0 si no lo encuentra.
*/
function existeRegistro($nuevo_vector, $indice, $dato_buscar) {
	for ($i = 0; $i < count($nuevo_vector); $i ++) {
		if ($nuevo_vector[$i][$indice] === $dato_buscar) {
			return 1;
		}
	}
	return 0;
}
/**
*   Propiedad intelectual del FullEngine.
*
*   Obtiene los descripotores de acuerdo al lenguaje.
*   @author freina
*   @date 06-Sep-2004 07:33
*   @location Cali-Colombia
*/
function getDescLang($rcData,$sbTable,$sbKey,$sbName){

	settype($objService,"object");
	settype($rcResult,"array");
	settype($rcConstante,"array");
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcIndex,"array");
	settype($sbValue,"string");
	settype($nuCont,"integer");
	settype($nuRow,"string");
	
	if($rcData && is_array($rcData) && $sbTable && $sbKey && $sbName){
		
		//Para cargar el lenguaje
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion
			$rcUser["lang"] = Application :: getSingleLang();
		}
		
		$sbTable = strtolower($sbTable);
		$sbKey = strtolower($sbKey);
		$sbName = strtolower($sbName);
		
		//se obtiene la constante de configuracion
		$objService = Application :: loadServices("General");
		$rcConstante = Application :: getConstant("TAB_TIP_DESC");
		$objGateway = $objService->getGateWay("tablastipole");
		$objGateway->setData(array("entidad"=>$sbTable,"langcodigos"=>$rcUser["lang"]));
		$objGateway->getByTatlnomtabls_Langcodigos();
		$rcTmp = $objGateway->getResult();
		$objService->close();
		
		if($rcConstante && is_array($rcConstante) && $rcTmp && is_array($rcTmp)){
			$rcConstante = $rcConstante[$sbTable];
			foreach($rcTmp as $nuRow=>$rcRow){
				$rcIndex[$rcRow["tatlvalcods"]] = $rcRow["tatlvaldesls"]; 
			}
			
			//por ultimo se toma el valor de del nuevo lenguaje y se actualiza
			foreach($rcData as $nuCont=>$rcTmp){
				$rcResult[$nuCont][$sbKey] = $rcTmp[$sbKey];
				$rcResult[$nuCont][$sbName] = $rcIndex[$rcTmp[$sbKey]];
			}
		}else{
			$rcResult = $rcData;
		}
	}
	
	return $rcResult;
}
?>