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
function smarty_function_select_row_table_service_personal($params, & $smarty) {
	
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
	if(isset($listTiorcodigos))
	{
		$rcTior = explode(",",$listTiorcodigos);
		$objParams = Application::getDomainController("ParamsManager");
		foreach ($rcTior as $value)
			$rcTiorcodigos = array_merge($rcTiorcodigos,$objParams->getParam("human_resources",$value));
		$rcTiorcodigos = array_unique($rcTiorcodigos);
	}
	
	$objService = Application :: loadServices($service);
	if(isset($listTiorcodigos))
		$objService->tiorcodigos = $rcTiorcodigos;
	if(!$method)
	{
		$gateway = $objService->getGateWay($table_name);
		$v = call_user_func(array ($gateway, "getAll$table_name"));
	}
	else
		$v = $objService->$method();
	$objService->close();
	
	if(!$load)
		if($value)
			$load=$value;
	if(!$load)
		$load = $_REQUEST[$name];
	if (!isset ($size))
		$size = 1;
	if (isset ($id))
		$sbid = " id='$id'";
		
	if(!$value)
		if($field)
			$value = $field;
		
	$html_result = '';
	if($multiple==1){
		if(!$nuOptions){
			$size = sizeof($v);
			if($size > 10)
				$size = 10;
		}
		$html_result .= "<select name='".$name."[]' multiple size='$size' $sbid ".$sbCommand.">";
	}else
		$html_result .= "<select name='$name' size='$size' $sbid ".$sbCommand.">";
	
	if(!isset($is_null))
		$is_null = 1;
	if($is_null)
		$html_result .= "<option value=''>---</optional>";

	for ($i = 0; $i < count($v); $i ++) 
	{
		$html_result .= "<option value='";
		$html_result .= $v[$i][$value];
		if ($_REQUEST[$name] == $v[$i][$value])
			$html_result .= "' selected>";
		else
			$html_result .= "'>";

		if(strstr($action,"ShowById")==false)
    		$_REQUEST[$name] = stripslashes($_REQUEST[$name]);
		$html_result .= $v[$i][$label];
		$html_result .= " - ".$v[$i][$value];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";
	return $html_result;

}
?>
