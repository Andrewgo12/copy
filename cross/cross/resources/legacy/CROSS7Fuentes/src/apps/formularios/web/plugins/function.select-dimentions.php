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
function smarty_function_select_dimentions($params, & $smarty) {
	
	extract($params);
	extract($_REQUEST);
	
	settype($rcParams, "array");
	settype($rcTmp, "array");
	settype($sbid, "string");
	settype($nuCont, "integer");
	$rcTmp[0] = $rcRow;
	
	$rcUser = Application::getUserParam();
	$generalService = Application::loadServices('General');
    $dimensionManager = $generalService->InitiateClass('DimensionManager');
    $dimensionManager->setIdProcess($rcUser["username"]);
    $dimensionManager->setOperation('getDataReferenceField');
    
    $dimensionManager->rcDetalleDimension = $rcTmp;
	$dimensionManager->execute();
	$v = $dimensionManager->getReference();
	list($sbKey,$v) = each($v);
	
	if (!isset ($label)) {
		$label = $value;
	}

	if (isset ($id)) {
		$sbid = " id=\"$id\"";
	}

	$html_result = '';
	$html_result .= "<select name='$name' id=$id ";
	if (isset($accesskey))
		$html_result .= " accesskey='".$accesskey."'";
	$html_result .= "><option value=''>---</optional>";

	$nuTam = sizeof($v);
	for ($i = 0; $i < $nuTam; $i ++) {
		$html_result .= "<option value='";
		$html_result .= $v[$i][0];
		if ($_REQUEST[$name] == $v[$i][0] || strtoupper($_REQUEST[$name]) == strtoupper($v[$i][1])) {
			$html_result .= "' selected>";
		} else {
			$html_result .= "'>";
		}
		if(strstr($action,"ShowById")==false)
    		$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
		$html_result .= $v[$i][1];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";

	return $html_result;

}
?>