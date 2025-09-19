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


function smarty_function_select_data_from_param($params, &$smarty)
{
	//Este plugin se caracteriza por sacar todo de un constant
	extract($params);
	extract($_REQUEST);
	
	$objGeneral = Application :: loadServices("General");
	$rcValues = $objGeneral->getParam($module,$param);

	if(isset($onchange))
		$onchange = 'onchange="'.$onchange.'"';	
		
	$html_result = '';
	$html_result .= "<select name='".$name."' $onchange id='".$id."'>";
	$html_result .= "<option value='' Selected>---</option>";
	
	if(is_array($rcValues)) {
		foreach ($rcValues as $row)
		{
			$html_result .= "<option value='";
			$html_result .= $row[0];
			if(array_key_exists($name,$_REQUEST))
			{
				if($_REQUEST[$name] && $_REQUEST[$name]==$row[0])
				{
					$html_result .= "' selected>";
				}
				else
				{
					$html_result .= "'>";
				}
			}
			else
			{
				$html_result .= "'>";
			}
			$html_result .= $row[1];
			$html_result .="</option>";
		}
	}
	$html_result .= "</select>";
	return $html_result;
}
?>