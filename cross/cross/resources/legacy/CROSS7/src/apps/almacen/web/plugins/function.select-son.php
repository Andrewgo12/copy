<?php   
/*
 * Smarty plugin
 * Type:     function
 * Name:     select_hijo
 * Version:  1.0
 * Date:     Oct 30, 2003
 * Author:	 freina.<freina@parquesoft.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      table_hijo = is the name of the table child (required)
 *      id_hijo = is the primary of the table child (required)
 *      label_hijo = is the value of the field in the table child (optional)
 *      select_papa = name of the select father(required)
 *		foreign_name=name of the foreign key
 *
 * Examples: 
 *
 *    {select_father name="operacion__id_tipo_pieza"
 *    table_papa="tipo_pieza" id_papa="id" label_papa="nombre" command_default="CmdDefaultOperacion"}
 *
 *    {select_hijo name="operacion__id_modelo_pieza"
 *    table_hijo="modelo_pieza" id_hijo="id" label_hijo="nombre"
 *    select_papa="operacion__id_tipo_pieza"
 *    command_default="CmdDefaultOperacion"}
 *
 *    {select_hijo name="operacion__id_parte_pieza"
 *    table_hijo="Parte_pieza" id_hijo="id" label_hijo="nombre"
 *    select_papa="operacion__id_modelo_pieza,operacion__id_tipo_pieza"
 *    command_default="CmdDefaultOperacion"}
 *
 */
function smarty_function_select_son($params, & $smarty) {
	
	settype($rctmp,"array");
	settype($sbfunction,"string");
	settype($sbparametros,"string");
	settype($sbhtml_result,"string");
	settype($sbcommand,"string");
	settype($sbflag,"string");
	settype($nucant,"integer");
	extract($params);
	
	$sbflag = true;

	$sbhtml_result = '';
	if($command_default){
		$sbcommand =  " onchange=\"action.value = '".$command_default."';submit();\" "; 
	}
	$sbhtml_result .= "<select name='".$name."' id='".$id_hijo."' $sbcommand>";

	$v = explode(",", $select_papa);
	
	$nucant = count($v);

	for ($i = 0; $i < $nucant; $i ++) {
		if($_REQUEST[$v[$i]]){
			($i +1 < $nucant) ? ($sbparametros .= $_REQUEST[$v[$i]].',') : ($sbparametros .= $_REQUEST[$v[$i]]);
		}
		else{
			$sbflag = false;
			break;
		}
	}

	if ($sbflag) {

		if (!isset ($sqlid)) {
			
			$gateway = Application :: getDataGateway("$table_hijo");
			$sbfunction = "getBy".$table_hijo."_fkey".$foreign_name;
			$hijo = $gateway->$sbfunction($sbparametros);
			
		} else {
			$gateway = Application :: getDataGateway("SqlExtended");
			$rctmp = explode(",",$sbparametros);
			$hijo = $gateway->getAutoReference($sqlid,$rctmp);
		}

		$sbhtml_result .= "<option value=''>---</option>";

		for ($i = 0; $i < count($hijo); $i ++) {
			$sbhtml_result .= "<option value='";
			$sbhtml_result .= $hijo[$i][$id_hijo];
			if ($_REQUEST[$name] == $hijo[$i][$id_hijo]) {
				$sbhtml_result .= "' selected>";
			} else {
				$sbhtml_result .= "'>";
			}

			$sbhtml_result .= $hijo[$i][$label_hijo];
			$sbhtml_result .= "</option>";
		}
	} else {
		$sbhtml_result .= "<option value=''>---</option>";
	}

	$sbhtml_result .= "</select>";

	print $sbhtml_result;
}
?>