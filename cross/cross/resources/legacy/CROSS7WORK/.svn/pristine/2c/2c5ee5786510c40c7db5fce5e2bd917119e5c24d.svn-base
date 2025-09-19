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


function smarty_function_select_father_preg($params, &$smarty)
{
	extract($params);
	extract($_REQUEST);
	$pregunta_manager = Application::getDomainController("PreguntaManagerExtended");
	$gateway =$pregunta_manager->getPreguntaByEjetematico($ejetematico__ejtecodigon);


	if(!isset($label)){
		$label = $value;
	}

	if(!isset($size)){
		$size = 1;
	}

	$html_result = '';
	$html_result .= "<select name='$name' size='$size'>";

	if($is_null == "true"){
		$html_result .= "<option value=''>---</optional>";
	}
	if($gateway){
		foreach ($gateway as $rcRow)
		{
			$html_result .= "<option value='";
			$html_result .= $rcRow["pregcodigon"];
			if($_REQUEST[$name]==$rcRow["pregcodigon"]){
				$html_result .= "' selected>";
			}else{
				$html_result .= "'>";
			}
			$html_result .= $rcRow["pregdescris"];
			$html_result .="</option>";
		}
	}
	$html_result .= "</select>";

	print $html_result;

}

?>
