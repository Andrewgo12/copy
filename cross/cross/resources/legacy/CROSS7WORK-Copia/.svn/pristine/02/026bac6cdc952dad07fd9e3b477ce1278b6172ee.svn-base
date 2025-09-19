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
*
* Examples:
*       {select_row_table name="Mycombo" table_name="dept" value="deptno"}
*       {select_row_table name="Mycombo" table_name="dept" value="deptno" label="dname" size="5" is_null="true"}
*
* --------------------------------------------------------------------
*/
function smarty_function_select_constant($params, &$smarty){
	//Este plugin se caracteriza por sacar todo de un constant
	extract($params);
	extract($_REQUEST);
	
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($sbValues,"string");
	
	if($sqlid){
		$objData = Application::getDataGateway("sqlExtended");
		$rcValues = $objData->getAutoReference($sqlid);
		if(is_array($rcValues)){
			foreach ($rcValues as $rcData)
				$rcValores[$rcData["authusernams"]] = $rcData["authrealname"]." ".$rcData["authrealape1"];
			$rcValues = $rcValores;
		}
	}else{
		$rcValues = Application::getConstant(strtoupper($id));
		if($labelfont){
			$rcUser = Application::getUserParam();
			if(!is_array($rcUser)){
				//Si no existe usuario en sesion 
				$rcUser["lang"] = Application::getSingleLang();
			}
			$labelfont = strtolower($labelfont);
			include($rcUser["lang"]."/".$rcUser["lang"].".$labelfont.php");
			if(is_array($rcValues) && $rcValues){
				foreach($rcValues as $sbValues){
					$rcTmp[$sbValues] = $rclabels[$sbValues]["label"];
				}
				$rcValues = $rcTmp;
			}
		}
	}
	
	if(is_array($rcValues)){
		$rcValues = array_unique($rcValues);
	}

	if(isset($onChange))
		$onChange = "onChange='".$onChange."'";	
		
	$html_result = '';
	$html_result .= "<select name='".$name."' $onChange id='".$id."'>";
	$html_result .= "<option value='' Selected>---</option>";
	
	if(is_array($rcValues))
	while (list($sbKey,$sbValue) = each($rcValues)){
		$html_result .= "<option value='";
		$html_result .= $sbKey;
		if(array_key_exists($name,$_REQUEST)){
			if($_REQUEST[$name] && $_REQUEST[$name]==$sbKey){
				$html_result .= "' selected>";
			}
			else{
				$html_result .= "'>";
			}
		}
		else{
			$html_result .= "'>";
		}
		$html_result .= $sbValue;
		$html_result .="</option>";
	}
	$html_result .= "</select>";
	return $html_result;
}
?>